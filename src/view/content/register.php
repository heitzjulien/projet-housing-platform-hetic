<?php foreach($data["error"] as $e): ?>
    <p><?= $e ?></p>
<?php endforeach; ?>
<h2>Register :</h2>
<form method="POST">
    <label for="firstname">Firstname :</label>
    <input id="firstname" name="firstname" type="text" placeholder="Firstname" <?php if($data["user"]) { echo("value='" . $data["user"]->getFirstname() . "'"); } ?>>
    <label for="lastname">Lastname :</label>
    <input id="lastname" name="lastname" type="text" placeholder="Lastname" <?php if($data["user"]) { echo("value='" . $data["user"]->getLastname() . "'"); } ?>>
    <label for="mail">Mail :</label>
    <input id="mail" name="mail" type="text" placeholder="exemple@mail.com" <?php if($data["user"]) { echo("value='" . $data["user"]->getMail() . "'"); } ?>>
    <label for="birthdate">Birthdate :</label>
    <input id="birthdate" name="birthdate" type="date" <?php if($data["user"]) { echo("value='" . $data["user"]->getBirthdate() . "'"); } ?>>
    <label for="password">Password :</label>
    <input id="password" name="password" type="password" placeholder="Password">
    <label for="confpsd">Confirm Password :</label>
    <input id="confpsd" name="confpsd" type="password" placeholder="Confirm password">
    <input type="submit" value="Register">
</form>
<a href="login">Login !</a>
