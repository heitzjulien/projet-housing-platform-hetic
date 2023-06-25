<main>
    <section>
        <h1>Votre espace</h1>
        <div class="container">
        </div>
    </section>
</main>

<script src="<?= __ROOT_URL__ ?>/scripts/dashboardVotreEspace.js" type="module"></script>

<?php if(in_array('admin', $data['user_logged_in']->getRoles())):?>
    <script src="<?= __ROOT_URL__ ?>/scripts/dashboardAdmin.js" type="module"></script>
<?php endif; ?>

<?php if(in_array('management', $data['user_logged_in']->getRoles())):?>
    <script src="<?= __ROOT_URL__ ?>/scripts/dashboardParametre.js" type="module"></script>
<?php endif; ?>