<?php

namespace App\Models;
use CodeIgniter\Model;

class EcritModel extends Model
{
    protected $table = 'ecrit';
    protected $allowedFields = ['code_catalogue', 'id_auteur'];
    public $useAutoIncrement = false;
}
