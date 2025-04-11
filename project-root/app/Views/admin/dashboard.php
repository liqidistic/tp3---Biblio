<?= $this->extend('template/head') ?>
<?= $this->section('content') ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur</title>
    <link rel="stylesheet" href="">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .navbar {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 14px 20px;
            margin: 0 10px;
        }
        .navbar a:hover {
            background-color: #575757;
        }
        .container {
            display: flex;
            flex-wrap: nowrap; 
            gap: 20px;
            padding: 20px;
            justify-content: center;
            max-width: 100%; 
        }
        .card {
            background-color: white;
            padding: 20px;
            width: 300px; 
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            flex: 0 0 auto; 
            box-sizing: border-box;
        }
        .card i {
            font-size: 40px;
            margin-bottom: 10px;
        }
        .card h3 {
            margin: 10px 0;
        }
        .card p {
            font-size: 16px;
            color: #555;
        }
        .card button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 10px;
            width: 100%;
            transition: background-color 0.3s;
        }
        .card button:hover {
            background-color: #45a049;
        }
        
        @media (max-width: 1000px) {
            .container {
                flex-wrap: wrap; 
            }
        }
    </style>
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
            <a href="<?= base_url('admin/ajouter_livre') ?>"><button>Ajouter</button></a>
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