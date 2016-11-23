<?php
session_start();
/*
* Header
* Author: Stephen King
* Version 2016.10.5.1
*
* This page controls all of the dependencies and opening tags for the website.
*/

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Serpent</title>

      <!-- Bootstrap Core CSS -->
    <link href="startbootstrap-admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="startbootstrap-admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
   <!-- <link href="startbootstrap-admin/dist/css/timeline.css" rel="stylesheet">

	<!--Morris Charts CSS-->
	<link href="startbootstrap-admin/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="startbootstrap-admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="startbootstrap-admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	 <!-- jQuery -->
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>-->
    <script src="startbootstrap-admin/vendor/jquery/jquery.min.js"></script>

	 <!-- Bootstrap Core JavaScript -->
    <script src="startbootstrap-admin/vendor/bootstrap/js/bootstrap.min.js"></script>

	 <!-- Metis Menu Plugin JavaScript -->
    <script src="startbootstrap-admin/vendor/metisMenu/metisMenu.min.js"></script>

    <!--Font Awesome-->
    <link rel="stylesheet" href="dependencies/fontawesome/css/font-awesome.min.css">

    <!-- Custom Theme JavaScript -->
    <script src="startbootstrap-admin/dist/js/sb-admin-2.js"></script>

	<!-- TPS Generated Content -->
	<link href="dependencies/css/tiles.css" rel="stylesheet">
	<link href="dependencies/css/text.css" rel="stylesheet">
    <link href="dependencies/css/displays.css" rel="stylesheet">
    <link href="dependencies/css/highhandform.css" rel="stylesheet">
    <link href="dependencies/css/glyphicons.css" rel="stylesheet">
    <link href="dependencies/css/ring.css" rel="stylesheet">
    <link href="dependencies/css/cards.css" rel="stylesheet">
    <link href="dependencies/css/styling.css" rel="stylesheet">
    <link href="dependencies/css/displaymodal.css" rel="stylesheet">

	<?php
    require_once("HelperFunctions.php");
    require_once(getServerPath()."dbcon.php");
    $dbcon = NEW DbCon();
   ?>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


</head>
