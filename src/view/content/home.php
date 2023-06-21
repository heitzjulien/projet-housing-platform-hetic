<?php
$cardCount = 0;
?>

<main>
    <?php foreach ($data["error"] as $e): ?>
        <p class='error'>
            <?= $e ?>
        </p>
    <?php endforeach; ?>
    <?php if ($data["valid"]): ?>
        <p class='valid'>
            <?= $data["valid"] ?>
        </p>
    <?php endif; ?>
    <section id="homeHero">
        <div class="heroTextContainer">
            <h1>Profitez de nos logements premiums parisiens</h1>
            <p>Des localisations attractives et un service de compétition</p>
            <a href="<?= __ROOT_URL__ ?>/search" class="button transparentBtn">
                Découvrir
            </a>
        </div>
        <div class="heroImgContainer">
<!--        --><?php //foreach($data['images'] as $i): ?>
<!--            <img src="--><?php //= $i->getImage() ?><!--" alt="Appartment interior image" width="400px" class="mainImage">-->
<!--        --><?php //endforeach; ?>
        </div>
    </section>
    <section id="homeRecommandations">
        <h2>Nos recommandations</h2>
        <div class="housingContainer">
<!--            --><?php //= var_dump($data['housing']) ?>
            <?php foreach($data['housing'] as $datum): ?>
                <div class="housingCard" id="card<?= $cardCount ?>">
                    <img src="<?= $datum['images']?>" alt="Image du logement"/>
                    <div class="housingCardFooter">
                        <div class="primaryDesc">
                            <p class="housingTitle"><?=$datum["name"]?></p>
                            <p class="housingTitle"><?=$datum["number_pieces"]?> pièce(s) • <?= $datum["area"]?> m²</p>
                            <p><?= $datum["city"] ?> • <?= (int)$datum["district"] == 1 ? (int)$datum["district"] . "er" : (int)$datum["district"] . "ème" ?> </p>
                        </div>
                        <div class="descDivider"></div>
                        <div class="secondaryDesc">
                            <p><?= $datum["description"]?></p>
                        </div>
                    </div>
                </div>
            <?php $cardCount++ ?>
            <?php endforeach; ?>
        </div>
        <div class="carouselCta">
            <button id="carouselButton1">
            </button>
            <button id="carouselButton2">
            </button>
            <button id="carouselButton3">
            </button>

        </div>
        <a href="<?= __ROOT_URL__ ?>/search" class="button fullBtn">
            En voir plus
        </a>
    </section>
    <section id="homeServices">
        <div>
            <img src="./assets/images/washing.service.svg" alt="Cleaning service">
            <h3>Laverie</h3>
        </div>
        <div>
            <img src="./assets/images/taxi.service.svg" alt="Cleaning service">
            <h3>Taxi</h3>
        </div>
        <div>
            <img src="./assets/images/cleaning.service.svg" alt="Cleaning service">
            <h3>Nettoyage</h3>
        </div>
    </section>
</main>
<script src="./scripts/homeCardLogement.js"></script>

