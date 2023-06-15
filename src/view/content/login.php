<?php foreach($data["error"] as $e): ?>
    <p><?= $e ?></p>
<?php endforeach; ?>
<h2>Login :</h2>
<form method="POST">
    <label for="mail">Mail :</label>
    <input id="mail" name="mail" type="text" placeholder="exemple@mail.com" <?php if($data["user"]) { echo("value='" . $data["user"]->getMail() . "'"); } ?>>
    <label for="password">Password :</label>
    <input id="password" name="password" type="password" placeholder="Password">
    <input type="submit" value="Login">
</form>
<a href="register">Register !</a>
