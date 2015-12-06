<?php
	
	include('dbconnect.php');
	
	if( $_POST ){
		$username = $_POST['Username'];  
		$password = $_POST['Password'];
		
		$query1 = "SELECT UserName FROM [User] WHERE Password = '$password'";
		$sql = sqlsrv_query($conn, $query1);
	
		if( !$sql ){
			echo "Incorrect query\n";		
		}
		else{
			
			$obj = sqlsrv_fetch( $sql );
			$username1 = sqlsrv_get_field($sql, 0);
			
			if($username1 == $username){
				$query2 = "SELECT * FROM UserDetail WHERE UserName = '$username1'";
				//$param2 = array($newpassword);
				$sql2 = sqlsrv_query($conn, $query2);
				
				
				$user = array();
				while( $obj1 = sqlsrv_fetch_object( $sql2 ) ){
					$user['Name'] = $obj1->Name;
					$user['Address1'] = $obj1->Address1;
					$user['Address2'] = $obj1->Address2;
					$user['Phone'] = $obj1->PhoneNumber;
					$user['Email'] = $obj1->Email;
				}
				
				echo json_encode($user);
			}
		}
		//header('Location: new_user.php');
		sqlsrv_close( $conn);
	}
?>