<div class="error">
    <?php foreach($data["error"] as $e): ?>
        <p>
            <?= $e ?>
        </p>
    <?php endforeach; ?>
</div>
<div class="valid">
    <?php if($data["valid"]): ?>
        <p>Modifications apportées</p>
    <?php endif; ?>
</div>

<h2>Appartement :</h2>
<form method="POST">
    <input type="hidden" name="table" value="housing">
    <div>
        <label for="name">Nom de l'appartement :</label>
        <input id="name" name="name" type="text" value="<?= $data['housing']->getName(); ?>">
    </div>
    <div>
        <label for="capacity">Capacité :</label>
        <input id="capacity" name="capacity" type="number" value="<?= $data['housing']->getCapacity(); ?>">
    </div>
    <div>
        <label for="price">Prix /nuit en € :</label>
        <input id="price" name="price" type="number" value="<?= $data['housing']->getPrice(); ?>">
    </div>
    <div>
        <label for="description">Description :</label>
        <textarea name="description" id="description" cols="50" rows="3"><?= $data['housing']->getDescription(); ?></textarea>
    </div>
    <div>
        <label for="note">Note :</label>
        <input id="note" name="note" type="text" value="<?= $data['housing']->getNote(); ?>" placeholder="Note du personnel d'entretient">
    </div>
    <div>
        <label for="instruction">Instruction :</label>
        <input id="instruction" name="instruction" type="number" value="<?= $data['housing']->getInstruction(); ?>" placeholder="Instruction pour le personnel d'entretient">
    </div>
    <div>
        <label for="number_pieces">Nombre de pièces :</label>
        <input id="number_pieces" name="number_pieces" type="number" value="<?= $data['housing']->getNumberPieces(); ?>">
    </div>
    <div>
        <label for="number_rooms">Nombre de chambres :</label>
        <input id="number_rooms" name="number_rooms" type="number" value="<?= $data['housing']->getNumberRooms(); ?>">
    </div>
    <div>
        <label for="number_bathroom">Nombre de salles de bains :</label>
        <input id="number_bathroom" name="number_bathroom" type="number" value="<?= $data['housing']->getNumberBathroom(); ?>">
    </div>
    <div>
        <fieldset>
            <legend>Extérieur :</legend>
            <div>
                <input type="checkbox" id="pool" name="pool" value="pool" <?php if(in_array('pool', $data['housing']->getExterior())){ echo("checked"); }?>>
                <label for="pool">Piscine</label>
            </div>
            <div>
                <input type="checkbox" id="terrace" name="terrace" value="terrace" <?php if(in_array('terrace', $data['housing']->getExterior())){ echo("checked"); }?>>
                <label for="terrace">Terrasse</label>
            </div>
            <div>
                <input type="checkbox" id="garden" name="garden" value="garden" <?php if(in_array('garden', $data['housing']->getExterior())){ echo("checked"); }?>>
                <label for="garden">Jardin</label>
            </div>
            <div>
                <input type="checkbox" id="gym" name="gym" value="gym" <?php if(in_array('gym', $data['housing']->getExterior())){ echo("checked"); }?>>
                <label for="gym">Salle de sport</label>
            </div>
        </fieldset>
    </div>
    <div>
        <fieldset>
            <legend>Parking :</legend>
            <div>
                <input type="checkbox" id="garage" name="garage" value="garage" <?php if(in_array('garage', $data['housing']->getCarPark())){ echo("checked"); }?>>
                <label for="garage">Garage</label>
            </div>
            <div>
                <input type="checkbox" id="underground_parking" name="underground_parking" value="underground_parking" <?php if(in_array('underground_parking', $data['housing']->getCarPark())){ echo("checked"); }?>>
                <label for="underground_parking">Parking sous terrain</label>
            </div>
            <div>
                <input type="checkbox" id="parking_spot" name="parking_spot" value="parking_spot" <?php if(in_array('parking_spot', $data['housing']->getCarPark())){ echo("checked"); }?>>
                <label for="parking_spot">Place de parking</label>
            </div>
            <div>
                <input type="checkbox" id="covered_parking_space" name="covered_parking_space" value="covered_parking_space" <?php if(in_array('covered_parking_space', $data['housing']->getCarPark())){ echo("checked"); }?>>
                <label for="covered_parking_space">Place de parking couverte</label>
            </div>
        </fieldset>
    </div>

    <div>
        <label for="area">Surface en m2 :</label>
        <input id="area" name="area" type="number" value="<?= $data['housing']->getArea(); ?>">
    </div>
    <input type="submit" value="Mettre a jour">
