<?php

require_once("config.php");

try {
  // 接続処理
  $dbh = new PDO('mysql:host='.$localhost.'; dbname='.$dbname.'; charset=utf8', "$user", "$password");

  // 削除処理
    $stmt = $dbh->prepare('DELETE FROM users WHERE id = :id');
    $stmt->execute(array(':id' => $_GET["id"]));

} catch (Exception $e) {
          echo 'エラーが発生しました。:' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>削除完了</title>
    <link rel="stylesheet" type="text/css" href="./css/delete.css">
  </head>
  <body>
    <div id = "header">
      <h1>従業員一覧</h1>
    </div>
      <div id = "wrapper">
        <p class = "comment">リストから削除しました。</p>
        <p>
          <a href="empList.php">従業員リストへ</a>
        </p>
      </div>
  </body>
</html>
