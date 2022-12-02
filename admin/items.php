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
  pages();
  // $items_Count = sql("SELECT * FROM items LIMIT $page_start,3","fetch");

  //Select Items Data From database
  $items = sql("SELECT items.*,categories.name AS category
                   FROM items INNER JOIN categories ON categories.cat_id = items.cat_id
                   ORDER BY item_id DESC LIMIT $page_start,$page_items","fetchAll");
  ?>
<?php
  if(!empty($items)){
?>
  <h3 class="table-title"><span>عناصر الفعاليات </span><i class="fa fa-cubes" aria-hidden="true"></i></h3>
  <div class="table-container">
  <table class="main-table text-center table table-bordered">
    <thead>
      <tr>
        <th>التسلسل</th>
        <th>العنوان</th>
        <th>تاريخ الديوانية</th>
        <th>فرع الديوانية</th>
        <th>رقم الديوانية</th>
        <th>اسم المؤلف</th>
        <th>اسم الملقى</th>
        <th>نبذة عن الملقى</th>
        <th>رقم التواصل </th>
        <th>رابط التسجيل </th>
        <th>صورة الاعلان</th>
        <th>صورة الكتاب </th>
        <th> صور الفعالية 1</th>
        <th> صور الفعالية 2</th>
        <th> صور الفعالية 3</th>
        <th>الفيديو </th>
        <th>pdf</th>
        <th>التحكم</th>
      </tr>
        </thead>
        <tbody>
      <?php
      $num = 1;
foreach ($items as $item) {
echo"<tr>";
echo"<td>$num</td>";
echo"<td>$item[name]</td>";
echo"<td>$item[add_date]</td>";
echo"<td>$item[category]</td>";
echo"<td>$item[numb]</td>";
echo"<td>$item[auther]</td>";
echo"<td>$item[deliver]</td>";
echo"<td>$item[deliver_pref]</td>";
echo"<td>$item[contact_number]</td>";
echo"<td><a href='$item[link]' target='_blank'>$item[link]</a></td>";
echo"<td><img style='width:100px;height:100px;' src='../$item[image]' /></td>";
echo"<td><img style='width:100px;height:100px;' src='../$item[book]' /></td>";
echo"<td><img style='width:100px;height:100px;' src='../$item[photo]' /></td>";
echo"<td><img style='width:100px;height:100px;' src='../$item[photo2]' /></td>";
echo"<td><img style='width:100px;height:100px;' src='../$item[photo3]' /></td>";
echo"<td><iframe width='80' height='80' src='$item[video]' frameborder='0' allowfullscreen></iframe></td>";
echo"<td><a href='$item[pdf]' target='_blank'>$item[pdf]</a></td>";
echo"<td><div class='inline-btn'><a href='?do=edit&itemid=$item[item_id]' class='start-btn green'><i class='fa fa-edit'></i>تعديل</a>
<a href='?do=delete&itemid=$item[item_id]' class='start-btn orangered confirm'><i class='fa fa-close'></i>حذف</a>";
if($item['approve']==0){
  echo "<a href='?do=approve&itemid=$item[item_id]' class='start-btn dark'><i class='fa fa-check'></i>نشر</a>";
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
</div>
  <?php
  echo "<a href='?do=add' class='start-btn blue add'><i class='fa fa-plus'></i>اضف جديد</a>";
  pages_links("items");
} elseif($do == 'add'){
  ?>
    <h3 class="table-title"><span>اضف فعالية جديدة </span><i class="fa fa-cubes" aria-hidden="true"></i></h3>
    <div class="child-page">
    <form class="form" action="?do=insert" method="post" enctype="multipart/form-data">
    <!----------------Start Name -------------->
      <label  class="col-sm-2 control-label">اسم الكتاب </label>
      <input type="text" class="form-control" name="name" placeholder="اسم الكتاب " required="required">
    <!----------------Start Image -------------->
      <label  class="col-sm-2 control-label">صورة الاعلان</label><span>(width:1500px,height:1000px)</span>
        <input type="file" class="form-control" name="file" placeholder="صورة الاعلان">
    <!----------------Start Image -------------->
      <label  class="col-sm-2 control-label">صورة الكتاب </label><span>(A4)</span>
        <input type="file" class="form-control" name="book" placeholder="صورة الكتاب ">
        <!----------------Start Image -------------->
        <label  class="col-sm-2 control-label"> صور الفعالية 1</label>
        <input type="file" class="form-control" name="photo" placeholder=" صور الفعالية 1">
        <!----------------Start Image -------------->
        <label  class="col-sm-2 control-label"> صور الفعالية 2</label>
        <input type="file" class="form-control" name="photo2" placeholder="صور الفعالية 2">
        <!----------------Start Image -------------->
        <label  class="col-sm-2 control-label">  صور الفعالية 3 </label>
        <input type="file" class="form-control" name="photo3" placeholder=" صور الفعالية 3">
        <!----------------Start Image -------------->
          <label  class="col-sm-2 control-label"> الفيديو</label>
            <input type="url" class="form-control" name="video" placeholder="الفيديو ">
    <!----------------Start Image -------------->
      <label  class="col-sm-2 control-label">ملف pdf</label><span>(width:1500px,height:1000px)</span>
        <input type="file" class="form-control" name="pdf" placeholder="pdf" >
    <!----------------Start Categories -------------->
      <label  class="col-sm-2 control-label">فرع الديوانية </label>
      <select name="category" class="form-control">
        <?php
        //Select Categories Data From database
        $cats = sql("SELECT * FROM categories ORDER BY cat_id","fetchAll");
        foreach ($cats as $cat) {
        echo "<option value='$cat[cat_id]'> $cat[name]</option>";
      }
        ?>
      </select>
<!----------------Start Number -------------->
<label class="col-sm-2 control-label">رقم الديوانية </label>
<input type="number" class="form-control" name="numb" placeholder="رقم الديوانية" required="required">
<!----------------Start Number -------------->
<label class="col-sm-2 control-label">تاريخ الديوانية </label>
<input type="text" class="form-control" name="add_date" placeholder="تاريخ الديوانية " required="required">
<!----------------Start Guest -------------->
<label  class="col-sm-2 control-label" style="display:none;">اسم الضيف </label>
<input type="text" class="form-control" name="guest" placeholder="اسم الضيف" style="display:none;">
<!----------------Start Guest Pref -------------->
<label  class="col-sm-2 control-label" style="display:none;">نبذة عن الضيف </label>
<textarea  name="guest_pref" placeholder="نبذة عن الضيف"  style="display:none;"></textarea>
<!----------------Start Auther -------------->
<label  class="col-sm-2 control-label">اسم المؤلف</label>
<input type="text" class="form-control" name="auther" placeholder="اسم المؤلف" required="required">
<!----------------Start Guest -------------->
<label  class="col-sm-2 control-label">اسم الملقى </label>
<input type="text" class="form-control" name="deliver" placeholder="اسم الملقى" required="required">
<!----------------Start Guest Pref -------------->
<label  class="col-sm-2 control-label">نبذة عن الملقى </label>
<textarea  name="deliver_pref" placeholder="نبذة عن الملقى " required="required"></textarea>
<!----------------Start Contact Number -------------->
<label  class="col-sm-2 control-label">رقم التواصل </label>
<input type="number" class="form-control" name="contact_number" placeholder="رقم التواصل" required="required">
<!----------------Start Guest -------------->
<label  class="col-sm-2 control-label">رابط التسجيل </label>
<input type="text" class="form-control" name="link" placeholder="رابط التسجيل" >
<!----------------Start Sent -------------->
<button type="Add Item" class="start-btn blue">اضف جديد</button>
  </form>
    </div>
  <?php

}elseif($do == 'insert'){


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo '<h3>Insert</h3>';
    //Get User Data From Form

    $name      =$_POST['name'];
    $category  =$_POST['category'];
    $video     =$_POST['video'];
    $add_date  =$_POST['add_date'];
    $number          =$_POST['numb'];
    $guest           =$_POST['guest'];
    $guest_pref      =$_POST['guest_pref'];
    $auther          =$_POST['auther'];
    $deliver         =$_POST['deliver'];
    $deliver_pref    =$_POST['deliver_pref'];
    $contact_number  =$_POST['contact_number'];
    $link  =$_POST['link'];

    //php validation

  $formErrors=array();

    if(empty($name)){
      $formErrors[] = "الاسم مطلوب";
    }


    if(($category) === 0){
      $formErrors[] = "القسم مطلوب";
    }



    foreach ($formErrors as $error){
    echo "<div class='alert alert-danger'>$error</div>";
    }
    //Update In Database

    if (empty($formErrors)){
    upload("file","","../data/uploads/");
    upload2("pdf","","../data/uploads/");
    upload3("book","","../data/uploads/");
    upload4("photo","","../data/uploads/");
    upload5("photo2","","../data/uploads/");
    upload6("photo3","","../data/uploads/");
    sql("INSERT INTO items (name,add_date,cat_id,image,book,photo,photo2,photo3,numb,guest,guest_pref,auther,deliver,deliver_pref,contact_number,link,pdf,video)
    VALUES ('$name','$add_date','$category','$insert_src','$insert_src3','$insert_src4','$insert_src5','$insert_src6','$number','$guest','$guest_pref','$auther','$deliver','$deliver_pref','$contact_number','$link','$insert_src2','$video')","");
    $Msg = "<div class='alert alert-success'>تمت الاضافة بنجاح</div>";
    redirect($Msg,'back');
  }
  }else{
    echo "<div class='success'>";
    $Msg = "<p>تم التحديث بنجاح</p>";
    redirect($Msg,'back');
    echo "</div>";
  }
  echo "</div>";
}elseif($do == 'edit'){
  $Msg ="<div class='alert alert-danger'>Wrong Request</div>";
  $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'])?intval($_GET['itemid']) : redirect($Msg,'back');
  //Select Item Data From database
  $item = sql("SELECT * FROM items WHERE item_id ='$itemid'","fetch");
  ?>
  <h3 class="table-title"><span>تعديل</span><i class="fa fa-cubes" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=update" method="post" enctype="multipart/form-data">
  <input type="hidden" name="itemid" value="<?php echo $itemid ?>">
  <!----------------Start Name -------------->
    <label  class="col-sm-2 control-label">الاسم</label>
      <input
      type="text"
      class="form-control"
      name="name"
      placeholder="name"
      value="<?php echo $item['name']; ?>">
  <!----------------Start Categories -------------->
    <label  class="col-sm-2 control-label">الاقسام</label>
    <select name="category" class="form-control">
      <?php
      //Select Categories Data From database
      $cats = sql("SELECT * FROM categories ORDER BY cat_id","fetchAll");
      foreach ($cats as $cat) {
      echo "<option value='$cat[cat_id]'";  if ($item['cat_id'] == $cat['cat_id']) {echo 'selected';} echo "> $cat[name]</option>";
    }
      ?>
    </select>
  <!----------------Start Image -------------->
    <label  class="col-sm-2 control-label">الصورة</label> <span>(width:1000px,height:500px)</span>
    <input type="hidden"  class="form-control" name="oldfile" value="<?php echo $item['image'] ?>">
    <input type="file" class="form-control" name="file" placeholder="Image" >
    <br/>
    <img style='width:100px;height:100px;display:block' src='../<?php echo $item['image'] ?>' />
    <!----------------Start Image -------------->
      <label  class="col-sm-2 control-label">صورة الكتاب </label> <span>(A4)</span>
      <input type="hidden"  class="form-control" name="oldfile3" value="<?php echo $item['book'] ?>">
      <input type="file" class="form-control" name="book" placeholder="صورة الكتاب" >
      <br/>
      <img style='width:100px;height:100px;display:block' src='../<?php echo $item['book'] ?>' />
      <!----------------Start Image -------------->
        <label  class="col-sm-2 control-label"> صور الفعالية 1</label>
        <input type="hidden"  class="form-control" name="oldfile4" value="<?php echo $item['photo'] ?>">
        <input type="file" class="form-control" name="photo" placeholder="صور الفعالية 1 " >
        <br/>
        <img style='width:100px;height:100px;display:block' src='../<?php echo $item['photo'] ?>' />
        <!----------------Start Image -------------->
          <label  class="col-sm-2 control-label">  صور الفعالية 2</label>
          <input type="hidden"  class="form-control" name="oldfile5" value="<?php echo $item['photo2'] ?>">
          <input type="file" class="form-control" name="photo2" placeholder=" صور الفعالية 2 " >
          <br/>
          <img style='width:100px;height:100px;display:block' src='../<?php echo $item['photo2'] ?>' />
          <!----------------Start Image -------------->
            <label  class="col-sm-2 control-label">  صور الفعالية 3</label>
            <input type="hidden"  class="form-control" name="oldfile6" value="<?php echo $item['photo3'] ?>">
            <input type="file" class="form-control" name="photo3" placeholder=" صور الفعالية 3" >
            <br/>
            <img style='width:100px;height:100px;display:block' src='../<?php echo $item['photo3'] ?>' />

 <!----------------Start PDF -------------->
        <label  class="col-sm-2 control-label">PDF</label>
        <input type="file" class="form-control" name="pdf" placeholder="PDF">
        <input type="hidden"  class="form-control" name="oldfile2" value="<?php echo $item['pdf'] ?>">
        <!----------------Start PDF -------------->
    <label  class="col-sm-2 control-label">الفيديو</label>
    <input  type="url" class="form-control" name="video" placeholder="video">
    <!----------------Start Number -------------->
    <label  class="col-sm-2 control-label">رقم الديوانية </label>
    <input type="number" class="form-control" name="numb" placeholder="number" value="<?php echo $item['numb']; ?>" >
    <!----------------Start Number -------------->
    <label  class="col-sm-2 control-label">تاريخ الديوانية </label>
    <input type="text" class="form-control" name="add_date" placeholder="تاريخ الديوانية " value="<?php echo $item['add_date']; ?>" >
    <!----------------Start Guest -------------->
    <label  class="col-sm-2 control-label" style="display:none;">اسم الضيف </label>
    <input type="text" style="display:none;" class="form-control" name="guest" placeholder="guest" value="<?php echo $item['guest']; ?>" >
    <!----------------Start Guest Pref -------------->
    <label  class="col-sm-2 control-label" style="display:none;">نبذة عن الضيف </label>
    <textarea  style="display:none;" name="guest_pref" placeholder="guest pref" value="<?php echo $item['guest_pref']; ?>" ></textarea>
    <!----------------Start Auther -------------->
    <label  class="col-sm-2 control-label">اسم المؤلف</label>
    <input type="text" class="form-control" name="auther" placeholder="auther" value="<?php echo $item['auther']; ?>">
    <!----------------Start Guest -------------->
    <label  class="col-sm-2 control-label">اسم الملقى </label>
    <input type="text" class="form-control" name="deliver" placeholder="deliver" value="<?php echo $item['deliver']; ?>">
    <!----------------Start Guest Pref -------------->
    <label  class="col-sm-2 control-label">نبذة عن الملقى </label>
    <textarea  name="deliver_pref" placeholder="deliver pref" value="<?php echo $item['deliver_pref']; ?>"></textarea>
    <!----------------Start Contact Number -------------->
    <label  class="col-sm-2 control-label">رقم التواصل </label>
    <input type="number" class="form-control" name="contact_number" placeholder="Contact number" value="<?php echo $item['contact_number']; ?>">
    <label  class="col-sm-2 control-label">رابط التسجيل </label>
    <input type="text" class="form-control" name="link" placeholder="رابط التسجيل" value="<?php echo $item['link']; ?>">

    <!----------------Start Sent -------------->
    <button type="Add Item" class="start-btn blue">تعديل</button>
</form>
  </div>
<?php
//Select comments Data From database
$item_comments = sql("SELECT comments.*,users.username As username FROM comments INNER JOIN users
                      ON users.user_id = comments.user_id WHERE item_id='$itemid'","fetchAll");
if(!empty($item_comments)){
?>
<h3 class="child-page">Manage <?php echo $item["name"]; ?> التعليقات </h3>
<table class="main-table text-center table table-bordered">
  <thead>
    <tr>
      <th>التعليق</th>
      <th>اسم المستخدم</th>
      <th>التاريخ</th>
      <th>التحكم</th>
      </tr>
      </thead>
      <?php
foreach ($item_comments as $row) {
echo"<tr>";
echo"<td>$row[comment]</td>";
echo"<td>$row[username]</td>";
echo"<td>$row[comment_date]</td>";
echo"<td><a href='?do=edit&comid=$row[com_id]' class='start-btn green'><i class='fa fa-edit'></i>تعديل</a>
<a href='?do=delete&comid=$row[com_id]' class='start-btn orangered confirm'><i class='fa fa-close'></i>حذف</a>";
if($row['status']==0){
echo "<a href='?do=approve&comid=$row[com_id]' class='start-btn darb'><i class='fa fa-edit'></i>نشر</a>";
}
echo"
</td>
</tr>";

}
      ?>
</table>
<?php
}
// }else{
//   $Msg='<div class="alert alert-danger">Wrong Request</div>';
//   redirect($Msg,'back');
// }
}elseif($do == 'update'){

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo '<h3>update</h3>';

  //Get Item Data From Form

  $id        =$_POST['itemid'];
  $name      =$_POST['name'];
  $category  =$_POST['category'];
  $add_date  =$_POST['add_date'];
  $oldfile   =$_POST['oldfile'];
 $oldfile2   =$_POST['oldfile2'];
 $oldfile3   =$_POST['oldfile3'];
 $oldfile4   =$_POST['oldfile4'];
 $oldfile5   =$_POST['oldfile5'];
 $oldfile6   =$_POST['oldfile6'];
  $number          =$_POST['numb'];
  $video          =$_POST['video'];
  $guest           =$_POST['guest'];
  $guest_pref      =$_POST['guest_pref'];
  $auther          =$_POST['auther'];
  $deliver         =$_POST['deliver'];
  $deliver_pref    =$_POST['deliver_pref'];
  $contact_number  =$_POST['contact_number'];
  $link            =$_POST['link'];

  //Update In Database
        upload("file",$oldfile,"../data/uploads/");
        upload2("pdf",$oldfile2,"../data/uploads/");
        upload3("book",$oldfile3,"../data/uploads/");
        upload4("photo",$oldfile4,"../data/uploads/");
        upload5("photo2",$oldfile5,"../data/uploads/");
        upload6("photo3",$oldfile6,"../data/uploads/");
        $update_items = sql("UPDATE items SET name = '$name',numb = '$number',guest = '$guest',add_date = '$add_date',video = '$video',
                        guest_pref = '$guest_pref',auther = '$auther',deliver = '$deliver',deliver_pref = '$deliver_pref',contact_number = '$contact_number',
                        cat_id = '$category',image='$insert_src',link='$link',pdf = '$insert_src2',book = '$insert_src3',photo = '$insert_src4',photo2 = '$insert_src5',photo3 = '$insert_src6'
                        WHERE item_id = '$id'","");
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
  $check = checkItems("item_id","items",$itemid);
//Select Item Data From database
if ($check == 1){
       sql("DELETE FROM items WHERE item_id = '$itemid'","");

  $Msg = "<div class='alert alert-success'>تم الحذف بنجاح</div>";
    redirect($Msg,'back');
}else{
  $Msg ="This Id Is Not Exist";
  redirect($Msg,'back');
}
echo"</div>";


}elseif($do == 'approve'){

  //Delete User Page
  echo"
  <div class='container'>";
  $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'])?intval($_GET['itemid']) : 0;
//Chick If Item Exist In Database
  $check = checkItems("item_id","items",$itemid);
//Select User Data From database
if ($check == 1){
  sql("UPDATE items SET approve = 1 WHERE item_id ='$itemid'","");

  $Msg = "<div class='alert alert-success'>تم النشر بنجاح</div>";
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
