<?php

$servername = "localhost";
$username = "root";
$password = "coucou";
$dbname = "outland";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT planete, image, description FROM planetes");
    $stmt->execute();
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$sql = "SELECT planete,image,description FROM planetes;";
$stmt->execute();
?>
  <table>
    <?php while (false !== $row = $stmt->fetch(PDO::FETCH_ASSOC)) :?>
    <tr>
      <td>
        <?=$row["planete"]?>
      </td>
      <td>
        <?=$row["image"]?>
      </td>
      <td>
        <?=$row["description"]?>
      </td>
    </tr>
    <?php endwhile;?>
  </table>
