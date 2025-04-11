<!DOCTYPE html>
<html lang="fr">
    <meta charset="UTF-8">
<head>
    <title>Ajouter un livre</title>
</head>
<body>
    <h1>Ajouter un livre</h1>
    <form action="<?= base_url('admin/ajouter_livre') ?>" method="post">
        <input type="text" name="titre" placeholder="Titre du livre" required><br>
        <textarea name="description" placeholder="Description" required></textarea><br>
        <input type="text" name="auteur_id" placeholder="ID de l'auteur" required><br>
        <input type="text" name="mots_cles" placeholder="Mots-clés (séparés par des virgules)" required><br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
