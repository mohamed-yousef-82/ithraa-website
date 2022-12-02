<?php
$pageTitle ="registration";
include "init.php";
//Manage Page
  ?>
  <div class="container">
  <div class="page-style-one">
  <h2 class="page-title">التسجيل فى الموقع </h2>
  <form class="form" action="?do=Insert" method="post" enctype="multipart/form-data">
  <!----------------Start Name -------------->
    <label class="col-sm-2 control-label">الاسم</label>
      <input type="text" class="form-control" name="user" placeholder="اسم المستخدم" required="required">
      <div>
    <label  class="col-sm-2 control-label">صورة </label>
      <input type="file" class="form-control" name="file" placeholder="الصورة" required="required">
      </div>
  <!----------------Start Email -------------->
    <label class="col-sm-2 control-label">البريد الالكترونى </label>
      <input type="email" class="form-control" name="email" placeholder="البريد الالكترونى" required="required">
      <!----------------Start Email -------------->
        <label class="col-sm-2 control-label">رقم الجوال </label>
          <input type="number" class="form-control" name="mobile" placeholder="رقم الجوال" required="required">
  <!----------------Start Branch -------------->
      <label>الفرع</label>
      <select name="branch">
        <?php
      $cats = sql("SELECT * FROM categories ORDER BY cat_id","fetchAll");
      foreach ($cats as $cat) {
      echo "<option value='$cat[name]'> $cat[name]</option>";
      }
        ?>
      </select>
      <label>نوع العضوية</label>
      <select name="kind">
    <option value='1'>دائمة</option>
    <option value='2'>زوار</option>
      </select>
  <!----------------Start Sent -------------->
      <button type="submit" class="start-btn blue">ارسال</button>
</form>
  </div>
<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  //Get User Data From Form
  $user      =strip_tags($_POST['user']);
  $email     =strip_tags($_POST['email']);
  $mobile    =strip_tags($_POST['mobile']);
  $kind      =strip_tags($_POST['kind']);
  $branch    =strip_tags($_POST['branch']);

  //php validation

$formErrors=array();

  if(empty($user)){
    $formErrors[] = "الاسم مطلوب";
  }

  if(empty($email)){
    $formErrors[] = "البريد الالكترونى مطلوب";
  }

  if(empty($branch)){
    $formErrors[] = "الفرع مطلوب";
  }

  foreach ($formErrors as $error){
  echo "<div class='alert alert-danger'>$error</div>";
  }
  //Update In Database
  if (empty($formErrors)){
    // Check If User Exit In Database
    $check = checkItems("user","member_login",$user);
    if($check > 0){
      $Msg = 'Sorry This User  Id Exist';
      redirect($Msg,'back');
    }else{
      upload("file","","data/uploads/");
      sql("INSERT INTO member_login (user, email, mobile,add_date,image,branch,kind)
              VALUES ('$user', '$email', '$mobile',NOW(),'$insert_src','$branch','$kind')","");
  $Msg = "<div class='alert alert-success'>تم التسجيل بنجاح</div>";
  redirect($Msg,'back');
}
}
}
echo "</div>";
echo "</div>";
include "$str/footer.php";
?>
