<?php
include "init.php";
?>
<style>
p{
  display: block;
  width: 100%;
}
</style>
<div class="container">
<div class="page-style-one">
  <?php
  /*--- Get Category Items ---*/
  $item = sql("SELECT * FROM items WHERE item_id=$_GET[itemid]","fetch");
  echo "<h2 class='page-title'>$item[name]</h2>";
  ?>

<div class="row row-reverse">
<?php
$img = $item['image'];
$src=str_replace("../","",$img);
$book = $item['book'];
$src2=str_replace("../","",$book);
echo"<img style='margin-bottom:20px;' class='item-img' src='$src' />";
echo"<img class='item-img' src='$src2' />";
echo "<p class='blue-title'>تاريخ الفاعلية :</p>";
echo "<p>$item[add_date]</p>";
echo "<p class='blue-title'>رقم الديوانية:</p>";
echo "<p>$item[numb]</p>";
echo "<p class='blue-title'>اسم المؤلف:</p>";
echo "<p>$item[auther]</p>";
echo "<p class='blue-title'>اسم الملقى:</p>";
echo "<p>$item[deliver]</p>";
echo "<p class='blue-title'>نبذة عن الملقى:</p>";
echo "<p>$item[deliver_pref]</p>";
echo "<p class='blue-title'>رقم التواصل:</p>";
echo "<p>$item[contact_number]</p>";
echo "<p class='blue-title'>رابط التسجيل لغير الاعضاء:</p>";
echo "<a href='$item[link]' target='_blank'>$item[link]</a>";
 ?>
</div>
<h2 class="page-title">صور الفعالية </h2>
<div class="row row-reverse">
<?php
/*--- Get Category Items ---*/
$Items = sql("SELECT * FROM tabs_items  WHERE item_id=$_GET[itemid]","fetchAll");
if (!empty ($Items)){
foreach($Items As $Item){
  echo "<div class='box box-1 category-item'>";
  $img = $Item['image'];
  $src=str_replace("../","",$img);
  echo"<a href='$src'><img class='item-img' src='$src' /><a/>";
  // echo "<a href='item.php?itemid=$Item[item_id]'>$Item[title]</a>";
  echo "</div>";
}
}else {
  echo "لا يوجد بيانات لعرضها";
}
?>
</div>
<h2 class="page-title">PDF</h2>
<?php
 echo "<a style='text-decoration:underline;margin:20px 0px;' href='$item[pdf]'>  رابط تحميل ملف $item[name]</a>";
?>
<h2 class="page-title">فيديوهات الفعالية </h2>
<div class="row row-reverse">
<?php
/*--- Get Category Items ---*/

if (!empty($item["video"])){

    echo "<div class='box box-1 category-item'>";
    echo"<iframe width='100%' height='auto' src='$item[video]' frameborder='0' allowfullscreen></iframe>";
    echo "</div>";

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
