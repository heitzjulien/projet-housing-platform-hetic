<?php foreach($data["error"] as $e): ?>
    <p><?= $e ?></p>
<?php endforeach; ?>
<h2>Register :</h2>
<form method="POST">
    <label for="firstname">Firstname :</label>
    <input id="firstname" name="firstname" type="text" placeholder="Firstname" <?php if($data["newUser"]["firstname"]) { echo("value='" . $data["newUser"]["firstname"] . "'"); } ?>>
    <label for="lastname">Lastname :</label>
    <input id="lastname" name="lastname" type="text" placeholder="Lastname" <?php if($data["newUser"]["lastname"]) { echo("value='" . $data["newUser"]["lastname"] . "'"); } ?>>
    <label for="mail">Mail :</label>
    <input id="mail" name="mail" type="text" placeholder="exemple@mail.com" <?php if($data["newUser"]["mail"]) { echo("value='" . $data["newUser"]["mail"] . "'"); } ?>>
    <label for="birthdate">Date de naissance :</label>
    <input id="birthdate" name="birthdate" type="date" <?php if($data["newUser"]["birthdate"]) { echo("value='" . $data["newUser"]["birthdate"] . "'"); } ?>>
    <label for="password">Password :</label>
    <input id="password" name="password" type="password" placeholder="Mot de passe">
    <label for="confpsd">Confirm Password :</label>
    <input id="confpsd" name="confpsd" type="password" placeholder="Valider votre mot de passe">
    <input type="submit" value="Register">
</form>
<a href="./?p=login">Login !</a>
