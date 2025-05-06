<?php

namespace App\Controllers;

use App\Models\DemandeModel;
use App\Models\LivreModel;
use App\Models\ExemplaireModel;
use App\Controllers\BaseController;

class DemandeController extends BaseController
{
    public function creer()
    {
        helper(['form']);
        $livreModel = new LivreModel();
        $exemplaireModel = new ExemplaireModel();
        $demandeModel = new DemandeModel();

        log_message('debug', 'Méthode creer() appelée');

        if ($this->request->getMethod() === 'POST') {
            $codeCatalogue = $this->request->getPost('code_catalogue');
            $matriculeAbonne = session()->get('matricule_abonne');

            log_message('debug', 'Données reçues : code_catalogue = '.$codeCatalogue.' , matricule_abonne = '.$matriculeAbonne);

            // Vérifier qu’un exemplaire est disponible
            $exemplaire = $exemplaireModel->where('code_catalogue', $codeCatalogue)
                                           ->where('etat_exemplaire !=', 'DEGRADE')
                                           ->where('disponibilite', true)
                                           ->first();

            if (!$exemplaire) {
                return redirect()->to('/livre_disponible')->with('error', 'Aucun exemplaire disponible.');
            }

            $insertData = [
                'cote_exemplaire' => $exemplaire['cote_exemplaire'],
                'matricule_abonne' => $matriculeAbonne,
                'date_demande' => date('Y-m-d')
            ];

            $inserted = $demandeModel->insert($insertData);


            return redirect()->to('/mes_demandes')->with('success', 'Votre demande a été enregistrée.');
        }

        $livres = $livreModel->findAll();
        return view('creer_demande', ['livres' => $livres]);
    }

    public function mesDemandes()
    {
        $db = \Config\Database::connect();
        $matricule = session()->get('matricule_abonne');

        $builder = $db->table('demande');
        $builder->select('demande.*, livre.titre_livre');
        $builder->join('exemplaire', 'exemplaire.cote_exemplaire = demande.cote_exemplaire');
        $builder->join('livre', 'livre.code_catalogue = exemplaire.code_catalogue');
        $builder->where('demande.matricule_abonne', $matricule);

        $demandes = $builder->get()->getResultArray();

        return view('/mes_demandes', ['demandes' => $demandes]);
    }

    public function demander($cote_exemplaire)
    {
        $db = \Config\Database::connect();
        $matricule = session()->get('matricule_abonne');

        if (!$matricule) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté.');
        }

        $builder = $db->table('demande');

        $existing = $builder->where('matricule_abonne', $matricule)
                            ->where('cote_exemplaire', $cote_exemplaire)
                            ->get()
                            ->getRow();

        if ($existing) {
            return redirect()->back()->with('error', 'Vous avez déjà une demande pour cet exemplaire.');
        }

        $builder->insert([
            'matricule_abonne' => $matricule,
            'cote_exemplaire' => $cote_exemplaire,
            'date_demande' => date('Y-m-d')
        ]);

        return redirect()->to('/mes_demandes')->with('success', 'Demande enregistrée avec succès.');
    }

    public function supprimerDemande($cote_exemplaire)
    {
        $demandeModel = new DemandeModel();
        $matricule = session()->get('matricule_abonne');

        $deleted = $demandeModel->where('matricule_abonne', $matricule)
                                ->where('cote_exemplaire', $cote_exemplaire)
                                ->delete();

        return redirect()->to('/mes_demandes')->with(
            $deleted ? 'success' : 'error',
            $deleted ? 'Demande supprimée avec succès.' : 'Erreur lors de la suppression.'
        );
    }

    public function validerDemande($cote_exemplaire)
    {
        $db = \Config\Database::connect();
        $matricule = session()->get('matricule_abonne');

        $exemplaire = $db->table('exemplaire')
                         ->where('cote_exemplaire', $cote_exemplaire)
                         ->where('disponibilite', 1)
                         ->get()
                         ->getRow();

        if (!$exemplaire) {
            return redirect()->to('/livres_disponibles')->with('error', 'Exemplaire non disponible.');
        }

        $db->table('demande')->insert([
            'cote_exemplaire'   => $cote_exemplaire,
            'matricule_abonne'  => $matricule,
            'date_demande'      => date('Y-m-d')
        ]);

        return redirect()->to('/mes_demandes')->with('success', 'Demande validée.');
    }
}
