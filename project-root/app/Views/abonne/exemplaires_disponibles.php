<?= view('templates/header', ['title' => 'Exemplaires disponibles']) ?>

<div class="container">
    <h2 class="titre">Exemplaires disponibles</h2>

    <?php if (empty($exemplaires)): ?>
        <p>Aucun exemplaire disponible pour ce livre.</p>
    <?php else: ?>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Éditeur</th>
                    <th>État</th>
                    <th>Usure</th>
                    <th>Emplacement</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exemplaires as $e): ?>
                    <tr>
                        <td><?= esc($e['nom_editeur']) ?></td>
                        <td><?= esc($e['etat_exemplaire']) ?></td>
                        <td><?= esc($e['code_usure']) ?></td>
                        <td><?= esc($e['emplacement_rayon']) ?></td>
                        <td>
                            <a href="<?= site_url('demander/' . $e['cote_exemplaire']) ?>" class="btn btn-primary">
                                Demander
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?= view('templates/footer') ?>
