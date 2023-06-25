<div class="error">
    <?php foreach($data["error"] as $e): ?>
        <p>
            <?= $e ?>
        </p>
    <?php endforeach; ?>
</div>
<div class="valid">
    <?php if($data["valid"]): ?>
        <p><?= $data["valid"] ?></p>
    <?php endif; ?>
</div>

<h1>Paramètres</h1>

<section>
    <div class="user">
        <h3>Paramètres de l'utilisateur</h3>
        <form method="POST">
            <label for="firstname">Prénom </label>
            <input id="firstname" name="firstname" type="text" placeholder="Firstname" value="<?= $data["user_logged_in"]->getFirstname() ?>">
            <label for="lastname">Nom </label>
            <input id="lastname" name="lastname" type="text" placeholder="Lastname" value="<?= $data["user_logged_in"]->getLastname() ?>">
            <label for="mail">Mail </label>
            <input id="mail" name="mail" type="text" placeholder="exemple@mail.com" value="<?= $data["user_logged_in"]->getMail() ?>">
            <label for="birthdate">Date de naissance </label>
            <input id="birthdate" name="birthdate" type="date" value="<?= $data["user_logged_in"]->getBirthdate() ?>">
            <input type="submit" value="Mettre a jour" class="btn-submit">
        </form>
    </div>
    
    <div class="user">
        <h3>Validation du compte</h3>
        <p>Votre compte n'est pas <?= $data["user_logged_in"]->getAccountStatus() ?></p>
        <?php if($data["user_logged_in"]->getAccountStatus() == 'waiting'): ?>
            <p>Veuillez valider votre email. <a href="<?= __ROOT_URL__ ?>/dashboard/parametre?action=sendmail">Renvoyer la confirmation</a></p>
        <?php elseif($data["user_logged_in"]->getAccountStatus() == 'valid'): ?>
            <p><a href="<?= __ROOT_URL__ ?>/dashboard/parametre?action=disable" id="btn-account">Désactiver le compte</a></p>
        <?php elseif($data["user_logged_in"]->getAccountStatus() == 'disable'): ?>
            <p><a href="<?= __ROOT_URL__ ?>/dashboard/parametre?action=valid" id="btn-account">Réactiver le compte</a></p>
        <?php endif; ?>
    </div>
    
    <div class="user">
        <h3>Paramètres de sécurité</h3>
        <form method="POST">
            <label for="currentPsd">Mot de passe actuel</label>
            <input id="currentPsd" name="currentPsd" type="password" placeholder="Mot de passe">
            <label for="newPsd">Nouveau mot de passe</label>
            <input id="newPsd" name="newPsd" type="password" placeholder="Nouveau le mot de passe">
            <label for="confNewPsd">Confirmer le nouveau mot de passe</label>
            <input id="confNewPsd" name="confNewPsd" type="password" placeholder="Confirmer le mot de passe">
            <input type="submit" value="Mettre a jour" class="btn-submit">
        </form>
    </div>
    
    <div class="user">
        <h3>Déconnexion et suppression du compte</h3>
        <div class="user-choice">
            <a href="<?= __ROOT_URL__ ?>/logout?device=current">Déconnexion</a>
            <a href="<?= __ROOT_URL__ ?>/logout?device=all">Déconnexion de tous les appareils</a>
            <a href="<?= __ROOT_URL__ ?>/delete" id="btn-delete">Supprimer le compte</a>
        </div>
    </div>

</section>