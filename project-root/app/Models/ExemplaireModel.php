<?php

namespace app\Models;

use CodeIgniter\Model;

class ExemplaireModel extends Model
{
    protected $table = 'exemplaires';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_livre', 'etat'];
}
