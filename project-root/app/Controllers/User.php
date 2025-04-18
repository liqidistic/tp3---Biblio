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

    public function abonnes()
    {
        $this->load->model('Abonne_model'); // charge le modèle si ce n’est pas déjà fait
        $data['abonnes'] = $this->Abonne_model->get_all(); // récupère tous les abonnés
        $this->load->view('user/abonnes', $data); // passe la variable à la vue
    }
    
}