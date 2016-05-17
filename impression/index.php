<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>感想投稿フォーム</title>
  <link type="text/css" rel="stylesheet" href="style.css">
</head>
    <body>
      <div class="container">
      <h1>感想投稿フォーム</h1>
      <p>名前と感想を入力してね!</p>
      <form action="inquiry.php" method="post" enctype="multipart/form-data">
          名前:<br><input type="text" name="name"><br>
          感想:<br><input type="text" name="impression"><br><br>
          画像: <input type="file" name="upfile"><br>
      <input type="submit" value="感想を投稿">
      </form>
      <p><a href="results.php">投稿内容の確認</a></p>
      </div>
    </body>
</html>