<?php
$pageTitle ="Login";
include "init.php";
if(isset($_SESSION['user'])){
  header('Location:index.php');
}

/*--- Check If User Comming From HTTP Post Request ---*/
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset($_POST['login'])){
  $user=$_POST['username'];
  $pass=$_POST['password'];
  $hashepass=sha1($pass);
  /*--- Check If The User Is Exist In Database ---*/
  $login = sql("SELECT user_id,username,Password FROM users WHERE username = '$user' AND password = '$hashepass' AND regstatus = 1 ","fetch");
  if ($count == 1){
  $_SESSION['user'] = $user;
  $_SESSION['uid'] = $login['user_id'];
  header('Location:index.php');
  exit();
  }
  }else{

  /*--- PHP Validation ---*/
  $username = $_POST['username'];
  $formErrors=array();
  if (isset($_POST['username'])){
     $filteruser = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
  if (strlen($filteruser) < 4){
     $formErrors[] = "Your Username Must Be Larger Than 4 Characters";
  }
  }
  if (isset($_POST['email'])){
     $filteremail = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
     if(filter_var($filteremail,FILTER_VALIDATE_EMAIL) != true){
     $formErrors[] = "This Email Is Not Valid";
  }
  }
  if (isset($_POST['password']) && isset($_POST['password2'])){
  if (empty($_POST['password'])){
     $formErrors[] = "Password Required";
     }
     $pass1 = sha1($_POST['password']);
     $pass2 = sha1($_POST['password2']);
     if ($pass1 !== $pass2){
     $formErrors[] = "Sorry Password In Not Match";
     }
     }
  if (empty($formErrors)){
     /*--- Check If User Exit In Database ---*/
     $check = checkItems("username","users",$username);
     if($check > 0){
     $formErrors[] = "Sorry This User Is Exist";
     }else{
       $user=$_POST['username'];
       $pass=$_POST['password'];
       $hashepass=sha1($pass);
       $email=$_POST['email'];
       $insert_user = sql("INSERT INTO users (username, password, email,regstatus,date)
       VALUES ('$user', '$hashepass', '$email',0,NOW())","");
  //
  //    $stmt = $con->prepare("INSERT INTO users (username, password, email,regstatus,date) VALUES (:User, :Pass, :Email,0,NOW())");
  //    $stmt->execute(array(
  //   'User'=> $_POST['username'],
  //   'Pass'=> sha1($_POST['password']),
  //   'Email'=> $_POST['email']
  // ));
  $registered = "<div class='alert alert-success'>Congratulations You Are Regestrated Successfully</div>";
  }
  }
  }
  }
  ?>
  <div class="container">
  <div class="page-style-one">
  <h2 class="page-title">Login</h2>
  <!--Start Login Form -->
  <form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
  <input type="text" class="form-control" name="username" autocomplete="off" placeholder="Username" required="required">
  <input type="password" class="form-control" name="password" autocomplete="new-password" placeholder="Password" required="required">
  <input type="submit" class="start-btn blue"  name="login" value="Login">
  </form>
  <!-- <div class="sign-up">
  <h2 class="page-title">Sign Up</h2>
  <form  class="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
  <input type="text" class="form-control" name="username" autocomplete="off" placeholder="Username"  >
  <input type="password" class="form-control" name="password" autocomplete="new-password" placeholder="Type Password"  >
  <input type="password" class="form-control" name="password2" autocomplete="new-password" placeholder="Type Password Again" >
  <input type="email" class="form-control" name="email" placeholder="Email">
  <input type="submit" class="start-btn blue" value="Login">
  </form>
  </div> -->
  <div id="errors">
  <?php
  if (!empty($formErrors)){
  foreach ($formErrors as $error){
  echo "<div class='alert alert-danger'>$error</div>";
  }
  }
  if (isset ($registered)){
      echo "$registered";
  }
  ?>
  </div>
  </div>
  </section>
  <?php
  include "$str/footer.php";
  ?>
