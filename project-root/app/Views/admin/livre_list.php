<h1>Liste des livres</h1>
<ul>
    <?php foreach ($livres as $livre): ?>
        <li><?= esc($livre['titre']) ?> - ID: <?= $livre['id'] ?></li>
    <?php endforeach; ?>
</ul>
