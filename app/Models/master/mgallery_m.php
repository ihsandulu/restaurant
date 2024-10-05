<?php

namespace App\Models\master;

use App\Models\core_m;

class mgallery_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek gallery
        if ($this->request->getPostGet("gallery_id")) {
            $galleryd["gallery_id"] = $this->request->getPostGet("gallery_id");
        } else {
            $galleryd["gallery_id"] = -1;
        }
        $us = $this->db
            ->table("gallery")
            ->getWhere($galleryd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "gallery_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $gallery) {
                foreach ($this->db->getFieldNames('gallery') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $gallery->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('gallery') as $field) {
                $data[$field] = "";
            }
        }

        //upload image
        $data['uploadgallery_picture'] = "";
        if (isset($_FILES['gallery_picture']) && $_FILES['gallery_picture']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('gallery_picture');
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
                $direktori = 'images/gallery_picture'; //definisikan direktori upload            
                $gallery_picture = str_replace(' ', '_', $name);
                $gallery_picture = date("H_i_s_") . $gallery_picture; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $gallery_picture) {
                        delete_files($direktori, $gallery_picture); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->gallery($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $gallery_picture)) {
                    $data['uploadgallery_picture'] = "Upload Success !";
                    $input['gallery_picture'] = $gallery_picture;
                } else {
                    $data['uploadgallery_picture'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadgallery_picture'] = "Format File Salah !";
            }
        } 

        //delete
        if ($this->request->getPost("delete") == "OK") {  
              
                $this->db
                ->table("gallery")
                ->delete(array("gallery_id" => $this->request->getPost("gallery_id"),"gallery_id" =>$this->request->getPost("gallery_id")));
                $data["message"] = "Delete Success";
            
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'gallery_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["gallery_id"] = $this->request->getPost("gallery_id");

            $builder = $this->db->table('gallery');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $gallery_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;
        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'gallery_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["gallery_id"] = $this->request->getPost("gallery_id");
            $this->db->table('gallery')->update($input, array("gallery_id" => $this->request->getPost("gallery_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
