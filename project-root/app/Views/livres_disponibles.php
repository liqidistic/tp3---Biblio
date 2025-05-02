<?= view('templates/header', ['title' => 'Livres Disponibles']) ?>

<div class="container">
    <h2 class="titre">Livres disponibles</h2>

    <div class="info-box">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>État</th>
                    <th>Maison d’édition</th>
                    <th>Rayon</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($livres)): ?>
                    <?php foreach ($livres as $livre): ?>
                        <tr>
                            <td><?= esc($livre['titre_livre']) ?></td>
                            <td><?= esc($livre['code_usure']) ?></td>
                            <td><?= esc($livre['nom_editeur']) ?></td>
                            <td><?= esc($livre['emplacement_rayon']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4">Aucun livre disponible.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= view('templates/footer') ?>
