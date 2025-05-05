<h2>Exemplaires disponibles de <?= esc($livre->titre_livre) ?></h2>

<table>
    <tr>
        <th>État</th>
        <th>Rayon</th>
        <th>Action</th>
    </tr>
    <?php foreach ($exemplaires as $ex): ?>
        <tr>
            <td><?= esc($ex['code_usure']) ?></td>
            <td><?= esc($ex['emplacement_rayon']) ?></td>
            <td>
                <a href="<?= site_url('demander/' . $ex['cote_exemplaire']) ?>" class="btn btn-primary">
                    Faire une demande
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
