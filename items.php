<?php
include "init.php";
?>
<script>
function myFunction() {
    // Declare variables
    var input, filter, ul, li, a, i;
    // input = document.getElementsByClassName('data');
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    // ul = document.getElementById("myUL");
    li = document.getElementsByClassName('category-item');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
      a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
function myFunction2() {
    // Declare variables
    var input, filter, ul, li, a, i;
    // input = document.getElementsByClassName('data');
    input = document.getElementById('myInput2');
    filter = input.value.toUpperCase();
    // ul = document.getElementById("myUL");
    li = document.getElementsByClassName('category-item');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
      p = li[i].getElementsByTagName("p")[0];
        if (p.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
function myFunction3() {
    // Declare variables
    var input, filter, ul, li, a, i;
    // input = document.getElementsByClassName('data');
    input = document.getElementById('myInput3');
    filter = input.value.toUpperCase();
    // ul = document.getElementById("myUL");
    li = document.getElementsByClassName('category-item');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
      b = li[i].getElementsByTagName("b")[0];
        if (b.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>
<div class="container">
<div class="page-style-one">
<h2 class="page-title">الفعاليات </h2>
<div class="row">
<div class="box-1" style="padding-left:5px;">
<select style='width:100%;margin:auto;padding:10px;margin-top:10px;font-family:bein-normal;' id='myInput' onchange='myFunction()'>
  <option>اسم الكتاب </option>
  <?php
  $Items = sql("SELECT * FROM items  WHERE approve = 1 ORDER BY cat_id","fetchAll");
  if (!empty ($Items)){
  foreach($Items As $Item){
    echo "<option>$Item[name]</option>";
  }
  }
   ?>
</select>
</div>
<div class="box-1" style="padding-left:5px;">
<select style='width:100%;margin:auto;padding:10px;margin-top:10px;font-family:bein-normal;' id='myInput2' onchange='myFunction2()'>
  <option>رقم الفاعلية</option>
  <?php
  $Items = sql("SELECT * FROM items  WHERE approve = 1 ORDER BY cat_id","fetchAll");
  if (!empty ($Items)){
  foreach($Items As $Item){
    echo "<option>$Item[numb]</option>";
  }
  }
   ?>
</select>
</div>
<div class="box-1" style="padding-left:5px;">
<select style='width:100%;margin:auto;padding:10px;margin-top:10px;font-family:bein-normal;' id='myInput3' onchange='myFunction3()'>
  <option>الفرع</option>
  <?php
  $Items = sql("SELECT * FROM categories ORDER BY cat_id","fetchAll");
  if (!empty ($Items)){
  foreach($Items As $Item){
    echo "<option>$Item[name]</option>";
  }
  }
   ?>
</select>
</div>
</div>
<div class="row row-reverse">
<?php
/*--- Get Category Items ---*/
// $Items = sql("SELECT * FROM items  WHERE approve = 1 ORDER BY cat_id","fetchAll");
$Items = sql("SELECT items.*,categories.name AS category
                 FROM items INNER JOIN categories ON categories.cat_id = items.cat_id
                 WHERE approve = 1 ORDER BY item_id DESC","fetchAll");
if (!empty ($Items)){
foreach($Items As $Item){
  echo "<div class='box box-1 category-item'>";
  $img = $Item['book'];
  $src=str_replace("../","",$img);
  echo"<img class='item-img' src='$src' />";
  echo "<a href='item.php?itemid=$Item[item_id]'>$Item[name]</a>";
  echo "<p style='display:none;'>$Item[numb]</p>";
  echo "<b style='display:none;'>$Item[category]</b>";
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
