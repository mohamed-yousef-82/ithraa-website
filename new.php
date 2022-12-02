<?php
$pageTitle ="New Ad";
include "init.php";
if(isset($_SESSION['user'])){
if($_SERVER['REQUEST_METHOD'] == 'POST'){

/*--- Set Variables ---*/
$formErrors = array();
$name       = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
$desc       = filter_var($_POST['description'],FILTER_SANITIZE_STRING);
$price      = filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_INT);
$country    = filter_var($_POST['country'],FILTER_SANITIZE_STRING);
$status     = filter_var($_POST['status'],FILTER_SANITIZE_NUMBER_INT);
$category   = filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
$uid        = $_SESSION['uid'];

/*--- PHP Validation ---*/
if(strlen($name) < 4){
  $formErrors[] = "Name Must Be More Than 4 Characters";
}
if(strlen($desc) < 10){
  $formErrors[] = "Description Must Be More Than 10 Characters";
}
if(strlen($country) < 2){
  $formErrors[] = "Contry Must Be More Than 2 Characters";
}
if(empty($price)){
  $formErrors[] = "Price Required";
}
if(empty($status)){
  $formErrors[] = "Status Required";
}
if(empty($category)){
  $formErrors[] = "Category Required";
}
foreach ($formErrors as $error){
echo "<div class='alert alert-danger'>$error</div>";
}

/*--- Update In Database ---*/
if (empty($formErrors)){
   upload("file","","data/uploads/");
  $stmt = sql("INSERT INTO items (name, description, price, country_made,status,add_date,cat_id,user_id,image)
  VALUES ('$name', '$desc', '$price', '$country','$status',NOW(),'$category','$uid','$insert_src')","");
if($stmt){
  echo "Added Succefully";
}
}
}
?>
<div class="container">
<div class="page-style-one createads">
<h2 class="page-title">Create New Ad</h2>
<form class="form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
<!----------------Start Name -------------->
<div class="form-group">
<label  class="col-sm-2 control-label">Name</label>
<div class="col-sm-10">
<input type="text" class="form-control live"  data-class=".live-name" name="name" placeholder="name" required="required">
</div>
</div>
<!----------------Start Description -------------->
<div class="form-group">
<label  class="col-sm-2 control-label">Description</label>
<div class="col-sm-10">
<input type="text" class="form-control live" data-class=".live-desc" name="description" placeholder="Description" required="required">
</div>
</div>
<!----------------Start Price -------------->
<div class="form-group">
<label  class="col-sm-2 control-label">Price</label>
<div class="col-sm-10">
<input type="text" class="form-control live" data-class=".live-price" name="price" placeholder="Price" required="required">
</div>
</div>
<!----------------Start Country Made -------------->
<div class="form-group">
<label  class="col-sm-2 control-label">Country Made</label>
<div class="col-sm-10">
<input type="text" class="form-control" name="country" placeholder="Country Made" required="required">
</div>
</div>
<!----------------Start Status -------------->
<div class="form-group">
<label class="col-sm-2 control-label">Status</label>
<div class="col-sm-10">
<select name="status" class="form-control" required="required">
<option value="1">New</option>
<option value="2">Used</option>
</select>
</div>
</div>
<!----------------Start Categories -------------->
<div class="form-group">
<label class="col-sm-2 control-label">Categories</label>
<div class="col-sm-10">
<select name="category" class="form-control" required="required">
<?php
/*--- Select Categories Data From database ---*/
$cats = sql("SELECT * FROM Categories ORDER BY cat_id","fetchAll");
foreach ($cats as $cat) {
echo "<option value='$cat[cat_id]'> $cat[name]</option>";
}
?>
</select>
</div>
</div>
<!----------------Start Image -------------->
  <labe>Image</label>
  <input type="file" class="form-control" name="file" placeholder="Image" required="required">
<!----------------Start Send -------------->
<button type="Add Item" class="start-btn blue">Add Item</button>
</form>
</div>
</div>
</div>
<?php
}else{
  header('Location:login.php');
  exit();
}
include "$str/footer.php";
?>
