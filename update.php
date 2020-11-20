<?php
require_once("config.php");
try {
  // 接続処理
  $dbh = new PDO('mysql:host='.$localhost.'; dbname='.$dbname.'; charset=utf8', "$user", "$password");

  // 編集処理
  $sql =
  "UPDATE users
  SET id = :id, name = :name, huri = :huri, tel = :tel, mail = :mail, password = :password, role = :role
  WHERE id = :id";
  $stmt = $dbh->prepare($sql);

  $password = $_POST['password'];
  $password = password_hash($password, PASSWORD_DEFAULT);

  $params = array(
    ':id'=>$_POST['id'],
    ':name'=>$_POST['name'],
    ':huri'=>$_POST['huri'],
    ':tel'=>$_POST['tel'],
    ':mail'=>$_POST['mail'],
    ':password'=>$password,
    ':role'=>$_POST['role']
  );
  $stmt->execute($params);
  // echo '<p class = "comment">リストを更新しました。</p>';

} catch (Exception $e) {
          echo 'エラーが発生しました。:' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>更新完了</title>
    <link rel="stylesheet" type="text/css" href="./css/delete.css">

  </head>
  <body>
    <div id = "header">
      <h1>従業員一覧</h1>
    </div>
  <div id = "wrapper">
    <p class = "comment">リストを更新しました。</p>
    <p>
      <a href="empList.php">従業員リストへ</a>
    </p>
  </div>
  </body>
</html>
