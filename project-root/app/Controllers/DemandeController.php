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
            // Récupérer les données du formulaire
            $codeCatalogue = $this->request->getPost('code_catalogue');
            $matriculeAbonne = session()->get('matricule_abonne'); // Récupérer l'abonné connecté
    
            log_message('debug', 'Données reçues : code_catalogue = '.$codeCatalogue.' , matricule_abonne = '.$matriculeAbonne);
    
            // Vérification de la disponibilité d'un exemplaire
            $exemplairesDisponibles = $exemplaireModel->where('code_catalogue', $codeCatalogue)
                                                        ->where('etat_exemplaire !=', 'DEGRADE')  // Exclure les exemplaires dégradés
                                                        ->where('disponibilite', true)  // Vérifier si l'exemplaire est disponible
                                                        ->findAll();
    
            log_message('debug', 'Exemplaires disponibles : ' . count($exemplairesDisponibles));
    
            if (empty($exemplairesDisponibles)) {
                log_message('debug', 'Le livre avec le code_catalogue ' . $codeCatalogue . ' n\'est pas disponible.');
                return redirect()->to('/abonne/livre_disponible')->with('error', 'Le livre n\'est pas disponible.');
            }
    
            // Préparer les données à insérer
            $insertData = [
                'code_catalogue' => $codeCatalogue,
                'matricule_abonne' => $matriculeAbonne,
                'date_demande' => date('Y-m-d')  // Date actuelle
            ];
    
            log_message('debug', 'Données à insérer : ' . json_encode($insertData));
    
            // Insérer la demande dans la table 'demande'
            $inserted = $demandeModel->insert($insertData);
    
            // Vérification d'insertion
            if ($inserted) {
                log_message('debug', 'Demande insérée avec succès');
            } else {
                log_message('debug', 'Erreur lors de l\'insertion de la demande');
            }
    
            // Rediriger vers mes-demandes avec un message de succès
            return redirect()->to('/mes_demandes')->with('success', 'Votre demande a été enregistrée.');
        }
    
        // Charger les livres pour l'affichage
        $livres = $livreModel->findAll();
        return view('creer_demande', ['livres' => $livres]);
    }
    

    public function mesDemandes()
    {
        $demandeModel = new DemandeModel();
        $matriculeAbonne = session()->get('matricule_abonne'); // Identifiant de l'abonné
    
        // Effectuer une jointure entre la table 'demande' et 'livre' pour récupérer 'titre_livre'
        $demandes = $demandeModel->join('livre', 'livre.code_catalogue = demande.code_catalogue') // Joindre 'livre' à 'demande'
                                 ->select('demande.*, livre.titre_livre') // Sélectionner toutes les colonnes de 'demande' et 'titre_livre' de 'livre'
                                 ->where('matricule_abonne', $matriculeAbonne)
                                 ->findAll();
    
        // Afficher les demandes dans la vue
        return view('/mes_demandes', ['demandes' => $demandes]);
    }
    
    

public function supprimerDemande($codeCatalogue)
{
    $demandeModel = new DemandeModel();
    $matriculeAbonne = session()->get('matricule_abonne');  // Récupérer l'abonné connecté

    // Supprimer la demande dans la table 'demande'
    $deleted = $demandeModel->where('matricule_abonne', $matriculeAbonne)
                            ->where('code_catalogue', $codeCatalogue)
                            ->delete();

    // Vérification si la suppression a réussi
    if ($deleted) {
        return redirect()->to('/mes_demandes')->with('success', 'Demande supprimée avec succès.');
    } else {
        return redirect()->to('/mes_demandes')->with('error', 'Erreur lors de la suppression de la demande.');
    }
}

}
