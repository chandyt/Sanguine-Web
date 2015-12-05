<?php
 include('dbconnect.php');
 session_start();
if( $_POST )
{
	//echo $_POST['rdoAccountType'];
  $users_email = $_POST['Email'];
  $users_address1 = $_POST['Address1']  ;
  $users_address2 = $_POST['Address2']  ;
  $users_phone = $_POST['PhoneNumber'];
  $users_UserName = $_POST['Username'];  
  $users_password = $_POST['Password'];
  $users_type = $_POST['rdoAccountType'];
  $users_name = $_POST['Name'];
  $users_bloodtype = $_POST['bloodType'];
  if ($users_type=="2")
  {
	$users_Latitude=0;
	$users_Longitude=0;
  }
  else
  {
	$users_Latitude=$_POST['Latitude'];
	$users_Longitude=$_POST['Longitude'];
  }
  $users_LastUpdatedOn= date('m/d/Y h:i:s a', time());
	$query1="INSERT INTO [User] (UserName,Password,UserTypeId) VALUES (?,?,?)";
    $param1= array($users_UserName,$users_password,$users_type);
	$sql=sqlsrv_query($conn, $query1, $param1);

	if( !$sql )
	{
		echo "User already exists\n";
		
	}
	else
	{
		$query = "INSERT INTO [UserDetail]  (Name, Address1, Address2, PhoneNumber, Email, UserName, IsValidated) VALUES (?,?,?,?,?,?,?) ";
		$params = array($users_name, $users_address1, $users_address2, $users_phone, $users_email, $users_UserName, 0);
		echo $users_name . $users_address1 .'-'. $users_address2 .'-'. $users_phone .'-'. $users_email .'-'. $users_UserName;
		$sql=sqlsrv_query($conn, $query, $params);

		if( $sql )
			{

				echo "Row successfully inserted.\n";
				$query2="INSERT INTO [location] (UserName,Latitude,Longitude,LastUpdatedOn) VALUES (?,?,?,?)";
				$param2= array($users_UserName,$users_Latitude,$users_Longitude,$users_LastUpdatedOn);
				$sql=sqlsrv_query($conn, $query2, $param2);
				if( !$sql )
					{
						echo "Failed\n";
						
					}
					
			}
		else
			
			{
				
				echo "Row insertion failed.\n";
				die( print_r( sqlsrv_errors(), true));

			}
			if ($users_type==1)
			{
				$query3="INSERT INTO [BloodType] (UserName,Type) VALUES (?,?)";
				$param3= array($users_UserName,$users_bloodtype);
				$sql=sqlsrv_query($conn, $query3, $param3);
				if( !$sql )
					{
						echo "Failed\n";

						
					}
	
			}
			
	}
		$_SESSION["UserName"]=$users_UserName;
	$_SESSION["isAuthenticated"] = true;
	$_SESSION["DisplayName"] = $users_name;
	$_SESSION['add1'] =   $users_address1 ;
	$_SESSION['add2'] =   $users_address2;
	$_SESSION['phonenumber'] =  $users_phone;
	$_SESSION['emailaddress'] = $users_email;
	echo $users_type;

	if($users_type==2)
		header("Location: http://localhost/Sanguine-Web/jsonGenerator.php");
	else 
		header("Location: http://localhost/Sanguine-Web/donor_page.php");	
 
	//header('Location: new_user.php');
	
	sqlsrv_close( $conn);
}
?>