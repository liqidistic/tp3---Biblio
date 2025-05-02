<?= view('templates/header', ['title' => 'Créer un administrateur']) ?>

<div class="container">
    <section class="info-box login-card">
        <h2>👤 Création d’un nouvel administrateur</h2>

        <?php if (!isset($accesOK) || !$accesOK): ?>
        <form method="POST" action="/admin/creer">
            <label>Mot de passe maître :</label>
            <input type="password" name="mdp_maitre" required>
            <button type="submit">Vérifier</button>
        </form>
        <?php if (!empty($erreur)): ?>
            <p style="color: red;"><?= esc($erreur) ?></p>
        <?php endif; ?>
        <?php else: ?>
        <form method="POST" action="/admin/creer">
            <input type="hidden" name="mdp_maitre" value="<?= esc(MOT_DE_PASSE_MAITRE) ?>">

            <label>Identifiant admin :</label>
            <input type="text" name="identifiant" required>

            <label>Mot de passe :</label>
            <input type="password" name="mot_de_passe" required>

            <button type="submit">Créer l’admin</button>
        </form>
        <?php endif; ?>
    </section>
</div>

<?= view('templates/footer') ?>
