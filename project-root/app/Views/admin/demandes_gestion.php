<?= view('templates/header',['title'=>'Gestion des demandes']) ?>

<div class="container">
  <h2 class="titre">Demandes d’emprunt</h2>

  <div class="info-box">
    <?php if(empty($demandes)): ?>
      <p>Aucune demande enregistrée.</p>
    <?php else: ?>
      <table class="styled-table">
        <thead>
          <tr>
            <th>Abonné</th>
            <th>Livre</th>
            <th>Cote Exemplaire</th>
            <th>Date demande</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($demandes as $d): ?>
            <tr>
              <td><?= esc($d['matricule_abonne']) ?></td>
              <td><?= esc($d['titre_livre']) ?></td>
              <td><?= esc($d['cote_exemplaire']) ?></td>
              <td><?= esc($d['date_demande']) ?></td>
              <td>
                <form action="<?= base_url("admin/demandes/supprimer/{$d['matricule_abonne']}/{$d['cote_exemplaire']}") ?>"
                      method="POST" style="display:inline">
                  <?= csrf_field() ?>
                  <button class="btn btn-secondary">Supprimer</button>
                </form>
                <form action="<?= base_url("admin/demandes/valider/{$d['matricule_abonne']}/{$d['cote_exemplaire']}") ?>" method="POST" style="display:inline">
                <?= csrf_field() ?>
                <button class="btn btn-primary">Valider</button>
                </form>

              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</div>

<?= view('templates/footer') ?>
