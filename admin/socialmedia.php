<?php
$pageTitle ="socialmedia";
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
echo "<h3 class='table-title'><span>التواصل الاجتماعى</span><i class='fa fa-building' aria-hidden='true'></i></h3>";

  //Select Categories Data From database
  $socialmedia = sql("SELECT * FROM socialmedia ORDER By social_id DESC ","fetchAll");
?>
<table class="table">
<thead>
  <tr>
    <th>مسلسل</th>
    <th>الرابط</th>
    <th>الصورة</th>
    <th>التحكم</th>
  </tr>
    </thead>
  <tbody>
          <?php
          $num = 1;
          foreach ($socialmedia as $social) {
            echo"<tr>";
            echo"<td>$num</td>";
            echo"<td>$social[link]</td>";
            echo"<td><i class='$social[image]' aria-hidden='true'></i></td>";
            echo"<td><a href='?do=edit&social_id=$social[social_id]' class='start-btn green'><i class='fa fa-edit'></i>تعديل</a>
            <a href='?do=delete&social_id=$social[social_id]' class='confirm start-btn orangered confirm'><i class='fa fa-close'></i>حذف</a></td>";
            echo"</tr>";
            $num++;
          }
          ?>
          </tbody>
        </table>
        <a href="?do=add" class="start-btn blue add"><span class="fa fa-plus"></span>اضف جديد</a>
