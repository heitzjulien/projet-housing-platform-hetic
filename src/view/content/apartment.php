<main>
<?php if($data['error']):?>
    <div class="error">
        <?php foreach ($data["error"] as $e): ?>
            <p>
                <?= $e ?>
            </p>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="error">
        <?php foreach ($data["filter_error"] as $e): ?>
            <?php if($e): ?>
            <p>
                <?= $e ?>
            </p>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="valid">
        <?php if($data["valid"]): ?>
            <p><?= $data["valid"] ?></p>
        <?php endif; ?>
    </div>
    <h1><?= $data["housing"]->getName() ?></h1>
    <span class="adress"><?= $data["housing"]->getAddress() . " " . $data["housing"]->getCity()  . " " . $data["housing"]->getDistrict() ?></span>
    <div class="container">
        <?php foreach($data["housing"]->getImage() as $i): ?>
            <div class="image">
                <img src="<?= $i->getImage() ?>" alt="Apartment image">
            </div>
        <?php endforeach; ?>
        <div class="button">
            <a onclick="nextimg(-1)" class="prev">&#10094;</a>
            <a onclick="nextimg(1)" class="next">&#10095;</a>
        </div>
    </div>
    <div class="line1"></div>
    <div class="description">
        <h2>Description</h2>
        <div class="text">
            <span><?= $data["housing"]->getArea() ?>m2</span>
            <span><?= $data["housing"]->getCapacity() ?> voyageurs</span>
            <span><?= $data["housing"]->getNumberPieces() ?> pièces</span>
            <span><?= $data["housing"]->getNumberRooms() ?> chambre(s)</span>
            <span><?= $data["housing"]->getNumberBathroom() ?> salle de bains</span><br><br>
            <p><?= $data["housing"]->getDescription() ?></p>
        </div>
        <aside>
            <div class="booking-details">
                <div class="sub-details">
                    <div class="arrival">
                        <?php if($data["user_logged_in"]): ?>
                            <form method="POST">
                                <label for="date_start">Date d'arrivé :</label>
                                <input id="date_start" type="date" name="date_start" value="<?php if($data['filter']['date_start']) { echo(date("Y-m-d", $data['filter']['date_start'])); } ?>">
                                <label for="date_end">Date de départ :</label>
                                <input id="date_end" type="date" name="date_end" value="<?php if($data['filter']['date_end']) { echo(date("Y-m-d", $data['filter']['date_end'])); } ?>">
                                <div class="prices">
                                    <div class="price-details">
                                        <span><?= $data["housing"]->getPrice() ?>€</span>
                                        <span>/ nuit</span>
                                    </div>
                                </div>
                                <input type="submit" value="Réserver">
                            </form>
                        <?php else: ?>
                            <p>Vous devez être connecté pour réserver</p>
                            <a href="/login" class="btn-connection">Se connecter</a>
                        <?php endif; ?>
                    </div>
                </div>
        </aside>
    </div>
    <div class="service">
        <section class="photo">
            <img src="<?= __ROOT_URL__ ?>/assets/images/chef.jpg" alt="">
        </section>
        <section class="text2">
            <h2>Services</h2>
            <div class="liste">
                <?php foreach($data["housing"]->getService() as $s): ?>
                    <li><?= $s->getName() ?></li>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
    <script src="<?= __ROOT_URL__ ?>/scripts/productpage.js"></script>
<?php endif; ?>
</main>