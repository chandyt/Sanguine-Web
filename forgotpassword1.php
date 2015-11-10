<?php
	include('dbconnect.php');
	
	if( $_POST ){
		 
		$email = $_POST['email'];
		
		$length = 7;
		$onetimepassword = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	
		$query1 = "UPDATE UserDetail SET OneTimePassword = '$onetimepassword' WHERE Email = '$email'";
		
	
		$sql = sqlsrv_query($conn, $query1);
	
		if( !$sql ){
			echo "Email don't match\n";		
		}
		else{
			$message = "Use the following one time password to Reset your password for your account in Sanguine. If you had not requested for a password reset, 
			please ignore this mail. \r\n {$onetimepassword}";
			//$message = wordwrap($message, 70, "\r\n");
			mail($email, 'Request for Password Reset', $message, 'From: webmaster@example.com');
		}
		header('Location: pass_reset.php');
		sqlsrv_close( $conn);
	}
?>