<?php
include "init.php";
?>
<div class="container">
<div class="page-style-one">
<h2 class="page-title">فروع الديوانية </h2>
<div class="row row-reverse">
<?php
/*--- Get Category Items ---*/
$Items = sql("SELECT * FROM categories  ORDER BY cat_id","fetchAll");
if (!empty ($Items)){
foreach($Items As $Item){
  echo "<div class='box box-1 category-item'>";
  $img = $Item['image'];
  $src=str_replace("../","",$img);
  echo"<img class='item-img' src='$src' />";
  echo "<a href='branch.php?catid=$Item[cat_id]'>$Item[name]</a>";
  echo "</div>";
}
}else {
  echo "There In No Items";
}
?>
</div>
</div>
</div>
<?php
include "$str/footer.php";
?>
