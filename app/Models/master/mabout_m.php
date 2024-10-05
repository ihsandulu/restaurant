<?php

namespace App\Models\master;

use App\Models\core_m;

class mabout_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek about
        if ($this->request->getPostGet("about_id")) {
            $aboutd["about_id"] = $this->request->getPostGet("about_id");
        } else {
            $aboutd["about_id"] = -1;
        }
        $us = $this->db
            ->table("about")
            ->getWhere($aboutd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "about_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $about) {
                foreach ($this->db->getFieldNames('about') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $about->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('about') as $field) {
                $data[$field] = "";
            }
        }

        //upload image
        $data['uploadabout_picture1'] = "";
        if (isset($_FILES['about_picture1']) && $_FILES['about_picture1']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('about_picture1');
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
                $direktori = 'images/about_picture1'; //definisikan direktori upload            
                $about_picture1 = str_replace(' ', '_', $name);
                $about_picture1 = date("H_i_s_") . $about_picture1; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $about_picture1) {
                        delete_files($direktori, $about_picture1); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->about($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $about_picture1)) {
                    $data['uploadabout_picture1'] = "Upload Success !";
                    $input['about_picture1'] = $about_picture1;
                } else {
                    $data['uploadabout_picture1'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadabout_picture1'] = "Format File Salah !";
            }
        } 

        //upload image
        $data['uploadabout_picture2'] = "";
        if (isset($_FILES['about_picture2']) && $_FILES['about_picture2']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('about_picture2');
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
                $direktori = 'images/about_picture2'; //definisikan direktori upload            
                $about_picture2 = str_replace(' ', '_', $name);
                $about_picture2 = date("H_i_s_") . $about_picture2; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $about_picture2) {
                        delete_files($direktori, $about_picture2); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->about($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $about_picture2)) {
                    $data['uploadabout_picture2'] = "Upload Success !";
                    $input['about_picture2'] = $about_picture2;
                } else {
                    $data['uploadabout_picture2'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadabout_picture1'] = "Format File Salah !";
            }
        } 

        //delete
        if ($this->request->getPost("delete") == "OK") {  
              
                $this->db
                ->table("about")
                ->delete(array("about_id" => $this->request->getPost("about_id"),"about_id" =>$this->request->getPost("about_id")));
                $data["message"] = "Delete Success";
            
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'about_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["about_id"] = $this->request->getPost("about_id");

            $builder = $this->db->table('about');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $about_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;
        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'about_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["about_id"] = $this->request->getPost("about_id");
            $this->db->table('about')->update($input, array("about_id" => $this->request->getPost("about_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
