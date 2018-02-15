<?php
require_once "connexion.php";
$sql = "DELETE FROM
  `planetes`
WHERE
  `id` = :id
;";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $_POST['id']);
$stmt->execute();
if ($stmt->errorCode() !== '00000') {
    var_dump($stmt->errorInfo());
}
//redirecting to the display page (index.php in our case)
header("Location: index.php");
