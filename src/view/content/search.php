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
<script src="<?= __ROOT_URL__ ?>/scripts/cardLogements" type=" module"></script>