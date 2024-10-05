<?php

namespace App\Models\master;

use App\Models\core_m;

class mcontact_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek contact
        if ($this->request->getPostGet("contact_id")) {
            $contactd["contact_id"] = $this->request->getPostGet("contact_id");
        } else {
            $contactd["contact_id"] = -1;
        }
        $us = $this->db
            ->table("contact")
            ->getWhere($contactd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "contact_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $contact) {
                foreach ($this->db->getFieldNames('contact') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $contact->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('contact') as $field) {
                $data[$field] = "";
            }
        }

        //upload image
        $data['uploadcontact_picture'] = "";
        if (isset($_FILES['contact_picture']) && $_FILES['contact_picture']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('contact_picture');
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
                $direktori = 'images/contact_picture'; //definisikan direktori upload            
                $contact_picture = str_replace(' ', '_', $name);
                $contact_picture = date("H_i_s_") . $contact_picture; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $contact_picture) {
                        delete_files($direktori, $contact_picture); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->contact($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $contact_picture)) {
                    $data['uploadcontact_picture'] = "Upload Success !";
                    $input['contact_picture'] = $contact_picture;
                } else {
                    $data['uploadcontact_picture'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadcontact_picture'] = "Format File Salah !";
            }
        } 

        //upload brochure
        $data['uploadcontact_brochure'] = "";
        if (isset($_FILES['contact_brochure']) && $_FILES['contact_brochure']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('contact_brochure');
            $name = $file->getName(); // Mengetahui Nama File
            $originalName = $file->getClientName(); // Mengetahui Nama Asli
            $tempfile = $file->getTempName(); // Mengetahui Nama TMP File name
            $ext = $file->getClientExtension(); // Mengetahui extensi File
            $type = $file->getClientMimeType(); // Mengetahui Mime File
            $size_kb = $file->getSize('kb'); // Mengetahui Ukuran File dalam kb
            $size_mb = $file->getSize('mb'); // Mengetahui Ukuran File dalam mb


            //$namabaru = $file->getRandomName();//define nama fiel yang baru secara acak

            if ($type == 'image/jpg'||$type == 'image/jpeg'||$type == 'image/png'||$type == 'application/pdf') //cek mime file
            {    // File Tipe Sesuai   
                helper('filesystem'); // Load Helper File System
                $direktori = 'images/contact_brochure'; //definisikan direktori upload            
                $contact_brochure = str_replace(' ', '_', $name);
                $contact_brochure = date("H_i_s_") . $contact_brochure; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $contact_brochure) {
                        delete_files($direktori, $contact_brochure); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->contact($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $contact_brochure)) {
                    $data['uploadcontact_brochure'] = "Upload Success !";
                    $input['contact_brochure'] = $contact_brochure;
                } else {
                    $data['uploadcontact_brochure'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadcontact_brochure'] = "Format File Salah !";
            }
        } 

        //delete
        if ($this->request->getPost("delete") == "OK") {  
              
                $this->db
                ->table("contact")
                ->delete(array("contact_id" => $this->request->getPost("contact_id"),"contact_id" =>$this->request->getPost("contact_id")));
                $data["message"] = "Delete Success";
            
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'contact_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["contact_id"] = $this->request->getPost("contact_id");

            $builder = $this->db->table('contact');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $contact_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;
        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'contact_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["contact_id"] = $this->request->getPost("contact_id");
            $this->db->table('contact')->update($input, array("contact_id" => $this->request->getPost("contact_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
