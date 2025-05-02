<?= view('templates/header', ['title' => 'Ajouter un exemplaire']) ?>

<h2>Ajouter un exemplaire</h2>

<form method="POST" action="/admin/exemplaires/ajouter">
    <label>Livre (code catalogue) :</label>
    <select name="code_catalogue" required>
        <?php foreach ($livres as $livre): ?>
            <option value="<?= esc($livre['code_catalogue']) ?>">
                <?= esc($livre['titre_livre']) ?> (<?= esc($livre['code_catalogue']) ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <label>Nom éditeur :</label>
    <input type="text" name="nom_editeur" required>

    <label for="etat_exemplaire">État de l'exemplaire :</label>
                <select name="etat_exemplaire" id="etat_exemplaire" required>
                    <option value="NEUF">NEUF</option>
                    <option value="TRES BON">TRES BON</option>
                    <option value="BON">BON</option>
                    <option value="MOYEN">MOYEN</option>
                    <option value="DEGRADE">DEGRADE</option>
                </select>

    <label>Date d’acquisition :</label>
    <input type="date" name="date_acquisition" required>

    <label>Emplacement rayon :</label>
    <input type="text" name="emplacement_rayon" required>

    <button type="submit">Ajouter l'exemplaire</button>
</form>

<?= view('templates/footer') ?>
