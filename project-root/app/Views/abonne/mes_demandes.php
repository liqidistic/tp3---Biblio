<?= view('templates/header', ['title' => 'Mes demandes']) ?>

<div class="container">
    <h2 class="titre">Mes demandes</h2>

    <div class="info-box">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Exemplaire</th>
                    <th>Titre du livre</th>
                    <th>Date de la demande</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($demandes)): ?>
                    <tr>
                        <td colspan="4" class="text-center">Aucune demande enregistrée.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($demandes as $d): ?>
                        <tr>
                            <td><?= esc($d['cote_exemplaire']) ?></td>
                            <td><?= esc($d['titre_livre'] ?? 'Titre inconnu') ?></td>
                            <td><?= esc($d['date_demande']) ?></td>
                            <td>
                                <form action="<?= base_url('/supprimer-demande/' . $d['cote_exemplaire']) ?>" method="POST">
                                    <?= csrf_field() ?>
                                    <button class="btn btn-secondary">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= view('templates/footer') ?>
