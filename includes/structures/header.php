<?php
ob_start();
session_start();
$siteuser = "";
  if(isset($_SESSION['user'])){
    $siteuser = $_SESSION['user'];
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php getTitle() ?></title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo"$css" ?>/start.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/style.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/responsive.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/font-awesome.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/animate.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/rtl.css" />
</head>
<body>
    <div class="start">
    <main>
      <div class="header-top-container">
      <div class="header-top">
      <div class="container">

        <div class="social-icons">
          <?php
                          $socialmedia = sql("SELECT * FROM socialmedia ORDER By social_id DESC ","fetchAll");
                          foreach ($socialmedia as $social) {
                            echo "<a href='$social[link]' class='social'><i class='$social[image]' aria-hidden='true'></i></a>";
                          }
           ?>
          <div style="clear:both;">
          </div>
        </div>

      </div>
      </div>
      <div class="container">
        <div class="header-middle row row-medium">
        <div class="box box-1">
      <a class="logo" href="index.php">
        <!-- <img src="layout/img/logo.png" /> -->
        <?php
          $logo = sql("SELECT * FROM logo","fetch");
          echo "<img src='$logo[image]' />";
          ?>
      </a>
        </div>
        <div class="box box-1">
      <form class="search-form" action="search.php">
                        <i class="fa fa-search">
                        </i>
                        <input type="text" name="search" placeholder="ادخل كلمة البحث هنا . . ">
                        <input type="submit" name="submit" value="بحث" class="start-btn blue">

                    </form>
      </div>
      </div>
      </div>
      </div>
      <div class="fa fa-align-justify" id="menu-icon">
      </div>
      <div class="nav-container">
        <ul class="nav" id="nav">
         <div class="container">
        <ul class="nav-left">
          <li>
            <a class="home" href="index.php">
            ديوانية إثراء
            </a>
          </li>
          <?php
              echo "<li><a href='about.php'>";
              echo "من نحن";
              echo "</a></li>";
              echo "<li><a href='ithraa.php'>";
              echo "لائحة إثراء@X";
              echo "</a>";
              echo "</li>";
              echo "<li><a href='members.php'>";
              echo "الاعضاء";
              echo "</a></li>";
              echo "<li><a href='branchs.php'>";
              echo "فروع الديوانية ";
              echo "</a>";
              echo "<ul class='dropdown'>";
              $select = sql("SELECT * FROM categories ORDER BY cat_id","fetchAll");
              foreach ($select as $sub_cat) {
              $catname=str_replace("-","%20",$sub_cat["name"]);
              echo "<li><a href='branch.php?catid=$sub_cat[cat_id]&name=$catname'>";
              echo $sub_cat['name'];
              echo "</a></li>";
              }
              echo "</ul>";
              echo "</li>";
              echo "<li><a href='items.php'>";
              echo "الفعاليات ";
              echo "</a>";
              echo "</li>";
              echo "<li><a href='video.php'>";
              echo "الفيديوهات ";
              echo "</a>";
              echo "</li>";
              echo "<li><a href='#' class='goto'>";
              echo "اتصل بنا";
              echo "</a>";
              echo "</li>";

            ?>
            <?php
              // $about_page = sql("SELECT * FROM about","fetch");
              //   $aboutname=str_replace("-","%20",$about_page["title"]);

              ?>
              <!-- <li>
                <a href="request.php">
                  Price Request
                </a>
              </li> -->
          </ul>
          <ul class="nav-right">
          <?php
          if(isset($_SESSION['user'])){
            echo "<li class='user-box'><a> اهلا بك : ".$siteuser."</a>
                  <ul class='dropdown'>
                  <li><a href='profile.php'>الصفحة الشخصية</a></li>
                  <li><a href='new.php'>اضافة اعلان</a></li>
                  <li><a href='logout.php'>تسجيل الخروج</a></li>
                  </ul>
            </li>";
            // echo "";
            // echo "";
            // echo "";
            $usersratus = Check_User_Status($siteuser);
            if($usersratus == 1){
      echo "Your Account Need To Upgrade";
            }
          }else{
      ?>
          <!-- <li class="login-link"><a href="login.php">تسجيل الدخول</a></li> -->
          <li class="login-link"><a href="registration.php">تسجيل عضوية</a></li>
          <?php
          }
              ?>
  </ul>

          </div>
        </ul>
      </div>
