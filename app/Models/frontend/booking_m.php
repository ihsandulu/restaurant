<?php

namespace App\Models\frontend;

use App\Models\core_m;

class booking_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek booking
        if ($this->request->getPostGet("booking_id")) {
            $bookingd["booking_id"] = $this->request->getPostGet("booking_id");
        } else {
            $bookingd["booking_id"] = -1;
        }
        $us = $this->db
            ->table("booking")
            ->getWhere($bookingd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "booking_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $booking) {
                foreach ($this->db->getFieldNames('booking') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $booking->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('booking') as $field) {
                $data[$field] = "";
            }
        }

        //upload image 1
        $data['uploadbooking_picture1'] = "";
        if (isset($_FILES['booking_picture1']) && $_FILES['booking_picture1']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('booking_picture1');
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
                $direktori = 'images/booking_picture1'; //definisikan direktori upload            
                $booking_picture1 = str_replace(' ', '_', $name);
                $booking_picture1 = date("H_i_s_") . $booking_picture1; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $booking_picture1) {
                        delete_files($direktori, $booking_picture1); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->booking($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $booking_picture1)) {
                    $data['uploadbooking_picture1'] = "Upload Success !";
                    $input['booking_picture1'] = $booking_picture1;
                } else {
                    $data['uploadbooking_picture1'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadbooking_picture1'] = "Format File Salah !";
            }
        } 

        //delete
        if ($this->request->getPost("delete") == "OK") {  
              
                $this->db
                ->table("booking")
                ->delete(array("booking_id" => $this->request->getPost("booking_id"),"booking_id" =>$this->request->getPost("booking_id")));
                $data["message"] = "Delete Success";
            
        }
        // dd($_POST);
        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'booking_id' && $e != 'date') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["booking_id"] = $this->request->getPost("booking_id");

            $tgl = $this->request->getPost("date");
            $pecahtgl = explode("-",$tgl);
            $input["booking_from"] = date("Y-m-d",strtotime($pecahtgl[0]));
            $input["booking_to"] = date("Y-m-d",strtotime($pecahtgl[1]));
            $input["booking_date"] = date("Y-m-d");
            // dd($input);

            $builder = $this->db->table('booking');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $booking_id = $this->db->insertID();

            $data["message"] = "Room Booking Successful";

        
            $identity=$this->db->table("identity")->get()->getRow();
            $identitypicture=$identity->identity_logo;
            $wordToRemove = "Apartments";
            $identity_name = str_replace($wordToRemove, "", $identity->identity_name);
            if($identitypicture!=""){$user_image="images/identity_logo/".$identitypicture."?".time();}else{$user_image="images/identity_logo/no_image.png";}

            $room_name=$this->db->table("room")->where("room_id",$input["room_id"])->get()->getRow()->room_name;
            
            // $email_utama="admin@ragamconcept.online";
            $email_utama="booking@bataviaapartments.co.id";
            // $email_utama="suluhbatavia@gmail.com";
            $email_smtp = \Config\Services::email();
            $email_smtp->setFrom($email_utama, "Admin Hotel");
            $email_smtp->setTo($input["booking_email"]);
            $email_smtp->setSubject("Pemesanan Kamar Hotel : ".$identity_name);
            $isiemail='<table style="color:black!important; border: 1px solid black; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 15px; border: 1px solid black;">Dari Tanggal</td>
                        <td style="padding: 15px; border: 1px solid black;">'.date("d, M Y",strtotime($input["booking_from"])).'</td>
                    </tr>
                    <tr>
                        <td style="padding: 15px; border: 1px solid black;">Ke Tanggal</td>
                        <td style="padding: 15px; border: 1px solid black;">'.date("d, M Y",strtotime($input["booking_to"])).'</td>
                    </tr>
                    <tr>
                        <td style="padding: 15px; border: 1px solid black;">Kamar</td>
                        <td style="padding: 15px; border: 1px solid black;">'.$room_name.'</td>
                    </tr>
                    <tr>
                        <td style="padding: 15px; border: 1px solid black;">Jumlah Kamar</td>
                        <td style="padding: 15px; border: 1px solid black;">'.$input["booking_roomcount"].'</td>
                    </tr>
                    <tr>
                        <td style="padding: 15px; border: 1px solid black;">Dewasa</td>
                        <td style="padding: 15px; border: 1px solid black;">'.$input["booking_adult"].'</td>
                    </tr>
                    <tr>
                        <td style="padding: 15px; border: 1px solid black;">Anak-anak</td>
                        <td style="padding: 15px; border: 1px solid black;">'.$input["booking_child"].'</td>
                    </tr>
                    <tr>
                        <td style="padding: 15px; border: 1px solid black;">Nama</td>
                        <td style="padding: 15px; border: 1px solid black;">'.$input["booking_name"].'</td>
                    </tr>
                    <tr>
                        <td style="padding: 15px; border: 1px solid black;">Email</td>
                        <td style="padding: 15px; border: 1px solid black;">'.$input["booking_email"].'</td>
                    </tr>
                    <tr>
                        <td style="padding: 15px; border: 1px solid black;">Phone</td>
                        <td style="padding: 15px; border: 1px solid black;">'.$input["booking_phone"].'</td>
                    </tr>
                    <tr>
                        <td style="padding: 15px; border: 1px solid black;">Pesan</td>
                        <td style="padding: 15px; border: 1px solid black;">'.$input["booking_message"].'</td>
                    </tr>
                    <tr>
                        <td style="padding: 15px; border: 1px solid black;">Total Harga</td>
                        <td style="padding: 15px; border: 1px solid black;">'.number_format((float)$input["booking_totalprice"],0,",",".").'</td>
                    </tr>
                </table>
                <br/>
                <br/>
                <hr/>
                <br/>
                <br/>
                <h3 style="color:#514147;">Terimakasih telah mempercayakan malam istimewa anda pada kami</h3>
                <div style="color:#6E6E6E; font-size:15px;">Hotel '.$identity->identity_name.'</div>
                <div style="color:#6E6E6E; font-size:15px;">'.$identity->identity_address.'</div>
                <div style="color:#6E6E6E; font-size:15px;">'.$identity->identity_phone.'</div>
            </html>';
            
            $emailcustomer='<html style="font-size:18px!important;">
                <h1>
                    <img src="'.base_url($user_image).'" style="height:30px !important; width:auto;"/> Hotel '.$identity_name.'
                </h1>
                <div style="color:black!important;">Terima kasih telah melakukan pemesanan kamar di Batavia Serviced Residence. Notifikasi ini bukan merupakan konfirmasi pemesanan kamar, mohon menunggu email balasan selanjutnya untuk ketersediaan pesanan kamar anda</div>'.$isiemail;
            $email_smtp->setMessage($emailcustomer);
        
            // Kirim email
            if ($email_smtp->send()) {
                $emailmessage = ' & Email has been sent';
            } else {
                $emailmessage = ' '.$email_smtp->printDebugger();
            }
            $data["message"].= $emailmessage;

            
            $email_smtp1 = \Config\Services::email();
            // Menambahkan CC
            $cc_email1 = 'fo.batavia@gmail.com';
            $cc_email2 = 'marcombataviaapartment@gmail.com';
            $cc_email3 = 'booking@bataviaapartments.co.id';
            $cc_email4 = 'suluhbatavia@gmail.com';
            
            $email_smtp1->setFrom($email_utama, "Admin Hotel");
            $email_smtp1->setTo($email_utama);


            $email_smtp1->setBCC($cc_email1);
            $email_smtp1->setBCC($cc_email2);
            $email_smtp1->setBCC($cc_email3);
            $email_smtp1->setBCC($cc_email4);

            $email_smtp1->setSubject("Pemesanan Kamar Hotel : ".$identity_name);
            $emailadmin='<html style="font-size:18px!important;">
                <h1>
                    <img src="'.base_url($user_image).'" style="height:30px !important; width:auto;"/> Hotel '.$identity_name.'
                </h1>
                <div style="color:black!important;">Terjadi pemesanan kamar dengan data sebagai berikut:</div>'.$isiemail;
            $email_smtp1->setMessage($emailadmin);
            // Kirim email
            if ($email_smtp1->send()) {
                // $emailmessage = ' & Email has been sent';
            } else {
                // $emailmessage = ' '.$email_smtp1->printDebugger();
            }
            // $data["message"].= $emailmessage;
        }
        //echo $_POST["create"];die;
        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'booking_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["booking_id"] = $this->request->getPost("booking_id");
            $this->db->table('booking')->update($input, array("booking_id" => $this->request->getPost("booking_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
