<?php

namespace app\Models;

use CodeIgniter\Model;

class MotCleModel extends Model
{
    protected $table = 'motcle';
    protected $primaryKey = 'id_motCle';
    protected $allowedFields = ['motCle'];

    public function firstOrCreate($data)
    {
        $mot = $this->where($data)->first();
        if ($mot) return $mot;

        $this->insert($data);
        $data['id'] = $this->insertID();
        return $data;
    }
}
