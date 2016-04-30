<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>感想投稿フォーム</title>
  <link rel="stylesheet" href="">
</head>
<body>
  <h1>感想投稿フォーム</h1>
  <p>名前と感想を入力してね!</p>
  <form action="inquiry.php" method="post" enctype="multipart/form-data">
      名前:<br><input type="text" name="name"><br>
      感想:<br><input type="text" name="impression"><br>
      画像:<br><input type="file" name="upfile"><br>
  <input type="submit" value="感想を投稿">
  </form>
  <p><a href="results.php">投稿内容の確認</a></p>
</body>
</html>