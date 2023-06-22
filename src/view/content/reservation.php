<div>
    <?php foreach ($data["error"] as $e): ?>
        <p>
            <?= $e ?>
        </p>
    <?php endforeach; ?>
    <?php if($data["valid"] && !$data["error"]): ?>
        <p><?= $data["valid"] ?></p>
    <?php endif; ?>
    <?php foreach($data['reservation'] as $r): ?>
        <img src="<?= $r->getHousing()->getImage()[0]->getImage() ?>" alt="" width=400>
        <div>ID de réservation : <?= $r->getId() ?></div>
        <div>Nombre de jour : <?= $r->getPeriod() ?></div>
        <div>Prix total : <?= $r->getTotalPrice() ?>€</div>
        <div><?= $r->getHousing()->getCity() ?> | <?= $r->getHousing()->getZip() ?> | <?= $r->getHousing()->getAddress() ?></div>
        <?php switch($r->getStatus()):
            case "accept": ?>
                <form method="POST">
                    <input name="reservation_id" type="hidden" value="<?= $r->getId() ?>">
                    <input name="housing_id" type="hidden" value="<?= $r->getHousing()->getId() ?>">
                    <label for="date_start">Du</label>
                    <input id="date_start" name="date_start" type="date" value="<?= $r->getUnavailabilityStart() ?>">
                    <label for="date_end">au</label>
                    <input id="date_end" name="date_end" type="date" value="<?= $r->getUnavailabilityEnd() ?>">
                    <input type="submit" value="Modifier">
                </form>
                <a href="">Messagerie</a>
                <a href="<?= __ROOT_URL__ ?>/dashboard/reservation/delete?id=<?= $r->getId() ?>">Supprimer la réservation</a>
                <?php break;
            case "currently": ?>
                <div> Du <?= $r->getUnavailabilityStart() ?> au <?= $r->getUnavailabilityEnd() ?></div>
                <a href="">Messagerie</a>
                <?php break;
            case "pass": ?>
                <div> Du <?= $r->getUnavailabilityStart() ?> au <?= $r->getUnavailabilityEnd() ?></div>
                <a href="">Rédiger un avis</a>
                <?php break;
        endswitch; ?>

        <br>
    <?php endforeach; ?>
</div>
