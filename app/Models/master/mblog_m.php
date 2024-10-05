<?php

namespace App\Models\master;

use App\Models\core_m;

class mblog_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek blog
        if ($this->request->getPostGet("blog_id")) {
            $blogd["blog_id"] = $this->request->getPostGet("blog_id");
        } else {
            $blogd["blog_id"] = -1;
        }
        $us = $this->db
            ->table("blog")
            ->getWhere($blogd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "blog_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $blog) {
                foreach ($this->db->getFieldNames('blog') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $blog->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('blog') as $field) {
                $data[$field] = "";
            }
        }

        //upload image
        $data['uploadblog_picture'] = "";
        if (isset($_FILES['blog_picture']) && $_FILES['blog_picture']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('blog_picture');
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
                $direktori = 'images/blog_picture'; //definisikan direktori upload            
                $blog_picture = str_replace(' ', '_', $name);
                $blog_picture = date("H_i_s_") . $blog_picture; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $blog_picture) {
                        delete_files($direktori, $blog_picture); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->blog($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $blog_picture)) {
                    $data['uploadblog_picture'] = "Upload Success !";
                    $input['blog_picture'] = $blog_picture;
                } else {
                    $data['uploadblog_picture'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadblog_picture'] = "Format File Salah !";
            }
        } 

        //delete
        if ($this->request->getPost("delete") == "OK") {  
              
                $this->db
                ->table("blog")
                ->delete(array("blog_id" => $this->request->getPost("blog_id"),"blog_id" =>$this->request->getPost("blog_id")));
                $data["message"] = "Delete Success";
            
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'blog_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["blog_id"] = $this->request->getPost("blog_id");

            $builder = $this->db->table('blog');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $blog_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;
        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'blog_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["blog_id"] = $this->request->getPost("blog_id");
            $this->db->table('blog')->update($input, array("blog_id" => $this->request->getPost("blog_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
