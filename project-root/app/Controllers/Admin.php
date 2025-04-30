<?php

namespace App\Controllers;
use App\Models\EmprunteModel;
use App\Models\AbonneModel;
use App\Models\LivreModel;
use App\Models\DemandeModel;

class Admin extends BaseController
{
    public function creer_admin()
    {
        helper(['form']);

        $adminModel = new \App\Models\AdminModel();
        $accesOK = false;

        $mdpMaitre = trim($this->request->getPost('mdp_maitre'));

        if ($this->request->getMethod() === 'POST' && !$this->request->getPost('identifiant')) {
            if ($mdpMaitre === MOT_DE_PASSE_MAITRE) {
                $accesOK = true;
            } else {
                return view('admin/creer_admin', ['erreur' => 'Mot de passe maître incorrect']);
            }
        }

        if ($this->request->getPost('identifiant') && $this->request->getPost('mot_de_passe')) {
            if ($mdpMaitre !== MOT_DE_PASSE_MAITRE) {
                return view('admin/creer_admin', ['erreur' => 'Mot de passe maître incorrect']);
            }

            $adminModel->save([
                'identifiant' => $this->request->getPost('identifiant'),
                'mot_de_passe' => password_hash($this->request->getPost('mot_de_passe'), PASSWORD_DEFAULT)
            ]);

            return redirect()->to('/home')->with('success', 'Nouvel administrateur créé !');
        }

        return view('admin/creer_admin', ['accesOK' => $accesOK]);
    }

    public function livres()
    {
        $livreModel = new LivreModel();
        $data['livres'] = $livreModel->findAll();

        return view('admin/livres', $data);
    }

    public function ajouterLivre()
    {
        helper(['form','url']);

        // Si on vient de soumettre le formulaire...
        if ($this->request->getMethod() === 'POST') {
            // Récupère les champs POST
            $data = [
                'code_catalogue' => $this->request->getPost('code_catalogue'),
                'titre_livre'    => $this->request->getPost('titre_livre'),
                'theme_livre'    => $this->request->getPost('theme_livre'),
            ];

            // Insère en base
            $model = new LivreModel();
            if ($model->insert($data) === false) {
                // en cas d’erreur, renvoie la vue avec les messages
                return view('admin/ajouter_livre', [
                    'errors' => $model->errors()
                ]);
            }

            // succès → redirection
            return redirect()->to('/admin/livres')
                             ->with('success','Livre ajouté !');
        }

        // Sinon (GET), on affiche le formulaire
        return view('admin/ajouter_livre');
    }



    public function ajouterExemplaire()
    {
        $livreModel = new \App\Models\LivreModel();

        if ($this->request->getMethod() === 'POST') {
            $exemplaireModel = new \App\Models\ExemplaireModel();

            $exemplaireModel->save([
                'nom_editeur' => $this->request->getPost('nom_editeur'),
                'code_usure' => $this->request->getPost('code_usure'),
                'date_acquisition' => $this->request->getPost('date_acquisition'),
                'emplacement_rayon' => $this->request->getPost('emplacement_rayon'),
                'code_catalogue' => $this->request->getPost('code_catalogue')
            ]);

            return redirect()->to('/admin/livres');
        }

        $data['livres'] = $livreModel->findAll();
        return view('admin/ajouter_exemplaire', $data);
    }

    public function ajouterAbonne()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/home');
        }

        if ($this->request->getMethod() === 'POST') {
            $abonneModel = new \App\Models\AbonneModel();

            $abonneModel->save([
                'nom_abonne' => $this->request->getPost('nom_abonne'),
                'date_naissance_abonne' => $this->request->getPost('date_naissance_abonne'),
                'date_adhesion_abonne' => $this->request->getPost('date_adhesion_abonne'),
                'adresse_abonne' => $this->request->getPost('adresse_abonne'),
                'telephone_abonne' => $this->request->getPost('telephone_abonne'),
                'CSP_abonne' => $this->request->getPost('CSP_abonne')
            ]);

            return redirect()->to('/home');
        }

        return view('admin/ajouter_abonne');
    }
    public function abonnesEmprunts()
{
    helper('url');

    $empruntModel = new \App\Models\EmprunteModel();

    // On part de emprunte, on joint abonne, puis exemplaire, puis livre
    $builder = $empruntModel
    ->select(
        'abonne.matricule_abonne,'
      . ' abonne.nom_abonne,'
      . ' emprunte.cote_exemplaire,'
      . ' livre.titre_livre,'        
      . ' emprunte.date_emprunt,'
      . ' emprunte.date_retour'
    )
    ->join('abonne',    'emprunte.matricule_abonne = abonne.matricule_abonne')
    ->join('exemplaire','emprunte.cote_exemplaire  = exemplaire.cote_exemplaire')
    ->join('livre',     'exemplaire.code_catalogue  = livre.code_catalogue')
    ->orderBy('abonne.nom_abonne, emprunte.date_emprunt', 'ASC')
;

    $data['emprunts'] = $builder->get()->getResultArray();
    $data['title']    = 'Emprunts par abonné';

    return view('admin/abonnes_emprunts', $data);
}

public function retourLivre($matricule, $cote)
{
    helper(['form','url']);

    $emprunteModel   = new \App\Models\EmprunteModel();
    $exemplaireModel = new \App\Models\ExemplaireModel();

    // 1) Si on vient du formulaire (POST) : traiter le retour
    if ($this->request->getMethod() === 'POST') {
        // Récupère l’usure saisie et la date du jour
        $usure      = $this->request->getPost('usure');
        $dateRetour = date('Y-m-d');

        // Met à jour la date de retour de l’emprunt
        $emprunteModel
            ->where('matricule_abonne', $matricule)
            ->where('cote_exemplaire',  $cote)
            ->set('date_retour',        $dateRetour)
            ->update();

        // Met à jour l’usure de l’exemplaire
        $exemplaireModel->update($cote, [
            'code_usure' => $usure
        ]);

        return redirect()
            ->to('/admin/abonnes/emprunts')
            ->with('success', 'Livre marqué comme rendu !');
    }

    // 2) Sinon (GET) : afficher le formulaire de retour
    return view('admin/retour_livre', [
        'matricule' => $matricule,
        'cote'      => $cote
    ]);
}

public function gestionDemandes()
    {
        helper('url');
        $demModel = new DemandeModel();

        $data['demandes'] = $demModel
            ->orderBy('code_catalogue','ASC')
            ->orderBy('date_demande','ASC')
            ->findAll();

        return view('admin/demandes_gestion', $data);
    }

    public function supprimerDemande($matricule, $code)
    {
        helper('url');
        $demModel = new DemandeModel();

        $demModel
            ->where('matricule_abonne',$matricule)
            ->where('code_catalogue',  $code)
            ->delete();

        return redirect()->to('/admin/demandes')
                         ->with('success','Demande supprimée.');
    }
}
