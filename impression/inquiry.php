<?php
require_once("functions.php");
if(empty($_POST["name"]) || empty($_POST["impression"])){
  echo "名前か感想が未入力です";
  echo "<a href=index.php>戻る</a>";
  exit;
}




$name = $_POST["name"];
$impression =$_POST["impression"];
$file = $_FILES["upfile"]['tmp_name'];
$type = $_FILES["upfile"]['type'];
if (!isset($file)){
$imgdat = file_get_contents($file);
};
// $fp=fopen($_FILES["upfile"]['tmp_name'],"rb");
// $imgdat = fread($fp,filesize($_FILES["upfile"]["tmp_name"]));
// fclose($fp);
// $imgdat = addslashes($imgdat);
// $imgdat = mb_convert_encoding($imgdat, 'UTF-8', "SJIS,EUC-JP,auto");
// $imgdat = base64_encode($imgdat);
//exit;
// $imgdat = imagecreatefromstring($imgdat);
// header('Content-type: image/jpeg');

// $imgdat = mysql_real_escape_string($imgdat);
//$file2 = $_FILES["upfile"];
//var_dump($file2)."\n";
// var_dump($file);
// exit;
// echo $imgdat;
// exit;

//exit;


$dbh= connectDb();

$sql ="insert into posts (name, impression,created_at,image,mime_type) values
        (:name,:impression,now(),:image,:type)";
$stmt = $dbh->prepare($sql);

$stmt->bindParam(":name",$name);
$stmt->bindParam(":impression",$impression);
$stmt->bindParam(":image",$imgdat);
$stmt->bindParam(":type",$type);
$stmt->execute();
//echo "成功しました";

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>投稿確認画面</title>
  <link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
  <h1>下記の内容が投稿されました</h1>
  <p>名前: <?php echo h($name) ?></p>
  <p>感想: <?php echo h($impression) ?></p>
  <p><a href="index.php">戻る</a></p>
  <p><a href="results.php">投稿内容を確認</a></p>
  </div>
</body>
</html>