<h2>Gestion des demandes</h2>

<?php if (session()->getFlashdata('success')): ?>
    <p><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>Livre</th>
            <th>Abonné</th>
            <th>Date de demande</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($demandes as $demande): ?>
            <tr>
                <td><?= $demande['idLivre'] ?></td>
                <td><?= $demande['idAbonne'] ?></td>
                <td><?= $demande['dateDemande'] ?></td>
                <td><a href="<?= site_url('/admin/supprimer-demande/'.$demande['id']) ?>">Supprimer</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
