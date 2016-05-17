<?php

require_once("config.php");
require_once("functions.php");
session_start();
$id = $_SESSION['id'];

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $upfile = $_FILES['upfile']['tmp_name'];
    $type = $_FILES['upfile']['type'];
    $upfile = file_get_contents($upfile);

    $dbh = connectDatabase();
    $sql =
    "update users set
    profile = :profile,
    type = :type
    where id = :id";
    $stmt= $dbh->prepare($sql);
    $stmt->bindParam(":profile",$upfile);
    $stmt->bindParam(":type",$type);
    $stmt->bindParam(":id",$id);
    $stmt->execute();
}

$dbh =connectDatabase();
$sql="select * from users where id = :id ";
$stmt =$dbh->prepare($sql);
$stmt->bindParam(":id",$id);
$stmt->execute();
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>画像編集画面</title>
  <link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>

<?php if (is_null($row['0']['profile'])):?>
 <img src="images/profile.jpeg" alt="dummy">
<?php else : ?>
  <img src="images.php?id=<?php echo h($id) ?>">
<?php endif; ?>

<form action="profile.php" method="post" enctype="multipart/form-data">
  <input type="file" name="upfile"><br>
  <input type="submit" value="ファイルを変更">
</form>

<a href="index.php">戻る</a>

</body>
</html>

