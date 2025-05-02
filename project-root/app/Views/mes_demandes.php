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
                        <th>Livre</th>
                        <th>Date de demande</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($demandes as $demande): ?>
                        <tr>
                            <td><?= esc($demande['code_catalogue']) ?></td>
                            <td><?= esc($demande['date_demande']) ?></td>
                            
                            <td>
                               <!-- Formulaire pour supprimer la demande -->
                               <form method="POST" action="<?= site_url('/supprimer-demande/'.$demande['code_catalogue']) ?>" style="display:inline;">
                                    <?= csrf_field() ?>  <!-- CSRF pour la sécurité -->
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
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
