<main>
    <section id="homeHero">
        <div class="heroTextContainer">
            <h1>Profitez de nos logements premiums parisiens</h1>
            <p>Des localisations attractives et un service de compétition</p>
            <a href="<?= __ROOT_URL__ ?>/search" class="button transparentBtn">
                Découvrir
            </a>
        </div>
        <div class="heroImgContainer">
        <?php foreach($data['images'] as $i): ?>
            <img src="<?= $i->getImage() ?>" alt="Appartment interior image" width="400px" class="mainImage">
        <?php endforeach; ?>
        </div>
    </section>
    <section id="homeRecommandations">
        <h2>Nos recommandations</h2>
        <div class="recommandationsImgContainer">
            <div class="cardContainer">
<!--                <img src="#" alt="Appartment interior image" width="590px" class="cardImage">-->
                <div class="imageCardFooter">
                <?php foreach($data['housing'] as $h):?>
                    <h1>Id appartement : <?= $h->getId() ?></h1>
                <?php endforeach; ?>
                    <div class="leftInfos"></div>
                    <div class="dividingLine"></div>
                    <div class="rightInfos"></div>
                </div>
            </div>
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

