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
		  <a href="signout.php?logout">
            Sign Out
            </a>
        </div>


    </div>
 	
 	<div style="padding-top:50px;" class="btn-group btn-group-justified">
		  <!--a class="btn btn-default" href="maps.php">Send Blood Request</a>
		  <a class="btn btn-default" href="search_layout.php">Search</a-->
		  <a class="btn btn-default" href="user_infoedit.php">Update Profile</a>
		  <a class="btn btn-default" href="#">Donation History</a>
	</div>

    <div class ="row" >
        <span class="label label-default"><h1>  <?php echo $_SESSION["DisplayName"]; ?> </h1></span>
    
    </div>
   <!--h2>Basic Table</h2>
  <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p--> 
  <?php
  include('dbconnect.php');
  $searchId = $_SESSION['UserName'];


         $sql = "SELECT * FROM  [User] U 
            Left Join UserDetail UD ON  U.UserName= UD.UserName
            Left Join BloodType BT  ON UD.UserName=BT.UserName
            WHERE  UD.UserName = '$searchId' ";

        //$params = array($searchId);
        
    $stmt = sqlsrv_query( $conn, $sql);

    if( $stmt === false) {
    echo "Insertion Failed";
    die( print_r( sqlsrv_errors(), true) );
    }

    

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
    //echo $row['Name'].", ".$row['PhoneNumber'].",".$row['UserName'].",".$row['Email']."," .$row['Type']." <br />";
    $UserName = $row['UserName'];
    $Name = $row['Name'];
    $PhoneNumber = $row['PhoneNumber'];
    $Email = $row['Email'];
    $Type = $row['Type'];
    $Address1  = $row['Address1'];
    $Address2  = $row['Address2'];
    $UserTypeId   = $row['UserTypeId'];

    include "user_info.html";
}

sqlsrv_free_stmt( $stmt); 

sqlsrv_close( $conn);


?> 

  
