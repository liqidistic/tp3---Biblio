<?php

namespace App\Models;
use CodeIgniter\Model;

class AssocieModel extends Model
{
    protected $table = 'associe';
    protected $allowedFields = ['code_catalogue', 'id_motCle'];
    public $useAutoIncrement = false;
}
