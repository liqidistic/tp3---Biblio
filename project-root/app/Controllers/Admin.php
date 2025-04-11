<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
{
    // Vérifie si l’utilisateur est bien connecté en tant qu’admin
    if (!session()->get('is_admin')) {
        return redirect()->to('/login');
    }

    return view('admin/dashboard'); // ou autre vue d’accueil admin
}

    public function livres()
    {
        $livreModel = new \App\Models\LivreModel();
        $data['livres'] = $livreModel->findAll();
        return view('admin/livres_list', $data);
    }

    public function ajouterLivre()
    {
        helper(['form']);

        if ($this->request->getMethod() === 'post') {
            // Traitement du formulaire
            $livreModel = new \App\Models\LivreModel();
            $auteurModel = new \App\Models\AuteurModel();
            $motcleModel = new \App\Models\MotCleModel();

            // Vérifie ou crée l’auteur
            $auteurNom = $this->request->getPost('auteur');
            $auteur = $auteurModel->firstOrCreate(['nom' => $auteurNom]);

            // Création du livre
            $livreData = [
                'titre' => $this->request->getPost('titre'),
                'id_auteur' => $auteur['id'],
            ];
            $livreId = $livreModel->insert($livreData, true);

            // Création des mots-clés
            $mots = explode(',', $this->request->getPost('mots_cles'));
            foreach ($mots as $mot) {
                $mot = trim($mot);
                $mc = $motcleModel->firstOrCreate(['libelle' => $mot]);
                // Liaison livre <-> mot-clé
                $livreModel->addMotCle($livreId, $mc['id']);
            }

            return redirect()->to('/admin/livres');
        }

        return view('admin/livre_ajouter');
    }

    public function exemplaires()
    {
        $exemplaireModel = new \App\Models\ExemplaireModel();
        $data['exemplaires'] = $exemplaireModel->findAll();
        return view('admin/exemplaires_list', $data);
    }

    public function ajouterExemplaire()
    {
        helper(['form']);
        if ($this->request->getMethod() === 'post') {
            $model = new \App\Models\ExemplaireModel();
            $model->insert([
                'id_livre' => $this->request->getPost('id_livre'),
                'etat' => $this->request->getPost('etat'),
            ]);
            return redirect()->to('/admin/exemplaires');
        }
        return view('admin/exemplaire_ajouter');
    }

    public function abonnes()
    {
        $model = new \App\Models\AbonneModel();
        $data['abonnes'] = $model->findAll();
        return view('admin/abonnes_list', $data);
    }

    public function ajouterAbonne()
    {
        helper(['form']);
        if ($this->request->getMethod() === 'post') {
            $model = new \App\Models\AbonneModel();
            $model->insert([
                'nom' => $this->request->getPost('nom'),
                'prenom' => $this->request->getPost('prenom'),
                'email' => $this->request->getPost('email'),
            ]);
            return redirect()->to('/admin/abonnes');
        }
        return view('admin/abonne_ajouter');
    }

    public function voirAbonne($id)
    {
        helper(['form']);
        $model = new \App\Models\AbonneModel();
        $abonne = $model->find($id);

        if ($this->request->getMethod() === 'post') {
            $model->update($id, [
                'nom' => $this->request->getPost('nom'),
                'prenom' => $this->request->getPost('prenom'),
                'email' => $this->request->getPost('email'),
            ]);
            return redirect()->to("/admin/abonnes/$id");
        }

        return view('admin/abonne_detail', ['abonne' => $abonne]);
    }


    public function logout() {
        // Détruire la session
        $this->session->sess_destroy();

        // Rediriger l'utilisateur vers la page d'accueil
        redirect('/home');
    }
}

