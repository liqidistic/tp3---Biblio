<?= view('templates/header', ['title' => 'Faire une demande']) ?>

<div class="container">
    <section class="info-box login-card">
        <h2>Faire une demande de livre</h2>

        <form method="POST" action="<?= site_url('/creer_demande') ?>">
            <div class="form-group">
                <label for="code_catalogue">Sélectionner un livre :</label>
                <select name="code_catalogue" id="code_catalogue" required>
                    <option value="">-- Choisir un livre --</option>
                    <?php foreach ($livres as $livre): ?>
                        <option value="<?= esc($livre['code_catalogue']) ?>">
                            <?= esc($livre['titre_livre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Faire une demande</button>
            </div>
        </form>
    </section>
</div>

<?= view('templates/footer') ?>
