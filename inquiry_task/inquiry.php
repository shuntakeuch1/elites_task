<?php
function h($s){
  if($s !=""){
  return htmlspecialchars($s, ENT_QUOTES,"UTF-8");
  }else{
    return "<span style=color:#F33>※未入力です。</span>";
  }
}
$name = $_POST['name'];
$impression = $_POST['impression'];
$subject = $_POST['subject'];
$mail = $_POST['mail'];

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
   <meta charset="UTF-8">
   <title>感想投稿フォーム</title>
      <link type="text/css" rel="stylesheet" href="style.css"/>
  </head>
  <body>
    <div class="container">

    <h1>お問い合わせフォーム</h1>
    <p>以下の内容でよろしいでしょうか?</p>
    <p>名前: <?php echo h($name) ?></p>
    <p>件名: <?php echo h($subject) ?></p>
    <p>メール: <?php echo h($mail) ?></p>
    <p>本文: <?php echo h($impression) ?></p>
    <form action="thankyou.php" method="post">
        <input type="hidden" name="name" value="<?php echo h($name) ?>">
        <input type="hidden" name="subject" value="<?php echo h($subject) ?>">
        <input type="hidden" name="mail" value="<?php echo h($mail) ?>">
        <input type="hidden" name="impression" value="<?php echo h($impression) ?>">
<?php if($name != "" && $impression != "" && $subject != "" && $mail !=""):?>
        <input type="submit" value="この内容で送信">
      <?php endif ;?>
    </form>
    <a href="index.php">戻る</a>
  </div>
  </body>
</html