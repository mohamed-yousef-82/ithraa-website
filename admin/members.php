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
echo "<h3 class='table-title'><span>الاعضاء</span><i class='fa fa-building' aria-hidden='true'></i></h3>";
  //Select User Data From database
  $about = sql("SELECT * FROM members","fetch");
  if(!empty($about)){
    echo "<div class='row row-medium'>";
    echo "<div class='box box-1'>";
    echo "<div class='panel'>";
    echo "<img class='single-img' src='../$about[image]'/>";
    echo "<h3>سياسات الأعضاء</h3>";
    echo "<p> $about[member]</p>";
    echo "<h3>سياسات الزوار</h3>";
    echo "<p> $about[visitor]</p>";
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
    <!----------------Start Description -------------->
      <label class="col-sm-2 control-label">سياسات الأعضاء</label>
      <textarea name="member"  placeholder="سياسات الأعضاء" required="required"></textarea>
      <!----------------Start layer -------------->
      <label class="col-sm-2 control-label">سياسات الزوار </label>
      <textarea name="visitor"  placeholder="سياسات الزوار " required="required"></textarea>
    <!----------------Start Image -------------->
      <label  class="col-sm-2 control-label">صورة</label><span>(width:200px,height:200px)</span>
      <input type="file" class="form-control" name="file" placeholder="Image" required="required">
    <!----------------Start Sent -------------->
        <button type="submit" class="start-btn blue">اضافة</button>
  </form>
    <?php
  }
  ?>

<?php
}elseif($do == 'insert'){

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  echo '<h3>Insert</h3>';
  //Get User Data From Form
  $member     =$_POST['member'];
  $visitor    =$_POST['visitor'];

  //php validation

$formErrors=array();

  if(empty($member)){
    $formErrors[] = "اسم المستخدم مططلوب";
  }
  if(empty($visitor)){
    $formErrors[] = "اسم الزائر مطلوب";
  }

  foreach ($formErrors as $error){
  echo "<div class='alert alert-danger'>$error</div>";
  }
  //Update In Database
  if (empty($formErrors)){

      upload("file","","../data/uploads/");
      sql("INSERT INTO members (member,visitor,image)
              VALUES ('$member', '$visitor','$insert_src')","");
  $Msg = "<div class='alert alert-success'>تمت الاضافة بنجاح</div>";
  redirect($Msg,'back');
}
}else{
  $Msg='<div class="alert alert-danger">Wrong Request</div>';
  redirect($Msg,'back');
}



}elseif($do == 'edit'){

$edit_about = sql("SELECT * FROM members","fetch");

  ?>
  <h3 class="table-title"><span>تعديل</span><i class="fa fa-building" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=update" method="post" enctype="multipart/form-data">
    <!----------------Start Description -------------->
      <label class="col-sm-2 control-label">سياسات الأعضاء</label>
      <textarea name="member"  placeholder="سياسات الأعضاء" ><?php echo $edit_about['member'] ?></textarea>
      <!----------------Start layer -------------->
      <label class="col-sm-2 control-label">سياسات الزوار </label>
      <textarea name="visitor"  placeholder="سياسات الزوار " ><?php echo $edit_about['visitor'] ?></textarea>
  <!----------------Start Image -------------->
  <div class="form-group">
    <label  class="col-sm-2 control-label">Image</label>
    <div class="col-sm-10">
      <input type="hidden"  class="form-control" name="oldfile" value="<?php echo $edit_about['image'] ?>">
      <input type="file" class="form-control" name="file" placeholder="image">
    </div>
  </div>
  <!----------------Start Sent -------------->
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="start-btn blue">تعديل</button>
    </div>
  </div>
</form>
  </div>
<div class="col-md-8">
<?php
}elseif($do == 'update'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Get User Data From Form
    $member     =$_POST['member'];
    $visitor    =$_POST['visitor'];
    $oldfile          =$_POST['oldfile'];
    //Update In Database
      upload("file",$oldfile,"../data/uploads/");
      sql("UPDATE members SET member = '$member',visitor = '$visitor',image = '$insert_src'","");
      echo "<div class='success'>";
      $Msg = "<p>تم التحديث بنجاح</p>";
      redirect($Msg,'back');
      echo "</div>";

}else{
    $Msg = 'no allow';
    redirect($Msg,'back');
}
echo "</div>";
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
