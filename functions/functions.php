<?php
/*---Select From Database ---*/
Function sql($sql,$fetch){
  global $con;
  global $count;
  global $data;
  $stmt = $con->prepare($sql);
  $stmt->execute();
  if ($fetch !== ""){
  $count = $stmt->rowCount();
  $data = $stmt->$fetch();
  return $data;
  }
}

/*---Upload File ---*/
Function upload($upload,$oldupload,$src){
  global $file_src;
  global $tmp_file;
  global $insert_src;
  global $allow_extension;
  $file=$_FILES[$upload]["name"];
  $ext = pathinfo($file, PATHINFO_EXTENSION);
  $file = "file_".time().rand(5, 15).".".$ext;
  $tmp_file=$_FILES[$upload]["tmp_name"];
  $file_src=$src.$file;
  $insert_src=str_replace("../","",$file_src);
  $allow_extension = array("jpeg","jpg","gif","png","pdf","pptx");
  $file_ext = explode(".",$file);
  $file_extension = strtolower(end($file_ext));
  if (isset($_FILES[$upload])){
  if(!empty($_FILES[$upload]) && !empty($_FILES[$upload]["tmp_name"])){
  if (in_array($file_extension,$allow_extension)){
  move_uploaded_file($tmp_file,$file_src);
}else{
  echo "File Extension Not Allowed";
}
  }else{
    $insert_src=$oldupload;
  }
  }
  }
  /*---Upload2 File ---*/
  Function upload2($upload,$oldupload,$src){
    global $file_src2;
    global $tmp_file2;
    global $insert_src2;
    global $allow_extension2;
    $file=$_FILES[$upload]["name"];
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $file = "file_".time().rand(5, 15).".".$ext;
    $tmp_file2=$_FILES[$upload]["tmp_name"];
    $file_src2=$src.$file;
    $insert_src2=str_replace("../","",$file_src2);
    $allow_extension2 = array("jpeg","jpg","gif","png","pdf","pptx");
    $file_ext2 = explode(".",$file);
    $file_extension2 = strtolower(end($file_ext2));
    if (isset($_FILES[$upload])){
    if( !empty($_FILES[$upload]) && !empty($_FILES[$upload]["tmp_name"])){
    if (in_array($file_extension2,$allow_extension2)){
    move_uploaded_file($tmp_file2,$file_src2);
  }else{
    echo "File Extension Not Allowed";
  }
  }else{
    $insert_src2=$oldupload;
  }
    }
    }
    /*---Upload3 File ---*/

    Function upload3($upload,$oldupload,$src){
      global $file_src3;
      global $tmp_file3;
      global $insert_src3;
      global $allow_extension2;
      $file=$_FILES[$upload]["name"];
      $ext = pathinfo($file, PATHINFO_EXTENSION);
      $file = "file_".time().rand(5, 15).".".$ext;
      $tmp_file3=$_FILES[$upload]["tmp_name"];
      $file_src3=$src.$file;
      $insert_src3=str_replace("../","",$file_src3);
      $allow_extension3 = array("jpeg","jpg","gif","png","pdf","pptx");
      $file_ext3 = explode(".",$file);
      $file_extension3 = strtolower(end($file_ext3));
      if (isset($_FILES[$upload])){
      if (!empty($_FILES[$upload]) && !empty($_FILES[$upload]["tmp_name"])){
      if (in_array($file_extension3,$allow_extension3)){
      move_uploaded_file($tmp_file3,$file_src3);
    }else{
      echo "File Extension Not Allowed";
    }
    }else{
      $insert_src3=$oldupload;
    }
      }
      }

      /*---Upload4 File ---*/

      Function upload4($upload,$oldupload,$src){
        global $file_src4;
        global $tmp_file4;
        global $insert_src4;
        global $allow_extension2;
        $file=$_FILES[$upload]["name"];
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $file = "file_".time().rand(5, 15).".".$ext;
        $tmp_file4=$_FILES[$upload]["tmp_name"];
        $file_src4=$src.$file;
        $insert_src4=str_replace("../","",$file_src4);
        $allow_extension4 = array("jpeg","jpg","gif","png","pdf","pptx");
        $file_ext4 = explode(".",$file);
        $file_extension4 = strtolower(end($file_ext4));
        if (isset($_FILES[$upload])){
        if (!empty($_FILES[$upload]) && !empty($_FILES[$upload]["tmp_name"])){
        if (in_array($file_extension4,$allow_extension4)){
        move_uploaded_file($tmp_file4,$file_src4);
      }else{
        echo "File Extension Not Allowed";
      }
      }else{
        $insert_src4=$oldupload;
      }
        }
        }



        /*---Upload5 File ---*/

        Function upload5($upload,$oldupload,$src){
          global $file_src5;
          global $tmp_file5;
          global $insert_src5;
          global $allow_extension2;
          $file=$_FILES[$upload]["name"];
          $ext = pathinfo($file, PATHINFO_EXTENSION);
          $file = "file_".time().rand(5, 15).".".$ext;
          $tmp_file5=$_FILES[$upload]["tmp_name"];
          $file_src5=$src.$file;
          $insert_src5=str_replace("../","",$file_src5);
          $allow_extension5 = array("jpeg","jpg","gif","png","pdf","pptx");
          $file_ext5 = explode(".",$file);
          $file_extension5 = strtolower(end($file_ext5));
          if (isset($_FILES[$upload])){
          if (!empty($_FILES[$upload]) && !empty($_FILES[$upload]["tmp_name"])){
          if (in_array($file_extension5,$allow_extension5)){
          move_uploaded_file($tmp_file5,$file_src5);
        }else{
          echo "File Extension Not Allowed";
        }
        }else{
          $insert_src5=$oldupload;
        }
          }
          }


          /*---Upload4 File ---*/

          Function upload6($upload,$oldupload,$src){
            global $file_src6;
            global $tmp_file6;
            global $insert_src6;
            global $allow_extension2;
            $file=$_FILES[$upload]["name"];
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $file = "file_".time().rand(5, 15).".".$ext;
            $tmp_file6=$_FILES[$upload]["tmp_name"];
            $file_src6=$src.$file;
            $insert_src6=str_replace("../","",$file_src6);
            $allow_extension6 = array("jpeg","jpg","gif","png","pdf","pptx");
            $file_ext6 = explode(".",$file);
            $file_extension6 = strtolower(end($file_ext6));
            if (isset($_FILES[$upload])){
            if (!empty($_FILES[$upload]) && !empty($_FILES[$upload]["tmp_name"])){
            if (in_array($file_extension6,$allow_extension6)){
            move_uploaded_file($tmp_file6,$file_src6);
          }else{
            echo "File Extension Not Allowed";
          }
          }else{
            $insert_src6=$oldupload;
          }
            }
            }
