<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Page d’accueil
$routes->get('/', 'Home::index');
$routes->get('home', 'Connection::home');

// ===============================
// LOGIN / LOGOUT
// ===============================
$routes->get('login', 'Connection::index');
$routes->post('login', 'Connection::attemptLogin');
$routes->get('logout', 'Connection::logout', ['filter' => 'isLoggedIn']);

// ===============================
// ADMIN
// ===============================
$routes->group('admin', ['filter' => 'isLoggedIn'], function($routes) {
    $routes->get('ajouter_livre', 'Admin::ajouterLivre');
    $routes->post('ajouter_livre', 'Admin::ajouterLivre');
    $routes->get('exemplaires/ajouter', 'Admin::ajouterExemplaire');
    $routes->post('exemplaires/ajouter', 'Admin::ajouterExemplaire');
    $routes->get('abonnes/ajouter', 'Admin::ajouterAbonne');
    $routes->post('abonnes/ajouter', 'Admin::ajouterAbonne');
    $routes->match(['get', 'post'], 'abonnes/emprunts', 'Admin::abonnesEmprunts');
    $routes->match(['get', 'post'], 'retour/(:segment)/(:segment)', 'Admin::retourLivre/$1/$2');
    $routes->get('demande_gestion', 'Admin::gestionDemandes');
    $routes->post('demande_gestion/supprimer/(:segment)/(:segment)', 'Admin::supprimerDemande/$1/$2');
    $routes->get('creer', 'Admin::creer_admin');
    $routes->post('creer', 'Admin::creer_admin');
});

// Routes indépendantes admin (hors groupe)
$routes->get('admin/retourner/(:segment)', 'Admin::formRetour/$1', ['filter' => 'isLoggedIn']);
$routes->post('admin/retourner/(:segment)', 'Admin::traiterRetour/$1', ['filter' => 'isLoggedIn']);

// ===============================
// ABONNÉ
// ===============================
$routes->group('abonne', ['filter' => 'isLoggedIn'], function($routes) {
    $routes->get('emprunts', 'Abonne::emprunts');
    $routes->get('exemplaires', 'Abonne::exemplairesDisponibles');
    $routes->get('exemplaires/(:segment)', 'Abonne::exemplairesDisponibles/$1');
    $routes->get('emprunts/(:segment)', 'Abonne::emprunts/$1');
    $routes->post('emprunts/(:segment)', 'Abonne::emprunts/$1');
    $routes->match(['get', 'post'], 'demander/(:segment)', 'Abonne::demander/$1');
    $routes->get('mes_demandes', 'DemandeController::mesDemandes');  // OK si vue est bien dans abonne/
    $routes->post('supprimer-demande/(:segment)', 'DemandeController::supprimerDemande/$1');
    $routes->post('retourner/(:segment)', 'Abonne::retourner/$1');
    $routes->post('renouveler/(:segment)', 'Abonne::renouveler/$1');
    $routes->post('reserver/(:segment)', 'Abonne::reserver/$1');
});

// ===============================
// DEMANDE UTILISATEUR
// ===============================
$routes->get('creer_demande', 'DemandeController::creer', ['filter' => 'isLoggedIn']);
$routes->post('creer_demande', 'DemandeController::creer', ['filter' => 'isLoggedIn']);
$routes->get('supprimer_demande/(:num)', 'DemandeController::supprimer/$1', ['filter' => 'isLoggedIn']);
$routes->get('valider_demande/(:segment)/(:segment)', 'DemandeAdminController::validerDemande/$1/$2', ['filter' => 'isLoggedIn']);

// ===============================
// GÉNÉRAL
// ===============================
$routes->get('livres_disponibles', 'LivreController::livresDisponibles', ['filter' => 'isLoggedIn']);
$routes->get('livre/exemplaires/(:segment)', 'LivreController::exemplairesDisponibles/$1', ['filter' => 'isLoggedIn']);
$routes->get('demander/(:segment)', 'DemandeController::demander/$1', ['filter' => 'isLoggedIn']);
$routes->get('livres', 'LivreController::listeLivres', ['filter' => 'isLoggedIn']);
$routes->get('admin/ajouter_exemplaire/(:segment)', 'LivreController::afficherFormulaireExemplairePourLivre/$1', ['filter' => 'isLoggedIn']);
