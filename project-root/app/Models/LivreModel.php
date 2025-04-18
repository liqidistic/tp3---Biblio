<?php

namespace app\Models;

use CodeIgniter\Model;

class LivreModel extends Model
{
    protected $table = 'livre';
    protected $primaryKey = 'id';
    protected $allowedFields = ['code_catalogue', 'titre_livre', 'theme_livre'];
}

