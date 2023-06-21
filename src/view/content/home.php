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
        <div class="recommandationsImgContainer">
            <div class="cardContainer container">
<!--                <img src="#" alt="Appartment interior image" width="590px" class="cardImage">-->
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
<script>
    function createCardLogement(arrayAsso) {
        for (let i = 0; i < arrayAsso.length; i++) {

            let a = document.createElement('a')
            let img = document.createElement('img')
            let divDescription = document.createElement('div')
            let divName = document.createElement('div')
            let spanName = document.createElement('span')
            let area = document.createElement('p')
            let pDescription = document.createElement('p')
            let piece = document.createElement('p')

            a.setAttribute('href', "<?= __ROOT_URL__ ?>/apartment?housing_id=" + arrayAsso[i].id)
            a.classList.add('cardLogement')

            img.setAttribute('src', arrayAsso[i].images)
            img.setAttribute('alt', arrayAsso[i].alt)

            spanName.textContent = arrayAsso[i].name

            area.textContent = arrayAsso[i].area + 'm²'

            pDescription.textContent = arrayAsso[i].description

            piece.textContent = arrayAsso[i].number_pieces + ' pièces'

            divDescription.classList.add('description')
            divName.classList.add('name')

            a.appendChild(img)
            a.appendChild(divDescription)
            divDescription.appendChild(divName)
            divDescription.appendChild(pDescription)
            divName.appendChild(spanName)
            divName.appendChild(area)
            divName.appendChild(piece)

            document.querySelector(".container").appendChild(a)
        }
    }
    let json = <?php echo json_encode($data['housing']); ?>;
    console.log(json)
    createCardLogement(json)
</script>

