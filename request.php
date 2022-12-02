<?php
include "init.php";
?>
<div class="container">
<div class="page-style-one">
<!-- <h1><?php  echo str_replace("-","",$_GET['name']); ?></h1> -->
<h2 class="page-title">Price Request</h2>
<form class="form" action="?do=insert" method="post" enctype="multipart/form-data">
<!----------------Start Name -------------->
  <label>Name</label>
  <input type="text" name="name" placeholder="Name" required="required">
<!----------------Start Mobile -------------->
  <label>Mobile</label>
  <input type="number" name="mobile"  placeholder="Mobile" required="required">
  <!----------------Start Email -------------->
  <label>Email</label>
  <input type="email" name="email"  placeholder="Email" required="required">
  <!----------------Start Email -------------->
  <label>Product Number</label>
  <input type="number" name="product_number"  placeholder="Product Number" required="required">
  <!----------------Start Company -------------->
  <label>Company</label>
  <input type="text" name="company"  placeholder="Company" required="required">
  <!----------------Start Company -------------->
  <label>Distance In Meter</label>
  <input type="text" name="distance"  placeholder="Distance In Meter" required="required">
  <!----------------Start Company -------------->
  <label>Request Position country/town/state</label>
  <input type="text" name="country"  placeholder="Request Position country/town/state" required="required">
  <!----------------Start Description -------------->
  <label>Product Description</label>
  <textarea name="description"  placeholder="Product Description" required="required"></textarea>
<!----------------Start Sent -------------->
  <button type="submit" class="start-btn blue">Send Request</button>
  </form>

 <?php
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
   $name             =$_POST['name'];
   $email            =$_POST['email'];
   $mobile           =$_POST['mobile'];
   $product_number   =$_POST['product_number'];
   $company          =$_POST['company'];
   $country          =$_POST['country'];
   $distance         =$_POST['distance'];
   $description      =$_POST['description'];
   $to = "m.yousef_82@outlook.com";
   $subject = " طلب تسعيرة ";
   $message = " قام احد العملاء بارسال طلب تسعيرة لاحد منتجاتكم . . نرجو التوجه الى لوحة تحكم الموقع لمعاينة تفاصيل الطلب ";
   $headers = "From: $email.\r\n";
   mail($to, $subject, $message, $headers);
   sql("INSERT INTO Request (name,email,mobile,product_number,company,country,distance,description)
        VALUES ('$name','$email','$mobile','$product_number','$company','$country','$distance','$description')","");
        echo "Request Inserted Succefully";
   }
?>
</div>
</div>
<?php
include "$str/footer.php";
?>
