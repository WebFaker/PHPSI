<?php
// Require the file connexion.php to connect to the database
require_once "connexion.php";
// Updating the values below from the "planetes" table where there's the needed id
$sql = "UPDATE
  `planetes`
  SET
  `planete` = :planete,
  `image`= :image,
  `description`= :description,
  `temperature`= :temperature,
  `km`= :km
  WHERE
  `id` = :id
;";

// Preparing the update session
$stmt = $conn->prepare($sql);
// Taking and binding all the values
$stmt->bindValue(':id', $_POST['id']);
$stmt->bindValue(':planete', $_POST['planete']);
$stmt->bindValue(':image', $_POST['image']);
$stmt->bindValue(':description', $_POST['description']);
$stmt->bindValue(':temperature', $_POST['temperature']);
$stmt->bindValue(':km', $_POST['km']);
$stmt->execute();
// If there's an error, execute the code below
if ($stmt->errorCode() !== '00000') {
    var_dump($stmt->errorInfo());
}
//redirecting to the display page (index.php in our case)
header("Location: index.php");
