<?php
require_once('config.php');
require_once("functions.php");
session_start();

if($_SERVER["REQUEST_METHOD"] =="POST")
{
  $name = $_POST['name'];
  $password= $_POST['password'];
  $errors = array();

  //バリデーション
  if ($name ==""){
  $errors["name"]="ユーザーネームが未入力です";
  }
  if ($password ==""){
  $errors["password"]="パスワードが未入力です";
  }
//  echo password_hash($password,PASSWORD_DEFAULT);

  //バリデーション突破後
  if(empty($errors)){
  $dbh = connectDatabase();
  $sql = "select name from users where name = :name;";
  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(":name", $name);
  $stmt->execute();
  $row = $stmt->rowCount();
  if (!empty($row)){
    $overlap = "既に登録されているユーザーネームなので変更してください";
  }
  if(empty($row)){
    $password = password_hash($password,PASSWORD_DEFAULT);
    $dbh = connectDatabase();
    $sql = "insert into users (name,password,created_at) values
            (:name,:password,now());";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    header("Location: login.php");
    exit;
    }
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>新規登録画面</title>
</head>
<body>
  <h1>新規登録画面です!</h1>
    <?php if($overlap): ?>
      <?php echo $overlap?>
    <?php endif;?>

  <form action="" method="post">
    ユーザーネーム:
        <?php if($errors["name"]):?>
      <?php echo h($errors["name"]) ?>
    <?php endif ; ?>
    <br>
    <input type="text" name="name"><br>
    パスワード:
    <?php if($errors["password"]): ?>
      <?php echo h($errors["password"]) ?>
    <?php endif ; ?>
    <br><input type="password" name="password"><br>
    <input type="submit" value="新規登録">
  </form>
  <a href="login.php">ログインはこちら</a>
</body>
</html>