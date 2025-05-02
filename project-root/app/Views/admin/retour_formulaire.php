<?= view('templates/header', ['title' => 'Retour d\'emprunt']) ?>

<div class="container">
    <section class="info-box login-card">
        <h2>Retour d'emprunt</h2>

        <form method="POST" action="<?= site_url('/admin/retour_traitement') ?>">
            <input type="hidden" name="matricule_abonne" value="<?= esc($matricule_abonne) ?>">
            <input type="hidden" name="cote_exemplaire" value="<?= esc($cote_exemplaire) ?>">

            <div class="form-group">
                <label for="etat_exemplaire">État de l'exemplaire :</label>
                <select name="etat_exemplaire" id="etat_exemplaire" required>
                    <option value="NEUF">NEUF</option>
                    <option value="TRES BON">TRES BON</option>
                    <option value="BON">BON</option>
                    <option value="MOYEN">MOYEN</option>
                    <option value="DEGRADE">DEGRADE</option>
                </select>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Valider retour</button>
            </div>
        </form>
    </section>
</div>

<?= view('templates/footer') ?>