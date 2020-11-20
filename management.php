<?php
ini_set('display_errors', 0);
require_once("config.php");
try {
  //接続処理
  $dbh = new PDO('mysql:host='.$localhost.'; dbname='.$dbname.'; charset=utf8', "$user", "$password");

    $stmt = $dbh->query('SELECT * FROM users');
    $result = 0;
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST)) {

      $id = $_POST['id'];
      $user_id = $_POST['username'];
      $work = $_POST['work'];
      $comment = $_POST['comment'];


      $sql = "INSERT INTO jobs (id, username, work, comment) VALUES (:id, :username, :work, :comment)"; // INSERT文を変数に格納。:nameや:categoryはプレースホルダという、値を入れるための単なる空箱
      $stmt = $dbh->prepare($sql); //挿入する値は空のまま、SQL実行の準備をする
      $params = array(':id' => $id, ':username' => $user_id, ':work' => $work, ':comment' => $comment); // 挿入する値を配列に格納する
      $stmt->execute($params); //挿入する値が入った変数をexecuteにセットしてSQLを実行
      // echo $_POST['id'];
    }
} catch (Exception $e) {
          echo 'エラーが発生しました。:' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>業務管理</title>
<link rel="stylesheet" type="text/css" href="./css/management.css">
</head>
<body>

  <div id = "header">
    <h1>業務管理</h1>
  </div>

  <div id="wrapper">

    <div id="left_container">

<!-- テスト -->
  <form action="management.php" method="post">
    <dl>
      <dt>
        <select name="username">
          <?php foreach ($result as $row): ?>
          <option value="<?=$row['id']?>"><?=$row['id']?> <?=htmlspecialchars($row["name"], ENT_QUOTES, 'UTF-8')?></option>
          <?php endforeach ?>
        </select>
      </dt>
      <dd>
        <textarea name="work" rows="2" cols="20" placeholder="業務内容"></textarea>
        <textarea name="comment" rows="2" cols="20" placeholder="コメント、指示等"></textarea>
        <input type="submit" name="submit" value="登録" onClick="if(!confirm('登録してもよろしいですか？')) return false;">
      </dd>
    </dl>
    <div class="line">
    </div>

  </form>
<!-- テスト -->



        <!-- 下線 -->

    </div>
    <!-- left_c　ontainer -->


    <!-- right_container -->
  </div>


  <div id = "footer">
    <a href="emp.php">管理者画面へ</a>
    <a href="logout.php?logout">ログアウト</a>
    <a>sample@2020.</a>
  </div>


</body>
</html>
