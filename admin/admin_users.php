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
  pages();
  $query ="";
  if(isset($_GET['page']) && $_GET['page'] =='pending'){
    $query = 'AND regstatus = 0';
  }

  //Select User Data From database
  $users_stmt = sql("SELECT * FROM users WHERE groupid != 2 $query ORDER BY user_id Desc LIMIT $page_start,$page_items","fetchAll");
  if(!empty($users_stmt)){
  ?>
  <h3 class="table-title"><span>مستخدمى لوحة التحكم </span><i class="fa fa-user" aria-hidden="true"></i></h3>
  <table class="table">
    <thead>
      <tr>
        <th>مسلسل</th>
        <th>المستخدم</th>
        <th>البريد الالكترونى</th>
        <th>الاسم بالكامل</th>
        <th>تاريخ التسجيل</th>
        <th>الصورة</th>
        <th>التحكم</th>
      </tr>
        </thead>
        <?php
foreach ($users_stmt as $row) {
echo"<tr>";
echo"<td>$row[user_id]</td>";
echo"<td>$row[username]</td>";
echo"<td>$row[email]</td>";
echo"<td>$row[fullname]</td>";
echo"<td>$row[date]</td>";
echo"<td><img class='admin-img' src='../$row[image]' /></td>";
echo"<td><div class='inline-btn'><a href='?do=edit&user_id=$row[user_id]' class='start-btn green'><i class='fa fa-edit'></i>تعديل</a>
<a href='?do=delete&user_id=$row[user_id]' class='start-btn orangered'><i class='fa fa-close'></i>حذف</a>";
if($row['regstatus']==0){
  echo "<a href='?do=activate&user_id=$row[user_id]' class='start-btn dark'><i class='fa fa-edit'></i>تنشيط</a>";
}
echo"
</div>
</td>
</tr>";

}
        ?>
  </table>


  <?php
  }
  else{
    echo "<div class='nodata'>لا يوجد بيانات لعرضها</div>";
  }


  echo "<a href='?do=add' class='start-btn blue add'><i class='fa fa-plus'></i>اضف جديد</a>";
  pages_links("users");
} elseif($do == 'add'){
  ?>
  <h3 class="table-title"><span>تعديل المستخدم</span><i class="fa fa-user" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=insert" method="post" enctype="multipart/form-data">
  <!----------------Start Name -------------->
    <label for="inputEmail3" class="col-sm-2 control-label">الاسم</label>
      <input type="text" class="form-control" name="username" placeholder="Username" required="required">
  <!----------------Start Password -------------->
    <label for="inputPassword3" class="col-sm-2 control-label">كلمة السر</label>
      <input type="password"  class="password form-control" name="password" autocomplete="new-password" placeholder="Password">
      <i class="show-pass fa fa-eye fa-2x"></i>
  <!----------------Start Email -------------->

    <label for="inputEmail3" class="col-sm-2 control-label">البريد الالكترونى</label>
      <input type="email" class="form-control" name="email"  placeholder="Email" required="required">
  <!----------------Start Full Name -------------->

    <label for="inputEmail3" class="col-sm-2 control-label">الاسم بالكامل</label>
      <input type="text" class="form-control" name="full"  placeholder="Full Name" required="required">
    <label  class="col-sm-2 control-label">الصورة</label> <span>(width:200px,height:200px)</span>
      <input type="file" class="form-control" name="file" placeholder="Image" required="required">
  <!----------------Start Sent -------------->
      <button type="submit" class="start-btn blue add">اضف مستخدم</button>
</form>
</div>
<?php
}elseif($do == 'insert'){

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  //Get User Data From Form
  $user      =$_POST['username'];
  $pass      =$_POST['password'];
  $hashpass  =sha1($_POST['password']);
  $email     =$_POST['email'];
  $full      =$_POST['full'];

  //php validation

$formErrors=array();
  if(strlen($user) < 4){
    $formErrors[] = "Your Username Is Very Less";
  }

  if(strlen($user) > 20){
    $formErrors[] = "Your Username Is Very Long";
  }

  if(empty($user)){
    $formErrors[] = "Username Required";
  }

  if(empty($pass)){
    $formErrors[] = "Password Required";
  }

  if(empty($email)){
    $formErrors[] = "Email Required";
  }

  if(empty($email)){
    $formErrors[] = "Email Required";
  }

  if(empty($full)){
    $formErrors[] = "Full Name Required";
  }

  foreach ($formErrors as $error){
  echo "<div class='alert alert-danger'>$error</div>";
  }
  //Update In Database
  if (empty($formErrors)){
    // Check If User Exit In Database
    $check = checkItems("username","users",$user);
    if($check > 0){
      $Msg = '<div class="child-page"><div class="msg">Sorry This User  Id Exist</div></div>';
      redirect($Msg,'back');
    }else{
      upload("file","","../data/uploads/");
      sql("INSERT INTO users (username,password,email,fullname,groupid,date,image)
              VALUES ('$user', '$hashpass', '$email', '$full',1,NOW(),'$insert_src')","");
  $Msg = "<div class='child-page'><div class='msg'>Inserted Successfully</div></div>";
  redirect($Msg,'back');
}
}
}else{
  $Msg='<div class="child-page"><div class="msg">Wrong Request</div></div>';
  redirect($Msg,'back');
}



}elseif($do == 'edit'){
  ?>
  <h3 class="table-title"><span>Edit User</span><i class="fa fa-user" aria-hidden="true"></i></h3>
  <div class="child-page">
  <?php
  $Msg ="<div class='child-page'><div class='msg'>Wrong Request</div></div>";
  $userid = isset($_GET['user_id']) && is_numeric($_GET['user_id'])?intval($_GET['user_id']) : redirect($Msg,'back');
//Select User Data From database
$edit_users = sql("SELECT * FROM users WHERE user_id = $userid LIMIT 1","fetch");

if ($count == 1){
  ?>
  <form class="form" action="?do=update" method="post" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo $userid ?>">
  <!----------------Start Name -------------->

    <label for="inputEmail3" class="col-sm-2 control-label">الاسم</label>
      <input type="text" class="form-control" name="username" value="<?php echo $edit_users['username'] ?>">
  <!----------------Start Password -------------->

    <label for="inputPassword3" class="col-sm-2 control-label">كلمة السر</label>
      <input type="hidden"  class="form-control" name="oldpassword" value="<?php echo $edit_users['password'] ?>">
      <input type="password"  class="form-control" name="newpassword" autocomplete="new-password" placeholder="Leave This Field Empty If You Dont Want To Change">
  <!----------------Start Email -------------->
    <label for="inputEmail3" class="col-sm-2 control-label">البريد الالكتروونى</label>
    <input type="email" class="form-control" name="email" value="<?php echo $edit_users['email'] ?>" >
  <!----------------Start Full Name -------------->
    <label for="inputEmail3" class="col-sm-2 control-label">الاسم بالكامل</label>
    <input type="text" class="form-control" name="full" value="<?php echo $edit_users['fullname'] ?>" >
  <!----------------Start Image -------------->
    <label  class="col-sm-2 control-label">الصورة</label>
      <input type="hidden"  class="form-control" name="oldfile" value="<?php echo $edit_users['image'] ?>">
      <input type="file" class="form-control" name="file" placeholder="image">
  <!----------------Start Sent -------------->
      <button type="submit" class="start-btn blue add">تحديث</button>
</form>
<div class="col-md-8">
<?php
}else{
  $Msg='<div class="child-page"><div class="msg">Wrong Request</div></div>';
  redirect($Msg,'back');
}
?>
</div>
<?php
}elseif($do == 'update'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //Get User Data From Form
    $id        =$_POST['user_id'];
    $user      =$_POST['username'];
    $email     =$_POST['email'];
    $full      =$_POST['full'];
    $oldfile   =$_POST['oldfile'];

    //Password Update
    $pass=empty($_POST['newpassword'])?$_POST['oldpassword']:sha1($_POST['newpassword']);

    //php validation
$formErrors=array();
    if(strlen($user) < 4){
      $formErrors[] = "Your Username Is Very Less";
    }
    if(strlen($user) > 20){
      $formErrors[] = "Your Username Is Very Long";
    }
    if(empty($user)){
      $formErrors[] = "Username Required";
    }
    if(empty($email)){
      $formErrors[] = "Email Required";
    }
    if(empty($email)){
      $formErrors[] = "Email Required";
    }
    if(empty($full)){
      $formErrors[] = "Full Name Required";
    }
    foreach ($formErrors as $error){
    echo "<div class='alert alert-danger'>$error</div>";
    }

    //Update In Database
    if (empty($formErrors)){
      sql("SELECT * FROM users WHERE username = '$user' AND user_id != '$id'","fetch");
      if ($count==1){
        $Msg = "<div class='child-page'><div class='msg'>This User Is Exist</div></div>";
        redirect($Msg,'back');
      }else{
      upload("file",$oldfile,"../data/uploads/");
      sql("UPDATE users SET username = '$user',email = '$email',fullname = '$full',password = '$pass',image = '$insert_src' WHERE user_id = '$id'","");
      $Msg = "<div class='child-page'><div class='msg'>Updated Successfully</div></div>";
      redirect($Msg,'backk',3);
    }
  }
}else{
    $Msg = "<div class='child-page'><div class='msg'>no allow</div></div>";
    // redirect($Msg,'back',3);
}
echo "</div>";
}
elseif($do == 'delete'){
  //Delete User Page
  echo"
  <div class='container'>";
  $userid = isset($_GET['user_id']) && is_numeric($_GET['user_id'])?intval($_GET['user_id']) : 0;
//Chick If Item Exist In Database
  $check = checkItems("user_id","users",$userid);
//Select User Data From database
if ($check == 1){
  sql("DELETE FROM users WHERE user_id = '$userid'","");
  $Msg = "<div class='child-page'><div class='msg'>Deleted Successfully</div></div>";
  redirect($Msg,'back');
}else{
  $Msg = "<div class='child-page'><div class='msg'>This Id Is Not Exist</div></div>";
  redirect($Msg,'back');
}
echo"</div>";
}elseif($do == 'activate'){
  //Activate User Page
  echo"<h1>Activate User</h1>
  <div class='container'>";
  $userid = isset($_GET['user_id']) && is_numeric($_GET['user_id'])?intval($_GET['user_id']) : 0;
//Chick If Item Exist In Database
  $check = checkItems("user_id","users",$userid);
//Select User Data From database
if ($check == 1){
  sql("UPDATE users SET Regstatus = 1 WHERE user_id = '$userid'","");
  $Msg = "<div class='child-page'><div class='msg'>Activated Successfully</div></div>";
  redirect($Msg,'back');
}else{
  $Msg = "<div class='child-page'><div class='msg'>This Id Is Not Exist</div></div>";
  redirect($Msg,'back');
}
echo"</div>";

}
else{
  $Msg = "<div class='child-page'><div class='msg'>Error</div></div>";
redirect($Msg,'back');

}
}else{
  $Msg = "<div class='child-page'><div class='msg'>You Must Login</div></div>";
  redirect($Msg);
}
echo"</div>";
echo"</div>";
echo"</section>";
include "$str/footer.php";
?>
