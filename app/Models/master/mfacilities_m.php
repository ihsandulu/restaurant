<?php

namespace App\Models\master;

use App\Models\core_m;

class mfacilities_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek facilities
        if ($this->request->getPostGet("facilities_id")) {
            $facilitiesd["facilities_id"] = $this->request->getPostGet("facilities_id");
        } else {
            $facilitiesd["facilities_id"] = -1;
        }
        $us = $this->db
            ->table("facilities")
            ->getWhere($facilitiesd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "facilities_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $facilities) {
                foreach ($this->db->getFieldNames('facilities') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $facilities->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('facilities') as $field) {
                $data[$field] = "";
            }
        }

        //upload image
        $data['uploadfacilities_picture'] = "";
        if (isset($_FILES['facilities_picture']) && $_FILES['facilities_picture']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('facilities_picture');
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
                $direktori = 'images/facilities_picture'; //definisikan direktori upload            
                $facilities_picture = str_replace(' ', '_', $name);
                $facilities_picture = date("H_i_s_") . $facilities_picture; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $facilities_picture) {
                        delete_files($direktori, $facilities_picture); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->facilities($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $facilities_picture)) {
                    $data['uploadfacilities_picture'] = "Upload Success !";
                    $input['facilities_picture'] = $facilities_picture;
                } else {
                    $data['uploadfacilities_picture'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadfacilities_picture'] = "Format File Salah !";
            }
        } 

        //delete
        if ($this->request->getPost("delete") == "OK") {  
              
                $this->db
                ->table("facilities")
                ->delete(array("facilities_id" => $this->request->getPost("facilities_id"),"facilities_id" =>$this->request->getPost("facilities_id")));
                $data["message"] = "Delete Success";
            
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'facilities_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["facilities_id"] = $this->request->getPost("facilities_id");

            $builder = $this->db->table('facilities');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $facilities_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;
        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'facilities_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["facilities_id"] = $this->request->getPost("facilities_id");
            $this->db->table('facilities')->update($input, array("facilities_id" => $this->request->getPost("facilities_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
