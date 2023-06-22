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


<body>
    <div class="table" id="brightness">
        <div class="table_header">
            <h1>Dashboard Réservation </h1>
            <div class="new">
                <a href="#" onclick="toggle()">New</a>
                <button class="messagerie">Messagerie</button>
            </div>
        </div>
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>ID Réservation</th>
                        <th>Adresse</th>
                        <th>Date Arrivée - Date Départ</th>
                        <th>Prix</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>631411321411</td>
                        <td>6 Avenue des Gobelins, Paris ,75005</td> 
                        <td>10/06/2023 - 14/06/2023</td>
                        <td>9 536€</td>
                        <td>  
                            <select id="choix_statut">
                              <option value="Reserved"><span>Reserved</span></option>
                              <option value="unReserved">UnReserved</option>
                            </select>
                        </td>
                        <td>
                            <button class="edit">Edit</button>
                            <button class="delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>631411321411</td>
                        <td>48 Boulevard Saint-Antoine Paris 75001</td> 
                        <td>11/06/2023 - 16/06/2023</td>
                        <td>10 134€</td>
                        <td>  
                            <select id="choix_statut">
                              <option value="Reserved"><span>Reserved</span></option>
                              <option value="unReserved">UnReserved</option>
                            </select>
                        </td>
                        <td>
                            <button class="edit">Edit</button>
                            <button class="delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>631411321411</td>
                        <td>4 Boulevard Sainte-Marie, Paris 75008</td> 
                        <td>13/06/2023 - 17/06/2023</td>
                        <td>11 004€</td>
                        <td>  
                            <select id="choix_statut">
                              <option value="Reserved"><span>Reserved</span></option>
                              <option value="unReserved">UnReserved</option>
                            </select>
                        </td>
                        <td>
                            <button class="edit">Edit</button>
                            <button class="delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>631411321411</td>
                        <td>9 Boulevard Saint-Marcel, Paris 75005</td> 
                        <td>16/06/2023 - 21/06/2023</td>
                        <td>12 250€</td>
                        <td>  
                            <select id="choix_statut">
                              <option value="Reserved"><span>Reserved</span></option>
                              <option value="unReserved">UnReserved</option>
                            </select>
                        </td>
                        <td>
                            <button class="edit">Edit</button>
                            <button class="delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>631411321411</td>
                        <td>55 Rue Saint-Jacques, Paris 75003</td> 
                        <td>20/06/2023 - 22/06/2023</td>
                        <td>2 236€</td>
                        <td>  
                            <select id="choix_statut">
                              <option value="Reserved"><span>Reserved</span></option>
                              <option value="unReserved">UnReserved</option>
                            </select>
                        </td>
                        <td>
                            <button class="edit">Edit</button>
                            <button class="delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>631411321411</td>
                        <td>75 Rue des Ardennes, Paris 75014</td> 
                        <td>22/06/2023 - 26/06/2023</td>
                        <td>10 134€</td>
                        <td>  
                            <select id="choix_statut">
                              <option value="Reserved"><span>Reserved</span></option>
                              <option value="unReserved">UnReserved</option>
                            </select>
                        </td>
                        <td>
                            <button class="edit">Edit</button>
                            <button class="delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>631411321411</td>
                        <td>4 Boulevard Saint-Michel, Paris, 75005</td> 
                        <td>22/06/2023 - 26/06/2023</td>
                        <td>13 437€</td>
                        <td>  
                            <select id="choix_statut">
                              <option value="Reserved"><span>Reserved</span></option>
                              <option value="unReserved">UnReserved</option>
                            </select>
                        </td>
                        <td>
                            <button class="edit">Edit</button>
                            <button class="delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>631411321411</td>
                        <td>13 Boulevard Saint-Michel, Paris, 75005</td> 
                        <td>10/06/2023 - 14/06/2023</td>
                        <td>10 134€</td>
                        <td>  
                            <select id="choix_statut">
                              <option value="Reserved"><span>Reserved</span></option>
                              <option value="unReserved">UnReserved</option>
                            </select>
                        </td>
                        <td>
                            <button class="edit">Edit</button>
                            <button class="delete">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div id="popup">
        <div class="wrapper">
        <h1>Formulaire Réservation</h1>
            <img class="close" src="image/croix.png" alt="croix"  onclick="toggle()">
        </div>
            <form class="form">
                <div class="ensemble">
                    <div class="field input">
                        <input type="text" placeholder="ID Réservation" id="idreservation">
                    </div>
                    <div class="field input">
                        <input type="text" placeholder="Date" id="date">
                    </div>
                </div>
                <div class="ensemble">
                    <div class="field input">
                        <input type="text" placeholder="Adresse" id="adresse">
                    </div>  
                    <div class="field input">
                        <input type="text" placeholder="Prix" id="prix">
                    </div>
                </div>
                <div class="ensemble" style="margin-top: 25px;">
                </div>
                <div class="field button">
                    <input type="submit" valuer="Ajouter" onclick="toggle()">
                </div>
            </form>
        </div>
<script src="js/javascript4.js"></script>
</body>