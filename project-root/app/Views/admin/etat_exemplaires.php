 <?= view('templates/header', ['title' => 'Gestion de l\'état des exemplaires']) ?>

<div class="container">
    <section class="info-box">
        <h2>Gestion de l'état des exemplaires</h2>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>Livre</th>
                    <th>NEUF</th>
                    <th>TRES BON</th>
                    <th>BON</th>
                    <th>MOYEN</th>
                    <th>DEGRADE</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stats as $s): ?>
                    <tr>
                        <td><?= esc($s['livre']) ?></td>
                        <?php foreach (['NEUF', 'TRES BON', 'BON', 'MOYEN', 'DEGRADE'] as $etat): ?>
                            <td><?= esc($s['etats'][$etat]) ?> (<?= $s['total'] ? round($s['etats'][$etat] / $s['total'] * 100) : 0 ?>%)</td>
                        <?php endforeach; ?>
                        <td><?= esc($s['total']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>

<?= view('templates/footer') ?>