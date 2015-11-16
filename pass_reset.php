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
<!--Navigation Bar -->
 <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container" style="margin-left:0; padding-left:0;">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
</div>
        <div align="right" width="100%" style="padding-right:50px;color:#FFFFFF">
          <a href="user_login.html">
            Sign In
            </a>
        </div>

      
    </div>
	<br/><br/>
	<div height="15px">
 <h1 style = "text-align: center">Reset Password</h1>
	</div>

<div class="row">
	<div class="col-lg-12">
		<form class="form-horizontal" action="resetpassword_web.php?go" method="post">
	  	<fieldset>
	  	<div class = "well col-lg-12">
	  		<!--legend style="padding-left:80px">Reset Password</legend-->
		
				<div class="form-group">
		  <label for="inputPassword1" class="col-lg-2 control-label">OneTime Password</label>
		  <div class="col-lg-4">
			<input type="password" class="form-control" id="inputPassword1" name="onetimepassword" placeholder="Onetime Password" required>
		  </div>
			</div>
			<div class="form-group">
		  <label for="inputPassword2" class="col-lg-2 control-label">New Password</label>
		  <div class="col-lg-4">
			<input type="password" class="form-control" id="inputPassword2" name="newpassword" placeholder="New Password" required>
		  </div>
		</div>

		<input type="submit" class="btn btn-success" style="margin-left: 9em"  value="Submit">
		</div>
	</div>
</div>

</body>

</html>
