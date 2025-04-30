<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = session();

        if (!$session->get('loggedIn')) {
            return view('welcome');
        }

        $data = [
            'username' => $session->get('username'),
            'role'     => $session->get('role')
        ];

        return view('home', $data);
    }


}
