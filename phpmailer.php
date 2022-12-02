<form class="form-horizontal col-md-6" action="" method="post">
<!----------------Start title -------------->
<div class="form-group">
  <div class="col-sm-10">
    <input type="text" class="form-control" name="title" placeholder="title" required="required" />
  </div>
</div>
<!----------------Start email -------------->
<div class="form-group">
  <div class="col-sm-10">
    <input type="email" class="form-control" name="email" placeholder="email" required="required">
  </div>
</div>
<!----------------Start email -------------->
<div class="form-group">
  <div class="col-sm-10">
    <textarea class="form-control" name="message" required="required"></textarea>
  </div>
</div>
<!----------------Start Sent -------------->
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    <input type="submit" class="btn btn-default btn-danger" />
  </div>
</div>
</form>
<?php
require 'PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->Username = 'your-gmail-username@gmail.com';
$mail->Password = 'your-gmail-password';
$mail->setFrom('your@email-address.com');
$mail->addAddress('recipients@email-address.com');
$mail->Subject = 'Hello from PHPMailer!';
$mail->Body = 'This is a test.';
//send the message, check for errors
if (!$mail->send()) {
    echo "ERROR: " . $mail->ErrorInfo;
} else {
    echo "SUCCESS";
}
