<?php

namespace App\Models;
use CodeIgniter\Model;

class ExemplaireModel extends Model
{
    protected $table = 'exemplaire'; // Nom de ta table
    protected $primaryKey = 'cote_exemplaire'; // La clé primaire
    protected $allowedFields = ['cote_exemplaire', 'code_catalogue', 'etat_exemplaire']; // Les champs modifiables
    protected $useTimestamps = false;

    /**
     * Récupère tous les exemplaires sauf ceux dégradés
     */
   public function afficherFormulaireExemplaire()
{
    $db = \Config\Database::connect();
    $livres = $db->table('livre')->get()->getResultArray();

    return view('admin/ajouter_exemplaire', ['livres' => $livres]);
}


    /**
     * Récupère les exemplaires d'un livre spécifique (sauf dégradés)
     */
    public function getExemplairesParLivre($codeCatalogue)
    {
        return $this->where('code_catalogue', $codeCatalogue)
                    ->where('etat_exemplaire !=', 'DEGRADE')
                    ->findAll();
    }

    /**
     * Récupère un exemplaire précis même s'il est dégradé (optionnel)
     */
    public function getExemplaire($coteExemplaire)
    {
        return $this->find($coteExemplaire);
    }
}
