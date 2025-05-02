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

<?php if (empty($emprunts)): ?>
    <p>Tu n’as aucun emprunt en cours.</p>
<?php else: ?>
    <table class="styled-table">
        <tr>
            <th>Titre</th>
            <th>Exemplaire</th>
            <th>Date d'emprunt</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($emprunts as $e): ?>
            <tr>
                <td><?= esc($e['titre_livre']) ?></td>
                <td><?= esc($e['cote_exemplaire']) ?></td>
                <td><?= esc($e['date_emprunt']) ?></td>
                <td>
                    <?php if (!$e['estRenouvele']): ?>
                        <a href="/abonne/renouveler/<?= $e['cote_exemplaire'] ?>">Renouveler</a>
                    <?php else: ?>
                        <span style="color: gray;">Déjà renouvelé</span>
                    <?php endif; ?>
                    |
                    <a href="/abonne/retourner/<?= $e['cote_exemplaire'] ?>" class="btn">Retourner</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?= view('templates/footer') ?>
