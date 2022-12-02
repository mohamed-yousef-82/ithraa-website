<?php
ob_start();
session_start();

?>
<!DOCTYPY html >
<html>
<head>
  <title><?php getTitle() ?></title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo"$css" ?>/start.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/style.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/animate.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/themes/blue-theme.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/themes/dark-theme.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/themes/magenta-theme.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/themes/orangered-theme.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/themes/turquoise-theme.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/font-awesome.min.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/rtl.css" />
</head>
<body>
<header>
</header>
<main class="start">
<div class="dashboard row row-medium">
