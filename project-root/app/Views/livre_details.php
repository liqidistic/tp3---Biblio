<?= view('templates/header', ['title' => 'Détail du livre']) ?>

<div class="container">
  <!-- Encadré blanc pour le détail du livre -->
  <div class="info-box">
    <h2 class="titre"><?= esc($livre['titre_livre']) ?></h2>
    <p><strong>Thème :</strong> <?= esc($livre['theme_livre']) ?></p>
  </div>

  <?php if (empty($exemplaires)): ?>
    <div class="info-box">
      <p>Aucun exemplaire disponible pour ce livre.</p>
      <a href="<?= base_url('abonne/demander/'.$livre['code_catalogue']) ?>"
         class="btn btn-secondary">
        Faire une demande
      </a>
    </div>
  <?php else: ?>
    <div class="info-box">
      <h3>Exemplaires disponibles</h3>
      <table class="styled-table">
        <thead>
          <tr>
            <th>Éditeur</th>
            <th>Rayon</th>
            <th>Date acquisition</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($exemplaires as $ex): ?>
            <tr>
              <td><?= esc($ex['nom_editeur']) ?></td>
              <td><?= esc($ex['emplacement_rayon']) ?></td>
              <td><?= esc($ex['date_acquisition']) ?></td>
              <td>
                <a href="<?= base_url('abonne/emprunts/'.$ex['cote_exemplaire']) ?>"
                   class="btn btn-primary">
                  Emprunter
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<?= view('templates/footer') ?>
