<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {
        if (session()->has('abonne_id')) {
            return redirect()->to('/login');
        }
    else
        return view('user/userdashboard'); 
    }
}