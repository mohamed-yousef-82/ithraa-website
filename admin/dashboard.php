<?php
$pageTitle ="Admin";
include "init.php";
/*---Get Last Admin Users ---*/
$Latest_Admin_Users =getLatest("SELECT * FROM users WHERE groupid != 2 ORDER BY user_id DESC LIMIT 5");
/*---Get Last Admin Users ---*/
$Latest_Interface_Users =getLatest("SELECT * FROM users WHERE groupid = 2 ORDER BY user_id DESC LIMIT 5");
/*---Get Last Items ---*/
$Latest_Items =getLatest("SELECT * FROM items ORDER BY item_id DESC LIMIT 5");
?>
<section class="main-section box box-5">
  <div class="view-data">
  <div class="page-container">
  <div class="row stats">
        <div class="box box-1">
          <div class="stat">
            <i class="fa fa-users" aria-hidden="true"></i>
            <p>عدد المستخدمين</p>
            <span><a href="admin_users.php"><?php echo counter('user_id','users'); ?></a></span>
          </div>
        </div>
        <div class="box box-1">
          <div class="stat">
            <i class="fa fa-user" aria-hidden="true"></i>
            <p>بانتظار الموافقة </p>
            <span><a href="admin_users.php?do=manage&page=pending"><?php echo checkItems('regstatus','users','0'); ?></a></span>
          </div>
        </div>
        <div class="box box-1">
          <div class="stat">
            <i class="fa fa-pencil" aria-hidden="true"></i>
            <p>اجمالى الفعاليات  </p>
            <span><a href="items.php"><?php echo counter('item_id','items'); ?></a></span>
          </div>
        </div>
        <div class="box box-1">
          <div class="stat">
            <i class="fa fa-comments" aria-hidden="true"></i>
            <p>اجمالى العملاء </p>
            <span><a href="comments.php"><?php echo counter('client_id','clients'); ?></a></span>
          </div>
        </div>
        <div class="box box-1">
          <div class="stat">
            <i class="fa fa-comments" aria-hidden="true"></i>
            <p>فروع الديوانية</p>
            <span><a href="comments.php"><?php echo counter('cat_id','categories'); ?></a></span>
          </div>
        </div>
      </div>
  <div class="row top-space">
      <div class="box box-1">
<div class="panel">
        <h3 class="section-title"><i class="fa fa-folder-open" aria-hidden="true"></i>احدث الاعضاء المسجلين</h3>
            <ul>
            <?php
            if(!empty($Latest_Admin_Users)){
            foreach ($Latest_Admin_Users as $user) {
              echo "<li>";
              echo "<span>$user[username]</span>";
              echo "<div>";
              echo "<a href='admin_users.php?do=edit&user_id=$user[user_id]' class='start-btn green'><i class='fa fa-edit' ></i>تعديل</a>";
              echo "<a href='admin_users.php?do=delete&user_id=$user[user_id]' class='start-btn orangered'><i class='fa fa-close'></i>حذف</a>";
              if($user['regstatus']==0){
              echo "<a href='admin_users.php?do=activate&user_id=$user[user_id]' class='start-btn dark'><i class='fa fa-eye-slash' aria-hidden='true'></i>تنشيط</a>";
              echo "</div>";
              }
              echo "</li>";
            }
              }
            else{
                echo "<div class='nodata'>لا يوجد داتا لعرضها</div>";
            }
            ?>
            </ul>
          </div>
          </div>
            <div class="box box-1">
      <div class="panel">
          <h3 class="section-title"><i class="fa fa-folder-open" aria-hidden="true"></i></i>احدث المستخدمين المسجلين </h3>

            <ul>
            <?php
            if(!empty($Latest_Interface_Users)){
            foreach ($Latest_Interface_Users as $user) {
              echo "<li>";
              echo "<span>$user[username]</span>";
              echo "<a href='admin_users.php?do=delete&user_id=$user[user_id]' class='start-btn orangered'><i class='fa fa-close'></i>حذف</a>";
              if($user['regstatus']==0){
              echo "<a href='admin_users.php?do=activate&user_id=$user[user_id]' class='start-btn dark'><i class='fa fa-eye-slash' aria-hidden='true'></i>تنشيط</a>";
              }
              echo "</li>";
            }
              }
            else{
                echo "<div class='nodata'>لا يوجد داتا لعرضها</div>";
            }
            ?>
            </ul>

</div>
      </div>
      </div>
      <div class="row row-medium top-space">
      <div class="box box-1">
        <div class="panel">
          <h3 class="section-title"><i class="fa fa-folder-open" aria-hidden="true"></i>احدث العناصر المضافة</h3>
            <ul class="list-unstyled last-users">
            <?php
          if(!empty($Latest_Items)){
            foreach ($Latest_Items as $item) {
              echo "<li>";
              echo "<span>$item[name]</span>";
              echo "<a href='items.php?do=edit&itemid=$item[item_id]' class='start-btn green'><i class='fa fa-edit' ></i>تعديل</a>";
              echo "<a href='items.php?do=delete&itemid=$item[item_id]' class='start-btn orangered'><i class='fa fa-close'></i>حذف</a>";
              if($item['approve']==0){
              echo "<a href='items.php?do=approve&itemid=$item[item_id]' class='start-btn dark'><i class='fa fa-check'></i>موافقة</a>";
              }
              echo "</li>";
            }
              }
            else{
                echo "<div class='nodata'>لا يوجد داتا لعرضها</div>";
            }
            ?>
            </ul>
        </div>
      </div>

      <div class="box box-1">
        <div class="panel">
          <h3 class="section-title"><i class="fa fa-folder-open" aria-hidden="true"></i>احدث الصور </h3>
      <?php
      //Select comments Data From database
      $select = sql("SELECT tabs_items.*,tabs.title AS category
                       FROM tabs_items INNER JOIN tabs ON tabs.id = tabs_items.tab
                       ORDER BY id Desc LIMIT 2","fetchAll");

        if(!empty($select)){
        foreach ($select as $select_view) {
        echo "<ul>";
        echo "<li>";
        echo "$select_view[title]";
        echo"<br/>";
        echo "$select_view[description]";
        echo"<br/>";
        echo"<img style='width:70px;height:70px;' src='../$select_view[image]' />";
        echo"<br/>";
        echo"<br/>";
        echo"<td><div class='inline-btn'><a href='?do=edit&itemid=$select_view[id]' class='start-btn green'><i class='fa fa-edit'></i>تعديل</a>
        <a href='?do=delete&itemid=$select_view[id]' class='start-btn orangered confirm'><i class='fa fa-close'></i>حذف</a>";
        echo"<br/>";
        echo "</li>";
        echo "</ul>";
      }
    }  else{
          echo "<div class='nodata'>لا يوجد بيانات لعرضها</div>";
      }
      ?>
        </div>
      </div>
</div>
</div>
</section>
</div>
</div>
</main><!--End Start-->
<?php
include_once "$str/footer.php";
?>
