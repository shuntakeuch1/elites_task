<?php
session_start();
//idを持っていたら

require_once("config.php");
require_once("functions.php");

if(!empty($_SESSION["id"]))
{

  header("Location: index.php");
  exit;
}


if($_SERVER["REQUEST_METHOD"]=="POST")
{
  $name =$_POST["name"];
  $email =$_POST["email"];
  //エラーメッセージを入れる配列
  $errors =array();

  //バリデーション
  if($name == "")
  {
    $errors["name"]= "ユーザーネームが未入力です";
  }

  if($email == "")
  {
    $errors["email"] = "メールアドレスが未入力です";
  }
  //バリテーション突破後
  if(empty($errors))
  {
    $dbh = connectDatabase();
    $sql = "select * from users where name = :name and email = :email";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":name",$name);
    $stmt->bindParam(":email",$email);
    $stmt->execute();

    $row = $stmt->fetch();
    //var_dump($row);

    if($row)
    {
      $_SESSION["id"] =$row["id"];
      $_SESSION["name"] = $row["name"];

        $dbh = connectDatabase();
      $sql = "select a_counta from users where id = (:id)";
      $stmt= $dbh->prepare($sql);
      $stmt->bindParam(":id",$_SESSION["id"]);
      $stmt->execute();

      $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $row = $row[0]["a_counta"];
      $cnt = (integer)$row;
      $cnt++;

      $dbh = connectDatabase();
      $sql = "update users set a_counta = (:cnt) where id = (:id)";
      $stmt= $dbh->prepare($sql);
      $stmt->bindParam(":cnt",$cnt);
      $stmt->bindParam(":id",$_SESSION["id"]);
      $stmt->execute();

      header("Location: index.php");
      exit;
    }
    else
    {
      echo "ユーザーネームかメールアドレスが間違っています";
    }
  }
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>ログイン画面</title>
</head>
<body>
<h1>ログイン</h1>
    <form action="" method="post">
      <p>
      ユーザーネーム:<input type="text" name="name">
      <?php if($errors["name"]): ?>
        <?php echo h($errors["name"]) ?>
      <?php endif ;?>
      </p>
      <p>メールアドレス:<input type="text" name="email">
      <?php if($errors["email"]) : ?>
        <?php echo h($errors["email"])  ?>
      <?php endif;  ?>
      </p>
      <input type="submit" value="ログイン">
    </form>
    <a href="signup.php">新規登録はこちら</a>
</body>
</html>