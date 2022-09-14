<?php if(!empty($_SESSION['loginError'])) : ?>
<div class="alert alert-danger" role="alert">
  <?= $_SESSION['loginError'] ; unset($_SESSION['loginError']) ; ?>
</div>
<?php endif ;?>
<h1>Connexion</h1>
<?= $loginForm ?>
<a href="<?=URL?>/users/register">Créer un compte</a>