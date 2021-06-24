<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>WEB</h1>
    <ol>
      <li><a href="test.php?id=HTML">HTML</a></li>
      <li><a href="test.php?id=CSS">CSS</a></li>
      <li><a href="test.php?id=JavaScrit">JavaScript</a></li>
    </ol>
    <h2>
      <?php
        echo $_GET['id'];
      ?>
    </h2>
      <?php
        echo file_get_contents("data/".$_GET['id']);
      ?>
  </body>
</html>