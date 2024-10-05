<?php

namespace App\Models\master;

use App\Models\core_m;

class msosmed_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek sosmed
        if ($this->request->getPostGet("sosmed_id")) {
            $sosmedd["sosmed_id"] = $this->request->getPostGet("sosmed_id");
        } else {
            $sosmedd["sosmed_id"] = -1;
        }
        $us = $this->db
            ->table("sosmed")
            ->getWhere($sosmedd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "sosmed_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $sosmed) {
                foreach ($this->db->getFieldNames('sosmed') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $sosmed->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('sosmed') as $field) {
                $data[$field] = "";
            }
        }

        //upload image
        $data['uploadsosmed_picture1'] = "";
        if (isset($_FILES['sosmed_picture1']) && $_FILES['sosmed_picture1']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('sosmed_picture1');
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
                $direktori = 'images/sosmed_picture1'; //definisikan direktori upload            
                $sosmed_picture1 = str_replace(' ', '_', $name);
                $sosmed_picture1 = date("H_i_s_") . $sosmed_picture1; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $sosmed_picture1) {
                        delete_files($direktori, $sosmed_picture1); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->sosmed($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $sosmed_picture1)) {
                    $data['uploadsosmed_picture1'] = "Upload Success !";
                    $input['sosmed_picture1'] = $sosmed_picture1;
                } else {
                    $data['uploadsosmed_picture1'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadsosmed_picture1'] = "Format File Salah !";
            }
        } 

        //upload image
        $data['uploadsosmed_picture2'] = "";
        if (isset($_FILES['sosmed_picture2']) && $_FILES['sosmed_picture2']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('sosmed_picture2');
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
                $direktori = 'images/sosmed_picture2'; //definisikan direktori upload            
                $sosmed_picture2 = str_replace(' ', '_', $name);
                $sosmed_picture2 = date("H_i_s_") . $sosmed_picture2; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $sosmed_picture2) {
                        delete_files($direktori, $sosmed_picture2); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->sosmed($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $sosmed_picture2)) {
                    $data['uploadsosmed_picture2'] = "Upload Success !";
                    $input['sosmed_picture2'] = $sosmed_picture2;
                } else {
                    $data['uploadsosmed_picture2'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadsosmed_picture1'] = "Format File Salah !";
            }
        } 

        //delete
        if ($this->request->getPost("delete") == "OK") {  
              
                $this->db
                ->table("sosmed")
                ->delete(array("sosmed_id" => $this->request->getPost("sosmed_id"),"sosmed_id" =>$this->request->getPost("sosmed_id")));
                $data["message"] = "Delete Success";
            
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'sosmed_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["sosmed_id"] = $this->request->getPost("sosmed_id");

            $builder = $this->db->table('sosmed');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $sosmed_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;
        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'sosmed_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["sosmed_id"] = $this->request->getPost("sosmed_id");
            $this->db->table('sosmed')->update($input, array("sosmed_id" => $this->request->getPost("sosmed_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
