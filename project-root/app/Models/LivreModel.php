<?php

namespace App\Models;
use CodeIgniter\Model;

class LivreModel extends Model
{
    protected $table = 'livre';
    protected $primaryKey = 'code_catalogue';
    protected $allowedFields = ['code_catalogue', 'titre_livre', 'theme_livre'];
    protected $useTimestamps = false;

    public function getLivresDisponibles()
    {
        return $this->select('livre.*')
                    ->join('exemplaire', 'exemplaire.code_catalogue = livre.code_catalogue')
                    ->where('exemplaire.code_usure !=', 'DEGRADE')
                    ->groupBy('livre.code_catalogue')
                    ->findAll();
    }
    public function creerLivreEtExemplaire()
{
    $db = \Config\Database::connect();
    $request = $this->request;

    $code_catalogue = $request->getPost('code_catalogue');
    $titre_livre    = $request->getPost('titre_livre');
    $theme_livre    = $request->getPost('theme_livre');

    $livre = $db->table('livre')->getWhere(['code_catalogue' => $code_catalogue])->getRow();

    if (!$livre) {
        $db->table('livre')->insert([
            'code_catalogue' => $code_catalogue,
            'titre_livre' => $titre_livre,
            'theme_livre' => $theme_livre
        ]);
    }

    $db->table('exemplaire')->insert([
        'code_catalogue'     => $code_catalogue,
        'nom_editeur'        => $request->getPost('nom_editeur'),
        'code_usure'         => $request->getPost('code_usure'),
        'emplacement_rayon'  => $request->getPost('emplacement_rayon'),
        'etat_exemplaire'    => $request->getPost('etat_exemplaire'),
        'disponibilite'      => 1,
        'date_acquisition'   => date('Y-m-d')
    ]);
}
public function listeLivres()
{
    $db = \Config\Database::connect();

    $query = $db->query("
        SELECT 
            livre.titre_livre,
            exemplaire.code_usure,
            exemplaire.nom_editeur,
            exemplaire.emplacement_rayon
        FROM exemplaire
        INNER JOIN livre ON exemplaire.code_catalogue = livre.code_catalogue
        WHERE exemplaire.disponibilite = 1
    ");

    return $query->getResultArray(); 
}

public function ajouterLivreEtExemplaire($data)
{
    $db = \Config\Database::connect();

    // Vérifier si le livre existe
    $livre = $db->table('livre')->getWhere(['code_catalogue' => $data['code_catalogue']])->getRow();

    if (!$livre) {
        $db->table('livre')->insert([
            'code_catalogue' => $data['code_catalogue'],
            'titre_livre'    => $data['titre_livre'],
            'theme_livre'    => $data['theme_livre']
        ]);
    }

    if (!empty($data['auteurs']) && is_array($data['auteurs'])) {
        foreach ($data['auteurs'] as $idAuteur) {
            $db->table('livre_auteur')->insert([
                'code_catalogue' => $data['code_catalogue'],
                'id_auteur' => $idAuteur
            ]);
        }
    }

    // Créer l'exemplaire
    $db->table('exemplaire')->insert([
        'code_catalogue'     => $data['code_catalogue'],
        'nom_editeur'        => $data['nom_editeur'],
        'code_usure'         => $data['code_usure'],
        'emplacement_rayon'  => $data['emplacement_rayon'],
        'etat_exemplaire'    => $data['etat_exemplaire'],
        'disponibilite'      => 1,
        'date_acquisition'   => date('Y-m-d')
    ]);
}

}

