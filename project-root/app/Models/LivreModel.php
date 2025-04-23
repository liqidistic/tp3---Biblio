<?php

namespace App\Models;
use CodeIgniter\Model;

class LivreModel extends Model {
    protected $table = 'livre';
    protected $primaryKey = 'code_catalogue';
    protected $allowedFields = ['code_catalogue', 'titre_livre', 'theme_livre'];
    public $useAutoIncrement = false;

    public function getLivresDetails()
    {
        return $this->db->table('livre l')
            ->select('l.code_catalogue, l.titre_livre, l.theme_livre, a.nom_auteur, 
                      GROUP_CONCAT(DISTINCT mc.motCle ORDER BY mc.motCle SEPARATOR ", ") as mots_cles,
                      COUNT(DISTINCT e.cote_exemplaire) as nb_exemplaires')
            ->join('ecrit ec', 'l.code_catalogue = ec.code_catalogue', 'left')
            ->join('auteur a', 'ec.id_auteur = a.id_auteur', 'left')
            ->join('associe ac', 'l.code_catalogue = ac.code_catalogue', 'left')
            ->join('motcle mc', 'ac.id_motCle = mc.id_motCle', 'left')
            ->join('exemplaire e', 'l.code_catalogue = e.code_catalogue', 'left')
            ->groupBy('l.code_catalogue, l.titre_livre, l.theme_livre, a.nom_auteur')
            ->orderBy('l.titre_livre', 'ASC')
            ->get()
            ->getResult();
    }
}
