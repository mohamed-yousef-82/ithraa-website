<?php
$pageTitle ="Accordion";
include "init.php";

if(isset($_SESSION['username'])){

$do = isset($_GET['do'])?$_GET['do'] : 'manage';
?>
<section class="main-section box box-5">
<div class="view-data">
  <div class="page-container">
  <?php
//Pending Users
if($do =='manage'){
echo "<h3 class='table-title'><span>اقسام البوم الصور</span><i class='fa fa-building' aria-hidden='true'></i></h3>";
  //Select Categories Data From database
  $select = sql("SELECT * FROM tabs ORDER By id DESC ","fetchAll");
?>
<table class="table">
<thead>
  <tr>
    <th>مسلسل</th>
    <th>القسم</th>
    <th>التحكم</th>
  </tr>
  </thead>
          <?php
          $num = 1;
          foreach ($select as $selectview) {
            echo "<tr>";
            echo "<td>$num</td>";
            echo "<td>$selectview[title]</td>";
            echo "<td><a href='?do=edit&id=$selectview[id]' class='start-btn green'><i class='fa fa-edit'></i>تعديل</a>
            <a href='?do=delete&id=$selectview[id]' class='confirm start-btn orangered confirm'><i class='fa fa-close'></i>حذف</a></td>";
            $num++;
           }
            echo"</tr>";
          ?>
        </table>
        <a href="?do=add" class="start-btn blue add"><i class="fa fa-plus"></i> اضف جديد</a>
<?php
}
elseif($do == 'add'){
?>
    <h3 class="table-title"><span>اضف عنصر جديد</span><i class="fa fa-users" aria-hidden="true"></i></h3>
    <div class="child-page">
    <form class="form" action="?do=insert" method="post" enctype="multipart/form-data">
    <label>العنوان</label>
    <input type="text" name="title" placeholder="Title" required="required">
  <!----------------Start Sent -------------->
    <button class="start-btn blue">اضف جديد</button>
</form>
  </div>
<?php
}
elseif($do == 'insert'){
  $title = $_POST['title'];
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  echo '<h3>Insert New</h3>';
    sql("INSERT INTO tabs (title)
    VALUES ('$title')","");
  $Msg = "<div class='alert alert-success'>تمت الاضافة بنجاح</div>";
  redirect($Msg,'back');

  }else{
  $Msg='<div class="alert alert-danger">Wrong Request</div>';
  redirect($Msg,'back');
  }


}
elseif($do == 'edit'){
  $Msg ="<div class='alert alert-danger'>Wrong Request</div>";
  $id = isset($_GET['id']) && is_numeric($_GET['id'])?intval($_GET['id']) : redirect($Msg,'back');
  //Select Category Data From database
  $select = sql("SELECT * FROM tabs WHERE id = '$id'","fetch");
  ?>
  <h3 class="table-title"><span>تعديل</span><i class="fa fa-users" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=update" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $id ?>">
  <!----------------Start Category Parent -------------->
  <label>اسم القسم</label>
  <input type="text" name="title" value="<?php echo $select['title'] ?>">
  <!----------------Start Sent -------------->
  <button type="Update" class="start-btn blue">تعديل</button>
  </form>
  </div>
<?php

}
elseif($do == 'update'){
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo '<h3>update</h3>';

  //Get User Data From Form
  $title = $_POST['title'];
  $id     =$_POST['id'];
  //Update In Database
  $update = sql("UPDATE tabs SET title = '$title'
                  WHERE id = '$id'","");
                  echo "<div class='success'>";
                  $Msg = "<p>تم التحديث بنجاح</p>";
                  redirect($Msg,'back');
                  echo "</div>";

}else{
  $Msg = 'no allow';
  redirect($Msg,'back');
}


}
elseif($do == 'delete'){
  //Delete Category Page
  echo"
  <div class='container'>";
  $id = isset($_GET['id']) && is_numeric($_GET['id'])?intval($_GET['id']) : 0;
//Chick If Item Exist In Database
  $check = checkItems("id","tabs",$id);
//Select User Data From database
if ($check == 1){
  $delete = sql("DELETE FROM tabs WHERE id = '$id'","");
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
