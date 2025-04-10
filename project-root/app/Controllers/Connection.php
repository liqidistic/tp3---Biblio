<?php

namespace App\Controllers;

class Connection extends BaseController
{
    public function index(): string
    {
        return view("login_form");
    }

    public function attemptLogin() 
    {
        $abonneModel = new \App\Models\Abonne();

        $values = $this->request->getPost(['login', 'password']);
        if (!empty($values) && $values['login'] == APP_ADMIN_LOGIN && $values['password'] == APP_ADMIN_PASSWORD) {
            return $this->loginUser();
        } 
        
        $rechercheAbonne = $abonneModel->getAbonneByMatricule($values['login']);
        if (isset($rechercheAbonne) && $rechercheAbonne['nom_abonne'] === $values['password'])
            return $this->loginUser($rechercheAbonne);
        else{

            return redirect()->to('login');
        }
    }


    private function loginUser(?object $user = null)
    {
    $session = session();
    $session->set([
        'username' => isset($user) ? ($user['nom_abonne'] . strtoupper($user['nom_abonne'])) : 'Administrator',
        'loggedIn' => true
    ]);
    return redirect()->to("home");
    }
}