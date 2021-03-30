<?php
  session_start();
  $mode = 'input';
  $errormessage = array();
  if( isset($_POST['back']) && $_POST['back'] ){
    //戻る
  } else if( isset($_POST['confirm']) && $_POST['confirm'] ){
    //確認画面
    if( !$_POST['fullname'] ){
      $errormessage[] = "名前を入力してください";
    } else if( mb_strlen($_POST['fullname']) > 50 ){
      $errormessage[] = "名前は50文字以内にしてください";
    }
    $_SESSION['fullname'] = htmlspecialchars($_POST['fullname'], ENT_QUOTES);

    if( !$_POST['email'] ){
      $errormessage[] = "Eメールを入力してください";
    } else if( mb_strlen($_POST['email']) > 50 ){
      $errormessage[] = "Eメールは50文字以内にしてください";
    } else if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
      $errormessage[] = "メールアドレスが不正です";
    }
    $_SESSION['email'] = htmlspecialchars($_POST['email'], ENT_QUOTES);

    if( !$_POST['message'] ){
      $errormessage[] = "メッセージを入力してください";
    } else if( mb_strlen($_POST['message']) > 50 ){
      $errormessage[] = "お問い合わせ内容は500文字以内にしてください";
    }
    $_SESSION['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES);

    $_SESSION['prifecture'] = $_POST['prifecture'];
    if ( $errormessage ){
      $mode = 'input';
    } else {
      $mode = 'confirm';
    }
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
      <?php 
        if( $errormessage ){
          echo '<div style="color:red;">';
          echo implode('<br>', $errormessage );
          echo '</div>';
        }
      ?>

      <div class="bottom-content">
        <form action="./contactform.php" method="post" class="contact-form">
          <h2 class="heading-name">お問い合わせ</h2>
          <p>お名前</p>
          <input type="text" placeholder="名前" name="fullname" value="<?php echo $_SESSION['fullname'] ?>" class="small-field">
          <p>連絡先</p>
          <input type="e-mail" placeholder="メールアドレス" name="email" value="<?php echo $_SESSION['email'] ?>" class="small-field">
          <input type="text" placeholder="電話番号" name="tel" value="<?php echo $_SESSION['tel'] ?>" class="small-field">
          <p>お問い合わせ内容</p>
          <textarea placeholder="内容"  rows="10" name="message" class="large-field"><?php echo $_SESSION['message'] ?></textarea>
          <p>ご希望の返答期間</p>
          <select name=prifecture size=”3″ value="<?php echo $_SETTION['prifecture'] ?>">
            <option value=”″>--</option>
            <option value=”お急ぎ″>お急ぎ</option>
            <option value=”今週中″>3~5営業日後</option>
          </select><br>
            ※当日中にご確認して頂きたい場合は、お手数ですがお電話をお願い致します。xxx-xxx-xxxx
          <p>ご希望の返信方法</p>
          <input type="radio" name="contact" value="電話" />電話
          <input type="radio" name="contact" value="メール" />メール
          <p>興味がある分野</p>
          <input type="checkbox" name="interested[]" value="A" />A
          <input type="checkbox" name="interested[]" value="B" />B
          <input type="checkbox" name="interested[]" value="C" />C
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