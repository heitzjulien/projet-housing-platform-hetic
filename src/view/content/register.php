<link rel="stylesheet" href="https://use.typekit.net/olo1pvf.css">

<main>


    <aside>
        <img src="../public/assets/images/register.svg" alt="">
    </aside>

    <div class="form">
        <div class="error">

            <?php foreach ($data["error"] as $e): ?>
                <p>
                    <?= $e ?>
                </p>

            <?php endforeach; ?>
        </div>
        <h2>Register </h2>
        <form method="POST">

            <input id="firstname" name="firstname" type="text" placeholder="Firstname" <?php if ($data["user"]) {
                echo ("value='" . $data["user"]->getFirstname() . "'");
            } ?>>

            <input id="lastname" name="lastname" type="text" placeholder="Lastname" <?php if ($data["user"]) {
                echo ("value='" . $data["user"]->getLastname() . "'");
            } ?>>

            <input id="mail" name="mail" type="text" placeholder="exemple@mail.com" <?php if ($data["user"]) {
                echo ("value='" . $data["user"]->getMail() . "'");
            } ?>>

            <input id="birthdate" name="birthdate" type="date" <?php if ($data["user"]) {
                echo ("value='" . $data["user"]->getBirthdate() . "'");
            } ?>>

            <input id="password" name="password" type="password" placeholder="Password">
            <input id="confpsd" name="confpsd" type="password" placeholder="Confirm password">
            <input class="register" type="submit" value="Register">
        </form>
        <a href="<?= __ROOT_URL__ ?>/login">Already a member ? <span>Login</span></a>
    </div>
</main>