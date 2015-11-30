<?php
 include('dbconnect.php');

  $DeviceID = $_GET['DeviceId'];
  $GCMRegToken = $_GET['GCMRegToken']  ;


  $LastUpdatedOn= date('m/d/Y h:i:s a', time());
  $query1 = "SELECT * FROM [GCMRegKey] WHERE DeviceID = '$DeviceID'";
	$sql = sqlsrv_query($conn, $query1);

	if ($sql) {
		$rows = sqlsrv_has_rows( $sql );
		if ($rows === false)
		{
			$query1="INSERT INTO [GCMRegKey] (DeviceId,RegistrationToken,RegisterdOn) VALUES (?,?,?)";
			$param1= array($DeviceID,$GCMRegToken,$LastUpdatedOn);
			$sql=sqlsrv_query($conn, $query1, $param1);
			echo "2";
		}
		else{
			$obj = sqlsrv_fetch( $sql );
			$GCMRegToken1 = sqlsrv_get_field($sql, 2);
			if ($GCMRegToken1!=$GCMRegToken)
			{
				$query1="Update [GCMRegKey] set RegistrationToken =(?),RegisterdOn=(?) where DeviceID=(?)";
				$param1= array($GCMRegToken,$LastUpdatedOn,$DeviceID,);
				$sql=sqlsrv_query($conn, $query1, $param1);
				if( !$sql ){
					die( print_r( sqlsrv_errors(), true));
				}
			}
		}
	}
   

		sqlsrv_close( $conn);

?>