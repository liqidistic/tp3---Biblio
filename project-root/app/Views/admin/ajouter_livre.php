<?= view('templates/header', ['title' => 'Ajouter un livre']) ?>

<div class="info-box">
<h2>Ajouter un livre</h2>

<form method="POST" action="<?= base_url('admin/livres/ajouter') ?>">
    <?= csrf_field() ?>

    <label for="code_catalogue">Code catalogue :</label>
    <input type="text" id="code_catalogue" name="code_catalogue" required>

    <label for="titre_livre">Titre :</label>
    <input type="text" id="titre_livre" name="titre_livre" required>

    <label for="theme_livre">Thème :</label>
    <input type="text" id="theme_livre" name="theme_livre">

    <label for="auteurs">Auteur(s) (séparés par des virgules) :</label>
    <input type="text" id="auteurs" name="auteurs">

    <label for="motscles">Mot(s)-clé(s) (séparés par des virgules) :</label>
    <input type="text" id="motscles" name="motscles">

    <button type="submit">Ajouter</button>
</form>
</div>  

<?= view('templates/footer') ?>