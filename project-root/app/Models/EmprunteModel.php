<?php

namespace App\Models;

use CodeIgniter\Model;

class EmprunteModel extends Model
{
    protected $table = 'emprunte';
    protected $allowedFields = [
        'matricule_abonne',
        'cote_exemplaire',
        'date_emprunt',
        'date_retour',
        'estrenouvele'
    ];

    public function exemplairesEmpruntes(): array
    {
        return $this->select('cote_exemplaire')
            ->where('date_retour IS NULL', null, false)
            ->findAll();
    }
}
