<!DOCTYPE html>
<html lang="ja">
  <head>
  <meta charset="utf-8">
  <title>deleteLibrary</title>
  </head>
  <body>
  <p>削除完了</p><br>
  <table border=1>
    <tr>
    <th>ID</th>
    <th>Title</th>
    <th>Artist</th>
    </tr>
<?php
try{
    $pdo = new PDO(
        'mysql:host=127.0.0.1;dbname=musicdb;charset=utf8',
        'root',
        '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
    $id=htmlspecialchars($_POST["id"], ENT_QUOTES, "UTF-8");
    $prepare = $pdo->prepare('SELECT * FROM musics WHERE id = ?');
  $prepare->bindValue(1,(int)$id,PDO::PARAM_INT);//パラメータID,バインドする値,型指定 バインドする
  $prepare->execute();

  while($result = $prepare->fetch()){
    echo "<tr>\n";
    echo "<td>".$result['id']."</td>\n";
    echo "<td>".$result['title']."</td>\n";
    echo "<td>".$result['artist']."</td>\n";
    echo "</tr>\n";
  }

  unset($pdo);

  $pdo = new PDO(
    'mysql:host=127.0.0.1;dbname=musicdb;charset=utf8',
    'root',
    '',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
);

$prepare=$pdo->prepare('DELETE FROM
musics WHERE id=?');
$prepare->bindValue(1,(int)$id,PDO::PARAM_INT);//パラメータID,バインドする値,型指定 バインドする
$prepare->execute();

  }catch(PDOException $e){
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage()); 
}
?>
</table>
    <form
   action="index.html"
   method="post">
	<input type="submit" value="戻る" align="left" style="width:300px;">
</form>
  </body>
</html>
