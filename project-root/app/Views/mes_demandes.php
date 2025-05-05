<?= view('templates/header', ['title' => 'Mes demandes']) ?>

<div class="container">
    <section class="info-box">
        <h2>Mes demandes</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($demandes)): ?>
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
    </tbody>
</table>
        <?php else: ?>
            <p>Vous n'avez pas encore de demandes.</p>
        <?php endif; ?>
    </section>
</div>

<?= view('templates/footer') ?>
