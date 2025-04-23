<?php

namespace App\Models;

use CodeIgniter\Model;

class AuteurModel extends Model {
    protected $table = 'auteur';
    protected $primaryKey = 'id_auteur';
    protected $allowedFields = ['nom_auteur'];
}
