<div>
    <?php foreach($data['reservation'] as $r): ?>
        <img src="<?= $r->getHousing()->getImage()[0]->getImage() ?>" alt="" width=400>
        <div>ID de réservation : <?= $r->getId() ?></div>
        <div>Nombre de jour : <?= $r->getPeriod() ?></div>
        <div>Prix total : <?= $r->getTotalPrice() ?>€</div>
        <div><?= $r->getHousing()->getCity() ?> | <?= $r->getHousing()->getZip() ?> | <?= $r->getHousing()->getAddress() ?></div>
        <div> Du <?= $r->getUnavailabilityStart() ?> au <?= $r->getUnavailabilityEnd() ?></div>
        <?php switch($r->getStatus()):
            case "accept": ?>
                <a href="">Messagerie</a>
                <a href="">Modifier la réservation</a>
                <a href="">Supprimer la réservation</a>
                <?php break;
            case "currently": ?>
                <a href="">Messagerie</a>
                <?php break;
            case "pass": ?>
                <a href="">Rédiger un avis</a>
                <?php break;
        endswitch; ?>
    <?php endforeach; ?>
</div>
