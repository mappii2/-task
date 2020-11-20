<?php
ini_set('display_errors', 0);
// エラー非表示
	if (!isset($_POST['yourname'])  || $_POST['yourname'] === "" ){
		$errors['emp_id'] = "入力されていません。";
	}
// }
	require_once("config.php");

  try {
    //接続処理
    $dbh = new PDO('mysql:host='.$localhost.'; dbname='.$dbname.'; charset=utf8', "$user", "$password");

    // 検索機能
    $statement = $dbh->prepare("SELECT * FROM report WHERE emp_id LIKE (:emp_id) ");

    // 参照機能
    $stmt = $dbh->query('SELECT * FROM report');
    $result = 0;
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($statement){
  		$yourname = $_POST['yourname'];
  		$like_yourname = "%".$yourname."%";
  		//プレースホルダへ実際の値を設定する
  		$statement->bindValue(':emp_id', $like_yourname, PDO::PARAM_STR);

  		if($statement->execute()){
  			//レコード件数取得
  			$row_count = $statement->rowCount();

  			while($row = $statement->fetch()){
  				$rows[] = $row;
  			}
  		}
  			//データベース接続切断
  			$dbh = null;
       }
  } catch (Exception $e) {
            echo 'エラーが発生しました。:' . $e->getMessage();
    }
// }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>日報管理</title>
<link rel="stylesheet" type="text/css" href="./css/reportList.css">
</head>
<body>

  <div id = "header">
    <h1>日報管理</h1>
  </div>

<div id="form">
	<form action="reportList.php" method="post">
		従業員番号を入力：<input type="number" placeholder="0" name="yourname">
	<input type="submit" value="検索する">
	<p>検索結果</p>
	</form>

</div>

  <div id="wrapper">

    <table id ="serch">

      <?php if($row_count != 0): ?>
      <tr>
        <th>従業員番号</th>
        <th>日付</th>
        <th>業務報告</th>
        <th>反省、伝えたいこと等</th>
      </tr>
      <?php foreach($rows as $row): ?>
      <tr>
      	<td><?=htmlspecialchars($row['emp_id'],ENT_QUOTES,'UTF-8')?></td>
        <td><?=htmlspecialchars($row["day"], ENT_QUOTES, 'UTF-8')?></td>
        <td><?=htmlspecialchars($row["business"], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?=htmlspecialchars($row["comment"], ENT_QUOTES, 'UTF-8') ?></td>
      </tr>
      <?php endforeach ?>
      <?php endif ?>
    <table>
    <div class="line">

    </div>
    <table>
      <tr>
        <th>従業員番号</th>
        <th>日付</th>
        <th>業務報告</th>
        <th>反省、伝えたいこと等</th>
      </tr>
      <?php foreach ($result as $row): ?>
      <tr>
        <td><?=$row['emp_id']?></td>
        <td><?=htmlspecialchars($row["day"], ENT_QUOTES, 'UTF-8')?></td>
        <td><?=htmlspecialchars($row["business"], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?=htmlspecialchars($row["comment"], ENT_QUOTES, 'UTF-8') ?></td>
      </tr>
    <?php endforeach ?>
    </table>
  </div>


  <div id = "footer">
    <a href="emp.php">管理者画面へ</a>
    <a href="logout.php?logout">ログアウト</a>
    <a>sample@2020.</a>
  </div>


</body>
</html>
