<?= view('templates/header',['title'=>'Exemplaires disponibles']) ?>

<div class="container">
  <h2>Exemplaires disponibles<?= $code_catalogue ? " pour le livre {$code_catalogue}" : '' ?></h2>

  <?php if (empty($exemplaires)): ?>
    <p>Aucun exemplaire disponible pour le moment.</p>
  <?php else: ?>
    <table class="styled-table">
      <thead>
        <tr>
          <th>Cote</th>
          <th>Titre du livre</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($exemplaires as $ex): ?>
          <tr>
            <td><?= esc($ex['cote_exemplaire']) ?></td>
            <td><?= esc($ex['titre_livre']) ?></td>
            <td>
              <form action="<?= base_url('abonne/emprunts/'.$ex['cote_exemplaire']) ?>"
                    method="POST" style="display:inline">
                <?= csrf_field() ?>
                <button class="btn btn-primary">Réserver</button>
              </form>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php endif ?>
</div>

<?= view('templates/footer') ?>
