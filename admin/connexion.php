<?php
//This file is used to connect into the SQL

//$servername = "localhost";
//$username = "root";
//$password = "coucou";
//$dbname = "outland";
$servername = "localhost";
$username = "root";
$password = "coucou";
$dbname = "outland";

//Connecting to the database using PDO
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);

//If there's an error, use catch option
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
