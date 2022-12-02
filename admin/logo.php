
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
echo "<h3 class='table-title'><span>اسم الشركة والشعار</span><i class='fa fa-building' aria-hidden='true'></i></h3>";
  //Select User Data From database
  $logo = sql("SELECT * FROM logo","fetch");
  if(!empty($logo)){
    echo "<div class='row row-medium'>";
    echo "<div class='box box-1'>";
    echo "<div class='panel'>";
    echo "<img class='single-img' src='../$logo[image]'/>";
    echo "<br/>";
    echo "<h3> $logo[name]</h3>";
    echo"<br/><a href='?do=edit' class='start-btn blue'><i class='fa fa-edit'></i>Edit</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
  ?>

  <?php
  }
  else{
    ?>



    <form class="form" action="?do=insert" method="post" enctype="multipart/form-data">
    <!----------------Start Name -------------->
      <label>الاسم</label>
      <input type="text" class="form-control" name="name" placeholder="Title" required="required">
    <!----------------Start Image -------------->
      <label>الشعار</label>
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
  $title            =$_POST['name'];
  //php validation

$formErrors=array();

  if(empty($title)){
    $formErrors[] = "Name  Required";
  }


  foreach ($formErrors as $error){
  echo "<div class='alert alert-danger'>$error</div>";
  }
  //Update In Database
  if (empty($formErrors)){

      upload("file","","../data/uploads/");
      sql("INSERT INTO logo (name,image)
      VALUES ('$title','$insert_src')","");
  $Msg = "<div class='alert alert-success'>تمت الاضافة بنجاح</div>";
  redirect($Msg,'back');
}
}else{
  $Msg='<div class="alert alert-danger">طلب خاطىء</div>';
  redirect($Msg,'back');
}



}elseif($do == 'edit'){

$edit_logo = sql("SELECT * FROM logo","fetch");

  ?>
  <h3 class="table-title"><span>تعديل الاسم والشعار </span><i class="fa fa-building" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=update" method="post" enctype="multipart/form-data">
  <!----------------Start Name -------------->
    <label>الاسم</label>
    <input type="text" class="form-control" name="name" value="<?php echo $edit_logo['name'] ?>">
  <!----------------Start Image -------------->
    <label>الصورة</label>
      <input type="hidden" name="oldfile" value="<?php echo $edit_logo['image'] ?>">
      <input type="file" name="file" placeholder="الصورة">
  <!----------------Start Sent -------------->
      <button type="submit" class="start-btn blue">تعديل</button>
  </form>
  </div>
<?php
}elseif($do == 'update'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Get User Data From Form
    $name            =$_POST['name'];
    $oldfile          =$_POST['oldfile'];
    //Update In Database
      upload("file",$oldfile,"../data/uploads/");
      sql("UPDATE logo SET name = '$name',image = '$insert_src'","");
      echo "<div class='success'>";
      $Msg = "<p>Updated Successfully</p>";
      redirect($Msg,'back');
      echo "</div>";

}else{
    $Msg = 'no allow';
    redirect($Msg,'back');
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
