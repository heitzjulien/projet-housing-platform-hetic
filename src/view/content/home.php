<?php foreach($data['start'] as $i => $c): ?>
    <span>ID: <?= $c->getId() ?></span>
    <h2><?= $c->getName() ?></h2>
    <span>Pour <?= $c->getCapacity() ?> personnes</span>
    <p><?= $c->getPrice() ?>€/nuit</p>
    <p><?= $c->getDescription() ?></p>
    <p><?= $c->getNote() ?></p>
    <p><?= $c->getInstruction() ?></p>
    <p><?= $c->getNumberPieces() ?> pièces</p>
    <p><?= $c->getNumberRooms() ?> chambres</p>
    <p><?= $c->getNumberBathroom() ?> salles de bain</p>
    <p><?= $c->getExterior() ?></p>
    <p><?= $c->getCarPark() ?></p>
    <p><?= $c->getArea() ?>m²</p>
<?php endforeach; ?>
