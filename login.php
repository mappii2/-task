<?php
ob_start();
session_start();
// if( isset($_SESSION['user']) != "") {
//     header("Location: emp.php");
// }
include_once 'dbconnect.php';


// ログインボタンがクリックされたときに下記を実行
if(isset($_POST['login'])) {

  $mail = $mysqli->real_escape_string($_POST['mail']);
  $password = $mysqli->real_escape_string($_POST['password']);

  // クエリの実行
  $query = "SELECT * FROM users WHERE mail='$mail'";
  $result = $mysqli->query($query);
  if (!$result) {
    print('クエリーが失敗しました。' . $mysqli->error);
    $mysqli->close();
    exit();
  }

  // パスワード(暗号化済み）とユーザーIDの取り出し
  while ($row = $result->fetch_assoc()) {
    $db_hashed_pwd = $row['password'];
    $id = $row['id'];
    $role = $row['role'];
  }

  // データベースの切断
  $result->close();

  // $rink = "";
  // if($arr['user']['role'] === '管理者'){
  //   $rink = "admin.php";
  // } else {
  //   $rink = "emp.php";
  // }

  // ハッシュ化されたパスワードがマッチするかどうかを確認
  if (password_verify($password, $db_hashed_pwd)) {
    $_SESSION['user'] = $id;
    header("Location: emp.php");
    exit;
  } else { ?>
    <div class="alert alert-danger" role="alert">メールアドレスとパスワードが一致しません。</div>
  <?php }
}
 ?>

 <!DOCTYPE HTML>
 <html lang="ja">
 <head>
 <meta charset="utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>ログイン</title>
 <link rel="stylesheet" type="text/css" href="./css/login.css">

 </head>
 </head>
 <body>
  <div id="header">
    <h1>ログインフォーム</h1>
  </div>

 <div id="wrapper">

 <form method="post">
   <input type="email"  class="form-control" name="mail" placeholder="メールアドレス" required />
   <input type="password" class="form-control" name="password" placeholder="パスワード" required />
   <button type="submit" class="button" name="login">ログインする</button>
   <a href="register.php">会員登録はこちら</a>
 </form>

 </div>

 <div id = "footer">
   <a>sample@2020.</a>
 </div>
 </body>
 </html>
