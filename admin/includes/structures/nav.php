<aside class="box box-1">
<nav>
      <a class="admin-logo" href="dashboard.php"><img src="<?php echo"$img/logo.png" ?>" /></a>
        <?php
        if(isset($_SESSION['username'])){
        echo "<p class='welcome'>welcome $_SESSION[username]<p/>";
        }else{
          header('Location:index.php');
          exit();
        }
        ?>
        <ul>
        <li class="active"><a href="dashboard.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('INDEX') ?></a></li>
        <li>
        <a href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-text" aria-hidden="true"></i>المستخدم <span class="caret"></span></a>
            <ul>
            <li><a href="../index.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('VISIT_SHOP') ?></a></li>
            <li><a href="admin_users.php?do=edit&user_id=<?php echo $_SESSION['id']?>"><i class="fa fa-file-text" aria-hidden="true"></i>تعديل </a></li>
            <li><a href="logout.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('LOGOUT') ?></a></li>
            </ul>
        </li>
        <li>
        <a href="#"><i class="fa fa-file-text" aria-hidden="true"></i>عن الموقع <span class="caret"></span></a>
        <ul>
          <li><a href="about.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('ABOUT') ?></a></li>
          <li><a href="logo.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('LOGO') ?></a></li>
          <li><a href="contact.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('CONTACT') ?></a></li>
        </ul>
        </li>
        <li><a href="ithraa.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('ITHRAA') ?></a></li>
        <li><a href="members.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('MEMBERS') ?></a></li>
        <li><a href="users.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('USERS') ?></a></li>
        <li><a href="admin_users.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('ADMIN_USERS') ?></a></li>
        <li><a href="categories.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('CATEGORIES') ?></a></li>
        <li><a href="items.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('ITEMS') ?></a></li>
        <li><a href="comments.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('COMMENTS') ?></a></li>

        <li><a href="clients.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('CLIENTS') ?></a></li>

        <li><a href="slideshow.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('SLIDESHOW') ?></a></li>
        <li><a href="socialmedia.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('SOCIALMEDIA') ?></a></li>
        <li><a href="accordion.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('ACCORDION') ?></a></li>
        <li><a href="counter.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('COUNTER') ?></a></li>
        <!-- <li><a href="request.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('REQUEST') ?></a></li> -->
        <li><a href="message.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('MESSAGE') ?></a></li>
        </ul>
</nav>
</aside>
