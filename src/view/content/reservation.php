<div class="table" id="brightness">
    <div class="table_header">
        <h1>Dashboard Réservation </h1>
    </div>
    <?php foreach ($data["error"] as $e): ?>
        <p>
            <?= $e ?>
        </p>
    <?php endforeach; ?>
    <?php if($data["valid"] && !$data["error"]): ?>
        <p><?= $data["valid"] ?></p>
    <?php endif; ?>
    <div class="table_section">
        <table>
            <thead>
                <tr>
                    <th>ID Réservation</th>
                    <th>Adresse</th>
                    <th>Date Arrivée - Date Départ</th>
                    <th>Durée</th>
                    <th>Prix</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['reservation'] as $r): ?>
                <tr>
                    <td><?= $r->getId() ?></td>
                    <td><div class="adresse"><?= $r->getHousing()->getAddress() ?>, 
                    <span><?= $r->getHousing()->getCity() ?>, <?= $r->getHousing()->getZip() ?></span></div></td> 
                    <td>
                    <?php switch($r->getStatus()):
                        case "accept": ?>
                            <form method="POST" class="updateDate">
                                <input name="reservation_id" type="hidden" value="<?= $r->getId() ?>">
                                <input name="housing_id" type="hidden" value="<?= $r->getHousing()->getId() ?>">
                                <label for="date_start">Date d'arrivée :</label>
                                <input id="date_start" name="date_start" type="date" value="<?= $r->getUnavailabilityStart() ?>">
                                <label for="date_end">Date de départ :</label>
                                <input id="date_end" name="date_end" type="date" value="<?= $r->getUnavailabilityEnd() ?>">
                                <input class="submit" type="submit" value="Modifier">
                            </form>
                            <?php break;
                        default: ?>
                            Du <?= $r->getUnavailabilityStart() ?> au <?= $r->getUnavailabilityEnd() ?>
                            <?php break;
                    endswitch; ?>
                    </td>
                    <td><?= $r->getPeriod() ?></td>
                    <td><?= $r->getTotalPrice() ?>€</td>
                    <td><?= $r->getStatus() ?></td>
                    <td>
                    <?php switch($r->getStatus()):
                        case "accept": ?>
                            <a class="edit" href="">Messagerie</a>
                            <a class="delete" href="<?= __ROOT_URL__ ?>/dashboard/reservation/delete?id=<?= $r->getId() ?>">Delete</a>
                            <?php break;
                        case "currently": ?>
                            <a class="edit" href="">Messagerie</a>
                            <?php break;
                        case "pass": ?>
                            <a class="edit" href="">Rédiger un avis</a>
                            <?php break;
                    endswitch; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>