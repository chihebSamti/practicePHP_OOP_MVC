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
  <nav class="navbar navbar-expand-lg bg-light ">
    <div class="container-fluid">

      <a class="navbar-brand" href=<?= URL?>>Mes Annonces</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href=<?= URL?>>Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL?>/annonces">List des annonces</a>
          </li>
        </ul>
        
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
              <a class="nav-link " aria-current="page" href="<?=URL?>/users/login">Connexion</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <?= $contenu ?>
  </div>

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" 
    crossorigin="anonymous"></script>
</body>

</html>