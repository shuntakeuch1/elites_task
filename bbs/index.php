<?php

require_once("config.php");
require_once("functions.php");

session_start();
//idを持っていなかったらlogin.phpへ
if(empty($_SESSION["id"]))
{
  header("Location: login.php");
  exit;
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
  $name =$_SESSION["name"];
  $message =$_POST["message"];

  //エラーメッセージを入れる配列
  $errors =array();

  //バリデーション
  if($message == "")
  {
    $errors["message"]= "メッセージが未入力です";
  }

  //バリテーション突破後
  if (empty($errors))
  {
    $dbh = connectDatabase();
    $sql = "insert into posts (name,message,created_at,updated_at) values
            (:name,:message,now(),now())";
    $stmt= $dbh->prepare($sql);
    $stmt->bindParam(":name",$name);
    $stmt->bindParam(":message",$message);
    $stmt->execute();

    //ログイン画面へ飛ばす
    header("Location:index.php");
    exit;
  }
}
$id = $_SESSION["id"];
$dbh= connectDatabase();
$sql = "select * from users where id = (:id)";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(":id",$id);
$stmt->execute();
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $row['0']['a_counta'];
$user_id = $row['0']['id'];

$dbh= connectDatabase();
$sql = "select * from posts order by updated_at desc";
$stmt= $dbh->prepare($sql);
$stmt->execute();

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
  <lang="ja">
  <meta charset="utf-8">
  <title>会員制掲示板</title>
  <link type="text/css" rel="stylesheet" href="style.css">
</head>

<body>
    <h1>
      <?php echo h($_SESSION["name"]);?>さん 会員制掲示板へようこそ!
    </h1>
    <p>あなたは<?php echo h($count) ;?>回目のログインです</p>
<?php if (is_null($row['0']['profile'])):?>
  <img src="images/profile.jpeg" alt="dummy">
<?php else : ?>
  <img src="images.php?id=<?php echo h($id) ?>">
<?php endif; ?>
    <p>
      <a href="logout.php">[ログアウト]</a>
      <a href="profile.php?=<?php echo h($user_id) ?>">[画像の変更]</a>
    </p>
    <p>一言どうぞ!</p>
    <form action="" method="post">
      <textarea name="message" cols="30" rows="5"></textarea>
      <?php if($errors["message"]): ?>
        <?php echo h($errors["message"]) ?>
      <?php endif ;?>
      <input type="submit" value="投稿する">
        </form>
        <hr>
        <h1>投稿されたメッセージ</h1>
        <?php if(count($posts)) :?>
          <?php foreach($posts as $post):?>
           <li style="list-style-type:none">
             [#<?php echo h($post["id"])?>]
             @<?php echo h($post["name"]) ?><br>
             <?php echo h($post["message"]) ?><br>
             <a href="edit.php?id=<?php echo h($post["id"]) ?>">[編集]</a>
             <a href="delete.php?id=<?php echo h($post["id"]) ?>">[削除]</a>
             <?php echo h($post["updated_at"])?>
             <hr>
           </li>
          <?php endforeach ; ?>
        <?php else: ?>
          投稿されたメッセージはありません
        <?php endif;?>
</body>
</html>