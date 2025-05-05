<?= view('templates/header', ['title' => 'Livres Disponibles']) ?>

<div class="container">
    <h2 class="titre">Livres disponibles</h2>

    <div class="info-box">
        <?php if (empty($livres)): ?>
            <p>Aucun livre disponible.</p>
        <?php else: ?>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Code catalogue</th>
                        <th>Titre</th>
                        <th>Thème</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livres as $livre): ?>
                        <tr>
                            <td><?= esc($livre['code_catalogue']) ?></td>
                            <td><?= esc($livre['titre_livre']) ?></td>
                            <td><?= esc($livre['theme_livre']) ?></td>
                            <td>
                                <a href="<?= site_url('livre/exemplaires/' . urlencode($livre['code_catalogue'])) ?>" class="btn btn-primary">
                                    Voir les exemplaires
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?= view('templates/footer') ?>
