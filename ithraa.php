<?php
include "init.php";
?>
<div class="container">
<div class="page-style-one">
<h2 class="page-title">لائحة إثراء</h2>
<?php
  // Get Sub Categoriey
 $about_page = sql("SELECT * FROM ithraa","fetch");
 ?>
 <?php
 // echo "<h3>$about_page[title]</h3>";
 echo "<img class='about-img' src='$about_page[image]' />";
 echo "<a style='text-decoration:underline;margin:20px 0px;' href='$about_page[pdf]'> رابط تحميل ملف لائحة إثراء PDF </a>";
?>
</div>
</div>
<?php
include "$str/footer.php";
?>