<?php
}
elseif($do == 'add'){
?>
  <h3 class="table-title"><span>اضف جديد</span><i class="fa fa-camera-retro" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=insert" method="post">
  <!----------------Start Link -------------->
    <label  class="col-sm-2 control-label">رابط</label>
    <input type="text" class="form-control" name="link" placeholder="link" required="required">
  <!----------------Start Image-------------->
    <label  class="col-sm-2 control-label">الصورة</label>
    <ul class="social-icons">
    <li class="social-icon"><input name="image" type="radio" value="fa fa-facebook-square" /><i class="fa fa-facebook-square" aria-hidden="true"></i></li>
    <li class="social-icon"><input name="image" type="radio" value="fa fa-facebook" /><i class="fa fa-facebook" aria-hidden="true"></i></li>
    <li class="social-icon"><input name="image" type="radio" value="fa fa-twitter" /><i class="fa fa-twitter" aria-hidden="true"></i></li>
    <li class="social-icon"><input name="image" type="radio" value="fa fa-twitter-square" /><i class="fa fa-twitter-square" aria-hidden="true"></i></li>
    <li class="social-icon"><input name="image" type="radio" value="fa fa-youtube" /><i class="fa fa-youtube" aria-hidden="true"></i></li>
    <li class="social-icon"><input name="image" type="radio" value="fa fa-youtube-square" /><i class="fa fa-youtube-square" aria-hidden="true"></i></li>
    <li class="social-icon"><input name="image" type="radio" value="fa fa-google-plus" /><i class="fa fa-google-plus" aria-hidden="true"></i></li>
    <li class="social-icon"><input name="image" type="radio" value="fa fa-google-plus-square" /><i class="fa fa-google-plus-square" aria-hidden="true"></i></li>
    <li class="social-icon"><input name="image" type="radio" value="fa fa-linkedin" /><i class="fa fa-linkedin" aria-hidden="true"></i></li>
    <li class="social-icon"><input name="image" type="radio" value="fa fa-linkedin-square" /><i class="fa fa-linkedin-square" aria-hidden="true"></i></li>
  </ul>
  <!----------------Start Sent -------------->
      <button type="Add Category" class="start-btn blue">اضف جديد</button>
</form>
  </div>
<?php
}
elseif($do == 'insert'){
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  echo '<h3>Insert Category</h3>';
  //Get Category Data From Form
  $link      =$_POST['link'];
  $image      =$_POST['image'];
    // Check If Category Exit In Database
    $check = checkItems("link","socialmedia",$link );
    if($check == 1){
      $Msg = 'عفوا هذا القسم موجود ';
      redirect($Msg,'back');
    }else{
    sql("INSERT INTO socialmedia (link, image)
    VALUES ('$link', '$image')","");

  $Msg = "<div class='alert alert-success'>تمت الاضافة بنجاح</div>";
  redirect($Msg,'back');
  }
  }else{
  $Msg='<div class="alert alert-danger">Wrong Request</div>';
  redirect($Msg,'back');
  }
}
elseif($do == 'edit'){
  $Msg ="<div class='alert alert-danger'>Wrong Request</div>";
  $social_id = isset($_GET['social_id']) && is_numeric($_GET['social_id'])?intval($_GET['social_id']) : redirect($Msg,'back');
//Select Category Data From database
$socialmedia = sql("SELECT * FROM socialmedia WHERE social_id = '$social_id'","fetch");
if ($count == 1){
  ?>
   <h3 class="table-title"><span>تعديل</span><i class="fa fa-camera-retro" aria-hidden="true"></i></h3>
   <div class="child-page">
  <form class="form" action="?do=update" method="post">
    <input type="hidden" name="social_id" value="<?php echo $social_id ?>">
  <!----------------Start Name -------------->
    <label>الرابط</label>
      <input type="text" class="form-control" name="link" placeholder="link"  value="<?php echo $socialmedia['link']?>">
  <!----------------Start Description-------------->

      <i class="<?php echo $socialmedia['image']?>" aria-hidden="true"></i><br />
    <label>الصورة</label><br />
      <div>
      <input type="hidden" name="oldimage" type="radio" value="<?php echo $socialmedia['image']?>" />
      <input name="image" type="radio" value="fa fa-facebook-square" /><i class="fa fa-facebook-square" aria-hidden="true"></i>
      <input name="image" type="radio" value="fa fa-facebook" /><i class="fa fa-facebook" aria-hidden="true"></i>
      <input name="image" type="radio" value="fa fa-twitter" /><i class="fa fa-twitter" aria-hidden="true"></i>
      <input name="image" type="radio" value="fa fa-twitter-square" /><i class="fa fa-twitter-square" aria-hidden="true"></i>
      <input name="image" type="radio" value="fa fa-youtube" /><i class="fa fa-youtube" aria-hidden="true"></i>
      <input name="image" type="radio" value="fa fa-youtube-square" /><i class="fa fa-youtube-square" aria-hidden="true"></i>
      <input name="image" type="radio" value="fa fa-google-plus" /><i class="fa fa-google-plus" aria-hidden="true"></i>
      <input name="image" type="radio" value="fa fa-google-plus-square" /><i class="fa fa-google-plus-square" aria-hidden="true"></i>
      <input name="image" type="radio" value="fa fa-linkedin" /><i class="fa fa-linkedin" aria-hidden="true"></i>
      <input name="image" type="radio" value="fa fa-linkedin-square" /><i class="fa fa-linkedin-square" aria-hidden="true"></i>
    </div>

  <!----------------Start Sent -------------->
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button  class="start-btn blue">تعديل</button>
    </div>
  </div>
  </form>
    </div>
<?php
}
}
elseif($do == 'update'){
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo '<h3>update</h3>';

  //Get User Data From Form

  $link          =$_POST['link'];
  // $image         =$_POST['image'];
  // $oldimage      =$_POST['oldimage'];
  $id            =$_POST['social_id'];
  $image         =empty($_POST['image'])?$_POST['oldimage']:$_POST['image'];

  //Update In Database
  $update_category = sql("UPDATE socialmedia SET link = '$link',image = '$image'
                  WHERE social_id = '$id'","");
  $Msg = "<div class='alert alert-success'>تم التحديث بنجاح</div>";
  redirect($Msg,'back');

}else{
  $Msg = 'no allow';
  redirect($Msg,'back');
}
echo "</div>";

}
elseif($do == 'delete'){
  //Delete Category Page
  echo"<h1>Delete Social Media</h1>
  <div class='container'>";
  $social_id = isset($_GET['social_id']) && is_numeric($_GET['social_id'])?intval($_GET['social_id']) : 0;
//Chick If Item Exist In Database
  $check = checkItems("social_id","socialmedia",$social_id);
//Select User Data From database
if ($check == 1){
  $delete_category = sql("DELETE FROM socialmedia WHERE social_id = '$social_id'","");
  $Msg = "<div class='alert alert-success'>تم الحذف بنجاح</div>";
  redirect($Msg);
}else{
  $Msg ="This Id Is Not Exist";
  redirect($Msg,'back');
}
echo"</div>";

}
else{
$Msg = '<div class="alert alert-danger">Error</div>';
redirect($Msg,'back');
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
