<?php
session_start();
// if( isset($_SESSION['user']) != "") {
// // ログイン済みの場合はリダイレクト
// header("Location: emp.php");
// } else {
//   header("Location: login.php");
// }
// DBとの接続
include_once 'dbconnect.php';

// signupがPOSTされたときに下記を実行
if(isset($_POST['signup'])) {

  $name = $mysqli->real_escape_string($_POST['name']);
  $huri = $mysqli->real_escape_string($_POST['huri']);
  $tel = $mysqli->real_escape_string($_POST['tel']);
  $mail = $mysqli->real_escape_string($_POST['mail']);
  $password = $mysqli->real_escape_string($_POST['password']);
  $password = password_hash($password, PASSWORD_DEFAULT);
  $role = $mysqli->real_escape_string($_POST['role']);

  // POSTされた情報をDBに格納する
  $query = "INSERT INTO users(name, huri, tel, mail, password, role) VALUES('$name','$huri','$tel','$mail','$password','$role')";

  if($mysqli->query($query)) {  ?>
    <div class="alert alert-success" role="alert">登録しました</div>
    <?php } else { ?>
    <div class="alert alert-danger" role="alert">エラーが発生しました。</div>
    <?php
  }
}
 ?>

 <!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>従業員登録</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" type="text/css" href="./css/report.css">

<!-- Bootstrap読み込み（スタイリングのため） -->

</head>
<body>
<div id="header">
  <h1>登録フォーム</h1>
</div>
<div id="wrapper">

<form method="post">

  <table>
    <tr>
      <th>名前</th>
      <td><input type="text" class="form-control" name="name" required /></td>
    </tr>
    <tr>
      <th>フリガナ</th>
      <td><input type="text" class="form-control" name="huri" required></td>
    </tr>
    <tr>
      <th>電話番号</th>
      <td><input type="tel" class="form-control" name="tel" required></td>
    </tr>
    <tr>
      <th>メールアドレス</th>
      <td><input type="email"  class="form-control" name="mail" required /></td>
    </tr>
    <tr>
      <th>パスワード</th>
      <td><input type="password" class="form-control" name="password" required /></td>
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
  <button type="submit" class="button" name="signup">登録する</button>
</form>

  <a href="login.php">ログインはこちら</a>

</div>

<div id = "footer">
  <a href="logout.php?logout">ログアウト</a>
  <a>sample@2020.</a>
</div>
</body>
</html>
