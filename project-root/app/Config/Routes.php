<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// ===============================
// ROUTES LOGIN / LOGOUT
// ===============================
$routes->get('login', 'Connection::index');
$routes->post('login', 'Connection::attemptLogin');
$routes->get('home', 'Home::index', ['filter' => 'isLoggedIn']);
$routes->get('logout', 'Connection::logout');

// ===============================
// ROUTES ADMIN
// ===============================
$routes->get('admin/livres', 'Admin::livres', ['filter' => 'isLoggedIn']);
$routes->get('admin/livres/ajouter', 'Admin::ajouterLivre', ['filter' => 'isLoggedIn']);
$routes->post('admin/livres/ajouter', 'Admin::ajouterLivre', ['filter' => 'isLoggedIn']);
$routes->get('admin/exemplaires/ajouter', 'Admin::ajouterExemplaire', ['filter' => 'isLoggedIn']);
$routes->post('admin/exemplaires/ajouter', 'Admin::ajouterExemplaire', ['filter' => 'isLoggedIn']);
$routes->get('admin/abonnes/ajouter', 'Admin::ajouterAbonne', ['filter' => 'isLoggedIn']);
$routes->post('admin/abonnes/ajouter', 'Admin::ajouterAbonne', ['filter' => 'isLoggedIn']);
$routes->match(['GET', 'POST'], 'admin/abonnes/emprunts', 'Admin::abonnesEmprunts');
$routes->match(['GET', 'POST'], 'admin/retour/(:segment)/(:segment)', 'Admin::retourLivre/$1/$2');
$routes->get('admin/demande_gestion', 'Admin::gestionDemandes');
$routes->post('admin/demande_gestion/supprimer/(:segment)/(:segment)', 'Admin::supprimerDemande/$1/$2');

// ===============================
// ROUTES USER
// ===============================
$routes->get('abonne/emprunts', 'Abonne::emprunts');
$routes->get('abonne/exemplaires', 'Abonne::exemplairesDisponibles');
$routes->get('abonne/exemplaires/(:segment)', 'Abonne::exemplairesDisponibles/$1');
$routes->get('abonne/emprunts/(:segment)', 'Abonne::emprunts/$1');
$routes->post('abonne/emprunts/(:segment)', 'Abonne::emprunts/$1');
// Route pour afficher la page de demande d'un livre
$routes->get('abonne/livre_disponible/(:segment)', 'Abonne::demander/$1');

$routes->match(['GET', 'POST'], 'abonne/demander/(:segment)', 'Abonne::demander/$1');
$routes->get('/mes_demandes', 'Abonne::mesDemandes');
$routes->post('/supprimer-demande/(:segment)', 'DemandeController::supprimerDemande/$1');$routes->post('/retourner/(:segment)', 'Abonne::retourner/$1');
$routes->post('/renouveler/(:segment)', 'Abonne::renouveler/$1');
$routes->post('/reserver/(:segment)', 'Abonne::reserver/$1');

// ===============================
// ROUTES GENERALES
// ===============================
$routes->get('livre/(:any)', 'Livre::voir/$1');

// ===============================
// ROUTES ADMIN DEMANDES
// ===============================
$routes->get('/admin/demandes', 'DemandeAdminController::index');
$routes->get('/admin/supprimer_demande/(:num)', 'DemandeAdminController::supprimer/$1');

// ===============================
// ROUTES DEMANDE (UTILISATEUR)
// ===============================
$routes->get('/creer_demande', 'DemandeController::creer');
$routes->post('/creer_demande', 'DemandeController::creer');
$routes->get('/mes_demandes', 'DemandeController::mesDemandes');
$routes->get('/supprimer_demande/(:num)', 'DemandeController::supprimer/$1');
$routes->get('/valider_demande/(:segment)', 'DemandeController::valider/$1');

// ===============================
// ROUTES ADMIN EXEMPLAIRES
// ===============================
$routes->get('/admin/retour/(:num)/(:segment)', 'EmpruntController::retour/$1/$2');
$routes->post('/admin/retour_traitement', 'EmpruntController::retour_traitement');

// ===============================
// ROUTES ADMIN ETAT EXEMPLAIRES
// ===============================
$routes->get('/admin/etat_exemplaires', 'EtatExemplaireController::index');
