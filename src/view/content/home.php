<h2>Home</h2>

FOREACH DES IMAGES DE LA DB

<?php foreach($data['start'] as $i => $c): ?>
    <?= $c->getName() ?>
    <?= $c->getPrice() ?>€/nuit
    <?= $c->getDescription() ?>
    <?= $c->getInstruction() ?>
    <?= $c->getNumberPieces() ?> pièces
    <?= $c->getArea() ?>m²
<?php endforeach; ?>
