<?php

namespace App\Controllers\frontend;

use App\Controllers\baseController;

class about extends baseController
{

    protected $sesi_user;
    public function __construct()
    {
        $sesi_user = new \App\Models\global_m();
        $sesi_user->ceksesi();
    }


    public function index()
    {
        return view('template_front/about_v');
    }
}
