<?php
$pageTitle ="categories";
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
  $sort = 'ASC';
  $sort_array = array('ASC','DESC');
  if (isset($_GET['sort']) && in_array($_GET['sort'],$sort_array)){
     $sort = $_GET['sort'];
  }

  //Select Categories Data From database
  $category = sql("SELECT * FROM categories ORDER By cat_id DESC LIMIT $page_start,$page_items","fetchAll");

?>
<h3 class="table-title"><span>الاقسام</span><i class="fa fa-sitemap" aria-hidden="true"></i></h3>


<!-- <div class="ordering pull-right">
  <a href="?sort=ASC" class="<? if ($sort == 'ASC') {echo 'active';} ?>">ASC</a>
  <a href="?sort=DESC" class="<? if ($sort == 'DESC') {echo 'active';} ?>">DESC</a>

</div> -->
        </h3>
        <table class="table">
        <thead>
          <tr>
            <th>مسلسل</th>
            <th>القسم</th>
            <th>الوصف</th>
            <th>الصورة</th>
            <th>التحكم</th>
          </tr>
            </thead>
           <tbody>
          <?php
          $num = 1;
          foreach ($category as $cat) {
            echo"<tr>";
            echo"<td>$num</td>";
            echo"<td>$cat[name]</td>";
            echo"<td>$cat[description]</td>";
            echo"<td><img style='width:100px;height:100px;' src='../$cat[image]' /></td>";
            echo"<td><a href='?do=edit&catid=$cat[cat_id]' class='start-btn green'><i class='fa fa-edit'></i>Edit</a>
            <a href='?do=delete&catid=$cat[cat_id]' class='confirm start-btn orangered confirm'><i class='fa fa-close'></i>Delete</a></td>";
            // Get Sub Categoriey
            echo "<ul>";
          //  $subcategories = select("*","categories","where parent = $cat[ID]","","ID");
          //  $subcategories = sql("SELECT * FROM categories WHERE parent = $cat[cat_id] ORDER By cat_id","fetchAll");
          //  foreach ($subcategories as $subcat) {
          //   echo "<li>";
          //   echo $subcat['name'];
          //   echo"<a href='?do=edit&catid=$subcat[cat_id]' class='start-btn green'><i class='fa fa-edit'></i>Edit</a>
          //   <a href='?do=delete&catid=$subcat[cat_id]' class='confirm start-btn orangered confirm'><i class='fa fa-close'></i>Delete</a>";
          //   echo "</li>";
          //   echo "</ul>";
          //   echo"<tr>";
          //  }
           $num++;
          }
          ?>
          </tbody>
  </table>

        <a href="?do=add" class="start-btn blue add"><span class="fa fa-plus"></span>اضف جديد</a>
<?php
pages_links("categories");
}
elseif($do == 'add'){
?>
  <h3 class="table-title"><span>اضف فرع جديد</span><i class="fa fa-sitemap" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=insert" method="post" enctype="multipart/form-data">
  <!----------------Start Name -------------->
    <label  class="col-sm-2 control-label">الاسم</label>
    <input type="text" class="form-control" name="name" placeholder="الاسم" required="required">
  <!----------------Start Description-------------->
    <label  class="col-sm-2 control-label">الوصف</label>
    <input type="text"  class="form-control" name="description"  placeholder="الوصف">
    <!----------------Start Image -------------->
      <label  class="col-sm-2 control-label">الصورة</label> <span>(width:1000px,height:1000px)</span>
      <input type="file"  name="file" placeholder="Image" required="required">
  <!----------------Start Sent -------------->
      <button type="Add Category" class="start-btn blue">تعديل</button>
</form>
</div>
<?php
}
elseif($do == 'insert'){
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  echo '<h3>Insert Category</h3>';
  //Get Category Data From Form
  $name      =$_POST['name'];
  $desc      =$_POST['description'];

    // Check If Category Exit In Database
    $check = checkItems("name","categories",$name);
    if($check == 1){
      $Msg = 'Sorry This category Id Exist';
      redirect($Msg,'back');
    }else{
    upload("file","","../data/uploads/");
    sql("INSERT INTO categories (name, description,image)
    VALUES ('$name','$desc','$insert_src')","");
  $Msg = "<div class='alert alert-success'>Inserted Successfully</div>";
  redirect($Msg,'back');
  }
  }else{
  $Msg='<div class="alert alert-danger">Wrong Request</div>';
  redirect($Msg,'back');
  }
}
elseif($do == 'edit'){
  $Msg ="<div class='alert alert-danger'>Wrong Request</div>";
  $catid = isset($_GET['catid']) && is_numeric($_GET['catid'])?intval($_GET['catid']) : redirect($Msg,'back');
//Select Category Data From database
$cat = sql("SELECT * FROM categories WHERE cat_id = '$catid'","fetch");
if ($count == 1){
  ?>
  <h3 class="table-title"><span>تعديل القسم</span><i class="fa fa-sitemap" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=update" method="post" enctype="multipart/form-data">
    <input type="hidden" name="catid" value="<?php echo $catid ?>">
  <!----------------Start Name -------------->
    <label  class="col-sm-2 control-label">الاسم</label>
    <input type="text" class="form-control" name="name" placeholder="الاسم" required="required" value="<?php echo $cat['name']?>">
  <!----------------Start Description-------------->
    <label>الوصف</label>
      <input type="text"  class="form-control" name="description"  placeholder="الوصف" value="<?php echo $cat['description']?>">
    <!----------------Start Image -------------->
      <label  class="col-sm-2 control-label">الصورة</label>
      <input type="hidden"  class="form-control" name="oldfile" value="<?php echo $cat['image'] ?>">
      <input type="file" class="form-control" name="file" placeholder="الصورة" >
  <!----------------Start Sent -------------->
      <button type="Update" class="start-btn blue">تحديث</button>
  </form>
  </div>
<?php
}
}
elseif($do == 'update'){
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo '<h3>update</h3>';

  //Get User Data From Form

  $id        =$_POST['catid'];
  $name      =$_POST['name'];
  $desc      =$_POST['description'];
  $oldfile   =$_POST['oldfile'];

  //Update In Database
  upload("file",$oldfile,"../data/uploads/");
  $update_category = sql("UPDATE categories SET name = '$name',description = '$desc',
              image = '$insert_src'
                  WHERE cat_id = '$id'","");
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
  $catid = isset($_GET['catid']) && is_numeric($_GET['catid'])?intval($_GET['catid']) : 0;
//Chick If Item Exist In Database
  $check = checkItems("cat_id","categories",$catid);
//Select User Data From database
if ($check == 1){
  $delete_category = sql("DELETE FROM categories WHERE cat_id = '$catid'","");
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
echo "</section>";
include "$str/footer.php";
?>
