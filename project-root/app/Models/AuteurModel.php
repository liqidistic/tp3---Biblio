<?php

namespace app\Models;

use CodeIgniter\Model;

class AuteurModel extends Model
{
    protected $table = 'auteurs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom'];

    public function firstOrCreate($data)
    {
        $auteur = $this->where($data)->first();
        if ($auteur) return $auteur;

        $this->insert($data);
        $data['id'] = $this->insertID();
        return $data;
    }
}
