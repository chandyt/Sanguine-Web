<?php
session_start();
 $xdata=$_SESSION["data"];
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

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
		  <a class="btn btn-default" href="search_layout.php">Update Profile</a>
		  <a class="btn btn-default" href="DonationHistory.php">Donation History</a>
	</div>
	<br/><br/><br/>
	<div  style="padding-left:500px; ">
      <div style=" width: 500px;border: 1px solid #FFFFFF; border-bottom-right-radius: 1em; border-bottom-left-radius: 1em; border-top-right-radius: 1em; border-top-left-radius: 1em">
		<form role = "search" method="post" action= "search.php?go" id="searchform">
		<div >
		  <label for="searchId"> <h3>Search Donors </h3></label>
		  <span class="input-group-addon" id="sizing-addon3">
		  <input type="text" required class="form-control" name= "userId" placeholder="Username Or Phone number">
		  </span>
		  <div style="padding-left:400px;">
		  <input type="submit" class="btn btn-success" style="margin-left: 1em"  value="Search">
	</div>
    </div>
	</div>
</div>
  </body>
</html>
