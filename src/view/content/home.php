<h2>Home</h2>

<?php foreach($data['images'] as $i => $p): ?>
    <img src="<?= $p->getImages()[0]->getImage() ?>" alt="">
<?php endforeach; ?>

<?php foreach($data['start'] as $h => $c): ?>
    <p><?= $c->getName() ?></p>
    <p><?= $c->getCapacity() ?> personnes</p>
    <p><?= $c->getPrice() ?> €</p>
    <p><?= $c->getDescription() ?></p>
    <p><?= $c->getNbr_pieces() ?> pièces</p>
    <p><?= $c->getArea() ?> m²</p>
    <img src="<?= $c->getImages()[0]->getImage() ?>" alt="">
<?php endforeach; ?>