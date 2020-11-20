<?php

require_once("config.php");

try {
  // 接続処理
  $dbh = new PDO('mysql:host='.$localhost.'; dbname='.$dbname.'; charset=utf8', "$user", "$password");


  $stmt = $dbh->prepare('SELECT * FROM users WHERE id = :id');
  $stmt->execute(array(':id' => $_GET["id"]));
  $result = 0;
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (Exception $e) {
          echo 'エラーが発生しました。:' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>従業員編集</title>
<link rel="stylesheet" type="text/css" href="./css/report.css">
</head>
<body>

  <div id = "header">
    <h1>従業員編集</h1>
  </div>

  <div id="wrapper">
    <form action="update.php" method="post">
      <input type="hidden" name="id" value="<?php if (!empty($result['id'])) echo htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8');?>">
      <table>
        <tr>
          <th>名前</th>
          <td><input type="text" name="name" id="name" value="<?php if (!empty($result['name'])) echo(htmlspecialchars($result['name'], ENT_QUOTES, 'UTF-8'));?>" required></td>
        </tr>
        <tr>
          <th>フリガナ</th>
          <td><input type="text" name="huri" id="huri" value="<?php if (!empty($result['huri'])) echo(htmlspecialchars($result['huri'], ENT_QUOTES, 'UTF-8'));?>" required></td>
        </tr>
        <tr>
          <th>電話番号</th>
          <td><input type="tel" name="tel" id="tel" value="<?php if (!empty($result['tel'])) echo(htmlspecialchars($result['tel'], ENT_QUOTES, 'UTF-8'));?>" required><br></td>
        </tr>
        <tr>
          <th>メールアドレス</th>
          <td><input type="email" name="mail" id="mail" value="<?php if (!empty($result['mail'])) echo(htmlspecialchars($result['mail'], ENT_QUOTES, 'UTF-8'));?>" required></td>
        </tr>
        <tr>
          <th>パスワード</th>
          <td><input type="password" name="password" id="password" required></td>
        </tr>
        <tr>
          <th>ユーザ情報</th>
          <td>
            <select name="role">
              <option value="管理者">管理者</option>
              <option value="従業員">従業員</option>
              </select>
          </td>
        </tr>
      </table>
        <input type="submit" value="更新" class="btn-submit">
    </form>
  </div>





  <div id = "footer">
    <a href="logout.php?logout">ログアウト</a>
    <a>sample@2020.</a>
  </div>


</body>
</html>
