
<?php

 include('dbconnect.php');
//if( $_POST )
//{



  /*$users_email = $_POST['blah'];
  $users_address = $_POST['LOL'];
  $users_phone = $_POST['YOLO'];
  $users_UserName = $_POST['SWAG'];  
  $users_password = $_POST['PASS'];
  $users_type = $_POST['1'];
  $users_name = $_POST['foofighters'];
  $users_Latitude=$_POST['Latitude'];
  $users_Longitude=$_POST['Longitude'];
  $users_LastUpdatedOn=$_POST['LastUpdatedOn'];*/
  $users_name = 'foofighters';
  $users_email = 'blah';
  $users_address ='LOL';
  $users_phone = 'YOLO';
  $users_UserName = 'SWAG';  
  $users_password = 'PASS';
  $users_type = '1';
  $users_Latitude='0';
  $users_Longitude='0';
  $users_LastUpdatedOn='10/14/2015 11:22 AM';


	$query1="INSERT INTO [User] (UserName,Password,UserTypeId) VALUES (?,?,?)";
    $param1= array($users_UserName,$users_password,$users_type);
	//echo $query1;
	$sql=sqlsrv_query($conn, $query1, $param1);
	if( !$sql )
	{
		echo "User already exists\n";
		
	}
	else
	{
		$query = "INSERT INTO [UserDetail]  (Name, Address, PhoneNumber, Email, UserName) VALUES (?,?,?,?,?) ";
		$params = array($users_name, $users_address, $users_phone, $users_email, $users_UserName);
	
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
	}
	
    sqlsrv_free_stmt( $query);
	sqlsrv_close( $conn);

//}
?>
