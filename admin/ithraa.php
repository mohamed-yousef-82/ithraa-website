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
echo "<h3 class='table-title'><span>لائحة إثراء</span><i class='fa fa-building' aria-hidden='true'></i></h3>";
  //Select User Data From database
  $about = sql("SELECT * FROM ithraa","fetch");
  if(!empty($about)){
    echo "<div class='row row-medium'>";
    echo "<div class='box box-1'>";
    echo "<div class='panel'>";
    echo "<img class='single-img' src='../$about[image]'/>";
    echo "
    <a style='text-decoration:underline;margin:20px 0px;' href='../$about[pdf]'> رابط تحميل ملف لائحة إثراء PDF </a>
    ";
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
    <!----------------Start Image -------------->
      <label  class="col-sm-2 control-label">صورة</label><span>(width:1500px,height:500px)</span>
      <input type="file" class="form-control" name="file" placeholder="صورة" required="required">
      <!----------------Start PDF -------------->
        <label  class="col-sm-2 control-label">PDF</label>
        <input type="file" class="form-control" name="pdf" placeholder="PDF" required="required">
    <!----------------Start Sent -------------->
        <button type="submit" class="start-btn blue">اضافة</button>
  </form>
    <?php
  }
  ?>

<?php
}elseif($do == 'insert'){

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  //Get User Data From Form
  // $img    =$_POST['file'];
  // $pdf    =$_POST['pdf'];

  //php validation

$formErrors=array();

  // if(empty($img)){
  //   $formErrors[] = "Image Required";
  // }
  // if(empty($pdf)){
  //   $formErrors[] = "PDF Required";
  // }

  foreach ($formErrors as $error){
  echo "<div class='alert alert-danger'>$error</div>";
  }
  //Update In Database
  if (empty($formErrors)){

      upload("file","","../data/uploads/");
      upload2("pdf","","../data/uploads/");
      sql("INSERT INTO ithraa (image,pdf)
              VALUES ('$insert_src','$insert_src2')","");
  $Msg = "<div class='alert alert-success'>تمت الاضافة بنجاح</div>";
  redirect($Msg,'back');
}
}else{
  $Msg='<div class="alert alert-danger">Wrong Request</div>';
  redirect($Msg,'back');
}



}elseif($do == 'edit'){

$edit_about = sql("SELECT * FROM ithraa","fetch");

  ?>
  <h3 class="table-title"><span>تعديل</span><i class="fa fa-building" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=update" method="post" enctype="multipart/form-data">
    <!----------------Start Description -------------->
    <!----------------Start Image -------------->
      <label  class="col-sm-2 control-label">صورة</label>
      <input type="file" class="form-control" name="file" placeholder="Image">
      <input type="hidden"  class="form-control" name="oldfile" value="<?php echo $edit_about['image'] ?>">
      <!----------------Start PDF -------------->
        <label  class="col-sm-2 control-label">PDF</label>
        <input type="file" class="form-control" name="pdf" placeholder="PDF">
        <input type="hidden"  class="form-control" name="oldfile2" value="<?php echo $edit_about['pdf'] ?>">

  <!----------------Start Sent -------------->
      <button type="submit" class="start-btn blue">تعديل</button>
</form>
  </div>
<div class="col-md-8">
<?php
}elseif($do == 'update'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Get User Data From Form
    $oldfile          =$_POST['oldfile'];
    $oldfile2         =$_POST['oldfile2'];
    //Update In Database
      upload("file",$oldfile,"../data/uploads/");
      upload2("pdf",$oldfile2,"../data/uploads/");
      sql("UPDATE ithraa SET image = '$insert_src',pdf = '$insert_src2'","");
      echo "<div class='success'>";
      $Msg = "<p>Updated Successfully</p>";
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
