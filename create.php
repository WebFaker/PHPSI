<!doctype html>
<html lang="en">

<head>
  <title>Hello, world!</title>
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
        <li class="nav-item">
          <a class="nav-link" href="index.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="create.php">Ajouter une planète <span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="card mt-5">
      <div class="card-header">
        <h2>Ajouter une planète</h2>
      </div>
      <div class="card-body">
        <form method="post" action="add.php">
          <div class="form-group">
            <label for="name">Planète</label>
            <input placeholder="Planète" type="text" name="planet" id="name" class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Image (lien)</label>
            <input placeholder="Lien de l'image" type="link" name="img" class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Description</label>
            <input placeholder="Description" type="text" name="desc" class="form-control">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-info">Ajouter à la liste</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="card mt-5">
      <div class="card-header">
        <h2>Update person</h2>
      </div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label for="name">Name</label>
            <input value="<?= $person->name; ?>" type="text" name="name" id="name" class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" value="<?= $person->email; ?>" name="email" id="email" class="form-control">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-info">Update person</button>
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
