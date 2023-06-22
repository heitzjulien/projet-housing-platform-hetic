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
    <h1><?= $data["housing"]->getName() ?></h1>
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
                                <input type="submit" value="Réserver">
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="traverlers">
                        <span><?= $data["housing"]->getCapacity() ?> voyageurs</span>
                        <img src="./icons/chevron.png" alt="chevron">
                </div>
                <div class="prices">
                    <div class="price-details">
                        <span><?= $data["housing"]->getPrice() ?>€</span>
                        <span>/ nuit</span>
                    </div>
                </div>
                <a href="#">
                    <span style="margin: 10% 0 0 18%;">Réserver</span>
                </a>
            </div>
        </aside>
    </div>
    <div class="service">
        <section class="photo">
            <img src="Chef.jpg" alt="">
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