<?php

namespace app\Models;

use CodeIgniter\Model;

class AbonneModel extends Model
{
    protected $table = 'abonne';
    protected $primaryKey = 'matricule_abonne';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
    'matricule_abonne',
    'nom_abonne',
    'date_naissance_abonne',
    'date_adhesion_abonne',
    'adresse_abonne',
    'CSP_abonne'
    ];

    protected bool $allowEmptyInsert = false;
    protected bool $updateOnlyChanged = true;


}
