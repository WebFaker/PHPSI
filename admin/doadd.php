<?php
// On commence par récupérer les champs inscrits sur le formulaire
if(isset($_POST['planet']))      $planet=$_POST['planet'];
else      $planet="";

if(isset($_POST['img']))      $img=$_POST['img'];
else      $img="";

if(isset($_POST['desc']))      $desc=$_POST['desc'];
else      $desc="";

if(isset($_POST['temp']))      $temp=$_POST['temp'];
else      $temp="";

if(isset($_POST['prix']))      $prix=$_POST['prix'];
else      $prix="";


// On vérifie si les champs obligatoires sont vides, sinon on retourne un message d'erreur
if(empty($planet) OR empty($img) OR empty($prix))
    {
<<<<<<< HEAD:admin/doadd.php
    echo '<center>Attention, seul les champs <font color="red"><b>description</b></font> et <font color="red"><b>température</b></font> peuvent rester vide !</center> <br /> <center><a href="add.php">Retour en arrière.</a></center>';
=======
    echo '<center>Attention, seul le champs <font color="red"><b>description</b></font> peut rester vide !</center> <br /> <center><a href="add.html">Retour en arrière.</a></center>';
>>>>>>> a7d1136c2e5c5225ed5021c79229ce686e5caabd:add.php
    }

// Aucun champ obligatoire n'est vide, on peut donc rentrer dans la table
else
    {
         $servername = "localhost";
         $username = "root";
         $password = "babytchi99";
         $dbname = "outland";

         try {
             $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
             // set the PDO error mode to exception
             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $sql = "INSERT INTO planetes (planete, image, description, temperature, prix)
             VALUES ('$planet', '$img', '$desc', '$temp', '$prix')";
             // use exec() because no results are returned
             $conn->exec($sql);
             header('Location: success.html');
             }
         catch(PDOException $e)
             {
             echo $sql . "<br>" . $e->getMessage();
             }

         $conn = null;
       }
         ?>
