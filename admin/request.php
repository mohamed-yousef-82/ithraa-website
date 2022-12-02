<?php
$pageTitle ="Items";
include "init.php";

if(isset($_SESSION['username'])){
  ?>
  <section class="main-section box box-5">
  <div class="view-data">
  <div class="page-container">
  <h3 class="table-title"><span>Reguests</span><i class="fa fa-file-text" aria-hidden="true"></i></h3>
  <?php
$do = isset($_GET['do'])?$_GET['do'] : 'manage';

// =======================================================================//
// Items Page                                                             //
// =======================================================================//

//Pending Items
if($do =='manage'){

  //Select Items Data From database
  $requests = sql("SELECT * FROM request ORDER BY id Desc","fetchAll");

  ?>

<?php
  if(!empty($requests)){
?>

  <table style="padding:0px;" class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Company</th>
        <th>Product Number</th>
        <th>Distance In Meters</th>
        <th>Request Posetion</th>
        <th>Description</th>
        <th>Control</th>
      </tr>
        </thead>
      <?php
      $num = 1;
foreach ($requests as $request) {
echo"<tr>";
echo"<td>$num</td>";
echo"<td>$request[name]</td>";
echo"<td>$request[mobile]</td>";
echo"<td>$request[email]</td>";
echo"<td>$request[company]</td>";
echo"<td>$request[product_number]</td>";
echo"<td>$request[distance]</td>";
echo"<td>$request[country]</td>";
echo"<td>$request[description]</td>";
echo"<td><a href='?do=delete&id=$request[id]' class='start-btn orangered confirm'><i class='fa fa-close'></i>Delete</a>";
echo"
</td>
</tr>";
$num++;
}
}
else{
  echo "<div class='nodata'>No Data To Show</div>";
}
        ?>
  </table>


  <?php


}
elseif($do == 'delete'){
  //Delete Item Page

  $request_id = isset($_GET['id']) && is_numeric($_GET['id'])?intval($_GET['id']) : 0;
//Chick If Item Exist In Database
  $check = checkItems("id","request",$request_id);
//Select Item Data From database
if ($check == 1){
       sql("DELETE FROM request WHERE id = '$request_id'","");

  $Msg = "<div class='alert alert-success'>Deleted Successfully</div>";
    redirect($Msg,'back');
}else{
  $Msg ="This Id Is Not Exist";
  redirect($Msg,'back');
}
}
}else{
  $Msg ="You Must Login";
  redirect($Msg);
}
?>
</div>
</div>
</section>
<?php
include "$str/footer.php";
?>
