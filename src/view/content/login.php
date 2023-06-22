<main>
    <aside>
        <img src="<?= __ROOT_URL__ ?>/assets/images/login.svg" alt="">
    </aside>
    <div class='form'>
        <div class="error">
            <?php foreach ($data["error"] as $e): ?>
                <p>
                    <?= $e ?>
                </p>

            <?php endforeach; ?>
        </div>
        <h2>Login</h2>

        <form method="POST">

            <input id="mail" name="mail" type="text" placeholder="exemple@mail.com" <?php if ($data["user"]) {
                echo ("value='" . $data["user"]->getMail() . "'");
            } ?>>

            <input id="password" name="password" type="password" placeholder="Password">
            <input class="register" type="submit" value="Login">
        </form>
        <a href="<?= __ROOT_URL__ ?>/register">Not a member ? <span>Sign up now !</span></a>
    </div>
</main>