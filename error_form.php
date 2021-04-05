<?php
  //バリデーション
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

  if( !$_POST['phone'] ){
    $errormessage[] = "電話番号を入力してください";
  } else if( mb_strlen($_POST['phone']) > 12 ){
    $errormessage[] = "電話番号は12文字以内にしてください";
  }
  $_SESSION['phone'] = htmlspecialchars($_POST['phone'], ENT_QUOTES);

  if( !$_POST['message'] ){
    $errormessage[] = "メッセージを入力してください";
  } else if( mb_strlen($_POST['message']) > 50 ){
    $errormessage[] = "お問い合わせ内容は500文字以内にしてください";
  }
  $_SESSION['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES);

  if( !$_POST['henshin'] ){
    $errormessage[] = "ご希望の返信方法を選択してください";
  }
  $_SESSION['henshin'] = htmlspecialchars($_POST['henshin'], ENT_QUOTES);

  if( !$_POST['response'] ){
    $errormessage[] = "ご希望の返答期間を選択してください";
  }
  $_SESSION['response'] = htmlspecialchars($_POST['response'], ENT_QUOTES);
?>