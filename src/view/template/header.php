<header>
    <a href="<?= __ROOT_URL__ ?>/home">
        <img  src="<?= __ROOT_URL__ ?>/assets/icons/logo.svg"/>
    </a>
    <div>
        <button id="dialogHeader">
            <img src="<?= __ROOT_URL__ ?>/assets/icons/burger.svg" />
        <?php if($data['user_logged_in']): ?>
            <span><?= ($data['user_logged_in'])->getFirstname() ?></span>
        <?php else: ?>
            <img src="<?= __ROOT_URL__ ?>/assets/icons/userIcon.svg" />
        <?php endif; ?>
        </button>
        <div id="headerModal" class="hideModal">
        <?php if($data['user_logged_in']->isAdmin()):?>
            <a href="<?= __ROOT_URL__ ?>/dashboard/admin">Admin</a>
        <?php endif; ?>
        <?php if($data['user_logged_in']): ?>
            <a href="<?= __ROOT_URL__ ?>/dashboard/client">Dashboard</a>
            <a href="<?= __ROOT_URL__ ?>/settings">Réglages</a>
            <a href="<?= __ROOT_URL__ ?>/logout?device=current">Logout</a>
        <?php else: ?>
            <a href="<?= __ROOT_URL__ ?>/login">Connexion</a>
            <a href="<?= __ROOT_URL__ ?>/register">Inscription</a>
        <?php endif; ?>
        </div>
    </div>
 </header>
 