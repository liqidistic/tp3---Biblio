<?= view('templates/header', ['title' => 'Connexion']) ?>

<section class="tech info-box login-card">
    <h2>Connexion</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= site_url('login') ?>">
        <div class="form-group">
            <label for="login">Identifiant</label>
            <input type="text" placeholder="Ton numÃ©ro de matricule" name="login" id="login" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</section>

<?= view('templates/footer') ?>