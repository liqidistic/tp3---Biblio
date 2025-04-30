<?php

namespace App\Models;

use CodeIgniter\Model;

class AssocieModel extends Model
{
    protected $table = 'associe';
    protected $primaryKey = false;
    protected $allowedFields = ['code_catalogue', 'id_motcle'];
}
