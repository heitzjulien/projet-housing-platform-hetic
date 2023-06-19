<?php foreach ($data["error"] as $e): ?>
            <p class='error'>
                <?= $e ?>
            </p>
        <?php endforeach; ?>
<h2>Search</h2>
<form method="post">
    <input type="date" name="date_start" id="date_start">
    <input type="date" name="date_end" id="date_end">
    <input type="string" name="district" id="district" placeholder="district">
    <input type="int" name="number_pieces" id="number_pieces" placeholder="nbr piece">
    <input type="int" name="capacity" id="capacity" placeholder="capacity">
    <input type="submit" value="submit">
</form>

<div class="searchBar">
    <form action="" class="searchBarForm">
        <input type="text" placeholder="Arrondissement">
        <input type="text" placeholder="Arrivé">
        <input type="text" placeholder="Départ">
        <button type="submit">Chercher</button>
    </form>
</div>
<div class="filter">
    <form action="" class="filterForm">
        <div class="input-row">
            <label for="pièces">Pièces :</label>
            <input type="text" name="pièces" placeholder="">
        </div>

        <div class="input-row">
            <label for="surface">Surface en m² :</label>
            <input type="text" name="surface" placeholder="">
        </div>

        <div class="input-row">
            <label for="Arrondissement">Arrondissement :</label>
            <input type="text" name="Arrondissement" placeholder="">
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

            a.setAttribute('href', arrayAsso[i].href)
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