<h2>Search</h2>
<?php foreach($data['start'] as $i => $c): ?>
    <?= $c->getName() ?>
    <?= $c->getPrice() ?>€/nuit
    <?= $c->getDescription() ?>
    <?= $c->getInstruction() ?>
    <?= $c->getNumberPieces() ?> pièces
    <?= $c->getArea() ?>m²
<?php endforeach; ?>