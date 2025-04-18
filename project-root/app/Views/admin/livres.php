<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Livres - Admin</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>

    <h1>📚 Liste des Livres</h1>
    <a href="<?= base_url('admin/dashboard') ?>">← Retour au Tableau de Bord</a>
    <br><br>
    <a href="<?= base_url('admin/ajouter_livre') ?>"><button>➕ Ajouter un Livre</button></a>
    <br><br>

    <?php if (!empty($livres)): ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Éditeur</th>
                    <th>Année</th>
                    <th>Résumé</th>
                    <th>Mots-clés</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livres as $livre): ?>
                    <tr>
                        <td><?= $livre->id_livre ?></td>
                        <td><?= $livre->titre_livre ?></td>
                        <td><?= $livre->nom_auteur ?></td>
                        <td><?= $livre->editeur_livre ?></td>
                        <td><?= $livre->annee_livre ?></td>
                        <td><?= $livre->resume_livre ?></td>
                        <td><?= $livre->mots_cles ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun livre trouvé.</p>
    <?php endif; ?>

</body>
</html>
