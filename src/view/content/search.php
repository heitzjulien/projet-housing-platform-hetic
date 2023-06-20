<?php foreach ($data["error"] as $e): ?>
    <p class='error'>
        <?= $e ?>
    </p>
<?php endforeach; ?>
<h2>Search</h2>

<!-- <div class="searchBar">
     <form action="" class="searchBarForm">
        <input type="text" placeholder="Arrondissement">
        <input type="text" placeholder="Arrivé">
        <input type="text" placeholder="Départ">
        <button type="submit">Chercher</button>
    </form> 
</div> -->

<div class="filter">
    <form method="POST" class="filterForm">
        <div class="input-row">
            <label for="date_start">Date d'arrivé :</label>
            <input id="date_start" type="date" name="date_start" value="<?php if($data['filter']['date_start']) { echo(date("Y-m-d", $data['filter']['date_start'])); } ?>">
        </div>

        <div class="input-row">
            <label for="date_end">Date de départ :</label>
            <input id="date_end" type="date" name="date_end" value="<?php if($data['filter']['date_end']) { echo(date("Y-m-d", $data['filter']['date_end'])); } ?>">
        </div>

        <div class="input-row">
            <label for="district">Arrondissement :</label>
            <input id="district" type="number" name="district" value="<?= $data['filter']['district'] ?>" placeholder="16e">
        </div>
        
        <div class="input-row">
            <label for="number_pieces">Pièces :</label>
            <input id="number_pieces" type="number" name="number_pieces" value="<?= $data['filter']['number_pieces'] ?>" placeholder="7 pièces">
        </div>

        <div class="input-row">
            <label for="area">Surface en m² :</label>
            <input id="area" type="number" name="area" value="<?= $data['filter']['area'] ?>" placeholder="100m²">
        </div>

        <button type="submit">Filtrer</button>
    </form>
</div>


<div class="filter"></div>

<div class="container">
</div>

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

            // a.setAttribute('href', arrayAsso[i].href)
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
    createCardLogement(json)
</script>