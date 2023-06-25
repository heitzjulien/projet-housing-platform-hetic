<main>
    <div class="error">
        <?php foreach($data["error"] as $e): ?>
            <p>
                <?= $e ?>
            </p>
        <?php endforeach; ?>
    </div>
    <div class="valid">
        <?php if($data["valid"]): ?>
            <p>Les modifications on été apportées</p>
        <?php endif; ?>
    </div>
    <h2>Administration</h2>
    <?php foreach($data["users"] as $u):?>
        <div>
            <h3><?= $u->getFirstname() ?></h3>
            <form method="POST">
                <input name="id" type="hidden" value="<?= $u->getId() ?>">
                <fieldset>
                    <legend>Roles :</legend>

                    <div>
                        <input type="checkbox" id="client<?= $u->getId() ?>" name="client" checked disabled>
                        <label for="client<?= $u->getId() ?>">Client</label>
                    </div>
                    <div>
                        <input type="checkbox" id="management<?= $u->getId() ?>" name="management" <?php if(in_array('management', $u->getRoles())){ echo("checked"); }?>>
                        <label for="management<?= $u->getId() ?>">Management</label>
                    </div>
                    <div>
                        <input type="checkbox" id="maintenance<?= $u->getId() ?>" name="maintenance" <?php if(in_array('maintenance', $u->getRoles())){ echo("checked"); }?>>
                        <label for="maintenance<?= $u->getId() ?>">Maintenance</label>
                    </div>
                    <div>
                        <input type="checkbox" id="admin<?= $u->getId() ?>" name="admin" <?php if(in_array('admin', $u->getRoles())){ echo("checked"); }?>>
                        <label for="admin<?= $u->getId() ?>">Admin</label>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Account status :</legend>
                    <div>
                        <input type="radio" id="waiting<?= $u->getId() ?>" name="account_status" value="waiting" <?php if($u->getAccountStatus() == "waiting"){ echo("checked"); }?>>
                        <label for="waiting<?= $u->getId() ?>">Waiting</label>
                    </div>

                    <div>
                        <input type="radio" id="valid<?= $u->getId() ?>" name="account_status" value="valid" <?php if($u->getAccountStatus() == "valid"){ echo("checked"); }?>>
                        <label for="valid<?= $u->getId() ?>">Valid</label>
                    </div>

                    <div>
                        <input type="radio" id="disable<?= $u->getId() ?>" name="account_status" value="disable" <?php if($u->getAccountStatus() == "disable"){ echo("checked"); }?>>
                        <label for="disable<?= $u->getId() ?>">Disable</label>
                    </div>
                </fieldset>
                <input type="submit" value="Mettre a jour">
            </form>
            <?php if($u->getId() != $data["user_logged_in"]->getId()): ?>
                <a href="<?= __ROOT_URL__ ?>/delete?id=<?= $u->getId() ?>" id="btn-delete">Supprimer le compte</a>
            <?php endif; ?>
        </div>
        <br>
    <?php endforeach; ?>
</main>