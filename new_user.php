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
function handleRadioChanged(myRadio) {
    if( myRadio.value=="1")
		document.getElementById("dvBloodType").style.display = 'block';
	else
		document.getElementById("dvBloodType").style.display = 'none';
}

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
	
	
	 <div class="jumbotron">
      <div class="container">
		<div class = "row">
		<div class="col-md-12">
		<h1 style = "text-align: center">Register for Sanguine</h1>
		</div>
        </div>
		</div>
	  </div>
    </div>
	
	<!-- Buttons! -->
	
<!--<div class="btn-group btn-group-justified">
  <a class="btn btn-default" href="user_login.html">Home</a>
  <a class="btn btn-default" href="new_user.php">Register</a>
  <a class="btn btn-default" href="maps.php">Send Blood Request</a>
  <a class="btn btn-default" href="#">About Us</a>
</div>-->
	
	<div class="row">
	<div class="col-lg-12">
	<form class="form-horizontal" action="postdetails.php" method="post" onsubmit="return checkPassword()">
	  <fieldset>
	  <div class = "well col-lg-12">
	  
		<legend style="padding-left:80px">Input Credentials</legend>
		<div class="form-group">
		  <label for="inputName" class="col-lg-2 control-label">Name</label>
		  <div class="col-lg-4">
			<input type="text" class="form-control" name="Name" id="inputName" required>
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputUsername" class="col-lg-2 control-label">Username</label>
		  <div class="col-lg-4">
			<input type="text" class="form-control" id="inputUsername" name="Username" placeholder="Username"required>
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputEmail" class="col-lg-2 control-label">Email</label>
		  <div class="col-lg-4">
			<input type="text" class="form-control" id="inputEmail" name="Email" placeholder="abc@xyz.com"required>
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
			<input type="text" class="form-control" name="PhoneNumber" id="inputPhoneNumber" required>
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputStreetAddress1" class="col-lg-2 control-label">Street Address Line 1
		  </label>
		  <div class="col-lg-4">
			<input type="text" class="form-control" name="Address1" id="inputStreetAddress1" required>
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputStreetAddress2"  class="col-lg-2 control-label">Line 2</label>
		  
		  <div class="col-lg-4">
			<input type="text" class="form-control" name="Address2" id="inputStreetAddress2" required>
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputStreetAddress2" class="col-lg-2 control-label">Account Type</label>
		  <div class="col-lg-4">
			<input type="radio" class="" name="rdoAccountType" required value="1" onchange="handleRadioChanged(this)"> Donor
			<input type="radio" class="" name="rdoAccountType" required value="2" onchange="handleRadioChanged(this)" checked> Blood Bank
			
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


		<input type="submit" class="btn btn-success" style="margin-left:2em"  value="Register">
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
