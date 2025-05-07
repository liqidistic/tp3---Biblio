<?= view('templates/header', ['title' => 'Mes emprunts']) ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= esc(session()->getFlashdata('success')) ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= esc(session()->getFlashdata('error')) ?>
    </div>
<?php endif; ?>

<h2 class="titre">Mes emprunts en cours</h2>

<?php
    $empruntsEnCours = array_filter($emprunts, fn($e) => $e['rendu'] == 0);
?>

<?php if (empty($empruntsEnCours)): ?>
    <p>Tu n’as aucun emprunt en cours.</p>
<?php else: ?>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Exemplaire</th>
                <th>Date d'emprunt</th>
                <th>Date de retour</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empruntsEnCours as $e): ?>
                <tr>
                    <td><?= esc($e['titre_livre']) ?></td>
                    <td><?= esc($e['cote_exemplaire']) ?></td>
                    <td><?= esc($e['date_emprunt']) ?></td>
                    <td><?= esc($e['date_retour'] ?? '—') ?></td>
                    <td>
                        <div class="btn-group">
                            <?php if (!$e['estRenouvele']): ?>
                                <form method="POST" action="/abonne/renouveler/<?= esc($e['cote_exemplaire']) ?>" style="display:inline">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-secondary">Renouveler</button>
                                </form>
                            <?php else: ?>
                                <span class="btn btn-secondary" style="opacity: 0.6; cursor: not-allowed;">Déjà renouvelé</span>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?= view('templates/footer') ?>
