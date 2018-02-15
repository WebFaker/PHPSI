<?php
require_once "connexion.php";
$sql = "UPDATE
  `planetes`
  SET
  `planete` = :planete,
  `image`= :image,
  `description`= :description,
  `temperature`= :temperature,
  `prix`= :prix
  WHERE
  `id` = :id
;";

//$sql = "UPDATE planetes SET planete=$_POST['planete'], image=$_POST['image'], description=$_POST['description'], temperature=$_POST['temperature'], prix=$_POST['prix'] WHERE id=$_POST['id'];";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $_POST['id']);
$stmt->bindValue(':planete', $_POST['planete']);
$stmt->bindValue(':image', $_POST['image']);
$stmt->bindValue(':description', $_POST['description']);
$stmt->bindValue(':temperature', $_POST['temperature']);
$stmt->bindValue(':prix', $_POST['prix']);
$stmt->execute();
if ($stmt->errorCode() !== '00000') {
    var_dump($stmt->errorInfo());
}
//redirecting to the display page (index.php in our case)
header("Location: index.php");
