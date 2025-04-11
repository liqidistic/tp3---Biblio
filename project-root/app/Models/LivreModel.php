<?php

namespace app\Models;

use CodeIgniter\Model;

class LivreModel extends Model
{
    protected $table = 'livres';
    protected $primaryKey = 'id';
    protected $allowedFields = ['titre', 'id_auteur'];
}
