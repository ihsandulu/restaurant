<?php

namespace App\Controllers\frontend;

use App\Controllers\baseController;

class booking extends baseController
{

    protected $sesi_user;
    public function __construct()
    {
        $sesi_user = new \App\Models\global_m();
        $sesi_user->ceksesi();
    }


    public function index()
    {
        $data = new \App\Models\frontend\booking_m();
        $data = $data->data();
        return view('template_front/booking_v', $data);
    }
}
