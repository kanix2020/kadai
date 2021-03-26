<!DOCTYPE html>
<html lang="ja">
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>お問い合わせ</title>
  </head>
  <body>
    <div class="bottom-content">
      <form action="./contact.php" method="post" class="contact-form">
      <h2 class="heading-name">お問い合わせ</h2>
      <select name=”都道府県” size=”3″>
        <option value=”1″>--</option>
        <option value=”2″>東京</option>
        <option value=”3″>沖縄</option>
        <option value=”4″>沖縄</option>
      </select><br>
      <!-- <input type="hidden" name="data[MailMessage][category]" id="MailMessageCategory_" value=""><input type="radio" name="data[MailMessage][category]" id="MailMessageCategoryECCUBE" value="EC-CUBE" class=""><label for="MailMessageCategoryECCUBE">EC-CUBE</label>&nbsp;&nbsp;<input type="radio" name="data[MailMessage][category]" id="MailMessageCategoryその他" value="その他" class=""><label for="MailMessageCategoryその他">その他</label> -->
      <input type="text" placeholder="name" value="" class="small-field">
      <input type="e-mail" placeholder="e-mail" value="" class="small-field">
      <textarea placeholder="お問い合わせ内容" class="large-field"></textarea>
      <input type="submit" name="confirm" value="SEND" class="send">
      <input type="submit" name="confirm" value="戻る" class="send">
    </form>
      <?php
        print_r($_POST);
      ?>
  </div>
</html>