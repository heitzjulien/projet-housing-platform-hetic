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

<body>
    <h1>4 Boulevard Saint-Michel, Paris, 75005</h1>
    <div class="container">
        <div class="image">
            <img src="image/Ikea, Thonet, Kilim, Terrazzo, and A Bunch of Other Design Words You May Be Mispronouncing (Yes, Even IKEA!) - Emily Henderson.png" alt="">
        </div>
        <div class="image">
            <img src="image/Décoration intérieure maison _ rentrée tout en douceur.jpg" alt="">
        </div>
        <div class="image">
            <img src="image/7a0850357f08622c2f05e1349687e36b.jpg" alt="">
        </div>
        <div class="image">
            <img src="image/chb_2.jpg" alt="">
        </div>
        <div class="image">
            <img src="image/098364a4d3cd305a67a5c09694d64828.jpg" alt="">
        </div>
        <div class="image">
            <img src="image/Une baignoire îlot dans ma salle de bain - Jessica Venancio.jpg" alt="">
        </div>
        <div class="button">
            <a onclick="nextimg(-1)" class="prev">&#10094;</a>
            <a onclick="nextimg(1)" class="next">&#10095;</a>
        </div>
    </div>
    <div class="line1"></div>
    <div class="description">
        <h1>Description</h1>
        <div class="text">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Odio pellentesque diam volutpat commodo sed egestas. Phasellus egestas tellus rutrum tellus pellentesque. 
                At quis risus sed vulputate odio ut. Pharetra diam sit amet nisl suscipit adipiscing bibendum est ultricies. 
                Duis ultricies lacus sed turpis tincidunt id. Morbi quis commodo odio aenean sed. Viverra aliquet eget sit amet 
                tellus cras adipiscing enim eu. Ipsum dolor sit amet consectetur adipiscing elit. Non quam lacus suspendisse faucibus 
                interdum posuere. Et ligula ullamcorper malesuada proin libero. Faucibus in ornare quam viverra orci. Viverra maecenas 
                accumsan lacus vel facilisis volutpat est velit. Tellus molestie nunc non blandit massa enim nec dui nunc. Sit amet porttitor 
                eget dolor. In mollis nunc sed id semper risus. Hac habitasse platea dictumst quisque sagittis. Proin nibh nisl condimentum id
                venenatis a condimentum. Tincidunt nunc pulvinar sapien et. Nibh tortor id aliquet lectus proin nibh nisl condimentum id.
                Viverra suspendisse potenti nullam ac tortor vitae. Orci phasellus egestas tellus rutrum tellus pellentesque eu. Nisl
                condimentum id venenatis a condimentum vitae. Tincidunt augue interdum velit euismod. Sed viverra tellus in hac 
                habitasse platea dictumst vestibulum rhoncus. Maecenas pharetra convallis posuere morbi leo urna molestie at elementum. 
                Posuere urna nec tincidunt praesent. Nec ultrices dui sapien eget mi proin sed libero enim. Nulla facilisi morbi tempus
                iaculis urna id volutpat lacus. Dignissim cras tincidunt lobortis feugiat vivamus at augue.</p>
        </div>
        <aside>
            <div class="booking-details">
                <div class="sub-details">
                    <div class="arrival">
                        <p id="start">Arrivée</p>
                        <p>14/06/2023</p>
                    </div>
                    <div class="arrival">
                        <p id="stop">Départ</p>
                        <p>18/06/2023</p>
                    </div>
                </div>
                <div class="travelers">
                    <span>Voyageurs</span>
                    <img src="./icons/chevron.png" alt="">
                </div>
                <div class="prices">
                    <div class="price-details">
                        <span>3 nuits</span>
                        <span>10 079€</span>
                    </div>
                    <div class="price-details">
                        <span>Frais de services</span>
                        <span>1 286€</span>
                    </div>
                    <div class="price-details">
                        <span>Taxes</span>
                        <span>50€</span>
                    </div>
                    <div class="line"></div>
                    <div class="new-price">
                        <span>Total</span>
                        <span>11 415€</span>
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
            <img src="image/Chef.jpg" alt=''>
        </section>
        <section class="text2">
            <h1>Services</h1>
            <div class="liste">
                <li>Chauffeur</li>
                <li>Concierge</li>
                <li>Guide Privé</li>
                <li>Shoppeur Privé</li>
                <li>Chef Cusiné</li>
                <li>Livraison à domicile</li>
            </section>
        </section>
    </div>

    <script src="js/javascript2.js"></script>
</body>