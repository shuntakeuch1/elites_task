<?php
require_once("config.php");
require_once("functions.php");

session_start();
$id = $_SESSION['id'];


$dbh =connectDatabase();
$sql="select * from users where id = :id";
$stmt =$dbh->prepare($sql);
$stmt->bindParam(":id",$id);
$stmt->execute();
$row = $stmt->fetch();

$row = $row["profile"];

if( !isset($row)){
  echo "No Image!" ;
}else{
header('Context-type:image/jpeg');
echo $row;
}

?>