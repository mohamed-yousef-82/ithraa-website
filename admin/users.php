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
  $users_stmt = sql("SELECT * FROM member_login ORDER BY id DESC LIMIT $page_start,$page_items","fetchAll");
  if(!empty($users_stmt)){
  ?>
  <h3 class="table-title"><span>الاعضاء المسجلين</span><i class="fa fa-user" aria-hidden="true"></i></h3>
  <table class="table">
    <thead>
      <tr>
        <th>مسلسل</th>
        <th>اسم العضو</th>
        <th>البريد الالكترونى</th>
        <th>رقم الجوال</th>
        <th>الفرع</th>
        <th>نوع العضوية </th>
        <th>تاريخ التسجيل </th>
        <th>الصورة</th>
        <th>التحكم</th>
      </tr>
        </thead>
        <?php
foreach ($users_stmt as $row) {
echo"<tr>";
echo"<td>$row[id]</td>";
echo"<td>$row[user]</td>";
echo"<td>$row[email]</td>";
echo"<td>$row[mobile]</td>";
echo"<td>$row[branch]</td>";
if($row['kind']==1){echo"<td>دائمة</td>";}else{echo"<td>زوار</td>";}
echo"<td>$row[add_date]</td>";
echo"<td><img class='admin-img' src='../$row[image]' /></td>";
echo"<td><div class='inline-btn'><a href='?do=edit&user_id=$row[id]' class='start-btn green'><i class='fa fa-edit'></i>تعديل</a>
<a href='?do=delete&user_id=$row[id]' class='start-btn orangered'><i class='fa fa-close'></i>حذف</a>";
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

}elseif($do == 'edit'){
  ?>
  <h3 class="table-title"><span>تعديل بيانات مستخدم</span><i class="fa fa-user" aria-hidden="true"></i></h3>
  <div class="child-page">
  <?php
  $Msg ="<div class='child-page'><div class='msg'>Wrong Request</div></div>";
  $userid = isset($_GET['user_id']) && is_numeric($_GET['user_id'])?intval($_GET['user_id']) : redirect($Msg,'back');
//Select User Data From database
$edit_users = sql("SELECT * FROM member_login WHERE id = $userid LIMIT 1","fetch");

if ($count == 1){
  ?>

<form class="form" action="?do=update" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $userid ?>">
<!----------------Start Name -------------->
  <label class="col-sm-2 control-label">الاسم</label>
    <input type="text" class="form-control" name="user" value="<?php echo $edit_users['user'] ?>">
    <div>
  <label  class="col-sm-2 control-label">صورة </label>
    <input type="file" class="form-control" name="file" placeholder="الصورة" >
      <input type="hidden" name="oldfile" value="<?php echo $edit_users['image'] ?>">
    </div>
<!----------------Start Email -------------->
  <label class="col-sm-2 control-label">البريد الالكترونى </label>
    <input type="email" class="form-control" value="<?php echo $edit_users['email'] ?>" name="email" placeholder="البريد الالكترونى" >
    <!----------------Start Email -------------->
      <label class="col-sm-2 control-label">رقم الجوال </label>
        <input type="number" class="form-control" value="<?php echo $edit_users['mobile'] ?>" name="mobile" placeholder="رقم الجوال" >
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
    $id        =$_POST['id'];
    $user      =$_POST['user'];
    $email     =$_POST['email'];
    $mobile    =$_POST['mobile'];
    $kind      =$_POST['kind'];
    $branch    =$_POST['branch'];
    $oldfile   =$_POST['oldfile'];

    //php validation
$formErrors=array();

    foreach ($formErrors as $error){
    echo "<div class='alert alert-danger'>$error</div>";
    }

    //Update In Database
    if (empty($formErrors)){
      upload("file",$oldfile,"../data/uploads/");
      sql("UPDATE member_login SET user = '$user',email = '$email',mobile = '$mobile',kind = '$kind',branch = '$branch',image = '$insert_src' WHERE id = '$id'","");
      $Msg = "<div class='child-page'><div class='msg'>تم التحديث بنجاح</div></div>";
      redirect($Msg,'backk',3);

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
  $check = checkItems("id","member_login",$userid);
//Select User Data From database
if ($check == 1){
  sql("DELETE FROM member_login WHERE id = '$userid'","");
  $Msg = "<div class='child-page'><div class='msg'>تم الحذف بنجاح</div></div>";
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
