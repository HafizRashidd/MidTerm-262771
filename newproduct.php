<?php
// session_start();
include_once("dbconnect.php");

$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
$prname = $_POST['prname'];
$prtype = $_POST['prtype'];
$prprice = $_POST['prprice'];
$prqty = $_POST['prqty'];
$datecreated = $_POST['datecreated'];

try {
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO tbl_products (image, prname, prtype, prprice, prqty, datecreated)
  VALUES ('$image','$prname','$prtype','$prprice','$prqty','$datecreated')";
  $conn->exec($sql);
  echo "<script> alert('New record created successfully')</script>";
  echo "<script> window.location.replace('index.php') </script>;";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  echo "<script> window.location.replace('newproduct.html') </script>;";
}

$conn = null;

?>