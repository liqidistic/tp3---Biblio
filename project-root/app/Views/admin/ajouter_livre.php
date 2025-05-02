<?= view('templates/header', ['title' => 'Ajouter un livre']) ?>

<div class="info-box">
    <h2>Ajouter un livre</h2>

    <form method="POST" action="<?= base_url('admin/livres/creer') ?>">
        <?= csrf_field() ?>

        <label for="code_catalogue">Code catalogue :</label>
        <input type="text" name="code_catalogue" id="code_catalogue" required>

        <label for="titre_livre">Titre :</label>
        <input type="text" name="titre_livre" id="titre_livre" required>

        <label for="theme_livre">Thème :</label>
        <input type="text" name="theme_livre" id="theme_livre" required>

        <label for="motscles">Mot(s)-clé(s) :</label>
        <input type="text" name="motscles" id="motscles" placeholder="ex: roman, fantasy">

        <label for="nom_auteur_select">Auteur existant :</label>
<select name="nom_auteur" id="nom_auteur_select">
    <option value="">-- Ajouter un nouvel auteur ci-dessous --</option>
    <?php foreach ($auteurs as $auteur): ?>
        <option value="<?= esc($auteur['nom_auteur']) ?>"><?= esc($auteur['nom_auteur']) ?></option>
    <?php endforeach; ?>
</select>

<label for="nom_auteur">Nouvel auteur (si non listé ci-dessus) :</label>
<input type="text" name="nom_auteur_custom" id="nom_auteur">

        <button type="submit">Ajouter le livre</button>
    </form>
</div>

<?= view('templates/footer') ?>
