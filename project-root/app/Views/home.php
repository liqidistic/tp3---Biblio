<?= view('templates/header', ['title' => 'Accueil']) ?>

<div class="container">
    <section class="info-box">
        <h2 class="titre">Bienvenue, <?= esc($username) ?> !</h2>

        <?php if (session()->get('role') === 'admin'): ?>
            <div class="card-dashboard">
                <h3>Panel Administrateur</h3>
                <p>Tu es connecté en tant qu'<strong>Administrateur</strong>.</p>

                <div class="btn-group">
                    <a href="<?= site_url('/admin/ajouter_livre') ?>" class="btn btn-primary">Ajouter un livre</a>
                    <a href="<?= site_url('/admin/ajouter_exemplaire') ?>" class="btn btn-primary">Ajouter un exemplaire</a>
                    <a href="<?= site_url('/admin/abonnes/ajouter') ?>" class="btn btn-primary">Ajouter un abonné</a>
                    
                </div>
            </div>
        
        <?php elseif (session()->get('role') === 'abonne'): ?>
            <div class="card-dashboard">
                <h3>Espace Abonné</h3>
                <p>Tu es connecté en tant qu'<strong>Abonné</strong>.</p>

                <div class="btn-group">
                    <a href="<?= site_url('/abonne/emprunts') ?>" class="btn btn-primary">Voir mes emprunts</a>
                    <a href="<?= site_url('/mes_demandes') ?>" class="btn btn-primary">Voir mes demandes</a>
                    <a href="<?= site_url('/livres_disponibles') ?>" class="btn btn-primary">Voir les livres disponibles</a>
                </div>
            </div>
        <?php endif; ?>
    </section>
</div>

<?= view('templates/footer') ?>
