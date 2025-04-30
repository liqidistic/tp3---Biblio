<?php

namespace App\Controllers;
use App\Models\LivreModel;
use App\Controllers\BaseController;

class LivreController extends BaseController
{
    public function livresDisponibles()
    {
        $livreModel = new LivreModel();
        $livres = $livreModel->getLivresDisponibles(); 
        
        return view('abonne/livre_disponible', ['livres' => $livres]);
    }
}
