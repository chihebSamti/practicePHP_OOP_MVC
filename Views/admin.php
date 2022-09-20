<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" 
    crossorigin="anonymous">
</head>

<body>
  <!-- nav bar  -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
    <div class="container-fluid">
      <!-- logo  -->
      <a class="navbar-brand" href=<?= URL?>>Mes Annonces</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- navbar component -->
      <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <!-- left navbar component  -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href=<?= URL?>>Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL?>/annonces">List des annonces</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL?>/annonces/ajouter">Ajouter une annonce</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL?>/admin">Espace admin</a>
          </li>
        </ul>
        <!-- right navbar component-->
        <ul class="navbar-nav ml-auto">
          <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])): ?>
            <li class="nav-item">
            <a class="nav-link" href="<?=URL?>/users/profil">Profil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=URL?>/users/logout">Deconnexion</a>
          </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="<?=URL?>/users/register">Inscription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="<?=URL?>/users/login">Connexion</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- body  -->
  <div class="container">
    <!-- alet message section  -->
    <?php if(!empty($_SESSION['message'])) : ?>
            <div class="alert alert-success" role="alert">
              <?= $_SESSION['message'] ; unset($_SESSION['message']) ; ?>
            </div>
    <?php endif ;?>
    <!-- . -->
    <?php if(!empty($_SESSION['error'])) : ?>
            <div class="alert alert-danger" role="alert">
              <?= $_SESSION['error'] ; unset($_SESSION['error']) ; ?>
            </div>
    <?php endif ;?>

    <!-- content -->
    <?= $contenu ?>
  </div>
  <!-- JavaScript Bundle with Popper -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" 
    crossorigin="anonymous"></script>
  <script src="<?=URL?>/js/scripts.js"></script>
</body>

</html>