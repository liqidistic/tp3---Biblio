<?php

namespace App\Controllers;


use App\Models\ExemplaireModel;
use App\Models\LivreModel;
use App\Models\EmprunteModel;
use App\Models\DemandeModel;



class Abonne extends BaseController
{
    /**
     * Liste les emprunts en cours de l’abonné
     */
    
    public function emprunts()
    {
        helper(['url']);
        $session = session();
        if (! $session->get('loggedIn') || $session->get('role') !== 'abonne') {
            return redirect()->to('/login');
        }
    
        $matricule   = $session->get('matricule_abonne');
        $empModel    = new EmprunteModel();
        $exModel     = new ExemplaireModel();
        $livreModel  = new LivreModel();
    
        // Récupère les emprunts actifs (date_retour IS NULL)
        $emprunts = $empModel
            ->where('matricule_abonne', $matricule)
            ->where('rendu', false)
            ->findAll();
    
        // Ajoute titre et état renouvellement
        foreach ($emprunts as &$e) {
            $ex = $exModel->where('cote_exemplaire', $e['cote_exemplaire'])->first();
            if ($ex) {
                $livre = $livreModel->where('code_catalogue', $ex['code_catalogue'])->first();
                $e['titre_livre'] = $livre['titre_livre'] ?? 'Inconnu';
            } else {
                $e['titre_livre'] = 'Inconnu';
            }
    
            $e['estRenouvele'] = in_array($e['estrenouvele'], [true, 't', 1], true);
        }
    
        return view('abonne/emprunts', ['emprunts' => $emprunts]);
    }
    

    /**
     * Affiche les exemplaires disponibles pour un livre donné
     */
    public function exemplairesDisponibles(?string $code_catalogue = null)
{
    helper('url');
    if (! session()->get('loggedIn') || session()->get('role')!=='abonne') {
        return redirect()->to('/login');
    }

    // 1) Code des exemplaires encore empruntés
    $idsActifs = array_column(
      (new EmprunteModel())
        ->select('cote_exemplaire')
        ->where('date_retour', null)
        ->findAll(),
      'cote_exemplaire'
    );

    // 2) Récupère les exemplaires libres (global ou filtré)
    $qb = (new ExemplaireModel());
    if ($code_catalogue !== null) {
        $qb = $qb->where('code_catalogue', $code_catalogue);
    }
    if (! empty($idsActifs)) {
        $qb = $qb->whereNotIn('cote_exemplaire', $idsActifs);
    }
    $exemplaires = $qb->findAll();

    // 3) Ajoute le titre du livre
    $livreModel = new LivreModel();
    foreach ($exemplaires as &$e) {
        $livre = $livreModel->find($e['code_catalogue']);
        $e['titre_livre'] = $livre['titre_livre'] ?? 'Inconnu';
    }

    return view('abonne/exemplaires_disponibles', [
      'exemplaires'    => $exemplaires,
      'code_catalogue' => $code_catalogue
    ]);
}

    /**
     * Emprunte un exemplaire si libre aujourd’hui
     */
    public function emprunter(string $cote_exemplaire)
    {
        helper(['url']);
    $session = session();

    if (! $session->get('loggedIn') || $session->get('role') !== 'abonne') {
        return redirect()->to('/login');
    }

    $matricule = $session->get('matricule_abonne');
    $empModel = new EmprunteModel();
    $exModel = new ExemplaireModel();
    $livreModel = new LivreModel();

    // Récupère les emprunts actifs (date_retour IS NULL)
    $emprunts = $empModel
        ->where('matricule_abonne', $matricule)
        ->where('date_retour', null)
        ->findAll();

    // Ajoute les infos nécessaires
    foreach ($emprunts as &$e) {
        $ex = $exModel->find($e['cote_exemplaire']);
        $livre = $livreModel->find($ex['code_catalogue']);
        $e['titre_livre'] = $livre['titre_livre'] ?? 'Inconnu';
        $e['estRenouvele'] = in_array($e['estrenouvele'], [true, 't', 1], true);
    }

    return view('abonne/emprunts', ['emprunts' => $emprunts]);
}

