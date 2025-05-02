<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Bibliothèque') ?></title>
    <link rel="stylesheet" href="/assets/styles.css">
    </head>
<body>
<header>
    <section class="titre">
        <h1>Bibliothèque en ligne</h1>
    </section>

    <nav>
        <a href="/">&#x1F3E1; Accueil</a>
        <?php if (session()->get('loggedIn')): ?>
            <?php if (session()->get('role') === 'admin'): ?>
                | <a href="/admin/livres">&#x1F4DA; Gérer les livres</a>
                | <a href="/admin/abonnes/ajouter">&#x1F464; Ajouter un abonné</a>
                | <a href="/admin/creer">&#x1F46E; Créer admin</a>
                |<a href="/admin/demande_gestion">&#x1F46E; Gestion des demandes</a>
                |<a href="<?= base_url('admin/abonnes/emprunts') ?>">&#x1F4D6; Emprunts abonnés</a>

                
            <?php elseif (session()->get('role') === 'abonne'): ?>
                | <a href="/livres_disponibles">&#x1F4D6; Livres disponibles</a>
            <?php endif; ?>
            | <a href="/logout">&#x1F6AA; Se déconnecter</a>
        <?php else: ?>
            | <a href="/login">&#x1F510; Connexion</a>
        <?php endif; ?>
    </nav>
</header>

<main>
