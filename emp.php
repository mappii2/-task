<?php
ini_set('display_errors', 0);
session_start();
include_once 'dbconnect.php';

if( isset($_SESSION['user']) == "") {
// ログイン済みの場合はリダイレクト
header("Location: login.php");
}

// ユーザーIDからユーザー名を取り出す
$query = "SELECT * FROM users join jobs on users.id = jobs.username WHERE users.id=".$_SESSION['user']."";
$result = $mysqli->query($query);

if (!$result) {
  print('クエリーが失敗しました。' . $mysqli->error);
  $mysqli->close();
  exit();
}

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $id = $row['id'];
  $name = $row['name'];
  $mail = $row['mail'];
  $role = $row['role'];
  $work = $row['work'];
  $comment = $row['comment'];
}

// データベースの切断
$result->close();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<?php if($role != '従業員'):?>
<title>管理者</title>
<?php else:?>
<title>従業員</title>
<?php endif; ?>

<link rel="stylesheet" type="text/css" href="./css/emp.css">
<link rel="stylesheet" type="text/css" href="./css/admin.css">
</head>
<body>

  <div id = "header">
    <?php if($role != '従業員'):?>
    <h1>管理者画面</h1>
    <?php else:?>
    <h1>従業員画面</h1>
    <?php endif; ?>
  </div>
  <!-- headr -->
<?php if($role != '従業員'):?>
  <div id="wrapper">
    <a href="management.php"><span class="span_box">業務管理</span></a>
    <p class="line"></p>
    <a href="empList.php"><span class="span_box">従業員一覧</span></a>
    <p class="line"></p>
    <a href="reportList.php"><span class="span_box">日報管理</span></a>
  </div>

  <h1>instagram</h1>

  <div id="twitter">
    <div id="twitter_list">
      <ul class="insta__wrap">
<?php
    $insta_media_limit = '9';
    $insta_business_id = '17841444277522606';
    $insta_access_token = 'EAAiJAEmDmsABABe9fqqjYJatUGZCK1hPmdSzcZBZCtkJPVJ3hj1Lko43nK4WDqX9GLEurgaRbYfrZCLi5cYoNNGoaQmeWZA0aZAlJakAw1kuwoOb4l4fp7P6UKsRlW23tHmD1BtTeW4PRJbZAZAAhQgqM0vlnJcrIZB6VoT5ZBWluCM8BNKexQh1OTemfOcfvWBhoZD';

    $json = file_get_contents("https://graph.facebook.com/v6.0/{$insta_business_id}?fields=name%2Cmedia.limit({$insta_media_limit})%7Bcaption%2Cmedia_url%2Cthumbnail_url%2Cpermalink%7D&access_token={$insta_access_token}");

    $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $obj = json_decode($json, true);

    $insta = [];

    foreach ($obj['media']['data'] as $k => $v) {
        if ($v['thumbnail_url']) {
            $data = [
                'img' => $v['thumbnail_url'], // 投稿が動画だったらサムネURLを入れてます
                'caption' => $v['caption'],
                'link' => $v['permalink'],
            ];
        } else {
            $data = [
                'img' => $v['media_url'],
                'caption' => $v['caption'],
                'link' => $v['permalink'],
            ];
        }
        $insta[] = $data;
    }
    foreach ($insta as $k => $v){
        // ひとます最低限、画像だけ出してます
        echo '<li class="insta__item"><img src="'.$v['img'].'"></li>';
    }
?>
</ul>
  </div>
  </div>
<?php endif; ?>
<?php if($role == '従業員'):?>
  <div id="wrapper1">
    <div class="comment">
      <p><?php echo $name; ?> さん</p>
      <p>おはようございます！本日の業務を確認しましょう！</p>
    </div>
    <!-- comment -->

    <div class="line1">

    </div>
    <!-- line -->

    <table>
      <tr>
        <th>本日の業務</th>
        <td><p><?php echo $work;?></p></td>
      </tr>
      <tr>
        <th>コメント</th>
        <td><p><?php echo $comment;?></p></td>
      </tr>
    </table>

    <div class="line1">

    </div>
    <!-- line -->

    <div class="comment">
      <p>今日も1日頑張りましょう！</p>
    </div>
    <!-- comment -->
  </div>
  <!-- wrapper -->

  <div id="under_container">
    <div id="underbox">
      <p>業務終了後、日報の提出をお願いします。</p>
      <a href="report.php">日報フォームはこちら←</a>
    </div>
    <div id="twitter_list1">
      <p>企業用instagram</p>
      <ul class="insta__wrap2">
<?php
    $insta_media_limit = '9';
    $insta_business_id = '17841444277522606';
    $insta_access_token = 'EAAiJAEmDmsABABe9fqqjYJatUGZCK1hPmdSzcZBZCtkJPVJ3hj1Lko43nK4WDqX9GLEurgaRbYfrZCLi5cYoNNGoaQmeWZA0aZAlJakAw1kuwoOb4l4fp7P6UKsRlW23tHmD1BtTeW4PRJbZAZAAhQgqM0vlnJcrIZB6VoT5ZBWluCM8BNKexQh1OTemfOcfvWBhoZD';

    $json = file_get_contents("https://graph.facebook.com/v6.0/{$insta_business_id}?fields=name%2Cmedia.limit({$insta_media_limit})%7Bcaption%2Cmedia_url%2Cthumbnail_url%2Cpermalink%7D&access_token={$insta_access_token}");

    $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $obj = json_decode($json, true);

    $insta = [];

    foreach ($obj['media']['data'] as $k => $v) {
        if ($v['thumbnail_url']) {
            $data = [
                'img' => $v['thumbnail_url'], // 投稿が動画だったらサムネURLを入れてます
                'caption' => $v['caption'],
                'link' => $v['permalink'],
            ];
        } else {
            $data = [
                'img' => $v['media_url'],
                'caption' => $v['caption'],
                'link' => $v['permalink'],
            ];
        }
        $insta[] = $data;
    }
    foreach ($insta as $k => $v){
        // ひとます最低限、画像だけ出してます
        echo '<li class="insta__item"><img src="'.$v['img'].'"></li>';
    }
?>
</ul>
    </div>
  </div>
<?php endif; ?>

  <div id = "footer">
    <a href="logout.php?logout">ログアウト</a>
    <a>sample@2020.</a>
  </div>
  <!-- footer -->

</body>
</html>
