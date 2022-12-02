<?php
$pageTitle ="ديوانية إثراء";
include "init.php";
?>
        <div class="main-content">
          <div id="section1">
            <div class="slide-show-container">
              <ul class="circles">
                <?php
                //Get Category Items
                $select=sql("SELECT * FROM slideshow ORDER BY id LIMIT 5","fetchAll");
                $num = 1;
                foreach($select As $selectview){
                  ?>
                <li class="circle" data-show="#<?php echo $num ?>">
                </li>
                <?php
                $num ++;
              }
              ?>
              </ul>
              <div class="slide-show">
                <?php
                //Get Category Items
                $select=sql("SELECT * FROM slideshow ORDER BY id LIMIT 5","fetchAll");
                $num = 1;
                foreach($select As $selectview){
                  ?>
                <div class="slider" id="<?php echo $num ?>">
                <div class="details">
                <?php echo "<h3>$selectview[title]</h3>"; ?>
                <?php echo "<p>$selectview[description]</p>"; ?>
                <?php if($selectview['link'] !== ""){ echo "<a class='start-btn orangered' href='$selectview[link]'>قراءة المزيد</a>"; } ?>
                <?php echo "</div>"; ?>
                <?php $img = $selectview['image'];
                 $src=str_replace("../","",$img);
                 echo "<img src='$src' />";
                  ?>
                </div>
                  <?php
                  $num ++;
                }
                ?>
                </div>
              <div class="links">
                <a class="arrow next" id="next">
                  <i class="fa fa-chevron-circle-right">
                  </i>
                </a>
                <a class="arrow prev" id="prev">
                  <i class="fa fa-chevron-circle-left">
                  </i>
                </a>
              </div>
              <div id="stop">
                <button id="run">
                </button>
              </div>
            </div>
              </div>
            <div class="welcome" id="section2">
              <div class="about-title">
              <div class="container">
                      <?php
                        $about_page = sql("SELECT * FROM about","fetch");
                          $aboutname=str_replace("-","%20",$about_page["title"]);
                          echo "<h3 class='section-title'>$aboutname</h3>";
                          echo "<a style='display:inline-block;' class='start-btn blue' href='about.php'>المزيد</a>";

                          ?>
                          </div>
                          </div>
                          <div class="container">
                          <div class="row row-medium padding-vertical">
                            <div class="box box-1 about  wow fadeInLeft">
                              <div>
                          <?php
                          function custom_echo($x, $length)
                            {
                            if(strlen($x)<=$length)
                            {
                              echo $x;
                            }
                            else
                            {
                              $y=substr($x,0,$length) . '...';
                              echo $y;
                            }
                          }
                          custom_echo("<p>$about_page[description]</p>",600);

                        ?>

                    </div>
                      <img class="intro-img wow fadeInRight" src="<?php echo $about_page['image'] ?>" />
                    </div>



                  </div>



                </div>
              </div>
            <div class="items-slider padding-vertical" id="section5">
              <div class="container">
                <h3 class="section-title">احدث الفعاليات
                </h3>
                <span class="separate">
                               <span class="line"></span>
                               <span class="separate-circle"></span>
                               <span class="line"></span>
                               </span>
                <div class="items-slider-container">
                  <div class="items-slider-horizontal wow fadeInLeft">
                    <div id="prev">
                      
                    </div>
                    <div id="slide-image">
                      <ul>
                        <?php
                          $last_items = sql("SELECT * FROM items WHERE approve = 1 ORDER BY cat_id","fetchAll");
                          foreach ($last_items as $last) {
                            echo "<li><div>";
                            echo "<img src='$last[image]' />";
                            echo "<p><a style='color:#fff;' href='item.php?itemid=$last[item_id]'>$last[name]</a></p>";

                            echo "</div></li>";
                          }
                          ?>
                      </ul>
                    </div>
                    <div id="next">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="filter">
              <h3 class="section-title">البوم الصور
              </h3>
              <span class="separate">
                             <span class="line"></span>
                             <span class="separate-circle"></span>
                             <span class="line"></span>
                             </span>
            <div class="row row-medium">
              <div class="box box-1">
            <ul class="items-filter">
              <li class="all"><a class='all'>جميع الفعاليات </a></li>
            <?php
            $select = sql("SELECT * FROM items ORDER BY item_id LIMIT 5","fetchAll");
          foreach ($select as $select_view) {
?>
<li>
<a data-filter="<?php echo $select_view['item_id'] ?>"><?php echo $select_view['name'] ?></a>
</li>
        <?php
        }
        echo "</ul><div class='container'><ul class='row'>";
        $select = sql("SELECT * FROM items  WHERE approve = 1 ORDER BY item_id DESC LIMIT 30","fetchAll");
        foreach ($select as $select_view) {
          if( $select_view['photo'] !== ""){
        ?>
        <li class="box box-1 item-filter-show" data-filter-item="<?php echo $select_view['item_id'] ?>">
        <a href="<?php echo $select_view['photo'] ?>"><img class="responsive-img" src="<?php echo $select_view['photo'] ?>" /></a>
        </li>
        <?php
      }
        }
        foreach ($select as $select_view) {
          if( $select_view['photo2'] !== ""){
        ?>
        <li class="box box-1 item-filter-show" data-filter-item="<?php echo $select_view['item_id'] ?>">
        <a href="<?php echo $select_view['photo2'] ?>"><img class="responsive-img" src="<?php echo $select_view['photo2'] ?>" /></a>
        </li>
        <?php
      }
        }
        foreach ($select as $select_view) {
          if( $select_view['photo3'] !== ""){
        ?>
        <li class="box box-1 item-filter-show" data-filter-item="<?php echo $select_view['item_id'] ?>">
        <a href="<?php echo $select_view['photo3'] ?>"><img class="responsive-img" src="<?php echo $select_view['photo3'] ?>" /></a>
        </li>
        <?php
      }
        }
        ?>
      </ul>
      </div>
      </ul>
      </div> <!-- Container Full End -->
    </div>
    </div>
           <div class="accordion-container">
           <div class="container">
            <div class="row row-medium">
              <div class="box box-1">
                <h3 class="border-title">
                  <i class="fa fa-bullseye" aria-hidden="true"></i>
                  اهداف الديوانية
                </h3>
                <div class="accordion">
                  <?php
               $select = sql("SELECT * FROM accordion ORDER BY id","fetchAll");
             foreach ($select as $select_view) {
               ?>
               <div class="item">
                 <div class="title">
                   <i class="fa">
                   </i>
                     <?php echo $select_view['title'];?>
                 </div>
                 <div class="content">
                   <ul>
                     <li class="start-media-object">
                     <div class="media-object-section">
                     <div class="thumbnail">
                       <?php
                       $img = $select_view['image'];
                      $src=str_replace("../","",$img);
                       echo "<img src='$src' />";
                       ?>
                     </div>
                     </div>
                     <div class="media-object-section">
                     <p><?php echo $select_view['description'];?></p>
                     <a href="branches.php" class="about-btn">المزيد</a>
                     </div>
                     </li>
                   </ul>
                 </div>
      </div>
            <?php
            }
            ?>
                </div>
              </div>
              <div class="box box-1">
                <h3 class="border-title">
                  <i class="fa fa-video-camera" aria-hidden="true"></i>
                  فيديو الديوانية
                </h3>
                <p>
                نعرض لكم احدث الفيديوهات الخاصة بلقائات الديوانية
                </p>
                <?php
               $select = sql("SELECT * FROM video ORDER BY id LIMIT 1","fetch");
                ?>
        <iframe width="560" height="315" src="<?php echo $select['link'] ?>" frameborder="0" allowfullscreen></iframe>
              </div>
              </div>
              </div>
              </div>

              <div class="counter-outer">
                  <div class="container">
                    <h3 class="section-title">احصائيات الديوانية
                    </h3>
                    <span class="separate">
                                   <span class="line"></span>
                                   <span class="separate-circle"></span>
                                   <span class="line"></span>
                                   </span>
                <ul class="counter row row-medium">
                  <?php
               $select = sql("SELECT * FROM counter ORDER BY id","fetchAll");
             foreach ($select as $select_view) {
               ?>
               <li class="box box-1">
                 <div>
                 <img src="<?php echo $select_view['image'];?>" />
                 <p><?php echo $select_view['title'];?></p>
                  <span class="number"><?php echo $select_view['count'];?></span>
                </div>
                </li>
                  <?php
        }
               ?>
             </ul>
              </div>
              </div>
      </div>
      <div class="clients padding-vertical">
          <div class="container">
        <h3 class="section-title">العملاء
        </h3>
        <span class="separate">
                       <span class="line"></span>
                       <span class="separate-circle"></span>
                       <span class="line"></span>
                       </span>
        <div>
          <ul class="row row-medium">
            <?php
            $clients = sql("SELECT * FROM clients ORDER By client_id DESC LIMIT 6","fetchAll");
            foreach ($clients as $client) {
              echo "<li class='box box-1'>";
              echo "<img src='$client[image]' />";
              echo "</li>";
             }
            ?>
            <li class="start-media-object">

            </li>
          </ul>
        </div>
      </div>
      </div>
      <!-- <div class="progress-container">
        <div class="row row-medium">

          <div class="box box-1">
            <div class="container">
              <h3 class="section-title">
                Skills
              </h3>
            <div class="Progress">
              <?php
           $select = sql("SELECT * FROM prograss ORDER BY id","fetchAll");
         foreach ($select as $select_view) {
           ?>
           <div class="myProgress">
             <div class="mybar">
               <p><?php echo $select_view['title'];?></p>
               <div data-width="<?php echo $select_view['count'];?>" class="label">

            </div>
              </div>
              </div>
              <?php
    }
           ?>









            </div>
          </div>
        </div>
        <div class="box box-1">
          <img class="responsive-img" src="layout/img/skills.gif" />
      </div>
      </div>
      </div> -->
              <!-- <div class="projects padding-vertical">


                          <div class="container">
                <h3 class="section-title">Projects
                </h3>
                <span class="separate">
                               <span class="line"></span>
                               <span class="separate-circle"></span>
                               <span class="line"></span>
                               </span>
                  <ul class="row row-medium image-box">
                    <?php
                      $project_items = sql("SELECT * FROM items  WHERE approve = 1  ORDER BY cat_id","fetchAll");
                      foreach ($project_items as $last) {
                        echo "<li class='box box-1'><div>";
                        echo "<img src='$last[image]' />";
                        echo "<h3 style='background:#573235;'><a style='color:#fff;' href='project.php?item_id=$last[item_id]'>$last[name]</a></h3>";
                        // echo $last['name'];
                        echo "</div></li>";
                      }
                      ?>
              </div>
                </div> -->

              <div class="contact padding-vertical">
                  <div class="container">
                <h3 class="section-title">
                  اتصل بنا
                </h3>
                <span class="separate">
                 <span class="line"></span>
                 <span class="separate-circle"></span>
                 <span class="line"></span>
                 </span>
                <div>
                  <div class="contact">
                  <div class="row row-medium">
                    <!-- <div class="box box-1">
                      <img class="responsive-img" src="layout/img/contact.png" />
                  </div> -->
                    <div class="box box-1">

                    <?php
                    // $action=$_POST['action'];
                    if (!isset ($_POST['action']))

                    {
                    ?>
                        <form action="" class="form" method="post" >
                        <input type="hidden" name="action" value="submit">
                        <label for="fname">الاسم :
                        </label>
                        <input type="text" id="name" name="name">
                        <label for="country">البريد الالكترونى :
                        </label>
                        <input type="text" id="email" name="email">
                        <label for="country">الرسالة :
                        </label>
                        <textarea name="message">
                        </textarea>
                        <input type="submit" class="start-btn orangered" name="send" value="Send" />
                        </form>
          </div>
          <div class="box box-1">
            <h3 class="contact-data-title">
              بيانات الاتصال
            </h3>
            <div class="top-contact">
              <?php
              $contact = sql("SELECT * FROM contact","fetch");
              ?>
              <div class="contact-data">
              <p><i class="fa fa-phone-square"></i> التليفون :</p>
              <span><?php echo $contact["phone"] ?></span>
              </div>
              <div class="contact-data">
                <p><i class="fa fa-envelope"></i> البريد الإلكترونى :</p>
                <span><?php echo $contact["email"] ?></span></div>
                <div class="contact-data">
                  <p><i class="fa fa-home"></i> العنوان :</p>
                  <span><?php echo $contact["address"] ?></span></div>
            </div>
          </div>
        </div>
                    <?php
                    }
                    else
                    {

                    function myEmail(){
                    $contact = sql("SELECT * FROM contact","fetch");

                    $to =$contact['email'];
                    return $to;

                    }
                    $name=$_POST['name'];
                    $email=$_POST['email'];
                    $message=$_POST['message'];

                    if (($name=="")||($email=="")||($message==""))
                    {
                    echo "All fields are required, please fill <a href=\"\">the form</a> again.";
                    }
                    else{
                    $from="From: $name<$email<\r\nReturn-path: $email";
                    mail(myEmail(), $name,$message, $from);
                    echo "Email sent!";
                    }
                    }
                    ?>
                  </div>
                  </div>
                </div>
              </div>




              </div>
<?php
include "$str/footer.php";
?>
