<?php
$pageTitle ="clients";
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
  pages();
echo "<h3 class='table-title'><span>عملائنا</span><i class='fa fa-building' aria-hidden='true'></i></h3>";
  $sort = 'ASC';
  $sort_array = array('ASC','DESC');
  if (isset($_GET['sort']) && in_array($_GET['sort'],$sort_array)){
     $sort = $_GET['sort'];
  }

  //Select Categories Data From database
                   $clients = sql("SELECT clients.*,categories.name AS category
                                    FROM clients INNER JOIN categories ON categories.cat_id = clients.cat_id
                                    ORDER BY client_id Desc LIMIT $page_start,$page_items","fetchAll");

  // $clients = sql("SELECT * FROM clients ORDER By client_id DESC  LIMIT $page_start,$page_items","fetchAll");

?>




<table class="table">
<thead>
  <tr>
    <th>مسلسل</th>
    <th>الشعار</th>
    <th>الاسم</th>
    <th>الفرع</th>
    <th>التحكم</th>
  </tr>
    </thead>
          <?php
          $num = 1;
          foreach ($clients as $client) {
            echo "<tr>";
            echo "<td>$num</td>";
            echo "<td><img style='width:100px;height:100px;' src='../$client[image]' /></td>";
            echo "<td>$client[name]</td>";
            echo "<td>$client[category]</td>";
            echo "<td><a href='?do=edit&client_id=$client[client_id]' class='start-btn green'><i class='fa fa-edit'></i>تعديل</a>
            <a href='?do=delete&client_id=$client[client_id]' class='confirm start-btn orangered confirm'><i class='fa fa-close'></i>حذف</a></td>";
            $num++;
           }
            echo"</tr>";
          ?>
        </table>
        <a href="?do=add" class="start-btn blue add"><i class="fa fa-plus"></i> اضافة جديد</a>
<?php
pages_links("clients");
}
elseif($do == 'add'){
?>
    <h3 class="table-title"><span>اضافة عميل جديد</span><i class="fa fa-users" aria-hidden="true"></i></h3>
    <div class="child-page">
    <form class="form" action="?do=insert" method="post" enctype="multipart/form-data">
    <label>الاسم</label>
    <input type="text" name="name" placeholder="Name" required="required">
    <label>الفرع</label>
    <select name="branch">
      <?php
      //Select Categories Data From database
      $cats = sql("SELECT * FROM categories ORDER BY cat_id","fetchAll");
      foreach ($cats as $cat) {
      echo "<option value='$cat[cat_id]'> $cat[name]</option>";
    }
      ?>
    </select>
    <label>الصورة</label> <span>(width:200px,height:170px)</span>
    <input type="file" name="file" placeholder="الصورة" required="required">
  <!----------------Start Sent -------------->
      <button type="Add Category" class="start-btn blue">اضف جديد</button>
</form>
  </div>
<?php
}
elseif($do == 'insert'){
  $name      =$_POST['name'];
  $brunch    =$_POST['branch'];
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  echo '<h3>Insert Client</h3>';

      upload("file","","../data/uploads/");
    sql("INSERT INTO clients (image,name,cat_id)
    VALUES ('$insert_src','$name','$brunch')","");

  $Msg = "<div class='alert alert-success'>تمت الاضافة بنجاح</div>";
  redirect($Msg,'back');

  }else{
  $Msg='<div class="alert alert-danger">Wrong Request</div>';
  redirect($Msg,'back');
  }


}
elseif($do == 'edit'){
  $Msg ="<div class='alert alert-danger'>Wrong Request</div>";
  $client_id = isset($_GET['client_id']) && is_numeric($_GET['client_id'])?intval($_GET['client_id']) : redirect($Msg,'back');
  //Select Category Data From database
  $client = sql("SELECT * FROM clients WHERE client_id = '$client_id'","fetch");
  ?>
  <h3 class="table-title"><span>تعديل</span><i class="fa fa-users" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=update" method="post" enctype="multipart/form-data">
    <input type="hidden" name="client_id" value="<?php echo $client_id ?>">
    <label>الاسم</label>
    <input type="text" name="name" placeholder="الاسم" value="<?php echo $client['name'] ?>">
    <label>الفرع </label>
    <select name="branch">
      <?php
      //Select branches Data From database
      $cats = sql("SELECT * FROM categories ORDER BY cat_id","fetchAll");
      foreach ($cats as $cat) {
      echo "<option value='$cat[cat_id]'";  if ($client['cat_id'] == $cat['cat_id']) {echo 'selected';} echo "> $cat[name]</option>";

    }
      ?>
    </select>
  <!----------------Start Category Parent -------------->
    <label  class="col-sm-2 control-label">الصورة</label>
      <input type="hidden"  class="form-control" name="oldfile" value="<?php echo $client['image'] ?>">
      <input type="file" class="form-control" name="file" placeholder="الصورة">
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
  $oldfile   =$_POST['oldfile'];
  $id        =$_POST['client_id'];
  $name      =$_POST['name'];
  $branch    =$_POST['branch'];
  //Update In Database
  upload("file",$oldfile,"../data/uploads/");
  $update_category = sql("UPDATE clients SET image = '$insert_src',name = '$name',cat_id = '$branch'
                  WHERE client_id = '$id'","");
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
  $client_id = isset($_GET['client_id']) && is_numeric($_GET['client_id'])?intval($_GET['client_id']) : 0;
//Chick If Item Exist In Database
  $check = checkItems("client_id","clients",$client_id);
//Select User Data From database
if ($check == 1){
  $delete_category = sql("DELETE FROM clients WHERE client_id = '$client_id'","");
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
