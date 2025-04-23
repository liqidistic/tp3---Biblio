<!DOCTYPE html>
<html>
<head>
    <title>Liste des livres</title>
</head>
<body>

    <h1>Liste des livres</h1>

    <?php if (!empty($livres)): ?>
        <table border="1" cellpadding="5">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Titre</th>
                    <th>Thème</th>
                    <th>Auteur</th>
                    <th>Mots-clés</th>
                    <th>Nombre d'exemplaires</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livres as $livre): ?>
                    <tr>
                        <td><?= esc($livre->code_catalogue) ?></td>
                        <td><?= esc($livre->titre_livre) ?></td>
                        <td><?= esc($livre->theme_livre) ?></td>
                        <td><?= esc($livre->nom_auteur) ?></td>
                        <td><?= esc($livre->mots_cles) ?></td>
                        <td><?= esc($livre->nb_exemplaires) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun livre trouvé.</p>
    <?php endif; ?>
    <a href="<?= site_url('admin/ajouterLivre') ?>" class="btn-ajouter">➕ Ajouter un livre</a>

</body>
</html>
