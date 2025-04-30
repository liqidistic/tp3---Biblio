<?php

namespace App\Models;

use CodeIgniter\Model;

class EcritModel extends Model
{
    protected $table = 'ecrit';
    protected $primaryKey = false;
    protected $allowedFields = ['code_catalogue', 'id_auteur'];
}
