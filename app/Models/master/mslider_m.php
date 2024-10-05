<?php

namespace App\Models\master;

use App\Models\core_m;

class mslider_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek slider
        if ($this->request->getPostGet("slider_id")) {
            $sliderd["slider_id"] = $this->request->getPostGet("slider_id");
        } else {
            $sliderd["slider_id"] = -1;
        }
        $us = $this->db
            ->table("slider")
            ->getWhere($sliderd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "slider_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $slider) {
                foreach ($this->db->getFieldNames('slider') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $slider->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('slider') as $field) {
                $data[$field] = "";
            }
        }

        //upload image
        $data['uploadslider_picture'] = "";
        if (isset($_FILES['slider_picture']) && $_FILES['slider_picture']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('slider_picture');
            $name = $file->getName(); // Mengetahui Nama File
            $originalName = $file->getClientName(); // Mengetahui Nama Asli
            $tempfile = $file->getTempName(); // Mengetahui Nama TMP File name
            $ext = $file->getClientExtension(); // Mengetahui extensi File
            $type = $file->getClientMimeType(); // Mengetahui Mime File
            $size_kb = $file->getSize('kb'); // Mengetahui Ukuran File dalam kb
            $size_mb = $file->getSize('mb'); // Mengetahui Ukuran File dalam mb


            //$namabaru = $file->getRandomName();//define nama fiel yang baru secara acak

            if ($type == 'image/jpg'||$type == 'image/jpeg'||$type == 'image/png') //cek mime file
            {    // File Tipe Sesuai   
                helper('filesystem'); // Load Helper File System
                $direktori = 'images/slider_picture'; //definisikan direktori upload            
                $slider_picture = str_replace(' ', '_', $name);
                $slider_picture = date("H_i_s_") . $slider_picture; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $slider_picture) {
                        delete_files($direktori, $slider_picture); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->slider($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $slider_picture)) {
                    $data['uploadslider_picture'] = "Upload Success !";
                    $input['slider_picture'] = $slider_picture;
                } else {
                    $data['uploadslider_picture'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadslider_picture'] = "Format File Salah !";
            }
        } 

        //delete
        if ($this->request->getPost("delete") == "OK") {  
              
                $this->db
                ->table("slider")
                ->delete(array("slider_id" => $this->request->getPost("slider_id"),"slider_id" =>$this->request->getPost("slider_id")));
                $data["message"] = "Delete Success";
            
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'slider_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["slider_id"] = $this->request->getPost("slider_id");

            $builder = $this->db->table('slider');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $slider_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;
        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'slider_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["slider_id"] = $this->request->getPost("slider_id");
            $this->db->table('slider')->update($input, array("slider_id" => $this->request->getPost("slider_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
