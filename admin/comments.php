<?php
$pageTitle ="comments";
include "init.php";

if(isset($_SESSION['username'])){

$do = isset($_GET['do'])?$_GET['do'] : 'manage';
//Manage Page
?>
<section class="main-section box box-5">
<div class="view-data">
  <div class="page-container">
<h3 class="table-title">التعليقات</h3>
<?php
if($do =='manage'){
  pages();
  //Select comments Data From database
  $Admin_Comments = sql("SELECT comments.*,items.name As item_name,users.username As username,users.image As image
                  FROM comments INNER JOIN items ON items.Item_ID = comments.item_id
                  INNER JOIN users ON users.user_id = comments.user_id ORDER BY com_id Desc LIMIT $page_start,$page_items","fetchAll");
  if(!empty($data)){
  ?>



  <table class="main-table text-center table table-bordered">
    <thead>
      <tr>
        <th>مسلسل</th>
        <th>التعليق</th>
        <th>اسم العنصر</th>
        <th>المستخدم </th>
        <th>التاريخ</th>
        <th>الصورة</th>
        <th>التحكم </th>
      </tr>
        </thead>
        <?php
foreach ($Admin_Comments as $row) {
echo"<tr>";
echo"<td>$row[com_id]</td>";
echo"<td>$row[comment]</td>";
echo"<td>$row[item_name]</td>";
echo"<td>$row[username]</td>";
echo"<td>$row[comment_date]</td>";
echo"<td><img style='width:100px;height:100px;' src='../$row[image]' /></td>";
echo"<td>
<a href='?do=delete&comid=$row[com_id]' class='btn btn-danger confirm'><i class='fa fa-close'></i>Delete</a>";
if($row['status']==0){
  echo "<a href='?do=approve&comid=$row[com_id]' class='btn btn-info'><i class='fa fa-edit'></i>Approve</a>";
}
echo"
</td>
</tr>";

}
        ?>
  </table>



  <?php
}
else{
  echo "<div class='nodata'>No Data To Show</div>";
}
  //ُEdit Page
echo "<br/><div>";
pages_links("comments");
echo "</div>";
}
elseif($do == 'edit'){
  $Msg ="<div class='alert alert-danger'>Wrong Request</div>";
  $comid = isset($_GET['comid']) && is_numeric($_GET['comid'])?intval($_GET['comid']) : redirect($Msg,'back',3);
//Select Comments Data From database
    $comments = sql("SELECT * FROM comments WHERE com_id='$comid'","fetch");

if ($count == 1){
  ?>
  <h1>تعديل التعليقات </h1>
  <form class="form-horizontal col-md-6" action="?do=update" method="post">
    <input type="hidden" name="comid" value="<?php echo $comid ?>">
  <!----------------Start comment -------------->
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">التعليق</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="comment"  required="required"><?php echo $comments['comment'] ?></textarea>
    </div>
  </div>
  <!----------------Start Sent -------------->
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default btn-danger">حفظ</button>
    </div>
  </div>
</form>
<div class="col-md-8">
<?php
}else{
  $Msg='<div class="alert alert-danger">Wrong Request</div>';
  redirect($Msg,'back');
}
}elseif($do == 'update'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      echo '<h3>update</h3>';

    //Get Comment Data From Form

    $comid       =$_POST['comid'];
    $comment     =$_POST['comment'];

    //Update In Database
    $update_comment = sql("UPDATE comments SET comment = '$comment' WHERE com_id = '$comid'","");

    echo "<div class='success'>";
    $Msg = "<p>تم التحديث بنجاخ</p>";
    redirect($Msg,'back',3);
    echo "</div>";


}else{
    $Msg = 'no allow';
    redirect($Msg,'back',3);
}
echo "</div>";
}
elseif($do == 'delete'){
  //Delete Comments Page
  echo"<h1>Delete User</h1>
  <div class='container'>";
  $comid = isset($_GET['comid']) && is_numeric($_GET['comid'])?intval($_GET['comid']) : 0;
//Chick If Item Exist In Database
  $check = checkItems("com_id","comments",$comid);
//Select User Data From database
if ($check == 1){
  $delete_comment = sql("DELETE FROM comments WHERE com_id = '$comid'","");
  $Msg = "<div class='alert alert-success'>تم الحذف بنجاح</div>";
  redirect($Msg,"back");
}else{
  $Msg ="This Id Is Not Exist";
  redirect($Msg,'back');
}
echo"</div>";
}elseif($do == 'approve'){
  //Activate User Page
  echo"<h1>ِالتعليقات الموافق عليها</h1>
  <div class='container'>";
  $comid = isset($_GET['comid']) && is_numeric($_GET['comid'])?intval($_GET['comid']) : 0;
//Chick If Comment Exist In Database
  $check = checkItems("com_id","comments",$comid);
//Select User Data From database
if ($check == 1){
  $approve_comment = sql("UPDATE comments SET status = 1 WHERE com_id = '$comid'","");
  $Msg = "<div class='alert alert-success'>تم التفعيل بنجاح</div>";
  redirect($Msg,'back');
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
