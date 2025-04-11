<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $session = session();
        $template =
            view('template/head', [
                'loggedIn' => $session->get('loggedIn'),
                'name' => $session->get('username')
            ]) .
            view('template/footer');
        return "Bienvenue sur la page d'accueil !";
    }
}
