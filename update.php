<?php
session_start();
$check = $_SESSION['UserName'];
?>

<?php 
include('dbconnect.php');
//if ( isset($_SESSION['UserName'])){
//	echo "Welcome to sanguine"."$_SESSION['DisplayName']";
	//include"edit_field.html";
//$check = "harsh";
//echo $check;
if( $_POST ){
	//echo $_POST['rdoAccountType'];
  $users_email = $_POST['Email'];
  $users_address1 = $_POST['Address1']  ;
  $users_address2 = $_POST['Address2']  ;
  $users_phone = $_POST['PhoneNumber'];
  //$users_Name = $_POST['Name'];  
  //$users_password = $_POST['Password'];
  $blood_type = $_POST['bloodType'];

  $users_type = $_POST['rdoAccountType'];
  $users_name = $_POST['Name'];
// if ($users_type=="2")
 // {
	//$users_Latitude=0;
//	$users_Longitude=0;        
// }
//  else
 // {
 //   $users_Latitude=$_POST['Latitude'];
//	$users_Longitude=$_POST['Longitude'];
//  }
//  $users_LastUpdatedOn= date('m/d/Y h:i:s a', time()); 

// need to get the user's UserName from the login page==> $UserName


	//$query1="UPDATE [User] SET UserTypeId = '$users_type' WHERE UserName = '$check'";
	$query1="UPDATE [User] SET UserTypeId = ? WHERE UserName = ?";
   	$param1= array($users_type,$check);
	//echo $query1;
	$sql=sqlsrv_query($conn, $query1,$param1);
	if( !$sql )
	{
		echo "Insertion of UserTypeID failed\n";
	//	echo " Username does not exist\n";

	}else{
			echo "passed step1";
		$query = "UPDATE [UserDetail] SET Name=?, Address1=?, Address2=?, PhoneNumber=?, Email=? WHERE UserName = ?";
		$params = array($users_name, $users_address1, $users_address2, $users_phone, $users_email,$check);
	
		$sql=sqlsrv_query($conn, $query, $params);

		if( $sql )
			{
				echo "Row successfully inserted.\n";
		//		$query2="UPDATE [location] (Latitude,Longitude,LastUpdatedOn) VALUES (?,?,?) WHERE UserName = "$_SESSION['UserName']"";
		//		$param2= array($users_Latitude,$users_Longitude,$users_LastUpdatedOn);
		//		$sql=sqlsrv_query($conn, $query2, $param2);
		//		if( !$sql )
		//			{
		//				echo "Failed\n";
						
		//			}
			
		//	}


		//else
		//	{
		//		echo "Row insertion failed.\n";
		//		die( print_r( sqlsrv_errors(), true));
		//	}
	

			// Update the blood type in the table Bloodtype.............


			$query3 = "UPDATE [bloodType] SET Type=? WHERE UserName = ?";
			$params3 = array($blood_type,$check);
	
			$sql=sqlsrv_query($conn, $query3, $params3);

		if($sql )

		{
			echo "Blood Type updated";
		}else{

			echo " Blood type update failed";
		}


	}
}
	sqlsrv_close( $conn);

}

//}else 
 //  { 
 //  	echo "You are not loggedin." ;
//   }

	header('Location: search_result.php');
	//sqlsrv_close( $conn);

?>