<?php
session_start();
include('dbconnect.php');

 $username = $_GET['username'];
  $sql = "SELECT TOP 1 U.UserName as [username], * FROM  [User] U 
  			Left Join UserDetail UD ON  U.UserName= UD.UserName
  			Left Join BloodType BT  ON UD.UserName=BT.UserName
  			WHERE  U.UserTypeId=1  AND ( UD.UserName = '$username') ";
 $stmt = sqlsrv_query( $conn, $sql);
 if( $stmt === false)
{
     echo "Error in query preparation/execution.\n";
     die( print_r( sqlsrv_errors(), true));
}
 while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
 {
	 $Name= $row['Name'];
 }
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
	  <div   align="Left" width="60%" style="Padding-left:30px; float: left; color:#FFFFFF">
        <h2>Sanguine</h2><br>
        </div>
        <div   align="right" width="100%" style="float: right;padding-right:50px;color:#FFFFFF">
         Welcome <b> <?php echo $_SESSION["DisplayName"]; ?></b><br>
		  <a href="signout.php?logout">
            Sign Out
            </a>
        </div>
    </div>
	<br/><br/>


    </div>

    <div style="padding-top:50px;" class="btn-group btn-group-justified">
		  <a class="btn btn-default" href="gpsdata.php">Send Blood Request</a>
		  <a class="btn btn-default" href="search_layout.php">Search</a>
		  <a class="btn btn-default" href="user_infoedit.php">Update Profile</a>
		  <a class="btn btn-default" href="DonationHistory.php">Donation History</a>
    </div>

    <form class="form-horizontal" action="UpdateDonationHistory.php" method="post" onsubmit="return checkPassword()">
      <fieldset>
      <div class = "well col-lg-12">
      
        <legend style="padding-left:80px">Enter Donation Information</legend>
        <div class="form-group">
          <label for="inputDonorName" class="col-lg-2 control-label">Donor Name</label>
          <div class="col-lg-4">
            <?php echo $Name ?>
          </div>
        </div>


		<input type="hidden" name="UserName" value="<?php echo $username ?>">
		
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
	<div class="form-group">
        <input type="submit" class="btn btn-success" style="margin-left:2em"  value="Submit">
		<input type="submit" class="btn btn-success" style="margin-left:2em"  value="Cancel">
		</div>
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