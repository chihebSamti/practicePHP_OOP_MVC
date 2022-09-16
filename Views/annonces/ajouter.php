<h1>Ajouter une annonce</h1>

<?php if(!empty($_SESSION['formError'])) : ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $_SESSION['formError'] ; unset($_SESSION['formError']) ; ?>
            </div>
    <?php endif ;?>

<?= $form ?>
