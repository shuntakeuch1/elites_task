<?php


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
      <p>全てを入力してね!</p>
      <form action="inquiry.php" method="post">
      <p class="text">お名前:<br><input type="text" name="name"></p>
      <p class="text">件名:<br><input type="text" name="subject"></p>
      <p class="text">メール:<br><input type="email" name="mail"></p>
      <p>本文:<br><textarea name="impression" cols=60 rows=6></textarea></p>
      <p><input id="bottan" type="submit" value="メールの送信"></p>
      </form>
    </div>
  </body>
</html