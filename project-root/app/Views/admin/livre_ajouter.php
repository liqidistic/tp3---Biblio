<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Livre</title>
</head>
<body>
    <h1>Ajouter un Livre</h1>
    <form action="<?= site_url('admin/ajouterLivre') ?>" method="post">
        <label for="code_catalogue">Code Catalogue :</label>
        <input type="text" name="code_catalogue" required><br>

        <label for="titre">Titre :</label>
        <input type="text" name="titre" required><br>

        <label for="theme">Thème :</label>
        <input type="text" name="theme" required><br>

        <label for="auteur">Nom de l’Auteur :</label>
        <input type="text" name="auteur" required><br>

        <label for="mots_cles">Mots-clés (séparés par des virgules) :</label>
        <input type="text" name="mots_cles"><br>

        <input type="submit" value="Ajouter">
    </form>
</body>
</html>
