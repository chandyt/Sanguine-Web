<?php 
session_start();
?>

<?php 

include('dbconnect.php');
if ( $_POST){
	$Username = $_POST['Username'];
	$Password = $_POST['Password'];

$query1 = "SELECT * FROM [User] WHERE UserName = '$Username'";
		$sql = sqlsrv_query($conn, $query1);

		if( !$sql ){
			echo "sql query failed\n";		
		}
		else{
			$obj = sqlsrv_fetch( $sql );
			$dbName = sqlsrv_get_field($sql, 0);
			$dbPass = sqlsrv_get_field($sql, 1);
			
			//$query2 = "UPDATE [User] SET Password = '$newpassword' WHERE UserName = '$username'";
			//$param2 = array($newpassword);
			//$sql2 = sqlsrv_query($conn, $query2);
		}

if (isCorrectLogin($Username, $Password))	{
	echo "welcome to sanguine.".$Username;

}
else {
	echo "wrong credentials.";

	}
}


function isCorrectLogin($username, $password){
	global $dbName;
	global $dbPass;
	if ($username == $dbName){
		if ($password == $dbPass){
			return true;
		}
	else {	
		return false;
		}
    }
}


?>