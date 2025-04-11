<?php

namespace app\Models;

use CodeIgniter\Model;

class MotCleModel extends Model
{
    protected $table = 'mots_cles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['libelle'];

    public function firstOrCreate($data)
    {
        $mot = $this->where($data)->first();
        if ($mot) return $mot;

        $this->insert($data);
        $data['id'] = $this->insertID();
        return $data;
    }
}
