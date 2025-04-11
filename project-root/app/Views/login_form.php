<?= $this->extend('template/head') ?>
<?= $this->section('content') ?>

<body>
    <div class="container">
        <h1>Se connecter</h1>
        <form method="POST" action="/login">
            <label for="login">Matricule abonné / Identifiant admin</label>
            <input id="login" name="login" type="text" />

            <label for="password">Nom abonné / Mot de passe admin</label>
            <input id="password" name="password" type="password" />

            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>

<?= $this->endSection() ?>