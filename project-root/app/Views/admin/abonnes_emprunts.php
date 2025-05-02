<?= view('templates/header', ['title' => $title]) ?>

<div class="container">
    <h2 class="titre"><?= esc($title) ?></h2>

    <div class="info-box">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Abonné</th>
                    <th>Livre</th>
                    <th>Date emprunt</th>
                    <th>Date retour</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($emprunts)): ?>
                    <tr>
                        <td colspan="6" class="text-center">Aucun emprunt trouvé.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($emprunts as $e): ?>
                        <tr>
                            <td><?= esc($e['matricule_abonne']) ?></td>
                            <td><?= esc($e['nom_abonne']) ?></td>
                            <td><?= esc($e['titre_livre']) ?></td>
                            <td><?= esc($e['date_emprunt']) ?></td>
                            <td><?= esc($e['date_retour'] ?? '—') ?></td>
                            <td>
                                <?php if (empty($e['date_retour'])): ?>
                                    <a href="<?= base_url("admin/retour/{$e['matricule_abonne']}/{$e['cote_exemplaire']}") ?>"
                                       class="btn btn-primary">
                                        Rendre
                                    </a>
                                <?php else: ?>
                                    <span class="badge badge-success">✔️ Retourné</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= view('templates/footer') ?>
