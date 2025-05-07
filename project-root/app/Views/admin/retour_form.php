<?= view('templates/header', ['title' => 'Gestion des demandes']) ?>

<h2>Retour de l’exemplaire <?= esc($exemplaire['cote_exemplaire']) ?></h2>

<form method="post" action="<?= site_url('/admin/retourner/' . $exemplaire['cote_exemplaire']) ?>">
    <div class="form-group">
        <label>Nouvel état de l’exemplaire :</label>
        <select name="etat_exemplaire" class="form-control" required>
            <option value="NEUF">Neuf</option>
            <option value="BON">Bon</option>
            <option value="MOYEN">Moyen</option>
            <option value="DEGRADE">Dégradé</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Valider le retour</button>
</form>

<?= view('templates/footer') ?>
