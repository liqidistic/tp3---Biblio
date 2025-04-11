<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {
        // Vérifie si l'utilisateur est connecté
        if (!session()->has('abonne_id')) {
            return redirect()->to('/login');
        }

        return view('User/userdashboard');
    }
}
