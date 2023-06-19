<main>
<?php if($data['error']):?>
    <?php foreach ($data["error"] as $e): ?>
        <p>
            <?= $e ?>
        </p>
    <?php endforeach; ?>
<?php else: ?>
    <span><?= $data["housing"]->getId() ?></span>
    <span><?= $data["housing"]->getName() ?></span>
    <span><?= $data["housing"]->getCapacity() ?></span>
    <span><?= $data["housing"]->getPrice() ?></span>
    <span><?= $data["housing"]->getDescription() ?></span>
    <span><?= $data["housing"]->getNote() ?></span>
    <span><?= $data["housing"]->getInstruction() ?></span>
    <span><?= $data["housing"]->getNumberPieces() ?></span>
    <span><?= $data["housing"]->getNumberRooms() ?></span>
    <span><?= $data["housing"]->getNumberBathroom() ?></span>
    <?php if($data["housing"]->getExterior() != false) :?>
        <?php foreach($data["housing"]->getExterior() as $e): ?>
            <span><?= $e ?></span>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if($data["housing"]->getCarPark() != false) :?>
        <?php foreach($data["housing"]->getCarPark() as $c): ?>
            <span><?= $c ?></span>
        <?php endforeach; ?>
    <?php endif; ?>
    <span><?= $data["housing"]->getArea() ?></span>
    <?php foreach($data["housing"]->getImage() as $i): ?>
        <img src="<?= $i->getImage() ?>" alt="Apartment image">
    <?php endforeach; ?>
    <span><?= $data["housing"]->getCountry() ?></span>
    <span><?= $data["housing"]->getCity() ?></span>
    <span><?= $data["housing"]->getZip() ?></span>
    <span><?= $data["housing"]->getDistrict() ?></span>
    <span><?= $data["housing"]->getAddress() ?></span>
<?php endif; ?>
</main>