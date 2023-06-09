<?php
$cardCount = 0;
$partners = ["partner1", "partner2", "partner3", "partner4", "partner5"];
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
    <section id="homeHero" class="bgHeroImage">
        <div class="heroTextContainer">
            <h1>Profitez de nos logements premiums parisiens</h1>
            <p>Des localisations attractives et un service de compétition</p>
            <a href="<?= __ROOT_URL__ ?>/search" class="button transparentBtn">
                Découvrir
            </a>
        </div>
        <div class="heroImgContainer">
            <div class="heroImgCard"
                style="background-image: url('<?= $data['images'][0]->getImage() ?>');"
            >
            </div>
            <div class="heroImgCard"
                style="background-image: url('<?= $data['images'][1]->getImage() ?>');"
            >
            </div>
        </div>
    </section>

    <section id="homeRecommandations">
        <h2>Nos recommandations</h2>
        <div class="housingContainer">
            <?php foreach($data['housing'] as $datum): ?>
                <div class="housingCard" id="card<?= $cardCount ?>">
                        <img src="<?= $datum['images']?>" alt="Image du logement"/>
                    <a href="<?= __ROOT_URL__ . "/apartment?housing_id=" . $datum["id"]?>">
                        <div class="housingCardFooter">
                            <div class="primaryDesc">
                                <p class="housingTitle"><?=$datum["name"]?></p>
                                <p class="housingTitle"><?=$datum["number_pieces"]?> pièce(s) • <?= $datum["area"]?> m²</p>
                                <p><?= $datum["city"] ?> • <?= (int)$datum["district"] == 1 ? (int)$datum["district"] . "er" : (int)$datum["district"] . "ème" ?> </p>
                            </div>
                            <div class="descDivider"></div>
                            <div class="secondaryDesc">
                                <p><?= $datum["name"]?></p>
                            </div>
                        </div>
                    </a>
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
            <img src="<?= __ROOT_URL__ ?>/assets/images/washing.service.svg" alt="Cleaning service" />
            <h3>Laverie</h3>
        </div>
        <div>
            <img src="<?= __ROOT_URL__ ?>/assets/images/taxi.service.svg" alt="Cleaning service" />
            <h3>Taxi</h3>
        </div>
        <div>
            <img src="<?= __ROOT_URL__ ?>/assets/images/cleaning.service.svg" alt="Cleaning service" />
            <h3>Nettoyage</h3>
        </div>
    </section>
    <section id="homeReinsurance">
        <h2>Nos partenaires</h2>
        <div>
            <?php foreach ($partners as $partner): ?>
            <img src="<?= __ROOT_URL__ ?>/assets/images/partnerships/<?= $partner ?>.svg" alt="Partner Logo" />
            <?php endforeach; ?>
        </div>
    </section>
</main>

<script src="<?= __ROOT_URL__ ?>/scripts/homeCardLogement.js"></script>

