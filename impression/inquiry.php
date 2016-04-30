<?php
require_once("functions.php");
if(empty($_POST["name"]) || empty($_POST["impression"])){
  echo "名前か感想が未入力です";
  echo "<a href=index.php>戻る</a>";
  exit;
}




$name = $_POST["name"];
$impression =$_POST["impression"];
$file = $_FILES["upfile"]['name'];
//$file2 = $_FILES["upfile"];
//var_dump($file2)."\n";
var_dump($file);
//exit;


$dbh= connectDb();
$sql ="insert into posts (name, impression,created_at,image) values
        (:name,:impression,now(),:image)";
$stmt = $dbh->prepare($sql);

$stmt->bindParam(":name",$name);
$stmt->bindParam(":impression",$impression);
$stmt->bindParam(":image",$file);
$stmt->execute();
//echo "成功しました";

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>投稿確認画面</title>
  <link rel="stylesheet" href="">
</head>
<body>
  <h1>下記の内容が投稿されました</h1>
  <p>名前: <?php echo h($name) ?></p>
  <p>感想: <?php echo h($impression) ?></p>
  <p><a href="index.php">戻る</a></p>
  <p><a href="results.php">投稿内容を確認</a></p>
</body>
</html>