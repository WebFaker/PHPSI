<?php
// Starting by taking all the data we typed in the add.php file
if(isset($_POST['planet']))      $planet=$_POST['planet'];
else      $planet="";

// If the user entered a value in the formula, it's creating a var with the value in it
if(isset($_POST['img']))      $img=$_POST['img'];
// Otherwise, if nothing has been typed, create an empty var
else      $img="";

if(isset($_POST['desc']))      $desc=$_POST['desc'];
else      $desc="";

if(isset($_POST['temp']))      $temp=$_POST['temp'];
else      $temp="";

if(isset($_POST['km']))      $km=$_POST['km'];
else      $km="";


// Checking if the needed fields has been entered, if not, get an error
if(empty($planet) OR empty($img) OR empty($km))
    {
    echo '<center>Attention, seul les champs <font color="red"><b>description</b></font> et <font color="red"><b>température</b></font> peuvent rester vide !</center> <br /> <center><a href="add.php">Retour en arrière.</a></center>';
    }

// All the needed fields are set, we're now entering into the database
else
    {
// Connect to the database
         $servername = "localhost";
         $username = "root";
         $password = "coucou";
         $dbname = "outland";

// Trying to connect
         try {
             $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
             // set the PDO error mode to exception
             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Inserting into the database named "planetes", into the columns : "planete", "image", "description", "temperature" and "km"
// The values below : "$planet", "$img", "$desc", "$temp", "$km"
             $sql = "INSERT INTO planetes (planete, image, description, temperature, km)
             VALUES ('$planet', '$img', '$desc', '$temp', '$km')";
             // use exec() because no results are returned
             $conn->exec($sql);
// header is used to take the user to a new page, here, to success.html
             header('Location: success.html');
             }

// If there's any error, use the catch part below
         catch(PDOException $e)
             {
             echo $sql . "<br>" . $e->getMessage();
             }
// Exit the database
         $conn = null;
       }
         ?>
