<?php
session_start();
 $xdata=$_SESSION["data"];
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
		  <a href="signout.php?logout">
            Sign Out
            </a>
        </div>


    </div>

    <div style="padding-top:50px;" class="btn-group btn-group-justified">
          <a class="btn btn-default" href="maps.php">Send Blood Request</a>
          <a class="btn btn-default" href="search_layout.php">Search</a>
          <a class="btn btn-default" href="bloodbank_infoedit.php">Update Profile</a>
          <a class="btn btn-default" href="#">Donation History</a>
    </div>

    <form class="form-horizontal" action="postdetails.php" method="post" onsubmit="return checkPassword()">
      <fieldset>
      <div class = "well col-lg-12">
      
        <legend style="padding-left:80px">Enter Donation Information</legend>
        <div class="form-group">
          <label for="inputDonorName" class="col-lg-2 control-label">Donor Name</label>
          <div class="col-lg-4">
            <input type="text" class="form-control" name="DonorName" id="inputDonorName" required>
          </div>
        </div>

        <div id="dvBloodType" style="display:none">
            
          <label for="inputStreetAddress2" class="col-lg-2 control-label">Blood Type</label>

            <select name="bloodType" id="bloodType">
              <!--option value="All">All</option-->
              <option value="A+">A+</option>
              <option value="A-">A-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>
              <option value="AB+">AB+</option>
              <option value="AB+">AB-</option>
              <option value="O+">O+</option>
              <option value="O-">O-</option>
              
            </select>
        </div>

        <div class="form-group">
          <label for="inputBP" class="col-lg-2 control-label">Blood Pressure</label>
          <div class="col-lg-4">
            <input type="text" class="form-control" id="inputBP" name="BP" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputTemp" class="col-lg-2 control-label">Temperature</label>
          <div class="col-lg-4">
            <input type="text" class="form-control" id="inputTemp" name="Temperature" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputCholesterol" class="col-lg-2 control-label">Cholesterol</label>
          <div class="col-lg-4">
            <input type="text" class="form-control" id="inputCholesterol" name="Cholesterol" required>
          </div>
        </div>

        <input type="submit" class="btn btn-success" style="margin-left:2em"  value="Submit">
      </fieldset>
    </div>
    </fieldset> 
    </form>

    <div class="container">
    <hr>
    <footer>
        <p>&copy; Sanguine 2015</p>
      </footer>
    </div>
</body>