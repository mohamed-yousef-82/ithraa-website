<?php
$sdb = "mysql:host=localhost;dbname=ithraa";
$user = "root";
$pass = "";
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",);

try {
    $con = new PDO($sdb, $user, $pass,$options);
    // set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
