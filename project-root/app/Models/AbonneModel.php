<?php

namespace App\Models;

use CodeIgniter\Model;

class AbonneModel extends Model
{
    protected $table = 'abonne';
    protected $primaryKey = 'matricule_abonne';

    protected $allowedFields = [
        'matricule_abonne',
        'nom_abonne',
        'date_naissance_abonne',
        'date_adhesion_abonne',
        'adresse_abonne',
        'telephone_abonne',
        'csp_abonne',
    ];

    public function getAbonneByMatricule($matricule)
    {
        return $this->find($matricule); // Utilise la clé primaire
    }
}
