<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LivreModel;

class LivreController extends BaseController
{
    public function livresDisponibles()
    {
        $model = new LivreModel();
        $data['livres'] = $model->listeLivres();

        return view('livres_disponibles', $data);
    }

    public function afficherFormulaireAjout()
    {
        $db = \Config\Database::connect();
        $auteurs = $db->table('auteur')->get()->getResultArray();
    
        return view('admin/ajouter_livre', ['auteurs' => $auteurs]);
    }
    

public function creerLivreAvecAuteur()
{
    $db = \Config\Database::connect();

    $code = $this->request->getPost('code_catalogue');
    $titre = $this->request->getPost('titre_livre');
    $theme = $this->request->getPost('theme_livre');
    $motscles_input = $this->request->getPost('motscles'); // ex: "fantasy, aventure"
    $nom_auteur = $this->request->getPost('nom_auteur_custom') ?: $this->request->getPost('nom_auteur');

    // Créer le livre
    $db->table('livre')->insert([
        'code_catalogue' => $code,
        'titre_livre' => $titre,
        'theme_livre' => $theme
    ]);

    // Insérer auteur s'il n'existe pas
    $auteur = $db->table('auteur')->getWhere(['nom_auteur' => $nom_auteur])->getRow();
    if (!$auteur) {
        $db->table('auteur')->insert(['nom_auteur' => $nom_auteur]);
        $id_auteur = $db->insertID();
    } else {
        $id_auteur = $auteur->id_auteur;
    }

    // Lier livre et auteur
    $db->table('livre_auteur')->insert([
        'code_catalogue' => $code,
        'id_auteur' => $id_auteur
    ]);

    // Gérer les mots-clés
    $motscles = array_map('trim', explode(',', $motscles_input));
    foreach ($motscles as $motcle) {
        if ($motcle === '') continue;

        // Vérifie si le mot-clé existe déjà
        $existant = $db->table('motcle')->getWhere(['motcle' => $motcle])->getRow();
        if (!$existant) {
            $db->table('motcle')->insert(['motcle' => $motcle]);
            $id_motcle = $db->insertID();
        } else {
            $id_motcle = $existant->id_motcle;
        }

        // Lier au livre via la table associe
        $db->table('associe')->insert([
            'code_catalogue' => $code,
            'id_motcle' => $id_motcle
        ]);
    }

    return redirect()->to('/admin/ajouter_exemplaire/' . urlencode($code));
}

public function afficherFormulaireExemplaire()
{
    $db = \Config\Database::connect();
    $livres = $db->table('livre')->get()->getResultArray();

    return view('admin/ajouter_exemplaire', ['livres' => $livres]);
}

public function creerExemplaire()
{
    $db = \Config\Database::connect();

    $data = [
        'code_catalogue'     => $this->request->getPost('code_catalogue'),
        'nom_editeur'        => $this->request->getPost('nom_editeur'),
        'code_usure'         => $this->request->getPost('code_usure'),
        'date_acquisition'   => $this->request->getPost('date_acquisition'),
        'emplacement_rayon'  => $this->request->getPost('emplacement_rayon'),
        'etat_exemplaire'    => $this->request->getPost('etat_exemplaire'),
        'disponibilite'      => 1,
    ];

    $db->table('exemplaire')->insert($data);

    return redirect()->to('/livres_disponibles')->with('success', 'Exemplaire ajouté avec succès.');
}

public function afficherFormulaireExemplairePourLivre($code_catalogue)
{
    $db = \Config\Database::connect();
    $livre = $db->table('livre')->getWhere(['code_catalogue' => $code_catalogue])->getRow();

    if (!$livre) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return view('admin/ajouter_exemplaire', ['livre' => $livre]);
}


}
