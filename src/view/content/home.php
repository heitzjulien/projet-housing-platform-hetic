<h2>Home</h2>
<!-- Pas de JSON pour $data['images'] j'avais la flemme mais si nécessaire @Julien-->
<?php foreach($data['images'] as $i => $p): ?>
    <img src="<?= $p->getImage()[0]->getImage() ?>" alt="">
<?php endforeach; ?>

<?php foreach($data['start'] as $h => $c): ?>
    <p><?= $c->getName() ?></p>
    <p><?= $c->getCapacity() ?> personnes</p>
    <p><?= $c->getPrice() ?> €</p>
    <p><?= $c->getDescription() ?></p>
    <p><?= $c->getNumberPieces() ?> pièces</p>
    <p><?= $c->getArea() ?> m²</p>
    <img src="<?= $c->getImage()[0]->getImage() ?>" alt="">
<?php endforeach; ?>