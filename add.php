<?php
// On commence par récupérer les champs inscrits sur le formulaire
if(isset($_POST['planet']))      $planet=$_POST['planet'];
else      $planet="";

if(isset($_POST['img']))      $img=$_POST['img'];
else      $img="";

if(isset($_POST['desc']))      $desc=$_POST['desc'];
else      $desc="";

// On vérifie si les champs obligatoires sont vides, sinon on retourne un message d'erreur
if(empty($planet) OR empty($img))
    {
    echo '<font color="red">Attention, seul le champs <b>description</b> peut rester vide !</font>';
    }

// Aucun champ obligatoire n'est vide, on peut donc rentrer dans la table
else
    {
         $servername = "localhost";
         $username = "root";
         $password = "coucou";
         $dbname = "outland";

         try {
             $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
             // set the PDO error mode to exception
             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $sql = "INSERT INTO planetes (planete, image, description)
             VALUES ('$planet', '$img', '$desc')";
             // use exec() because no results are returned
             $conn->exec($sql);
             echo "C'est ajouté lol !";
             }
         catch(PDOException $e)
             {
             echo $sql . "<br>" . $e->getMessage();
             }

         $conn = null;
       }
         ?>
