<?= view('templates/header', ['title' => 'Bienvenue']) ?>
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

<div class="container">
    <section class="hero info-box">
        <h1>&#x1F4DA; Bienvenue sur la bibliothèque en ligne</h1>
        <p>Un projet de développement web réalisé dans le cadre de notre formation BTS SIO.</p>
    </section>

    <section class="about info-box">
        <h2>&#x1F4BB; À propos du projet</h2>
        <p>
            Cette application web a été conçue pour permettre aux abonnés d’une bibliothèque
            de consulter les livres disponibles, d’en emprunter, et de suivre leurs
            emprunts en cours. L’interface est simple, intuitive, et adaptée à un usage réel.
        </p>
    </section>

    <section class="features info-box">
        <h2>&#x2728; Fonctionnalités proposées aux abonnés</h2>
        <ul>
            <li>&#x1F4D6; Voir les livres disponibles à l'emprunt</li>
            <li>&#x1F4DD; Demander un livre indisponible</li>
            <li>&#x1F4CB; Suivre les emprunts en cours</li>
            <li>&#x1F4DA; Explorer le catalogue</li>
        </ul>
    </section>

    <section class="tech info-box">
        <h2>&#x1F6E0;&#xFE0F; Technologies utilisées</h2>
        <ul>
            <li>&#x1F525; CodeIgniter 4 (PHP)</li>
            <li>&#x1F4D1; MYSQL</li>
            <li>&#x1F4C4; HTML/CSS</li>
        </ul>
    </section>

    <section class="credits info-box">
        <h2>&#x1F465; Réalisé par César &amp; Cristhian</h2>
        <p>Avec l’aide précieuse de :</p>
        <ul>
            <li>&#x1F916; ChatGPT – pour la mise en forme et l'accompagnement technique</li>
            <li>&#x1F4C8; GitHub – pour le versioning et la gestion de projet</li>
            <li>&#x1F4C3; Documentation officielle de CodeIgniter – pour la compréhension du framework</li>
        </ul>
    </section>

    <section class="call-to-action info-box">
        <p>&#x1F513; Pour accéder à votre espace abonné, cliquez sur "Connexion".</p>
    </section>
</div>

<?= view('templates/footer') ?>
