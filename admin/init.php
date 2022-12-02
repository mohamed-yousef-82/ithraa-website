<?php
include "../config.php";
//routes
$str="includes/structures";  //structures directory
$css="layout/css";  //css structures directory
$js="layout/js"; //js structures directory
$img="layout/images"; //Images structures directory
$fn="../functions"; //functions structures directory
$lang="includes/langs"; //js structures directory
//Include Files
include "$lang/english.php";
include "$fn/functions.php";
include "$str/header.php";
if (!isset($noNavbar)){
include "$str/nav.php";
}
?>
