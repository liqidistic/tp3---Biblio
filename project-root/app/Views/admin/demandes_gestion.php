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
            <th>Date demande</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($demandes as $d): ?>
            <tr>
              <td><?= esc($d['matricule_abonne']) ?></td>
              <td><?= esc($d['code_catalogue']) ?></td>
              <td><?= esc($d['date_demande']) ?></td>
              <td>
                <form action="<?= base_url("admin/demandes/supprimer/{$d['matricule_abonne']}/{$d['code_catalogue']}") ?>"
                      method="POST" style="display:inline">
                  <?= csrf_field() ?>
                  <button class="btn btn-secondary">Supprimer</button>
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
