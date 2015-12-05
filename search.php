<?php
session_start();
?>
<html>
<head>
	<meta charset="utf-8">
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

<?php 

include('dbconnect.php');
$searchId="";

if($_POST)
{
	$searchId = $_POST['userId'];
}
else
{
	$searchId =$_SESSION["searchUserName"];
	
}

if($searchId != "")
{
    $sql = "SELECT U.UserName as [username], * FROM  [User] U 
  			Left Join UserDetail UD ON  U.UserName= UD.UserName
  			Left Join BloodType BT  ON UD.UserName=BT.UserName
  			WHERE  U.UserTypeId=1  AND ( UD.UserName = '$searchId' OR UD.PhoneNumber = '$searchId') ";

        
	$stmt = sqlsrv_query( $conn, $sql);

	if( $stmt === false) {
		echo "false";
		die( print_r( sqlsrv_errors(), true) );
	}

$rows = sqlsrv_has_rows( $stmt );
if ($rows === true)
{
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		?> 
		<div class="container">
		<h2>Search Result</h2>
	  <table class="table table-hover"> 
		<thead>
		  <tr>
			<th>UserName</th>
			<th>Name</th>
			<th>PhoneNumber</th>
			<th>Email</th>
			<th>Blood Group</th>
		  </tr>
		</thead>
		<tbody>
		  <tr>
			<td><?php echo $row['username'] ?></td>
			<td><?php echo $row['Name'] ?></td>
			<td><?php echo $row['PhoneNumber'] ?></td>
			<td><?php echo  $row['Email'] ?></td>
			<td><?php echo $row['Type'] ?></td>
			<td><a href= <?php echo "edit_field.php?username=" . $row['username']?> > Edit Info</a></td>
			<td><a href= <?php echo "donation.php?username=" . $row['username']?>> Add Donation</a></td>
		  </tr>
		  </tbody>
	  </table>
	</div>
	<?php
		}
}
else
{
	?> 
		<div class="container">
		<h2>No result found.</h2>
			
	</div>
	
	<?php
}

	
	
//header('Location: search_result.html');

sqlsrv_free_stmt( $stmt); 

sqlsrv_close( $conn);
 
}
?>


