<?php
session_start();
 //$xdata=$_SESSION["data"];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sanguine-Donor Tracking</title>
	<meta charset="utf-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.css" />
	<link rel="stylesheet" type="text/css" href="css/styles.css">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Sanguine</title>
    <link href="css/bootstrap.css" rel="stylesheet">
</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" width="100%">
      <div class="container" style="margin-left:0;">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>

        </div>
      </div>
        <div   align="right" width="100%" style="padding-right:50px;color:#FFFFFF">
         Welcome <b> <?php echo $_SESSION["DisplayName"]; ?></b><br>
		  <a href="user_login.html">
            Sign Out
            </a>
        </div>


    </div>
 	
 	<div style="padding-top:50px;" class="btn-group btn-group-justified">
		  <!--a class="btn btn-default" href="maps.php">Send Blood Request</a>
		  <a class="btn btn-default" href="search_layout.php">Search</a-->
		  <a class="btn btn-default" href="search_layout.php">Update Profile</a>
		  <a class="btn btn-default" href="#">Donation History</a>
	</div>