      
<?php 

include('dbconnect.php');

if($_POST)
{
	$searchId = $_POST['userId'];


	//$sql = "SElECT UserName, PhoneNumber, Name , Email , Type FROM [UserDetail]  INNER JOIN [BloodType] ON Username"

	$sql = "SELECT * FROM [UserDetail] WHERE UserName = '$searchId' OR PhoneNumber = '$searchId'";

	      /*'$searchId' or PhoneNumber = '$searchId' " 
       		or Username = ? "*/

        //$params = array($searchId);
        
	$stmt = sqlsrv_query( $conn, $sql);

	if( $stmt === false) {
	echo "false";
    die( print_r( sqlsrv_errors(), true) );
	}

	//$row_count = sqlsrv_num_rows( $stmt ); 

    		//if ($row_count === false)
   			//		echo "Error in retrieveing row count.";
   			//else
   				//echo $row_count;

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	echo $row['Name'].", ".$row['PhoneNumber'].",".$row['UserName'].",".$row['Email']." <br />";
	
	}


//header('Location: search_result.html');

sqlsrv_free_stmt( $stmt);    

sqlsrv_close( $conn);
 
}
?>