/*---Insert In Database ---*/
// Function sql($sql){
//   global $con;
//   $stmt = $con->prepare($sql);
//   $stmt->execute();
//   }
/*--- Echo Page Title ---*/
function getTitle(){
  global $pageTitle;
  if(isset($pageTitle)){
  echo $pageTitle;
  }else{
  echo 'Default';
  }
}
/*--- Redirect Function ---*/
function redirect($Msg,$url=null,$seconds=1){
  if($url === null){
    $url="index.php";
    $link ="Home Page";
  }else{
    $url = isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !==''?$_SERVER['HTTP_REFERER']:'index.php';
  }
  echo "$Msg";
  // echo "<div class='alert alert-danger'>You Will Be Redirect To $url After $seconds Seconds</div>";
  header("refresh:$seconds;url=$url");
  exit();
}

// Check Items In Database Function
function checkItems($select,$from,$value){
  global $con;
  $stmt = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
  $stmt->execute(array($value));
  $count = $stmt->rowCount();
  return "$count";
}

// Counter Function

function counter($item,$table){
  global $con;
  $stmt = $con->prepare("SELECT COUNT($item) From $table");
  $stmt->execute();
  return $stmt->fetchcolumn();
}

// Latest Items Function
Function getLatest($select){
  global $con;
  $stmt = $con->prepare($select);
  $stmt->execute();
  $rows = $stmt -> fetchAll();
  return $rows;
}

function Check_User_Status($user){
  global $con;
  $stmts = $con->prepare("SELECT
    Username,RegStatus
    FROM users
    WHERE
    Username = ?
    AND RegStatus = 0 ");

  $stmts->execute(array($user));
  $status = $stmts->rowCount();
  return $status;
}

function pages(){
  global $page_items;
  global $page_start;
  global $page_items;
  $page_items =10;
  if (isset($_GET['page'])){
  $page=$_GET['page'];
  if ($page =="" || $page =="1"){
  $page_start =0;
  }else{
  $page_start=($page*$page_items)-$page_items;
  }
  }else{
  $page_start =0;
  }
}
function pages_links($table){
  global $con;
  global $page_items;
  $stmt = $con->prepare("SELECT * FROM $table");
  $stmt->execute();
  $count = $stmt->rowCount();
  $pages_num = ceil($count/$page_items);
  echo "<ul class='pages'>";
  for($a=1;$a<=$pages_num;$a++){
  echo "<li><a href='?page=$a'>$a</a><li>";
  }
  echo "</ul>";
  }


?>
