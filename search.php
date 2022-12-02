<?php
include "init.php";
?>
<div class="container">
<div class="page-style-one">
<h2 class="page-title">Search Resault</h2>
<div class="row row-reverse">
  <?php
if (isset ($_GET['search'])){
	$search = trim(strip_tags($_GET['search']));

if(empty ($search)){
  echo "<span>Please Insert Search Data<div/>";
}else
{
  $Items = sql("SELECT * FROM items WHERE name LIKE '%$search%' ORDER BY item_id","fetchAll");
  if (!empty ($Items)){
  foreach($Items As $Item){
    echo "<div class='box box-1 category-item'>";
    echo "<span class='item-date'><i class='fa fa-calendar' aria-hidden='true'></i>$Item[add_date]</span>";
    $img = $Item['image'];
    $src=str_replace("../","",$img);
    echo"<img class='item-img' src='$src' />";
    echo "<a href='item.php?itemid=$Item[item_id]'>$Item[name]</a>";
    echo "</div>";
  }
  }else {
    echo "There In No Data";
  }
}
}

	?>
</div>
</div>
</div>
<?php
include "$str/footer.php";
?>
