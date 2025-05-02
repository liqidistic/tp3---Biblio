<?= view('templates/header', ['title' => 'Ajouter un abonné']) ?>

<div class="container">
    <section class="info-box login-card">
        <h2>Ajouter un abonné</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= site_url('/admin/abonnes/ajouter') ?>">

            <div class="form-group">
                <label for="nom_abonne">Nom :</label>
                <input type="text" name="nom_abonne" id="nom_abonne" required>
            </div>

            <div class="form-group">
                <label for="date_naissance_abonne">Date de naissance :</label>
                <input type="date" name="date_naissance_abonne" id="date_naissance_abonne" required>
            </div>

            <div class="form-group">
                <label for="date_adhesion_abonne">Date d'adhésion :</label>
                <input type="date" name="date_adhesion_abonne" id="date_adhesion_abonne" required>
            </div>

            <div class="form-group">
                <label for="adresse_abonne">Adresse :</label>
                <input type="text" name="adresse_abonne" id="adresse_abonne" required>
            </div>

            <div class="form-group">
                <label for="telephone_abonne">Téléphone :</label>
                <input type="text" name="telephone_abonne" id="telephone_abonne" required>
            </div>

            <div class="form-group">
                <label for="csp_abonne">Occupation :</label>
                <input type="text" name="csp_abonne" id="csp_abonne" required>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Ajouter l'abonné</button>
            </div>

        </form>
    </section>
</div>

<?= view('templates/footer') ?>
