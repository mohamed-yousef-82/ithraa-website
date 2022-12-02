<?php
include "init.php";
?>
<div class="container">
<div class="page-style-one">
<h2 class="page-title">الاعضاء</h2>
<?php
  // Get Sub Categoriey
 $about_page = sql("SELECT * FROM members","fetch");
 ?>
 <?php
 // echo "<h3>$about_page[title]</h3>";
 echo "<img class='about-img' src='$about_page[image]' />";
 echo "<h3>سياسات الأعضاء</h3>";
 echo "<p>$about_page[member]</p>";
 echo "<h3>سياسات الزوار</h3>";
 echo "<p>$about_page[visitor]</p>";
?>
<a href="http://dethra.org/registration.php">رابط تسجيل عضوية</a>
</div>
</div>
<?php
include "$str/footer.php";
?>
