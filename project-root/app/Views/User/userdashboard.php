<?= $this->extend('template/head') ?>
<?= $this->section('content') ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
   
    <div class="navbar">
        <a href="<?= base_url('user/dashboard') ?>">Tableau de Bord</a>
        <a href="<?= base_url('user/livres') ?>">Livres</a>
        <a href="<?= base_url('user/exemplaires') ?>">Exemplaires</a>
        <a href="<?= base_url('user/emprunt') ?>">Mes emprunts</a>
    </div>

   
    <div class="container">
        <div class="card">
            <i class="fas fa-book"></i>
            <h3>Emprunter un livre</h3>
            <p>Empruntez un nouveau livre à la bibliothèque.</p>
            <a href="<?= base_url('user/emprunt') ?>"><button>Ajouter</button></a>
        </div>
        <div class="card">
            <h3>Liste des livres</h3>
            <p>Consultez tous les livres de la bibliothèque.</p>
            <a href="<?= base_url('user/livres') ?>"><button>Voir</button></a>
        </div>
        <div class="card">
            <h3>Liste des exemplaires</h3>
            <p>Consultez tous les exemplaires de la bibliothèque.</p>
            <a href="<?= base_url('user/exemplaires') ?>"><button>Voir</button></a>
        </div>
        <div class="card">
            <h3>Mes informations</h3>
            <p>Consultez et modifier vos informations personnelles.</p>
            <a href="<?= base_url('user/moncompte') ?>"><button>Voir</button></a>
        </div>
    </div>

</body>
</html>
<?= $this->endSection() ?>