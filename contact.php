<form class="form-horizontal col-md-6" action="" method="post">
<!----------------Start title -------------->
<input type="text" class="form-control" name="title" placeholder="title" required="required" />
<!----------------Start email -------------->
    <input type="email" class="form-control" name="email" placeholder="email" required="required">
    <!----------------Start email -------------->
    <input type="email" class="form-control" name="to" placeholder="recipient" required="required">
<!----------------Start email -------------->
    <textarea class="form-control" name="message" required="required"></textarea>
<!----------------Start Sent -------------->
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    <input type="submit" class="btn btn-default btn-danger" />
  </div>
</div>
</form>
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $to = strip_tags($_POST['to']);
  $subject =  strip_tags($_POST['title']);
  $message =  strip_tags($_POST['message']);
  $email = strip_tags($_POST['email']);
  $headers = "From: $email.\r\n";
  if (mail($to, $subject, $message, $headers)) {
     echo "SUCCESS";
  } else {
     echo "ERROR";
  }
}
?>
