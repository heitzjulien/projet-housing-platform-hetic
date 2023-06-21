<?php foreach($data["error"] as $e): ?>
    <p><?= $e ?></p>
<?php endforeach; ?>

<?php if($data["valid"]): ?>
    <p><?= $data["valid"] ?></p>
<?php endif; ?>

<h2>Settings</h2>

<h3>User settings</h3>
<form method="POST">
    <label for="firstname">Firstname :</label>
    <input id="firstname" name="firstname" type="text" placeholder="Firstname" value="<?= $data["user_logged_in"]->getFirstname() ?>">
    <label for="lastname">Lastname :</label>
    <input id="lastname" name="lastname" type="text" placeholder="Lastname" value="<?= $data["user_logged_in"]->getLastname() ?>">
    <label for="mail">Mail :</label>
    <input id="mail" name="mail" type="text" placeholder="exemple@mail.com" value="<?= $data["user_logged_in"]->getMail() ?>">
    <label for="birthdate">Birthdate :</label>
    <input id="birthdate" name="birthdate" type="date" value="<?= $data["user_logged_in"]->getBirthdate() ?>">
    <input type="submit" value="Update">
</form>

<br>

<h3>Account validation</h3>
<p>Your accoun't is <?= $data["user_logged_in"]->getAccountStatus() ?></p>
<?php if($data["user_logged_in"]->getAccountStatus() == 'waiting'): ?>
    <p>Please validate your email. <a href="<?= __ROOT_URL__ ?>/dashboard/parametre?action=sendmail">Resend the confirmation</a></p>
<?php elseif($data["user_logged_in"]->getAccountStatus() == 'valid'): ?>
    <p><a href="<?= __ROOT_URL__ ?>/dashboard/parametre?action=disable">Disable account</a></p>
<?php elseif($data["user_logged_in"]->getAccountStatus() == 'disable'): ?>
    <p><a href="<?= __ROOT_URL__ ?>/dashboard/parametre?action=valid">Reactivate account</a></p>
<?php endif; ?>

<br>

<h3>Security settings</h3>
<form method="POST">
    <label for="currentPsd">Current Password :</label>
    <input id="currentPsd" name="currentPsd" type="password" placeholder="Password">
    <label for="newPsd">New Password :</label>
    <input id="newPsd" name="newPsd" type="password" placeholder="Confirm password">
    <label for="confNewPsd">Confirm New Password :</label>
    <input id="confNewPsd" name="confNewPsd" type="password" placeholder="Confirm password">
    <input type="submit" value="Update">
</form>

<br>

<h3>Logout and Delete Account</h3>
<a href="<?= __ROOT_URL__ ?>/logout?device=current">Logout</a>
<a href="<?= __ROOT_URL__ ?>/logout?device=all">Logout All Device</a>
<a href="<?= __ROOT_URL__ ?>/delete">Delete Account</a>