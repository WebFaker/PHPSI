<?php
require_once "connexion.php";
?>

<!doctype html>
<html lang="FR">

<head>
  <title>Administrateur - Modifier</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-info">

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/">Accueil <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add.php">Ajouter une planète</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../index.php">Retour au site</a>
        </li>
      </ul>
    </div>
  </nav>

  <?php
  if(isset($_POST["id"])){
      $id = $_POST["id"];
  }
  $stmt = $conn->prepare("SELECT id, planete, image, description, temperature, prix FROM planetes WHERE id=$id");
  $stmt->execute();

  ?>

<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Edition des informations</h2>
    </div>

  <?php $row = $stmt->fetch(PDO::FETCH_ASSOC)?>

    <div class="card-body">
      <form method="post" action="doedit.php">
        <div class="form-group">
          <label for="name">Nom</label>
          <input value="<?= $row["planete"] ?>" type="text" name="planete" class="form-control">
        </div>
        <div class="form-group">
          <label for="name">Image</label>
          <input value="<?= $row["image"] ?>" type="text" name="image" class="form-control">
        </div>
        <div class="form-group">
          <label for="name">Description</label>
          <input value="<?= $row["description"] ?>" type="text" name="description" class="form-control">
        </div>
        <div class="form-group">
          <label for="name">Température</label>
          <input value="<?= $row["temperature"] ?>" type="text" name="temperature" class="form-control">
        </div>
        <div class="form-group">
          <label for="name">Prix</label>
          <input value="<?= $row["prix"] ?>" type="text" name="prix" class="form-control">
        </div>

        <div class="form-group">
            <input type="hidden" name="id" value="<?=$row["id"]?>">
            <input onclick="return confirm('Voulez-vous vraiment enregister vos modifications ?')" class="btn btn-info" type="submit" value="Valider">
        </div>
      </form>
    </div>
  </div>
</div>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

</html>
