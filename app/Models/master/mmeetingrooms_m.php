<?php

namespace App\Models\master;

use App\Models\core_m;

class mmeetingrooms_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek meeting
        if ($this->request->getPostGet("meeting_id")) {
            $meetingd["meeting_id"] = $this->request->getPostGet("meeting_id");
        } else {
            $meetingd["meeting_id"] = -1;
        }
        $us = $this->db
            ->table("meeting")
            ->getWhere($meetingd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "meeting_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $meeting) {
                foreach ($this->db->getFieldNames('meeting') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $meeting->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('meeting') as $field) {
                $data[$field] = "";
            }
        }

        //upload background
        $data['uploadmeeting_background'] = "";
        if (isset($_FILES['meeting_background']) && $_FILES['meeting_background']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('meeting_background');
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
                $direktori = 'images/meeting_background'; //definisikan direktori upload            
                $meeting_background = str_replace(' ', '_', $name);
                $meeting_background = date("H_i_s_") . $meeting_background; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $meeting_background) {
                        delete_files($direktori, $meeting_background); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->meeting($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $meeting_background)) {
                    $data['uploadmeeting_background'] = "Upload Success !";
                    $input['meeting_background'] = $meeting_background;
                } else {
                    $data['uploadmeeting_background'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadmeeting_background'] = "Format File Salah !";
            }
        } 

        //upload image 1
        $data['uploadmeeting_picture1'] = "";
        if (isset($_FILES['meeting_picture1']) && $_FILES['meeting_picture1']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('meeting_picture1');
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
                $direktori = 'images/meeting_picture1'; //definisikan direktori upload            
                $meeting_picture1 = str_replace(' ', '_', $name);
                $meeting_picture1 = date("H_i_s_") . $meeting_picture1; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $meeting_picture1) {
                        delete_files($direktori, $meeting_picture1); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->meeting($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $meeting_picture1)) {
                    $data['uploadmeeting_picture1'] = "Upload Success !";
                    $input['meeting_picture1'] = $meeting_picture1;
                } else {
                    $data['uploadmeeting_picture1'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadmeeting_picture1'] = "Format File Salah !";
            }
        } 

        //upload image2
        $data['uploadmeeting_picture2'] = "";
        if (isset($_FILES['meeting_picture2']) && $_FILES['meeting_picture2']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('meeting_picture2');
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
                $direktori = 'images/meeting_picture2'; //definisikan direktori upload            
                $meeting_picture2 = str_replace(' ', '_', $name);
                $meeting_picture2 = date("H_i_s_") . $meeting_picture2; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $meeting_picture2) {
                        delete_files($direktori, $meeting_picture2); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->meeting($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $meeting_picture2)) {
                    $data['uploadmeeting_picture2'] = "Upload Success !";
                    $input['meeting_picture2'] = $meeting_picture2;
                } else {
                    $data['uploadmeeting_picture2'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadmeeting_picture2'] = "Format File Salah !";
            }
        }  

        //upload image3
        $data['uploadmeeting_picture3'] = "";
        if (isset($_FILES['meeting_picture3']) && $_FILES['meeting_picture3']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('meeting_picture3');
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
                $direktori = 'images/meeting_picture3'; //definisikan direktori upload            
                $meeting_picture3 = str_replace(' ', '_', $name);
                $meeting_picture3 = date("H_i_s_") . $meeting_picture3; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $meeting_picture3) {
                        delete_files($direktori, $meeting_picture3); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->meeting($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $meeting_picture3)) {
                    $data['uploadmeeting_picture3'] = "Upload Success !";
                    $input['meeting_picture3'] = $meeting_picture3;
                } else {
                    $data['uploadmeeting_picture3'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadmeeting_picture3'] = "Format File Salah !";
            }
        } 

        //upload image4
        $data['uploadmeeting_picture4'] = "";
        if (isset($_FILES['meeting_picture4']) && $_FILES['meeting_picture4']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('meeting_picture4');
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
                $direktori = 'images/meeting_picture4'; //definisikan direktori upload            
                $meeting_picture4 = str_replace(' ', '_', $name);
                $meeting_picture4 = date("H_i_s_") . $meeting_picture4; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $meeting_picture4) {
                        delete_files($direktori, $meeting_picture4); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->meeting($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $meeting_picture4)) {
                    $data['uploadmeeting_picture4'] = "Upload Success !";
                    $input['meeting_picture4'] = $meeting_picture4;
                } else {
                    $data['uploadmeeting_picture4'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadmeeting_picture4'] = "Format File Salah !";
            }
        } 

        //upload image5
        $data['uploadmeeting_picture5'] = "";
        if (isset($_FILES['meeting_picture5']) && $_FILES['meeting_picture5']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('meeting_picture5');
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
                $direktori = 'images/meeting_picture5'; //definisikan direktori upload            
                $meeting_picture5 = str_replace(' ', '_', $name);
                $meeting_picture5 = date("H_i_s_") . $meeting_picture5; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $meeting_picture5) {
                        delete_files($direktori, $meeting_picture5); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->meeting($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $meeting_picture5)) {
                    $data['uploadmeeting_picture5'] = "Upload Success !";
                    $input['meeting_picture5'] = $meeting_picture5;
                } else {
                    $data['uploadmeeting_picture5'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadmeeting_picture5'] = "Format File Salah !";
            }
        } 

        //upload image6
        $data['uploadmeeting_picture6'] = "";
        if (isset($_FILES['meeting_picture6']) && $_FILES['meeting_picture6']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('meeting_picture6');
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
                $direktori = 'images/meeting_picture6'; //definisikan direktori upload            
                $meeting_picture6 = str_replace(' ', '_', $name);
                $meeting_picture6 = date("H_i_s_") . $meeting_picture6; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $meeting_picture6) {
                        delete_files($direktori, $meeting_picture6); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->meeting($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $meeting_picture6)) {
                    $data['uploadmeeting_picture6'] = "Upload Success !";
                    $input['meeting_picture6'] = $meeting_picture6;
                } else {
                    $data['uploadmeeting_picture6'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadmeeting_picture6'] = "Format File Salah !";
            }
        } 

        //delete
        if ($this->request->getPost("delete") == "OK") {  
              
                $this->db
                ->table("meeting")
                ->delete(array("meeting_id" => $this->request->getPost("meeting_id"),"meeting_id" =>$this->request->getPost("meeting_id")));
                $data["message"] = "Delete Success";
            
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'meeting_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["meeting_id"] = $this->request->getPost("meeting_id");

            $builder = $this->db->table('meeting');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $meeting_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;
        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'meeting_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["meeting_id"] = $this->request->getPost("meeting_id");
            $this->db->table('meeting')->update($input, array("meeting_id" => $this->request->getPost("meeting_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
