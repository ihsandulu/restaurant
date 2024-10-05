<?php

namespace App\Models\master;

use App\Models\core_m;

class mroom_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek room
        if ($this->request->getPostGet("room_id")) {
            $roomd["room_id"] = $this->request->getPostGet("room_id");
        } else {
            $roomd["room_id"] = -1;
        }
        $us = $this->db
            ->table("room")
            ->getWhere($roomd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "room_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $room) {
                foreach ($this->db->getFieldNames('room') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $room->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('room') as $field) {
                $data[$field] = "";
            }
        }

        //upload background
        $data['uploadroom_background'] = "";
        if (isset($_FILES['room_background']) && $_FILES['room_background']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('room_background');
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
                $direktori = 'images/room_background'; //definisikan direktori upload            
                $room_background = str_replace(' ', '_', $name);
                $room_background = date("H_i_s_") . $room_background; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $room_background) {
                        delete_files($direktori, $room_background); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->room($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $room_background)) {
                    $data['uploadroom_background'] = "Upload Success !";
                    $input['room_background'] = $room_background;
                } else {
                    $data['uploadroom_background'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadroom_background'] = "Format File Salah !";
            }
        } 

        //upload image 1
        $data['uploadroom_picture1'] = "";
        if (isset($_FILES['room_picture1']) && $_FILES['room_picture1']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('room_picture1');
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
                $direktori = 'images/room_picture1'; //definisikan direktori upload            
                $room_picture1 = str_replace(' ', '_', $name);
                $room_picture1 = date("H_i_s_") . $room_picture1; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $room_picture1) {
                        delete_files($direktori, $room_picture1); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->room($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $room_picture1)) {
                    $data['uploadroom_picture1'] = "Upload Success !";
                    $input['room_picture1'] = $room_picture1;
                } else {
                    $data['uploadroom_picture1'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadroom_picture1'] = "Format File Salah !";
            }
        } 

        //upload image2
        $data['uploadroom_picture2'] = "";
        if (isset($_FILES['room_picture2']) && $_FILES['room_picture2']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('room_picture2');
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
                $direktori = 'images/room_picture2'; //definisikan direktori upload            
                $room_picture2 = str_replace(' ', '_', $name);
                $room_picture2 = date("H_i_s_") . $room_picture2; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $room_picture2) {
                        delete_files($direktori, $room_picture2); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->room($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $room_picture2)) {
                    $data['uploadroom_picture2'] = "Upload Success !";
                    $input['room_picture2'] = $room_picture2;
                } else {
                    $data['uploadroom_picture2'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadroom_picture2'] = "Format File Salah !";
            }
        }  

        //upload image3
        $data['uploadroom_picture3'] = "";
        if (isset($_FILES['room_picture3']) && $_FILES['room_picture3']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('room_picture3');
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
                $direktori = 'images/room_picture3'; //definisikan direktori upload            
                $room_picture3 = str_replace(' ', '_', $name);
                $room_picture3 = date("H_i_s_") . $room_picture3; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $room_picture3) {
                        delete_files($direktori, $room_picture3); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->room($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $room_picture3)) {
                    $data['uploadroom_picture3'] = "Upload Success !";
                    $input['room_picture3'] = $room_picture3;
                } else {
                    $data['uploadroom_picture3'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadroom_picture3'] = "Format File Salah !";
            }
        } 

        //upload image4
        $data['uploadroom_picture4'] = "";
        if (isset($_FILES['room_picture4']) && $_FILES['room_picture4']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('room_picture4');
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
                $direktori = 'images/room_picture4'; //definisikan direktori upload            
                $room_picture4 = str_replace(' ', '_', $name);
                $room_picture4 = date("H_i_s_") . $room_picture4; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $room_picture4) {
                        delete_files($direktori, $room_picture4); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->room($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $room_picture4)) {
                    $data['uploadroom_picture4'] = "Upload Success !";
                    $input['room_picture4'] = $room_picture4;
                } else {
                    $data['uploadroom_picture4'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadroom_picture4'] = "Format File Salah !";
            }
        } 

        //upload image5
        $data['uploadroom_picture5'] = "";
        if (isset($_FILES['room_picture5']) && $_FILES['room_picture5']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('room_picture5');
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
                $direktori = 'images/room_picture5'; //definisikan direktori upload            
                $room_picture5 = str_replace(' ', '_', $name);
                $room_picture5 = date("H_i_s_") . $room_picture5; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $room_picture5) {
                        delete_files($direktori, $room_picture5); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->room($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $room_picture5)) {
                    $data['uploadroom_picture5'] = "Upload Success !";
                    $input['room_picture5'] = $room_picture5;
                } else {
                    $data['uploadroom_picture5'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadroom_picture5'] = "Format File Salah !";
            }
        } 

        //upload image6
        $data['uploadroom_picture6'] = "";
        if (isset($_FILES['room_picture6']) && $_FILES['room_picture6']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('room_picture6');
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
                $direktori = 'images/room_picture6'; //definisikan direktori upload            
                $room_picture6 = str_replace(' ', '_', $name);
                $room_picture6 = date("H_i_s_") . $room_picture6; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $room_picture6) {
                        delete_files($direktori, $room_picture6); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->room($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $room_picture6)) {
                    $data['uploadroom_picture6'] = "Upload Success !";
                    $input['room_picture6'] = $room_picture6;
                } else {
                    $data['uploadroom_picture6'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadroom_picture6'] = "Format File Salah !";
            }
        } 

        //delete
        if ($this->request->getPost("delete") == "OK") {  
              
                $this->db
                ->table("room")
                ->delete(array("room_id" => $this->request->getPost("room_id"),"room_id" =>$this->request->getPost("room_id")));
                $data["message"] = "Delete Success";
            
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'room_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["room_id"] = $this->request->getPost("room_id");

            $builder = $this->db->table('room');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $room_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;
        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'room_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["room_id"] = $this->request->getPost("room_id");
            $this->db->table('room')->update($input, array("room_id" => $this->request->getPost("room_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
