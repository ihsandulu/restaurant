<?php

namespace App\Models\master;

use App\Models\core_m;

class moffer_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek offer
        if ($this->request->getPostGet("offer_id")) {
            $offerd["offer_id"] = $this->request->getPostGet("offer_id");
        } else {
            $offerd["offer_id"] = -1;
        }
        $us = $this->db
            ->table("offer")
            ->getWhere($offerd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "offer_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $offer) {
                foreach ($this->db->getFieldNames('offer') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $offer->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('offer') as $field) {
                $data[$field] = "";
            }
        }

        //upload image
        $data['uploadoffer_picture'] = "";
        if (isset($_FILES['offer_picture']) && $_FILES['offer_picture']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('offer_picture');
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
                $direktori = 'images/offer_picture'; //definisikan direktori upload            
                $offer_picture = str_replace(' ', '_', $name);
                $offer_picture = date("H_i_s_") . $offer_picture; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $offer_picture) {
                        delete_files($direktori, $offer_picture); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->offer($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $offer_picture)) {
                    $data['uploadoffer_picture'] = "Upload Success !";
                    $input['offer_picture'] = $offer_picture;
                } else {
                    $data['uploadoffer_picture'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadoffer_picture'] = "Format File Salah !";
            }
        } 

        //delete
        if ($this->request->getPost("delete") == "OK") {  
              
                $this->db
                ->table("offer")
                ->delete(array("offer_id" => $this->request->getPost("offer_id"),"offer_id" =>$this->request->getPost("offer_id")));
                $data["message"] = "Delete Success";
            
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'offer_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["offer_id"] = $this->request->getPost("offer_id");

            $builder = $this->db->table('offer');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $offer_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;
        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'offer_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["offer_id"] = $this->request->getPost("offer_id");
            $this->db->table('offer')->update($input, array("offer_id" => $this->request->getPost("offer_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
