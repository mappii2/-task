<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>日報作成</title>
<link rel="stylesheet" type="text/css" href="./css/report.css">
</head>
<body>

  <div id = "header">
    <h1>日報フォーム</h1>
  </div>

  <div id="wrapper">

    <div id="comment">
      <p>今日も1日お疲れ様でした。日報の記入をお願いします！</p>
    </div>

    <form action="reportCom.php" method="post">
      <table>
        <tr>
          <th>社員No.(ID)</th>
          <td><input type="number" name="emp_id" required></td>
        </tr>
        <tr>
          <th>今日の日付</th>
          <td><input type="date" name="day" required></td>
        </tr>
        <tr>
          <th>業務報告</th>
          <td><textarea name="business" rows="5" cols="40"　required></textarea></td>
        </tr>
        <tr>
          <th>反省、伝えたいこと等</th>
          <td><textarea name="comment" rows="5" cols="40"　required></textarea></td>
        </tr>
      </table>

      <input type="submit" value"送信する" class="button">
    </form>

  </div>

  <div id = "footer">
    <a href="emp.php">戻る</a>
    <a href="logout.php?logout">ログアウト</a>
    <a>sample@2020.</a>
  </div>


</body>
</html>
