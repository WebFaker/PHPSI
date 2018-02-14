<?php
require_once "connexion.php";
?>
<!doctype html>
<html lang="fr">

<head>
  <title>Administrateur - Liste</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-info">

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">METTEZ VOTRE TRUC DE LOGO ICI</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/">Accueil <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="create.php">Ajouter une planète</a>
        </li>


      </ul>
    </div>
  </nav>

<?php
$stmt = $conn->prepare("SELECT id, planete, image, description FROM planetes");
$stmt->execute();
if(isset($_SESSION["id"])){
    $id = $_SESSION["id"];
}

?>

    <div class="container">
      <div class="card mt-5">
        <div class="card-header">
          <h2>Liste des planètes</h2>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <tr>
              <th>Planète</th>
              <th>Image</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          <?php while (false !== $row = $stmt->fetch(PDO::FETCH_ASSOC)) :?>
            <tr>
              <td>
                <?= $row["planete"]?>
              </td>
              <td>
                <?= $row["image"]?>
              </td>
              <td>
                <?= $row["description"]?>
              </td>
              <td>

                <a href="edit.php?id=<?= $row["id"] ?>" class="btn btn-info">Edit</a>

                <form action="delete.php" method="post">
                  <input type="hidden" name="id" value="<?=$row["id"]?>">
                  <input class="btn btn-danger" type="submit" value="Supprimer">
                </form>

              </td>
            </tr>
          <?php endwhile;?>
          </table>
        </div>
      </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

</html>
