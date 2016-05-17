<?php
require_once("functions.php");
$dbh =connectDb();
$sql="select * from posts";
$stmt =$dbh->prepare($sql);
$stmt->execute();
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
$row = array_reverse($row);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>投稿内容</title>
  <link type="text/css" rel="stylesheet" href="style.css">

</head>
<body>
  <div class="container">
  <h1>投稿された内容</h1>
    <div class="main">
    <?php if(count($row)):?>
        <?php foreach ($row as $post): ?>
          <li>
          「<?php echo h($post["impression"])  ?>」</li>
              <a>@<?php echo h($post["name"])  ?></a>
              <?php if (is_null($post["image"])):?>
                <p><img src="images/noimages.png"></p>
              <?php else : ?>
                <p><img src="images.php?id=<?php echo h($post["id"]) ?>"></p>
            <?php endif; ?>
        <?php endforeach ;?>
      <?php else:?>
        現在、投稿された感想はありません
      <?php endif;?>
      <p id="back"><a href="index.php">戻る</a></p>
    </div>
  </div>
</body>
</html>