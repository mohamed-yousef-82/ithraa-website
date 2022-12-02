<?php
$pageTitle ="Items";
include "init.php";

if(isset($_SESSION['username'])){
  ?>
  <section class="main-section box box-5">
  <div class="view-data">
  <div class="page-container">
  <h3 class="table-title"><span>ارسال رسالة</span><i class="fa fa-envelope" aria-hidden="true"></i></h3>
  <form class="form" action="" method="post">
  <!----------------Start title -------------->
  <input type="text" name="title" placeholder="عنوان الرسالة" required="required" />
      <!----------------Start email -------------->
      <input type="email" name="to" placeholder="المرسل اليه" required="required">
  <!----------------Start email -------------->
      <textarea name="message" required="required"></textarea>
  <!----------------Start Sent -------------->
      <input type="submit" class="start-btn blue" value="Send Message" />
  </form>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // $to = $_POST['to'];
    // $subject =  $_POST['title'];
    // $message =  $_POST['message'];
    // $email = $_POST['email'];
    // $headers = "From: $email.\r\n";
    // if (mail($to, $subject, $message, $headers)) {
    //    echo "SUCCESS";
    // } else {
    //    echo "ERROR";
    // }

    function myEmail(){
    $contact = sql("SELECT * FROM contact","fetch");

    $from =$contact['email'];
    return $from;

    }
      // $to = $_POST['to'];
    $to = $_POST['to'];
    $title=$_POST['title'];
    $message=$_POST['message'];

    if (($to=="")||($title=="")||($message==""))
    {
    echo "All fields are required, please fill <a href=\"\">the form</a> again.";
    }
    else{
    $from="From: ".myEmail()."";
    mail($to,$title,$message,$from);
    echo "تم الارسال بنجاح ";
    }

  }


}else{
  $Msg ="You Must Login";
  redirect($Msg);
}
?>
</div>
</div>
</section>
<?php
include "$str/footer.php";
?>
