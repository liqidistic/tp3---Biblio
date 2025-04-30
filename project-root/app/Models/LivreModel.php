<?php

namespace App\Models;
use CodeIgniter\Model;

class LivreModel extends Model
{
    protected $table = 'livre';
    protected $primaryKey = 'code_catalogue';
    protected $allowedFields = ['code_catalogue', 'titre_livre', 'theme_livre'];
    protected $useTimestamps = false;

    public function getLivresDisponibles()
    {
        return $this->select('livre.*')
                    ->join('exemplaire', 'exemplaire.code_catalogue = livre.code_catalogue')
                    ->where('exemplaire.code_usure !=', 'DEGRADE')
                    ->groupBy('livre.code_catalogue')
                    ->findAll();
    }
}