</form>

<br>
<h2>Images :</h2>
<form method="POST">
    <input type="hidden" name="table" value="housing_images">
    <input type="hidden" name="housing_id" value="<?= $data['housing']->getId(); ?>">

    <input type="submit" value="Mettre a jour">
</form>

<br>
<h2>Services :</h2>
<form method="POST">
    <input type="hidden" name="table" value="housing_services">
    <input type="hidden" name="housing_id" value="<?= $data['housing']->getId(); ?>">
    <fieldset>
            <legend>Services disponible pour l'appartement :</legend>
            <?php foreach($data['services'] as $s): ?>
            <div>
                <input type="checkbox" id="service<?= $s->getId() ?>" name="service<?= $s->getId() ?>" value="<?= $s->getId() ?>" <?php if(in_array($s, $data['housing']->getService())){ echo("checked"); }?>>
                <label for="service<?= $s->getId() ?>"><?= $s->getName() ?></label>
            </div>
            <?php endforeach; ?>
        </fieldset>
    <input type="submit" value="Mettre a jour">
</form>

<br>
<h2>Opinions :</h2>
<form method="POST">
    <input type="hidden" name="table" value="opinions">
    <input type="hidden" name="housing_id" value="<?= $data['housing']->getId(); ?>">

    <input type="submit" value="Mettre a jour">
</form>

<br>
<h2>Localisation :</h2>
<form method="POST">
    <input type="hidden" name="table" value="housing_location">
    <input type="hidden" name="housing_id" value="<?= $data['housing']->getId(); ?>">
    <div>
        <label for="country">Pays :</label>
        <input id="country" type="text" value="France" disabled>
    </div>
    <div>
        <label for="city">Ville :</label>
        <input id="city" type="text" value="Paris" disabled>
    </div>
    <div>
        <label for="zip">Code Postal :</label>
        <input id="zip" type="text" value="<?= $data['housing']->getZip(); ?>" disabled>
    </div>
    <div>
        <label for="district">Arrondissement :</label>
        <select id="district" name="district">
            <option value="01" <?php if($data['housing']->getDistrict() == '01'){ echo("selected"); }?>>01</option>
            <option value="02" <?php if($data['housing']->getDistrict() == '02'){ echo("selected"); }?>>02</option>
            <option value="03" <?php if($data['housing']->getDistrict() == '03'){ echo("selected"); }?>>03</option>
            <option value="04" <?php if($data['housing']->getDistrict() == '04'){ echo("selected"); }?>>04</option>
            <option value="05" <?php if($data['housing']->getDistrict() == '05'){ echo("selected"); }?>>05</option>
            <option value="06" <?php if($data['housing']->getDistrict() == '06'){ echo("selected"); }?>>06</option>
            <option value="07" <?php if($data['housing']->getDistrict() == '07'){ echo("selected"); }?>>07</option>
            <option value="08" <?php if($data['housing']->getDistrict() == '08'){ echo("selected"); }?>>08</option>
            <option value="09" <?php if($data['housing']->getDistrict() == '09'){ echo("selected"); }?>>09</option>
            <option value="10" <?php if($data['housing']->getDistrict() == '10'){ echo("selected"); }?>>10</option>
            <option value="11" <?php if($data['housing']->getDistrict() == '11'){ echo("selected"); }?>>11</option>
            <option value="12" <?php if($data['housing']->getDistrict() == '12'){ echo("selected"); }?>>12</option>
            <option value="13" <?php if($data['housing']->getDistrict() == '13'){ echo("selected"); }?>>13</option>
            <option value="14" <?php if($data['housing']->getDistrict() == '14'){ echo("selected"); }?>>14</option>
            <option value="15" <?php if($data['housing']->getDistrict() == '15'){ echo("selected"); }?>>15</option>
            <option value="16" <?php if($data['housing']->getDistrict() == '16'){ echo("selected"); }?>>16</option>
            <option value="17" <?php if($data['housing']->getDistrict() == '17'){ echo("selected"); }?>>17</option>
            <option value="18" <?php if($data['housing']->getDistrict() == '18'){ echo("selected"); }?>>18</option>
            <option value="19" <?php if($data['housing']->getDistrict() == '19'){ echo("selected"); }?>>19</option>
            <option value="20" <?php if($data['housing']->getDistrict() == '20'){ echo("selected"); }?>>20</option>
        </select>
    </div>
    <div>
        <label for="address">Adresse :</label>
        <input id="address" name="address" type="text" value="<?= $data['housing']->getAddress(); ?>">
    </div>
    <input type="submit" value="Mettre a jour">
</form>