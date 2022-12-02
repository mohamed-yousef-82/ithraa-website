<?php
include "init.php";
?>
<div class="container">
<div class="page-style-one">
  <?php
    // Get Sub Categoriey
   $about_page = sql("SELECT * FROM about","fetch");
   ?>
<h2 class="page-title"><?php echo $about_page['title'] ?></h2>
 <?php
 // echo "<h3>$about_page[title]</h3>";
 echo "<img class='about-img' src='$about_page[image]' />";
 echo "<h3>نبذة</h3>";
 echo "<p>$about_page[description]</p>";
 echo "<h3>الشريحة المستفيدة</h3>";
 echo "<p>$about_page[layer]</p>";
 echo "<h3>الاهداف</h3>";
 echo "<p>$about_page[goals]</p>";
 echo "<h3>سياسات عمل الديوانية</h3>";
 echo "<p>$about_page[policies]</p>";
?>
</div>
</div>
<?php
include "$str/footer.php";
?>