    /**
     * Formulaire de demande d’emprunt si aucun exemplaire libre
     */
    public function demander($codeCatalogue)
    {
        $livreModel = new LivreModel();
        $exemplaireModel = new ExemplaireModel();
    
        // Récupérer le livre
        $livre = $livreModel->find($codeCatalogue);
        if (!$livre) {
            return redirect()->to('/abonne/livre_disponible')->with('error', 'Le livre demandé n\'existe pas.');
        }
    
        // Vérifier la disponibilité d'exemplaires
        $exemplairesDisponibles = $exemplaireModel->where('code_catalogue', $codeCatalogue)
                                                  ->where('etat_exemplaire !=', 'DEGRADE') // Exclure les exemplaires dégradés
                                                  ->where('disponibilite', true) // Vérifier la disponibilité
                                                  ->findAll();
    
        if (empty($exemplairesDisponibles)) {
            // Si aucun exemplaire disponible, afficher la page de demande
            return view('abonne/livre_disponible', ['livre' => $livre, 'code_catalogue' => $codeCatalogue]);
        }
    
        // Sinon, afficher un message indiquant que le livre est déjà disponible
        return redirect()->to('/abonne/mes_demandes')->with('success', 'Livre disponible, vous pouvez faire une demande.');
    }
    

    /**
     * Liste des demandes de l’abonné
     */
    public function mesDemandes()
    {
        helper(['url']);
        $session   = session();
        if (! $session->get('loggedIn') || $session->get('role') !== 'abonne') {
            return redirect()->to('/login');
        }

        $demModel  = new DemandeModel();
        $matricule = $session->get('matricule_abonne');
        $demandes  = $demModel
            ->where('matricule_abonne', $matricule)
            ->orderBy('date_demande', 'DESC')
            ->findAll();

        return view('/mes_demandes', ['demandes' => $demandes]);
    }

    /**
     * Annule une demande
     */
    public function annulerDemande(string $code_catalogue)
    {
        helper(['url']);
        $session   = session();
        if (! $session->get('loggedIn') || $session->get('role') !== 'abonne') {
            return redirect()->to('/login');
        }

        $demModel = new DemandeModel();
        $matricule= $session->get('matricule_abonne');
        $demModel->where([
            'matricule_abonne' => $matricule,
            'code_catalogue'   => $code_catalogue
        ])->delete();

        return redirect()->to('/abonne/mes_demandes')
                         ->with('success', 'Demande annulée.');
    }


    /**
     * Renouvelle un emprunt
     */
    public function renouveler($cote_exemplaire)
    {
        $db = \Config\Database::connect();
        $matricule = session()->get('matricule_abonne');
    
        // Récupérer l'emprunt concerné
        $emprunt = $db->table('emprunte')
                      ->where('cote_exemplaire', $cote_exemplaire)
                      ->where('matricule_abonne', $matricule)
                      ->get()
                      ->getRow();
    
        if (!$emprunt) {
            return redirect()->back()->with('error', 'Emprunt introuvable.');
        }
    
        if ($emprunt->estrenouvele) {
            return redirect()->back()->with('error', 'Le livre a déjà été renouvelé une fois.');
        }
    
        // Ajouter 1 mois à la date actuelle de retour
        $dateRetour = new \DateTime($emprunt->date_retour);
        $dateRetour->modify('+1 month');
    
        // Mise à jour en base
        $db->table('emprunte')
           ->where('cote_exemplaire', $cote_exemplaire)
           ->where('matricule_abonne', $matricule)
           ->update([
               'date_retour' => $dateRetour->format('Y-m-d'),
               'estrenouvele' => true
           ]);
    
        return redirect()->back()->with('success', 'Renouvellement effectué avec succès. Un mois a été ajouté.');
    }
    
    public function reserver($codeCatalogue)
{
    $livreModel = new LivreModel();
    $exemplaireModel = new ExemplaireModel();

    // Récupérer le livre
    $livre = $livreModel->find($codeCatalogue);
    if (!$livre) {
        return redirect()->to('/abonne/livre_disponible')->with('error', 'Le livre demandé n\'existe pas.');
    }

    // Vérifier la disponibilité d'exemplaires
    $exemplairesDisponibles = $exemplaireModel->where('code_catalogue', $codeCatalogue)
                                              ->where('etat_exemplaire !=', 'DEGRADE') // Exclure les exemplaires dégradés
                                              ->where('disponibilite', true) // Vérifier si l'exemplaire est disponible
                                              ->findAll();

    if (empty($exemplairesDisponibles)) {
        return redirect()->to('/abonne/livre_disponible')->with('error', 'Le livre est actuellement indisponible.');
    }

    // Marquer le livre comme réservé ou créer une réservation
    // Exemple d'ajout de la réservation à la base de données (ajuste en fonction de la logique de réservation)
    $reservationsModel = new ReservationsModel();
    $reservationsModel->insert([
        'matricule_abonne' => session()->get('matricule_abonne'),
        'code_catalogue' => $codeCatalogue,
        'date_reservation' => date('Y-m-d')
    ]);

    return redirect()->to('/mes_demandes')->with('success', 'Votre réservation a été enregistrée.');
}

}