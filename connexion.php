<?php
//$servername = "localhost";
//$username = "root";
//$password = "coucou";
//$dbname = "outland";
$servername = "localhost";
$username = "root";
$password = "babytchi99";
$dbname = "outland";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
