<?php

namespace App\Controllers;
use App\Models\LivreModel;
use App\Controllers\BaseController;

class LivreController extends BaseController
{
    public function livresDisponibles()
{
    $db = \Config\Database::connect();
    $query = $db->query("
    SELECT l.titre_livre, l.code_catalogue, e.code_usure, e.nom_editeur, e.emplacement_rayon
    FROM exemplaire e
    INNER JOIN livre l ON e.code_catalogue = l.code_catalogue
    WHERE e.disponibilite = 1
");

    $data['livres'] = $query->getResult();

    return view('livres_disponibles', $data);
}
}