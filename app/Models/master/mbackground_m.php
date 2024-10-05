<?php

namespace App\Models\master;

use App\Models\core_m;

class mbackground_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek background
        if ($this->request->getPostGet("background_id")) {
            $backgroundd["background_id"] = $this->request->getPostGet("background_id");
        } else {
            $backgroundd["background_id"] = -1;
        }
        $us = $this->db
            ->table("background")
            ->getWhere($backgroundd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "background_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $background) {
                foreach ($this->db->getFieldNames('background') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $background->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('background') as $field) {
                $data[$field] = "";
            }
        }

        //upload image
        $data['uploadbackground_picture'] = "";
        if (isset($_FILES['background_picture']) && $_FILES['background_picture']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('background_picture');
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
                $direktori = 'images/background_picture'; //definisikan direktori upload            
                $background_picture = str_replace(' ', '_', $name);
                $background_picture = date("H_i_s_") . $background_picture; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $background_picture) {
                        delete_files($direktori, $background_picture); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->background($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $background_picture)) {
                    $data['uploadbackground_picture'] = "Upload Success !";
                    $input['background_picture'] = $background_picture;
                } else {
                    $data['uploadbackground_picture'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadbackground_picture'] = "Format File Salah !";
            }
        } 

        //delete
        if ($this->request->getPost("delete") == "OK") {  
              
                $this->db
                ->table("background")
                ->delete(array("background_id" => $this->request->getPost("background_id"),"background_id" =>$this->request->getPost("background_id")));
                $data["message"] = "Delete Success";
            
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'background_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["background_id"] = $this->request->getPost("background_id");

            $builder = $this->db->table('background');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $background_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;
        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'background_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["background_id"] = $this->request->getPost("background_id");
            $this->db->table('background')->update($input, array("background_id" => $this->request->getPost("background_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
