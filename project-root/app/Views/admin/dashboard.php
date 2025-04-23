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
        <a href="<?= base_url('admin/dashboard') ?>">Tableau de Bord</a>
        <a href="<?= base_url('admin/livres') ?>">Livres</a>
        <a href="<?= base_url('admin/exemplaires') ?>">Exemplaires</a>
        <a href="<?= base_url('admin/abonnes') ?>">Abonnés</a>
    </div>

   
    <div class="container">
        <div class="card">
            <i class="fas fa-book"></i>
            <h3>Ajouter un Livre</h3>
            <p>Ajoutez un nouveau livre à la bibliothèque.</p>
            <a href="<?= site_url('admin/ajouterLivre') ?>"><button>Ajouter</button></a>
        </div>
        <div class="card">
            <h3>Liste des Livres</h3>
            <p>Consultez tous les livres de la bibliothèque.</p>
            <a href="<?= base_url('admin/livres') ?>"><button>Voir</button></a>
        </div>
        <div class="card">
            <h3>Ajouter un Exemplaire</h3>
            <p>Ajoutez un exemplaire pour un livre existant.</p>
            <a href="<?= base_url('admin/ajouter_exemplaire') ?>"><button>Ajouter</button></a>
        </div>
        <div class="card">
            <h3>Liste des Exemplaires</h3>
            <p>Consultez tous les exemplaires de la bibliothèque.</p>
            <a href="<?= base_url('admin/exemplaires') ?>"><button>Voir</button></a>
        </div>
        <div class="card">
            <h3>Enregistrer un Abonné</h3>
            <p>Ajoutez un nouvel abonné à la bibliothèque.</p>
            <a href="<?= base_url('admin/enregistrer_abonne') ?>"><button>Ajouter</button></a>
        </div>
        <div class="card">
            <h3>Liste des Abonnés</h3>
            <p>Consultez la liste des abonnés de la bibliothèque.</p>
            <a href="<?= base_url('admin/abonnes') ?>"><button>Voir</button></a>
        </div>
    </div>

</body>
</html>
<?= $this->endSection() ?>