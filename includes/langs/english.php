<?php
function lang($phrase){
  static $lang = array(
    // Navbar Links
  "INDEX"      => "Home",
  "USERS" => "Users",
  "CATEGORIES" => "Categories",
  "ITEMS" => "Items",
  "COMMENTS" => "Comments",
  "LOGOUT" => "logout"
  );
  return $lang[$phrase];
};
?>
