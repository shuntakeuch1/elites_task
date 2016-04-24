<?php

//mb_language("japanese");
//mb_internal_encoding("EUC-JP");
$name = $_POST['name'];
$impression = $_POST['impression'];
$subject = $_POST['subject'];
$mail = $_POST['mail'];
//$from = "takeuchishun89@gmail.com";
//$from = mb_encode_mimeheader(mb_convert_encoding("武内 駿","JIS","EUC-JP"))."<takeuchishun89@gmail.com>";
mb_send_mail($mail,$subject,$impression);
//var_dump($mail,$subject,$impression);

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
   <meta charset="UTF-8">
   <title>サンキューページ</title>
      <link type="text/css" rel="stylesheet" href="style.css"/>
  </head>
  <body>
    <div class="container">
    <h1>ありがとうございました</h1>
    <p>以下の内容でメールが送信されました</p>
    <p>名前: <?php echo htmlspecialchars($name,ENT_QUOTES,"UTF-8") ?></p>
    <p>件名: <?php echo htmlspecialchars($subject,ENT_QUOTES,"UTF-8") ?></p>
    <p>メール: <?php echo htmlspecialchars($mail,ENT_QUOTES,"UTF-8") ?></p>
    <p>本文: <?php echo htmlspecialchars($impression,ENT_QUOTES,"UTF-8") ?></p>

<a href="index.php">戻る</a>
  </div>
  </body>
</html>
