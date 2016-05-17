<?php
require_once("functions.php");

$id = $_GET['id'];

$dbh =connectDb();
$sql="select * from posts where id = :id";
$stmt =$dbh->prepare($sql);
$stmt->bindParam(":id",$id);
$stmt->execute();
$row = $stmt->fetch();

// $c_type=$row["mime_type"];
$row = $row["image"];

if( !isset($row)){
  echo "No Image!" ;
}else{
header('Context-type:image/jpeg');
echo $row;
}


?>