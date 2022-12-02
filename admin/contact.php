
<?php
$pageTitle ="users";
include "init.php";
if(isset($_SESSION['username'])){
$do = isset($_GET['do'])?$_GET['do'] : 'manage';
//Manage Page
?>
<section class="main-section box box-5">
<div class="view-data">
<div class="page-container">
<?php
//Pending Users
if($do =='manage'){
  echo "<h3 class='table-title'><span>بيانات التواصل</span><i class='fa fa-building' aria-hidden='true'></i></h3>";
  //Select User Data From database
  $contact = sql("SELECT * FROM contact","fetch");
  if(!empty($contact)){
    echo "<div class='row row-medium'>";
    echo "<div class='box box-1'>";
    echo "<div class='panel'>";
    echo "<p>Email : $contact[email]</p>";
    echo "<p>Phone : $contact[phone]</p>";
    echo "<p>Phone : $contact[address]</p>";
    echo"<br/><a href='?do=edit' class='start-btn blue'><i class='fa fa-edit'></i>تعديل</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
  ?>

  <?php
  }
  else{
    ?>



    <form class="form" action="?do=insert" method="post" enctype="multipart/form-data">
      <h3>بيانات التواصل</h3>
    <!----------------Start Name -------------->
      <label for="inputEmail3" class="col-sm-2 control-label">البريد الإلكترونى </label>
      <input type="text" class="form-control" name="email" placeholder="البريد الإلكترونى" required="required">

    <!----------------Start Description -------------->
      <label for="inputEmail3" class="col-sm-2 control-label">الهاتف</label>
      <input type="text" class="form-control" name="phone"  placeholder="الجوال" required="required">
      <!----------------Start Description -------------->
        <label for="inputEmail3" class="col-sm-2 control-label">العنوان</label>
        <input type="text" class="form-control" name="address"  placeholder="العنوان" required="required">
    <!----------------Start Sent -------------->
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="start-btn blue">اضافة</button>
      </div>
    </div>
  </form>

    <?php
  }
  ?>

<?php
}elseif($do == 'insert'){

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  echo '<h3>Insert</h3>';
  //Get User Data From Form
  $email            =$_POST['email'];
  $phone      =$_POST['phone'];
  $address      =$_POST['address'];

  //php validation

$formErrors=array();

  if(empty($email)){
    $formErrors[] = "Email  Required";
  }

  if(empty($phone)){
    $formErrors[] = "Phone Required";
  }
  if(empty($address)){
    $formErrors[] = "Address Required";
  }

  foreach ($formErrors as $error){
  echo "<div class='alert alert-danger'>$error</div>";
  }
  //Update In Database
  if (empty($formErrors)){

      // upload("file","","../data/uploads/");
      sql("INSERT INTO contact (email,phone,address)
              VALUES ('$email', '$phone', '$address')","");
  $Msg = "<div class='alert alert-success'>تمت الاضافة بنجاح</div>";
  redirect($Msg,'back');
}
}else{
  $Msg='<div class="alert alert-danger">Wrong Request</div>';
  redirect($Msg,'back');
}



}elseif($do == 'edit'){

$contact = sql("SELECT * FROM contact","fetch");

  ?>
  <h3 class="table-title"><span>تعديل بيانات التواصل</span><i class="fa fa-building" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=update" method="post" enctype="multipart/form-data">
  <!----------------Start Name -------------->
  <label for="inputEmail3" class="col-sm-2 control-label">البريد الالكترونى</label>
  <input type="text" class="form-control" name="email" value="<?php echo $contact['email'] ?>" >
  <!----------------Start Full Name -------------->
  <label for="inputEmail3" class="col-sm-2 control-label">الهاتف</label>
  <input type="text" class="form-control" name="phone" value="<?php echo $contact['phone'] ?>" />
  <!----------------Start Full Name -------------->
  <label for="inputEmail3" class="col-sm-2 control-label">العنوان</label>
  <input type="text" class="form-control" name="address" value="<?php echo $contact['address'] ?>" />
  <!----------------Start Sent -------------->
  <button type="submit" class="start-btn blue">Edit</button>
</form>
</div>
<?php
}elseif($do == 'update'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Get User Data From Form
    $email      =$_POST['email'];
    $phone      =$_POST['phone'];
    $address      =$_POST['address'];
    //Update In Database
      // upload("file",$oldfile,"../data/uploads/");
      sql("UPDATE contact SET email = '$email',phone = '$phone',address = '$address'","");
      echo "<div class='success'>";
      $Msg = "<p>تم التحديث بنجاح</p>";
      redirect($Msg,'back');
      echo "</div>";

}else{
    $Msg = 'no allow';
    // redirect($Msg,'back',3);
}
}

}else{
  $Msg ="You Must Login";
  redirect($Msg);
}
echo"</div>";
echo"</div>";
echo"</section>";
include "$str/footer.php";
?>
