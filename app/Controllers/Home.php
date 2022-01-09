<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('head');
        //echo view('../welcome_message');
        echo view('footer');
    }
}
