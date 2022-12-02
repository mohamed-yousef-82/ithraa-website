<?php
include "init.php";
?>
<div class="container">
<div class="page-style-one">
<h2 class="page-title">شركاء الفرع </h2>
<div class="row row-reverse branch-client">
<?php
/*--- Get Category Items ---*/
$branch_client = sql("SELECT * FROM clients WHERE cat_id=$_GET[catid] ORDER BY cat_id","fetchAll");
if (!empty ($branch_client)){
foreach($branch_client As $branch){
  echo "<div class='box box-1 category-item'>";
  $img = $branch['image'];
  $src=str_replace("../","",$img);
  echo"<img class='item-img' src='$src' />";
  echo "<p>$branch[name]</p>";
  echo "</div>";
}
}else {
  echo "لا يوجد بيانات لعرضها";
}
?>
</div>
</div>
</div>
<?php
include "$str/footer.php";
?>
