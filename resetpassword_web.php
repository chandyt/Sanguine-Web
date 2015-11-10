<?php
	include('dbconnect.php');
	
	if( $_POST ){
		$onetimepassword = $_POST['onetimepassword'];  
		$newpassword = $_POST['newpassword'];
	
		$query1 = "SELECT UserName FROM UserDetail WHERE OneTimePassword = '$onetimepassword'";
		$sql = sqlsrv_query($conn, $query1);

		if( !$sql ){
			echo "Enter the correct One Time Password\n";		
		}
		else{
			$obj = sqlsrv_fetch( $sql );
			$username = sqlsrv_get_field($sql, 0);
			
			$query2 = "UPDATE [User] SET Password = '$newpassword' WHERE UserName = '$username'";
			//$param2 = array($newpassword);
			$sql2 = sqlsrv_query($conn, $query2);
		}
		header('Location: user_login.html');

		sqlsrv_close( $conn);
	}
?>