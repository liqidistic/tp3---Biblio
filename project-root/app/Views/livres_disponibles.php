<?= view('templates/header', ['title' => 'Livres Disponibles']) ?>

<h2>Livres disponibles</h2>
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
                    <td><?= esc($livre->titre_livre) ?></td>
                    <td><?= esc($livre->code_usure) ?></td>
                    <td><?= esc($livre->nom_editeur) ?></td>
                    <td><?= esc($livre->emplacement_rayon) ?></td>
                    <td><a href="<?= site_url('creer_demande/' . urlencode($livre->code_catalogue)) ?>" class="btn btn-primary">
    Faire une demande
</a>
                        </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Aucun livre disponible.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?= view('templates/footer') ?>
