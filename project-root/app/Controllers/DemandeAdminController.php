<?php

namespace App\Controllers;
use App\Models\DemandeModel;
use App\Controllers\BaseController;

class DemandeAdminController extends BaseController
{
    public function index()
    {
        $demandeModel = new DemandeModel();
        $demandes = $demandeModel->getAllDemandes();

        return view('gestion_demandes', ['demandes' => $demandes]);
    }

    public function supprimer($id)
    {
        $demandeModel = new DemandeModel();
        $demandeModel->delete($id);

        return redirect()->to('/admin/demandes')->with('success', 'Demande supprimée.');
    }
}
