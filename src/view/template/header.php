 <header>
    <a href="<?= __ROOT_URL__ ?>/home">
        <img  src="./assets/icons/logo.svg"/>
    </a>
    <div>
        <button id="dialogHeader">
            <img src="./assets/icons/burger.svg" />
        <?php if($data['user_logged_in']): ?>
            <span><?= ($data['user_logged_in'])->getFirstname() ?></span>
        <?php else: ?>
            <img src="./assets/icons/userIcon.svg" />
        <?php endif; ?>
        </button>
        <div id="headerModal" class="hideModal">
        <?php if($data['user_logged_in']): ?>
            <a href="<?= __ROOT_URL__ ?>/logout">Logout</a>
        <?php else: ?>
            <a href="<?= __ROOT_URL__ ?>/login">Connexion</a>
            <a href="<?= __ROOT_URL__ ?>/register">Inscription</a>
        <?php endif; ?>
        </div>

    </div>
 </header>