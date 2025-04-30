<?php

namespace App\Models;

use CodeIgniter\Model;

class MotCleModel extends Model
{
    protected $table = 'motcle';
    protected $primaryKey = 'id_motcle';
    protected $allowedFields = ['motcle'];
}
