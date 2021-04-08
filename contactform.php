<?php
  session_start();
  $mode = 'input';
  //バリデーション
  $errormessage = array();
  ・・コメント
  if( isset($_POST['back']) && $_POST['back'] ){
    //戻る
  } else if( isset($_POST['confirm']) && $_POST['confirm'] ){
    //エラーメッセージ内容（「error_form.php」呼び出し）
    require 'error_form.php';

    //エラーメッセージ表示
   if ( $errormessage ){
      $mode = 'input';
    } else {
      $mode = 'confirm';
    }
  } else if( isset($_POST['send']) && $_POST['send'] ){
    // メール送信
    // $message = "お問い合わせを受け付けました \r\n"
    //          . "名前:" . $_SESSION['fullname'] . "\r\n"
    //          . "メール:" . $_SESSION['email'] . "\r\n"
    //          . "電話番号:" . $_SESSION['phone'] . "\r\n"
    //          . "返信方法:" . $_SESSION['henshin'] . "\r\n"
    //          . "返答期間:" . $_SESSION['response'] . "\r\n"
    //          . "お問い合わせ内容:\r\n"
    //          . preg_replace("/\r\n|\r|\n/", "\r\n", $_SESSION['message']);
    // mail($_SESSION['email'], 'お問い合わせありがとうございます。', $message);
    // mail('test@test.com', 'お問い合わせありがとうございます。', $message);
    $_SESSION = array();
    $mode = 'send';
  } else {
    $_SESSION['fullname'] = '';
    $_SESSION['email']    = '';
    $_SESSION['phone']    = '';
    $_SESSION['message']  = '';
    $_SESSION['henshin'] = '';
    $_SESSION['response'] = '';
  }
  //興味のある分野（任意）
    $interested = implode('と', $_POST['interested']);
  
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
      <?php 
        if( $errormessage ){
          echo '<div style="color:red;">';
          echo implode('<br>', $errormessage );
          echo '</div>';
        }
      ?>

      <!-- 入力画面 -->
      <h2 style="text-align:center; margin:50px;">お問い合わせ</h2>
      <div class="bottom-content">
        <form action="./contactform.php" method="post" class="contact-form">
          <p>お名前</p>
          <input type="text" placeholder="名前" name="fullname" value="<?php echo $_SESSION['fullname'] ?>" class="small-field">
          <p>連絡先</p>
          <input type="e-mail" placeholder="メールアドレス" name="email" value="<?php echo $_SESSION['email'] ?>" class="small-field">
          <input type="tel" placeholder="電話番号" name="phone" value="<?php echo $_SESSION['phone'] ?>" class="small-field">
          <p>お問い合わせ内容</p>
          <textarea placeholder="内容"  rows="10" name="message" class="large-field"><?php echo $_SESSION['message'] ?></textarea>
          <p>ご希望の返答期間</p>
          <select name="response" size=”3″ value="<?php echo $_SESSION['response'] ?>">
            <option value=”″>--</option>
            <option name="response" value="1">1~2営業日以内</option>
            <option name="response" value="2">3~5営業日以内</option>
          </select><br>
            ※お急ぎの方はお手数ですが、お電話をお願い致します。（xxx-xxxx-xxxx）
          <p>ご希望の返信方法</p>
          <input type="radio" checked="checked" name="henshin" value="電話" />電話
          <input type="radio" name="henshin" value="メール" />メール
          <p>興味がある分野</p>
          <input type="checkbox" name="interested[]" value="A" />A
          <input type="checkbox" name="interested[]" value="B" />B
          <input type="checkbox" name="interested[]" value="C" />C
          <!-- 確認ボタン -->
          <input type="submit" name="confirm" value="確認" class="btn" />
        </form>
      </div>
    <?php }else if( $mode == 'confirm' ){ ?>
      <!-- 確認画面 -->  
      <form action="./contactform.php" method="post">
        <div class="check-content">
          名前 <?php echo $_SESSION['fullname'] ?> <br>
          Eメール <?php echo $_SESSION['email'] ?> <br>
          電話番号 <?php echo $_SESSION['phone'] ?> <br>
          お問い合わせ内容 <?php echo nl2br($_SESSION['message']) ?> <br>
          返答期間 <?php echo $_SESSION['response'] ?> <br>
          ご希望の返信方法 <?php echo $_SESSION['henshin'] ?> <br>
          興味がある分野 <?php echo $interested ?> <br>
        </div>  
        <input type="submit" name="send" value="SEND" class="btn">
        <input type="submit" name="back" value="戻る" class="btn">
      </form>
    <?php } else { ?>
      <!-- 完了画面 -->
      <p class="send-ok">送信しました。お問い合わせありがとうございました。</p>
      <button type=“button” onclick="location.href='./contactform.php'" class="btn">戻る</button>
    <?php } ?>
  </body>
</html>