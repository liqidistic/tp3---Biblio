<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'administrateur';
    protected $primaryKey = 'id_admin';
    protected $allowedFields = ['identifiant', 'mot_de_passe'];
    public $useTimestamps = false;
}
