<?php

namespace App\Controllers;

class Connection extends BaseController
{
    public function index()
    {
        return view('login_form');
    }

    public function attemptLogin()
    {
        $values = $this->request->getPost(['login', 'password']);
        $login = trim($values['login']);
        $password = trim($values['password']);

        $adminModel = new \App\Models\AdministrateurModel();
        $admin = $adminModel->where('identifiant', $login)->first();

        if ($admin && password_verify($password, $admin['mot_de_passe'])) {
            $this->loginUser(null, $admin);
            return redirect()->to('/home');
        }
        if (is_numeric($login)) {
            $abonneModel = new \App\Models\AbonneModel();
            $abonne = $abonneModel->getAbonneByMatricule($login);

            if ($abonne && $abonne['nom_abonne'] === $password) {
                $this->loginUser($abonne);
                return redirect()->to('/home');
            }
        }
        return view('login_form', ['erreur' => 'Échec de connexion : identifiants invalides.']);
    }

    private function loginUser($abonne = null, $admin = null)
    {
        $session = session();
        $session->set('loggedIn', true);

        if ($abonne) {
            $session->set('username', $abonne['nom_abonne']);
            $session->set('role', 'abonne');
            $session->set('matricule_abonne', $abonne['matricule_abonne']);
        } elseif ($admin) {
            $session->set('username', $admin['identifiant']);
            $session->set('role', 'admin');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
