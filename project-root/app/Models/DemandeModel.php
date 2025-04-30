<?php

namespace App\Models;
use CodeIgniter\Model;

class DemandeModel extends Model
{
    protected $table = 'demande';
    protected $primaryKey = ['matricule_abonne', 'code_catalogue'];  // La clé primaire composée
    protected $allowedFields = ['matricule_abonne', 'code_catalogue', 'date_demande'];  // Champs autorisés pour l'insertion
    protected $useTimestamps = false;  // Pas de timestamps (created_at, updated_at)
}
