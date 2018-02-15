
<?php
// Using one time the file connexion.php to connect to the database.
require_once "connexion.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Administrateur - Liste</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-info">

  <nav class="navbar">
    <img src="assets/img/outlandWhite.svg" class="navbar__logo" alt="logo">
    <ul class="header__items">
      <li class="header__item header__item__panier">
        <a class="header__item" href="../index.php">| Retour au site</a></li>
    </ul>
  </nav>

<?php
// Preparing the Statement, and selecting the columns id, planete, image, description, temperature, and prix from the planetes table.
$stmt = $conn->prepare("SELECT id, planete, image, description, temperature, km FROM planetes");
// Executing the action above.
$stmt->execute();
// Looking if "id" is set. Otherwise it shows nothing.
if(isset($_SESSION["id"])){
    $id = $_SESSION["id"];
}
?>

    <div class="container">
      <div class="card mt-5">
        <div class="card-header">
          <h2>Liste des planètes</h2>
          <a href="add.php">Ajouter une planète</a>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <tr>
              <th>Planète</th>
              <th>Image</th>
              <th>Description</th>
              <th>Température</th>
              <th>Diamètre</th>
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
                <?= $row["temperature"]?>
              </td>
              <td>
                <?= $row["km"]?>
              </td>
              <td>

                <form action="edit.php" method="post">
                  <input type="hidden" name="id" value="<?=$row["id"]?>">
                  <input class="btn btn-info" type="submit" value="Modifier">
                </form>

                <form action="dodelete.php" method="post">
                  <input type="hidden" name="id" value="<?=$row["id"]?>">
                  <input onclick="return confirm('Voulez-vous vraiment supprimer cette planète ? Cette action est irréversible.')" class="btn btn-danger" type="submit" value="Supprimer">
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
