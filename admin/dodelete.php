<?php
// Require the file connexion.php to connect to the database
require_once "connexion.php";
// DELETE FROM is used to delete a data from a database, here : "planetes", where the needed id is located
$sql = "DELETE FROM
  `planetes`
WHERE
  `id` = :id
;";
$stmt = $conn->prepare($sql);
// Bind the value $_POST['id'] for :id
$stmt->bindValue(':id', $_POST['id']);
$stmt->execute();
// If there's an error, execute the code below
if ($stmt->errorCode() !== '00000') {
    var_dump($stmt->errorInfo());
}
// Redirecting to the display page (index.php in our case)
header("Location: index.php");
