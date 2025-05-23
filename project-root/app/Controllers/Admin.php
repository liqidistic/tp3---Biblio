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
                'abonne.matricule_abonne, ' .
                'abonne.nom_abonne, ' .
                'emprunte.cote_exemplaire, ' .
                'livre.titre_livre, ' .
                'emprunte.date_emprunt, ' .
                'emprunte.date_retour, ' .
                'emprunte.rendu' // <- ajout de cette ligne
            )
            ->join('abonne',     'emprunte.matricule_abonne = abonne.matricule_abonne')
            ->join('exemplaire', 'emprunte.cote_exemplaire  = exemplaire.cote_exemplaire')
            ->join('livre',      'exemplaire.code_catalogue  = livre.code_catalogue')
            ->orderBy('abonne.nom_abonne, emprunte.date_emprunt', 'ASC');
    
        $data['emprunts'] = $builder->get()->getResultArray();
        $data['title']    = 'Emprunts par abonné';
    
        return view('admin/abonnes_emprunts', $data);
    }
    

public function traiterRetour($cote_exemplaire)
{
    $etat = $this->request->getPost('etat_exemplaire');
    $db = \Config\Database::connect();

    // Marquer le livre comme rendu
    $db->table('emprunte')
       ->where('cote_exemplaire', $cote_exemplaire)
       ->where('rendu', 0) // pour éviter de modifier un déjà rendu
       ->update([
           'rendu' => 1,
           'date_retour' => date('Y-m-d')
       ]);

    // Mettre à jour l’état de l’exemplaire (disponible et nouvel état d’usure)
    $db->table('exemplaire')
       ->where('cote_exemplaire', $cote_exemplaire)
       ->update([
           'disponibilite' => true,
           'code_usure' => $etat
       ]);

    return redirect()->to('/admin/abonnes/emprunts')->with('success', 'Livre retourné avec succès.');
}


public function gestionDemandes()
{
    $db = \Config\Database::connect();

    $demandes = $db->table('demande')
        ->select('demande.*, livre.titre_livre')
        ->join('exemplaire', 'exemplaire.cote_exemplaire = demande.cote_exemplaire')
        ->join('livre', 'livre.code_catalogue = exemplaire.code_catalogue')
        ->orderBy('date_demande', 'DESC')
        ->get()
        ->getResultArray();

    return view('admin/demandes_gestion', ['demandes' => $demandes]);
}


    public function supprimerDemande($matricule, $code)
    {
        helper('url');
        $demModel = new DemandeModel();

        $demModel
            ->where('matricule_abonne',$matricule)
            ->where('cote_exemplaire',  $code)
            ->delete();

        return redirect()->to('/admin/demandes')
                         ->with('success','Demande supprimée.');
    }
    public function validerDemande($matricule_abonne, $cote_exemplaire)
{
    $db = \Config\Database::connect();

    // Vérifie que la demande existe
    $demande = $db->table('demande')->getWhere([
        'matricule_abonne' => $matricule_abonne,
        'cote_exemplaire' => $cote_exemplaire
    ])->getRow();

    if (!$demande) {
        return redirect()->back()->with('error', 'Demande introuvable.');
    }

    // Calcul des dates
    $date_emprunt = date('Y-m-d');
    $date_retour = null; // Important : laisser null pour que l'abonné voie l'emprunt

    // Insère dans la table emprunte
    $db->table('emprunte')->insert([
        'matricule_abonne' => $matricule_abonne,
        'cote_exemplaire' => $cote_exemplaire,
        'date_emprunt' => $date_emprunt,
        'date_retour' => $date_retour,
        'estrenouvele' => 0
    ]);

    // Supprime la demande
    $db->table('demande')->where([
        'matricule_abonne' => $matricule_abonne,
        'cote_exemplaire' => $cote_exemplaire
    ])->delete();

    return redirect()->back()->with('success', 'Demande validée. Emprunt enregistré.');
}
public function formRetour($cote_exemplaire)
{
    $exemplaireModel = new \App\Models\ExemplaireModel();
    $exemplaire = $exemplaireModel->find($cote_exemplaire);

    if (!$exemplaire) {
        return redirect()->back()->with('error', 'Exemplaire introuvable.');
    }

    return view('admin/retour_form', ['exemplaire' => $exemplaire]);
}

}