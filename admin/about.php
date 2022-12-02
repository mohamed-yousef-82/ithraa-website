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
echo "<h3 class='table-title'><span>عن الشركة</span><i class='fa fa-building' aria-hidden='true'></i></h3>";
  //Select User Data From database
  $about = sql("SELECT * FROM about","fetch");
  if(!empty($about)){
    echo "<div class='row row-medium'>";
    echo "<div class='box box-1'>";
    echo "<div class='panel'>";
    echo "<img class='single-img' src='../$about[image]'/>";
    echo "<h3>العنوان</h3>";
    echo "<p> $about[title]</p>";
    echo "<h3>نبذة</h3>";
    echo "<p> $about[description]</p>";
    echo "<h3>الشريحة المستفيدة</h3>";
    echo "<p> $about[layer]</p>";
    echo "<h3>الاهداف</h3>";
    echo "<p> $about[goals]</p>";
    echo "<h3>سياسات عمل الديوانية</h3>";
    echo "<p> $about[policies]</p>";
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
      <label class="col-sm-2 control-label">العنوان</label>
      <input type="text" placeholder="العنوان" name="title" />
    <!----------------Start Description -------------->
      <label class="col-sm-2 control-label">نبذة</label>
      <textarea name="description"  placeholder="نبذة"></textarea>
      <!----------------Start layer -------------->
      <label class="col-sm-2 control-label">الشريحة المستفيدة </label>
      <textarea name="layer"  placeholder="الشريحة المستفيدة " required="required"></textarea>
      <!----------------Start goals -------------->
      <label class="col-sm-2 control-label">الاهداف</label>
      <textarea name="goals"  placeholder="الاهداف " required="required"></textarea>
      <!----------------Start  -------------->
      <label class="col-sm-2 control-label">سياسات عمل الديوانية</label>
      <textarea name="policies"  placeholder="سياسات عمل الديوانية " required="required"></textarea>
    <!----------------Start Image -------------->
      <label  class="col-sm-2 control-label">صورة</label> <span>(width:1000px,height:500px)</span>
      <input type="file" class="form-control" name="file" placeholder="صورة" required="required">
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
  $title      =$_POST['title'];
  $description      =$_POST['description'];
  $layer            =$_POST['layer'];
  $goals             =$_POST['goals'];
  $policies      =$_POST['policies'];

  //php validation

$formErrors=array();



  foreach ($formErrors as $error){
  echo "<div class='alert alert-danger'>$error</div>";
  }
  //Update In Database
  if (empty($formErrors)){

      upload("file","","../data/uploads/");
      sql("INSERT INTO about (title,description,layer,goals,policies,image)
              VALUES ('$title','$description', '$layer','$goals','$policies','$insert_src')","");
  $Msg = "<div class='alert alert-success'>تمت الاضافة بنجاح</div>";
  redirect($Msg,'back');
}
}else{
  $Msg='<div class="alert alert-danger">Wrong Request</div>';
  redirect($Msg,'back');
}



}elseif($do == 'edit'){

$edit_about = sql("SELECT * FROM about","fetch");

  ?>
  <h3 class="table-title"><span>تعديل</span><i class="fa fa-building" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=update" method="post" enctype="multipart/form-data">
    <!----------------Start Description -------------->
    <label class="col-sm-2 control-label">العنوان</label>
    <input type="text" name="title"  placeholder="<?php echo $edit_about['title'] ?>" >
      <label class="col-sm-2 control-label">نبذة</label>
      <textarea name="description" ><?php echo $edit_about['description'] ?></textarea>
      <!----------------Start layer -------------->
      <label class="col-sm-2 control-label">الشريحة المستفيدة </label>
      <textarea name="layer"  ><?php echo $edit_about['layer'] ?></textarea>
      <!----------------Start goals -------------->
      <label class="col-sm-2 control-label">الاهداف</label>
      <textarea name="goals" ><?php echo $edit_about['goals'] ?></textarea>
      <!----------------Start  -------------->
      <label class="col-sm-2 control-label">سياسات عمل الديوانية</label>
      <textarea  name="policies"><?php echo $edit_about['policies'] ?></textarea>
  <!----------------Start Image -------------->
  <div class="form-group">
    <label  class="col-sm-2 control-label">صورة</label><span> (width:1000px,height:500px)</span>
    <div class="col-sm-10">
      <input type="hidden"  class="form-control" name="oldfile" value="<?php echo $edit_about['image'] ?>">
      <input type="file" class="form-control" name="file" placeholder="صورة">
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
    $title      =$_POST['title'];
    $description      =$_POST['description'];
    $layer            =$_POST['layer'];
    $goals             =$_POST['goals'];
    $policies      =$_POST['policies'];
    $oldfile          =$_POST['oldfile'];
    //Update In Database
      upload("file",$oldfile,"../data/uploads/");
      sql("UPDATE about SET title = '$title',layer = '$layer',description = '$description',goals='$goals',policies='$policies',image = '$insert_src'","");
      echo "<div class='success'>";
      $Msg = "<p>تم التحديث بنجاح</p>";
      redirect($Msg,'back',3);
      echo "</div>";

}else{
    $Msg = 'no allow';
    redirect($Msg,'back',3);
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
