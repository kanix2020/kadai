<?php
  session_start();
  $mode = 'input';
  if( isset($_POST['back']) && $_POST['back'] ){
    //戻る
  } else if( isset($_POST['confirm']) && $_POST['confirm'] ){
    $_SESSION['prifecture'] = $_POST['prifecture'];
    $_SESSION['fullname'] = $_POST['fullname'];
    $_SESSION['email']    = $_POST['email'];
    $_SESSION['message']  = $_POST['message'];
    $mode = 'confirm';
  } else if( isset($_POST['send']) && $_POST['send'] ){
    // メール送信
    // $message = "お問い合わせを受け付けました \r\n"
    //          . "県名:" . $_SESSION['prifecture'] . "\r\n"
    //          . "名前:" . $_SESSION['fullname'] . "\r\n"
    //          . "email:" . $_SESSION['email'] . "\r\n"
    //          . "お問い合わせ内容:\r\n"
    //          . preg_replace("/\r\n|\r|\n/", "\r\n", $_SESSION['message']);
    // mail($_SESSION['email'], 'お問い合わせありがとうございます。', $message);
    // mail('test@test.com', 'お問い合わせありがとうございます。', $message);
    $_SESSION = array();
    $mode = 'send';
  } else {
    $_SESSION['prifecture'] = '';
    $_SESSION['fullname'] = '';
    $_SESSION['email']    = '';
    $_SESSION['message']  = '';
  }
?>
<!DOCTYPE html>
<html lang="ja">
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>お問い合わせ</title>
  </head>
  <body>
    <?php if( $mode == 'input'){ ?>
      <!-- 入力画面 -->
      <div class="bottom-content">
        <form action="./contactform.php" method="post" class="contact-form">
          <h2 class="heading-name">お問い合わせ</h2>
          <select name=prifecture size=”3″ value="<?php echo $_SETTION['prifecture'] ?>">
            <option value=”″>--</option>
            <option value=”東京″>東京</option>
            <option value=”沖縄″>沖縄</option>
            <option value=”埼玉″>埼玉</option>
          </select><br>
          <input type="text" placeholder="名前" name="fullname" value="<?php echo $_SESSION['fullname'] ?>" class="small-field">
          <input type="e-mail" placeholder="メールアドレス" name="email" value="<?php echo $_SESSION['email'] ?>" class="small-field">
          <textarea placeholder="お問い合わせ内容"  rows="10" name="message" class="large-field"><?php echo $_SESSION['message'] ?></textarea>
          <input type="submit" name="confirm" value="確認" class="btn" />
        </form>
      </div>
    <?php }else if( $mode == 'confirm' ){ ?>
      <!-- 確認画面 -->  
      <form action="./contactform.php" method="post">
        <div class="check-content">
          県名 <?php echo $_SESSION['prifecture'] ?> <br>
          名前 <?php echo $_SESSION['fullname'] ?> <br>
          Eメール <?php echo $_SESSION['email'] ?> <br>
          お問い合わせ内容 <?php echo nl2br($_SESSION['message']) ?> <br>
        </div>  
        <input type="submit" name="send" value="SEND" class="btn" />
        <input type="submit" name="back" value="戻る" class="btn">
      </form>
    <?php } else { ?>
        <!-- 完了画面 -->
        <p class="send-ok">送信しました。お問い合わせありがとうございました。</p>
        <button type=“button” onclick="location.href='./contactform.php'" class="btn">戻る</button>
    <?php } ?>
  </body>
</html>