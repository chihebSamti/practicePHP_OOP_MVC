<h1>Inscription</h1>
<?php if(!empty($_SESSION['registerError'])) : ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $_SESSION['registerError'] ; unset($_SESSION['registerError']) ; ?>
            </div>
    <?php endif ;?>
<?= $registerForm ?>
<a href="<?= URL ;?>/users/login">Se connecter</a>