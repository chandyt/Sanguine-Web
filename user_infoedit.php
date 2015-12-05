<?php
session_start();

 include('dbconnect.php');

 $username = $_SESSION["UserName"];
 echo $username;
  $sql = "SELECT TOP 1 U.UserName as [username], * FROM  [User] U 
  			Left Join UserDetail UD ON  U.UserName= UD.UserName
  			Left Join BloodType BT  ON UD.UserName=BT.UserName
  			WHERE  ( UD.UserName = '$username') ";
 $stmt = sqlsrv_query( $conn, $sql);
 if( $stmt === false)
{
     echo "Error in query preparation/execution.\n";
     die( print_r( sqlsrv_errors(), true));
}
 while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
 {
	 
	 $Name= $row['Name'];
	 $Email=  $row['Email'] ;
	 $PhoneNumber= $row['PhoneNumber'];
	 $Address1 =$row['Address1'];
	 $Address2 = $row['Address2'];
	 $BloodType= $row['Type'];
	 $UserType = $row['UserTypeId'];
 }


?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Sanguine</title>
    <link href="css/bootstrap.css" rel="stylesheet">

    <!--<link href="jumbotron.css" rel="stylesheet">-->
  </head>

<script>
var currentValue = 0;

function checkPassword(theForm) 
{
    var pass1 = document.getElementById("inputPassword1").value;
    var pass2 = document.getElementById("inputPassword2").value;
    var ok = true;
    if (pass1 != pass2) {
        alert("Passwords Do not match");
        document.getElementById("inputPassword1").style.borderColor = "#E34234";
        document.getElementById("inputPassword2").style.borderColor = "#E34234";
        ok = false;
    }
    else {
        //alert("Passwords Match!!!");
    }
    return ok;
}


</script>
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
  
  <div class="">
      <div class="container">
    <div class = "row">
    <div class="col-md-12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <h1 style = "text-align: center">Update Your Profile</h1>
    </div>
        </div>
    </div>
    </div>
    </div>
  <!-- Buttons! -->
  
  
  <div class="row">
  <div class="col-lg-12">
  <form class="form-horizontal" action="profile_update.php?go" method="post" onsubmit="return checkPassword()">
    <fieldset>
    <div class = "well col-lg-12">
    
    <legend style="padding-left:80px">Input Credentials</legend>
  
      <div class="form-group">
      <label for="inputName" class="col-lg-2 control-label">Name</label>
      <div class="col-lg-4">
      <input type="text" class="form-control" name="Name" id="inputName" value="<?php echo $Name ?>" required>
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-4">
      <input type="text" class="form-control" id="inputEmail" name="Email" placeholder="abc@xyz.com" value="<?php echo $Email ?>" required>
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword1" class="col-lg-2 control-label">Password</label>
      <div class="col-lg-4">
      <input type="password" class="form-control" id="inputPassword1" name="Password" placeholder="Password" required>
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword2" class="col-lg-2 control-label">Confirm Password</label>
      <div class="col-lg-4">
      <input type="password" class="form-control" id="inputPassword2" placeholder="Password" required>
      </div>
    </div>
    <div class="form-group">
      <label for="inputPhoneNumber" class="col-lg-2 control-label">Phone Number</label>
      <div class="col-lg-4">
      <input type="text" class="form-control" name="PhoneNumber" id="inputPhoneNumber" value="<?php echo $PhoneNumber ?>" required>
      </div>
    </div>
    <div class="form-group">
      <label for="inputStreetAddress1" class="col-lg-2 control-label">Street Address Line 1
      </label>
      <div class="col-lg-4">
      <input type="text" class="form-control" name="Address1" id="inputStreetAddress1" value="<?php echo $Address1 ?>" required>
      </div>
    </div>
    <div class="form-group">
      <label for="inputStreetAddress2"  class="col-lg-2 control-label">Line 2</label>
      
      <div class="col-lg-4">
      <input type="text" class="form-control" name="Address2" id="inputStreetAddress2" value="<?php echo $Address2 ?>" required>
      </div>
    </div>
<input type="hidden" name="bloodType" value="None">    
	<?php if ($UserType===1)
	{	
	?>
	
    <div id="dvBloodType" >
      
    <label for="inputStreetAddress2" class="col-lg-2 control-label">Blood Type</label>

	<select name="bloodType" id="bloodType">
        <option value="All">All</option>
        <option value="A+" <?php if ($BloodType =="A+") echo "Selected" ?>>A+</option>
        <option value="A-" <?php if ($BloodType =="A-") echo "Selected" ?>>A-</option>
        <option value="B+" <?php if ($BloodType =="B+") echo "Selected" ?>>B+</option>
        <option value="B-" <?php if ($BloodType =="B-") echo "Selected" ?>>B-</option>
        <option value="AB+" <?php if ($BloodType =="AB+") echo "Selected" ?>>AB+</option>
        <option value="AB-" <?php if ($BloodType =="AB-") echo "Selected" ?>>AB-</option>
        <option value="O+" <?php if ($BloodType =="O+") echo "Selected" ?>>O+</option>
        <option value="O-" <?php if ($BloodType =="O-") echo "Selected" ?>>O-</option>
        
      </select>
      </div>    

	<?php 
	}
	?>

    <input type="submit" class="btn btn-success" style="margin-left:2em"  value="Submit">
    </fieldset>
  </div>
  </fieldset> 
 </form>
</div>
</div>
  
    
  <div class="container">
  <hr>
  <footer>
        <p>&copy; Sanguine 2015</p>
      </footer>
    </div> <!-- /container -->
  


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>
