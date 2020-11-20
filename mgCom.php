<?php

require_once("config.php");

try {
  // 接続処理
  $dbh = new PDO('mysql:host='.$localhost.'; dbname='.$dbname.'; charset=utf8', "$user", "$password");

      //input_post.phpの値を取得
      $id = $_POST['id'];
      $task = $_POST['task'];
      $comment = $_POST['comment'];


      $sql = "INSERT INTO jobs (id, task, comment) VALUES (:id, :task, :comment)"; // INSERT文を変数に格納。:nameや:categoryはプレースホルダという、値を入れるための単なる空箱
      $stmt = $dbh->prepare($sql); //挿入する値は空のまま、SQL実行の準備をする
      $params = array(':id' => $id, ':task' => $task, ':comment' => $comment); // 挿入する値を配列に格納する
      $stmt->execute($params); //挿入する値が入った変数をexecuteにセットしてSQLを実行


    } catch (PDOException $e) {
    exit('データベースに接続できませんでした。' . $e->getMessage());
    }
    echo $task;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>送信完了</title>
    <link rel="stylesheet" type="text/css" href="./css/empCom.css">
  </head>
  <body>
    <div id = "header">
      <h1>業務登録</h1>
    </div>
      <div id = "wrapper">
        <p class = "comment">内容を送信しました。</p>
      </div>

      <div id = "logout">
        <a href="emp.php">管理者画面へ</a>
        <p><a href="logout.php">ログアウト</a></p>
      </div>
  </body>
</html>
