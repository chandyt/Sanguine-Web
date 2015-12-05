<?php
session_start();

?>

<?php 
include('dbconnect.php');

if( $_POST ){
  $users_username = $_POST['UserName'];  
  $users_email = $_POST['Email'];
  $users_address1 = $_POST['Address1']  ;
  $users_address2 = $_POST['Address2']  ;
  $users_phone = $_POST['PhoneNumber'];
  $users_name = $_POST['Name'];  
  $blood_type = $_POST['bloodType'];
  $users_isValidated=	$_POST['isValidated'];
  
 
	$query = "UPDATE [UserDetail] SET Name=(?), Address1=(?), Address2=(?), PhoneNumber=(?), Email=(?), IsValidated=(?) WHERE UserName = (?)";
	$params = array($users_name, $users_address1, $users_address2, $users_phone, $users_email,$users_isValidated, $users_username);
	
	$sql=sqlsrv_query($conn, $query, $params);

	if( $sql )
	{
		// Update the blood type in the table Bloodtype.............
		$query1 = "SELECT * FROM [bloodType] WHERE UserName = '$users_username'";
		$sql = sqlsrv_query($conn, $query1);
		if ($sql) {
			$rows = sqlsrv_has_rows( $sql );
			if ($rows === false)
			{
				$query1="INSERT INTO [bloodType] (UserName,Type) VALUES (?,?)";
				$param1= array($users_username,$blood_type);
				$sql=sqlsrv_query($conn, $query1, $param1);
			}
			else{
				
				$query3 = "UPDATE [bloodType] SET Type=? WHERE UserName = ?";
				$params3 = array($blood_type,$users_username);
				$sql=sqlsrv_query($conn, $query3, $params3);

			}
		}

	}

	//die( print_r( sqlsrv_errors(), true) );
	sqlsrv_close( $conn);
	
}
	
	$_SESSION["searchUserName"]= $users_username;
	header('Location: search.php?go');

?>