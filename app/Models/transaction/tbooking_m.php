<?php

namespace App\Models\transaction;

use App\Models\core_m;

class tbooking_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek booking
        if ($this->request->getVar("booking_id")) {
            $bookingd["booking_id"] = $this->request->getVar("booking_id");
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

        

        //delete
        if ($this->request->getPost("delete") == "OK") {  
            $booking_id=   $this->request->getPost("booking_id");                      
            $this->db
            ->table("booking")
            ->delete(array("booking_id" => $this->request->getPost("booking_id")));
            $data["message"] = "Delete Success";
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'booking_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }

            $builder = $this->db->table('booking');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $booking_id = $this->db->insertID();
            $data["message"] = "Insert Data Success";        }
        //echo $_POST["create"];die;
        
        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'booking_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $this->db->table('booking')->update($input, array("booking_id" => $this->request->getPost("booking_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;            
        }
        return $data;
    }
}
