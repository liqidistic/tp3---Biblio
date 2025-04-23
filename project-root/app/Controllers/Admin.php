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
    $data['livres'] = $livreModel->getLivresDetails();
    return view('admin/livres', $data);
}

public function ajouterLivre()
{
    helper(['form']);

    if ($this->request->getMethod() === 'post') {
        $livreModel = new \App\Models\LivreModel();
        $auteurModel = new \App\Models\AuteurModel();
        $motCleModel = new \App\Models\MotCleModel();
        $ecritModel = new \App\Models\EcritModel(); // table livre-auteur
        $associeModel = new \App\Models\AssocieModel(); // table livre-motcle

        $code = $this->request->getPost('code_catalogue');
        $titre = $this->request->getPost('titre_livre');
        $theme = $this->request->getPost('theme_livre');
        $nomAuteur = $this->request->getPost('auteur');
        $mots = explode(',', $this->request->getPost('mots_cles'));

        // 1. Ajouter le livre
        $livreModel->insert([
            'code_catalogue' => $code,
            'titre_livre' => $titre,
            'theme_livre' => $theme,
        ]);

        // 2. Chercher ou ajouter l’auteur
        $auteur = $auteurModel->where('nom_auteur', $nomAuteur)->first();
        if (!$auteur) {
            $auteurModel->insert(['nom_auteur' => $nomAuteur]);
            $idAuteur = $auteurModel->getInsertID();
        } else {
            $idAuteur = $auteur['id_auteur'];
        }

        // 3. Lier le livre à l’auteur
        $ecritModel->insert([
            'code_catalogue' => $code,
            'id_auteur' => $idAuteur
        ]);

        // 4. Ajouter les mots-clés et lier au livre
        foreach ($mots as $mot) {
            $mot = trim($mot);
            if ($mot === '') continue;

            $mc = $motCleModel->where('libelle', $mot)->first();
            if (!$mc) {
                $motCleModel->insert(['libelle' => $mot]);
                $idMC = $motCleModel->getInsertID();
            } else {
                $idMC = $mc['id_motcle'];
            }

            $associeModel->insert([
                'code_catalogue' => $code,
                'id_motcle' => $idMC
            ]);
        }

        return redirect()->to('/admin/livres')->with('success', 'Livre ajouté avec succès !');
    }

    return view('admin/livre_ajouter');
}


    public function exemplaires()
    {
        $exemplaireModel = new \App\Models\ExemplaireModel();
        $data['exemplaires'] = $exemplaireModel->findAll();
        return view('admin/exemplaires', $data);
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
    
}
