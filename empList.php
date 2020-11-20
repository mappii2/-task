<?php
require_once("config.php");
try {
  //接続処理
  $dbh = new PDO('mysql:host='.$localhost.'; dbname='.$dbname.'; charset=utf8', "$user", "$password");

    $stmt = $dbh->query('SELECT * FROM users');
    $result = 0;
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
          echo 'エラーが発生しました。:' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>従業員一覧</title>
<link rel="stylesheet" type="text/css" href="./css/empList.css">
</head>
<body>

  <div id = "header">
    <h1>従業員一覧</h1>
  </div>
  <!-- header -->


  <div id="wrapper">

    <table>
      <tr>
        <th>id</th>
        <th>名前</th>
        <th>フリガナ</th>
        <th>電話番号</th>
        <th>メールアドレス</th>
        <th>ユーザ</th>
        <th></th>
        <th></th>

      </tr>
      <?php foreach ($result as $row): ?>
      <tr>
        <td><?=$row['id']?></td>
        <td><?=htmlspecialchars($row["name"], ENT_QUOTES, 'UTF-8')?></td>
        <td><?=htmlspecialchars($row["huri"], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?=htmlspecialchars($row["tel"], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?=htmlspecialchars($row["mail"], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?=htmlspecialchars($row["role"], ENT_QUOTES, 'UTF-8') ?></td>
        <td><a href=edit.php?id=<?=$row["id"]?>>編集</a></td>
        <?php if($row["role"] != '管理者'):?>
        <td><a href=delete.php?id=<?=$row["id"]?> onClick="if(!confirm('ID:<?=$row["id"]?>を削除しますがよろしいですか？')) return false;">削除</a></td>
        <?php else:?>
        <td></td>
        <?php endif; ?>
      </tr>
      <?php endforeach ?>
    </table>
  </div>
  <!-- wrapper -->


  <div id = "footer">
    <a href="emp.php">管理者画面へ</a>
    <a href="logout.php?logout">ログアウト</a>
    <a>sample@2020.</a>
  </div>
  <!-- footer -->


</body>
</html>
