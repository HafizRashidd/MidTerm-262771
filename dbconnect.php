<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myshopdb";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>

<?php
//connect to database
$link=mysqli_connect("localhost","root","") or die(mysqli_error($link));
mysqli_select_db($link,"myshopdb") or die(mysqli_error($link));

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myshopdb";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>