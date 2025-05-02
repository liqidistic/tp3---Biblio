<?= view('templates/header', ['title' => 'Ajouter un exemplaire']) ?>

<div class="info-box">
    <h2>Ajouter un exemplaire de livre</h2>

    <form method="POST" action="<?= base_url('admin/exemplaires/creer') ?>">
        <?= csrf_field() ?>

        <?php if (isset($livre)): ?>
            <!-- Livre prérempli -->
            <input type="hidden" name="code_catalogue" value="<?= esc($livre->code_catalogue) ?>">
            <p><strong>Livre :</strong> <?= esc($livre->titre_livre) ?> (<?= esc($livre->code_catalogue) ?>)</p>
        <?php elseif (isset($livres)): ?>
            <!-- Liste déroulante de tous les livres -->
            <label for="code_catalogue">Livre (code catalogue) :</label>
            <select name="code_catalogue" id="code_catalogue" required>
                <option value="">-- Sélectionner un livre --</option>
                <?php foreach ($livres as $livreItem): ?>
                    <option value="<?= $livreItem['code_catalogue'] ?>">
                        <?= esc($livreItem['titre_livre']) ?> (<?= esc($livreItem['code_catalogue']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        <?php else: ?>
            <p style="color: red;">Aucun livre n’est disponible.</p>
        <?php endif; ?>

        <label for="nom_editeur">Maison d’édition :</label>
        <input type="text" name="nom_editeur" id="nom_editeur" required>

        <label for="code_usure">État :</label>
        <select name="code_usure" id="code_usure" required>
            <option value="NEUF">NEUF</option>
            <option value="TRES BON">TRES BON</option>
            <option value="BON">BON</option>
            <option value="MOYEN">MOYEN</option>
            <option value="DEGRADE">DEGRADE</option>
        </select>

        <label for="date_acquisition">Date d’acquisition :</label>
        <input type="date" name="date_acquisition" id="date_acquisition" required>

        <label for="emplacement_rayon">Emplacement en rayon :</label>
        <input type="text" name="emplacement_rayon" id="emplacement_rayon" required>

        <label for="etat_exemplaire">État exemplaire :</label>
        <input type="text" name="etat_exemplaire" id="etat_exemplaire" value="disponible" required>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?= view('templates/footer') ?>
