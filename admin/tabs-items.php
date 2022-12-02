<?php
$pageTitle ="Items";
include "init.php";

if(isset($_SESSION['username'])){

$do = isset($_GET['do'])?$_GET['do'] : 'manage';

// =======================================================================//
// Items Page                                                             //
// =======================================================================//
?>
<section class="main-section box box-5">
<div class="view-data">
<div class="page-container">
<?php
//Pending Items
if($do =='manage'){
  $select = sql("SELECT tabs_items.*,tabs.title AS category,items.name AS item_name
                   FROM tabs_items INNER JOIN tabs ON tabs.id = tabs_items.tab
                   INNER JOIN items ON items.item_id = tabs_items.item_id
                   ORDER BY id DESC","fetchAll");


  //Select Items Data From database
  // $select = sql("SELECT * from tabs_items  ORDER BY id Desc","fetchAll");

 // $Interface_Users_Items = sql("SELECT items.*,categories.name AS category,users.username
 //                  FROM Items INNER JOIN categories ON categories.cat_id = items.cat_id
 //                  INNER JOIN users ON users.user_id = items.user_id WHERE groupid = 2 ORDER BY item_id Desc","fetchAll");
  ?>
<?php
  if(!empty($select)){
?>
  <h3 class="table-title"><span>معرض الصور</span><i class="fa fa-cubes" aria-hidden="true"></i></h3>
  <table class="main-table text-center table table-bordered">
    <thead>
      <tr>
        <th>مسلسل</th>
        <th>العنوان</th>
        <th>الوصف</th>
        <th>القسم</th>
        <th>الفعالية</th>
        <th>الصورة</th>
        <th>التحكم</th>
      </tr>
        </thead>
        <tbody>
      <?php
      $num = 1;
foreach ($select as $select_view) {
echo"<tr>";
echo"<td>$num</td>";
echo"<td>$select_view[title]</td>";
echo"<td>$select_view[description]</td>";
echo"<td>$select_view[category]</td>";
echo"<td>$select_view[item_name]</td>";
echo"<td><img style='width:100px;height:100px;' src='../$select_view[image]' /></td>";
echo"<td><div class='inline-btn'><a href='?do=edit&itemid=$select_view[id]' class='start-btn green'><i class='fa fa-edit'></i>تعديل</a>
<a href='?do=delete&itemid=$select_view[id]' class='start-btn orangered confirm'><i class='fa fa-close'></i>حذف</a>";
if($select_view['approve']==0){
  echo "<a href='?do=approve&itemid=$select_view[id]' class='start-btn dark'><i class='fa fa-check'></i>نشر</a>";
}
echo"
</div>
</td>
</tr>";
$num++;
}
}
else{
  echo "<div class='nodata'>لا يوجد بيانات لعرضها</div>";
}
        ?>
        </tbody>
  </table>
<?php
echo "<a href='?do=add' class='start-btn blue add'><i class='fa fa-plus'></i>اضافة عنصر جديد</a>";
 ?>


  <?php


} elseif($do == 'add'){
  ?>
    <h3 class="table-title"><span>اضف جديد</span><i class="fa fa-cubes" aria-hidden="true"></i></h3>
    <div class="child-page">
    <form class="form" action="?do=insert" method="post" enctype="multipart/form-data">
    <!----------------Start Name -------------->
      <label>العنوان</label>
      <input type="text" name="title" placeholder="العنوان">
    <!----------------Start Description -------------->
      <label>الوصف</label>
      <input type="text" name="description" placeholder="الوصف">
    <!----------------Start Image -------------->
      <label>الصورة</label> <span>(width:500px,height:400px)</span>
        <input type="file" class="form-control" name="file" placeholder="الصورة" required="required">
    <!----------------Start Categories -------------->
      <label>القسم</label>
      <select name="tab">
        <?php
        //Select Categories Data From database
        $select = sql("SELECT * FROM tabs ORDER BY id","fetchAll");
        foreach ($select as $select_view) {
        echo "<option value='$select_view[id]'> $select_view[title]</option>";
      }
        ?>
      </select>
      <!----------------Start Categories -------------->
        <label>الفعالية </label>
        <select name="item_id">
          <?php
          //Select Categories Data From database
          $select = sql("SELECT * FROM items ORDER BY item_id","fetchAll");
          foreach ($select as $select_view) {
          echo "<option value='$select_view[item_id]'> $select_view[name]</option>";
        }
          ?>
        </select>
      <!----------------Start Sent -------------->
        <button class="start-btn blue">اضف جديد</button>
  </form>
    </div>
  <?php

}elseif($do == 'insert'){


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo '<h3>Insert</h3>';
    //Get User Data From Form
    $title    =$_POST['title'];
    $desc     =$_POST['description'];
    $tab      =$_POST['tab'];
    $item_id  =$_POST['item_id'];

    //php validation

  $formErrors=array();


      if(empty($tab)){
      $formErrors[] = "القسم مطلوب";
    }


    foreach ($formErrors as $error){
    echo "<div class='alert alert-danger'>$error</div>";
    }
    //Update In Database

    if (empty($formErrors)){
     upload("file","","../data/uploads/");
      sql("INSERT INTO tabs_items (title, description,tab,item_id,image)
              VALUES ('$title', '$desc','$tab','$item_id','$insert_src')","");
    $Msg = "<div class='alert alert-success'>تمت الاضافة</div>";
    redirect($Msg,'back');

  }
  }else{
    echo "<div class='success'>";
    $Msg = "<p>تم التحديث</p>";
    redirect($Msg,'back');
    echo "</div>";
  }
  echo "</div>";
}elseif($do == 'edit'){
  $Msg ="<div class='alert alert-danger'>Wrong Request</div>";
  $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'])?intval($_GET['itemid']) : redirect($Msg,'back');
//Select Item Data From database
$item = sql("SELECT * FROM tabs_items WHERE id ='$itemid'","fetch");
  ?>
  <h3 class="table-title"><span>تعديل</span><i class="fa fa-cubes" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=update" method="post" enctype="multipart/form-data">
  <input type="hidden" name="itemid" value="<?php echo $itemid ?>">
  <!----------------Start Name -------------->
    <label  class="col-sm-2 control-label">العنوان</label>
      <input
      type="text"
      class="form-control"
      name="title"
      placeholder="العنوان"
      value="<?php echo $item['title']; ?>">
  <!----------------Start Description -------------->
    <label  class="col-sm-2 control-label">الوصف</label>
      <input
      type="text"
      class="form-control"
      name="description"
      placeholder="الوصف"
      value="<?php echo $item['description']; ?>">
  <!----------------Start Categories -------------->
    <label  class="col-sm-2 control-label">القسم </label>
    <select name="tab" class="form-control">
      <?php
      //Select Categories Data From database
      $select = sql("SELECT * FROM tabs ORDER BY id","fetchAll");
      foreach ($select as $tab) {
      echo "<option value='$tab[id]'";  if ($item['tab'] == $tab['id']) {echo 'selected';} echo "> $tab[title]</option>";
    }
      ?>
    </select>
    <!----------------Start Categories -------------->
      <label  class="col-sm-2 control-label">الفعالية </label>
      <select name="item_id" class="form-control">
        <?php
        //Select Categories Data From database
        $select = sql("SELECT * FROM items ORDER BY item_id","fetchAll");
        foreach ($select as $tab) {
        echo "<option value='$tab[item_id]'";  if ($item['item_id'] == $tab['item_id']) {echo 'selected';} echo "> $tab[name]</option>";
      }
        ?>
      </select>
  <!----------------Start Image -------------->
    <label>الصورة</label>
      <input type="hidden" name="oldfile" value="<?php echo $item['image'] ?>">
      <input type="file" name="file" placeholder="الصورة" >
    <!----------------Start Sent -------------->
      <button type="Add Item" class="start-btn blue">تعديل</button>
</form>
  </div>
<?php
}elseif($do == 'update'){

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo '<h3>update</h3>';

  //Get Item Data From Form

  $id        =$_POST['itemid'];
  $title     =$_POST['title'];
  $desc      =$_POST['description'];
  $tab       =$_POST['tab'];
  $item_id   =$_POST['item_id'];
  $oldfile   =$_POST['oldfile'];

  //Update In Database
        upload("file",$oldfile,"../data/uploads/");
        $update_items = sql("UPDATE tabs_items SET title = '$title', description = '$desc',
                        tab = '$tab',item_id = '$item_id',image='$insert_src'
                        WHERE id = '$id'","");
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
elseif($do == 'delete'){
  //Delete Item Page
  echo"<h1>Delete Item</h1>
  <div class='container'>";
  $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'])?intval($_GET['itemid']) : 0;
//Chick If Item Exist In Database
  $check = checkItems("id","tabs_items",$itemid);
//Select Item Data From database
if ($check == 1){
       sql("DELETE FROM tabs_items WHERE id = '$itemid'","");

  $Msg = "<div class='alert alert-success'>تم الحذف بنجاح</div>";
    redirect($Msg,'back');
}else{
  $Msg ="This Id Is Not Exist";
  redirect($Msg,'back');
}
echo"</div>";


}elseif($do == 'approve'){

  //Delete User Page
  echo"<h1>Approve Items</h1>
  <div class='container'>";
  $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'])?intval($_GET['itemid']) : 0;
//Chick If Item Exist In Database
  $check = checkItems("id","tabs_items",$itemid);
//Select User Data From database
if ($check == 1){
  sql("UPDATE tabs_items SET approve = 1 WHERE id ='$itemid'","");

  $Msg = "<div class='alert alert-success'>تم النشر</div>";
  redirect($Msg,'back');
}else{
  $Msg ="This Id Is Not Exist";
  redirect($Msg,'back');
}
echo"</div>";


}else{
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
