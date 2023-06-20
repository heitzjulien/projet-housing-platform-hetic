<main>
<?php if($data['error']):?>
    <?php foreach ($data["error"] as $e): ?>
        <p>
            <?= $e ?>
        </p>
    <?php endforeach; ?>
<?php else: ?>
    <?php foreach ($data["filter_error"] as $e): ?>
        <p>
            <?= $e ?>
        </p>
    <?php endforeach; ?>
    <?php if($data["valid"]): ?>
        <p><?= $data["valid"] ?></p>
    <?php endif; ?>
    <?php if($data["user_logged_in"]): ?>
        <form method="POST">
            <label for="date_start">Date d'arrivé :</label>
            <input id="date_start" type="date" name="date_start" value="<?php if($data['filter']['date_start']) { echo(date("Y-m-d", $data['filter']['date_start'])); } ?>">
            <label for="date_end">Date de départ :</label>
            <input id="date_end" type="date" name="date_end" value="<?php if($data['filter']['date_end']) { echo(date("Y-m-d", $data['filter']['date_end'])); } ?>">
            <input type="submit" value="Réserver">
        </form>
    <?php endif; ?>
    <span></span>
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

    <h3>Services</h3>
    <?php foreach($data["housing"]->getService() as $s): ?>
        <span><?= $s->getIcon() ?></span>
        <span><?= $s->getName() ?></span>
        <span><?= $s->getDescription() ?></span>
        <br>
    <?php endforeach; ?>
<?php endif; ?>
</main>