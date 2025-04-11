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
        $abonneModel = new \App\Models\AbonneModel();

        $values = $this->request->getPost(['login', 'password']);
        if (!empty($values) && $values['login'] == APP_ADMIN_LOGIN && $values['password'] == APP_ADMIN_PASSWORD) {
            session()->set('is_admin', true); 
            return redirect()->to('/admin');
       } 
        
       $userFetched = $abonneModel->where('matricule_abonne',$this->request->getPost('login'))->first();

       if($this->request->getPost('password') == $userFetched['nom_abonne']) {
        return "Login OK";
       } else {
        return "Login KO";
       }
        }
    
    public function logout()
{
    session()->destroy();
    return redirect()->to('/login');
}
}
