<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dasboard Logement</title>
    <link rel="stylesheet" href="styles/style5.css">
</head>
<body>
    <div class="table" id="brightness">
        <div class="table_header">
            <h1>Dasboard Logements </h1>
            <div class="new">
                <a href="#" onclick="toggle()">New</a>
            </div>
        </div>
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>ID Logement</th>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Prix /nuit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['housing'] as $h):?>
                    <tr>
                        <td><?= $h->getId() ?></td>
                        <td><?= $h->getName() ?></td>
                        <td><div class="adresse"><?= $h->getAddress() ?>, 
                        <span><?= $h->getCity() ?>, <?= $h->getZip() ?></span></div></td>
                        <td><?= $h->getPrice() ?></td>
                        <td>
                            <button class="edit">Edit</button>
                            <button class="delete">Delete</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="popup">
        <div class="wrapper">
        <h1>Formulaire Logement</h1>
            <img class="close" src="image/croix.png" alt="croix"  onclick="toggle()">
        </div>
            <form class="form">
                <div class="ensemble">
                    <div class="field input">
                        <input type="text" placeholder="Adresse" id="adresse">
                    </div>
                </div>
                <div class="ensemble">
                    <div class="field input">
                        <input type="text" placeholder="ID Logement" id="IDLogement">
                    </div>
                </div>
                <div class="field button">
                    <input type="submit" valuer="Ajouter" onclick="toggle()">
                </div>
            </form>
    </div>
<script src="js/javascript.js"></script>
</body>
</html>