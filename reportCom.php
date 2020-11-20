<?php

require_once("config.php");

try {
  // 接続処理
  $dbh = new PDO('mysql:host='.$localhost.'; dbname='.$dbname.'; charset=utf8', "$user", "$password");

      //input_post.phpの値を取得
      $emp_id = $_POST['emp_id'];
      $day = $_POST['day'];
      $business = $_POST['business'];
      $comment = $_POST['comment'];


      $sql = "INSERT INTO report (emp_id, day, business, comment) VALUES (:emp_id, :day, :business, :comment)"; // INSERT文を変数に格納。:nameや:categoryはプレースホルダという、値を入れるための単なる空箱
      $stmt = $dbh->prepare($sql); //挿入する値は空のまま、SQL実行の準備をする
      $params = array(':emp_id' => $emp_id, ':day' => $day, ':business' => $business, ':comment' => $comment); // 挿入する値を配列に格納する
      $stmt->execute($params); //挿入する値が入った変数をexecuteにセットしてSQLを実行


    } catch (PDOException $e) {
    exit('データベースに接続できませんでした。' . $e->getMessage());
    }
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
      <h1>日報フォーム</h1>
    </div>
      <div id = "wrapper">
        <p class = "comment">日報を送信しました。</p>
        <p class = "comment">今日も一日お疲れ様です。</p>
      </div>

      <div id = "logout">
        <p><a href="logout.php">ログアウト</a></p>
        <p>ログアウトして終了してください→</p>
      </div>
  </body>
</html>
