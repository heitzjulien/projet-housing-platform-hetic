<?php //foreach($data['images'] as $i => $p): ?>
<!--    <img src="--><?php //= $p->getImage()[0]->getImage() ?><!--" alt="">-->
<?php //endforeach; ?>
<!---->
<?php //foreach($data['start'] as $h => $c): ?>
<!--    <p>--><?php //= $c->getName() ?><!--</p>-->
<!--    <p>--><?php //= $c->getCapacity() ?><!-- personnes</p>-->
<!--    <p>--><?php //= $c->getPrice() ?><!-- €</p>-->
<!--    <p>--><?php //= $c->getDescription() ?><!--</p>-->
<!--    <p>--><?php //= $c->getNumberPieces() ?><!-- pièces</p>-->
<!--    <p>--><?php //= $c->getArea() ?><!-- m²</p>-->
<!--    <img src="--><?php //= $c->getImage()[0]->getImage() ?><!--" alt="">-->
<?php //endforeach; ?>
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
            <img src="#" alt="Appartment interior image" width="400px" class="mainImage">
            <img src="#" alt="Appartment interior image" width="400px" class="secondaryImage">
        </div>
    </section>
    <section id="homeRecommandations">
        <h2>Nos recommandations</h2>
        <div class="recommandationsImgContainer">
            <div class="cardContainer">
                <img src="#" alt="Appartment interior image" width="590px" class="cardImage">
                <div class="imageCardFooter">
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
        <img src="">
    </section>
</main>

