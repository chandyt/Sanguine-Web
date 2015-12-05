<?php
 include('dbconnect.php');

 
 $DeviceID = $_GET['DeviceId'];
 $BloodType = $_GET['BloodType'];
 echo $BloodType;
 //TODO: Change the message Text Add location information to message
 $message=array("messageBody" => $BloodType . "blood needed urgent");

  $LastUpdatedOn= date('m/d/Y h:i:s a', time());
  $query1 = "SELECT * FROM [GCMRegKey] WHERE DeviceID = '$DeviceID'";
  $sql = sqlsrv_query($conn, $query1);

	if ($sql) {
		$obj = sqlsrv_fetch( $sql );
		$GCMRegToken = sqlsrv_get_field($sql, 2);
		$headers = array
		(
			'Authorization: key=AIzaSyBDfpH3wKyj5sJLTlkqBOZ2Q6ibvFq1cbw',
			'Content-Type: application/json'
		);
		$url = 'https://android.googleapis.com/gcm/send';
		$fields = array(
            'registration_ids' => array($GCMRegToken),
            'data' => $message,
        );
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
        // Execute post
        $result = curl_exec($ch);
		echo $result;
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
 
        // Close connection
        curl_close($ch);
	}
	
   

		sqlsrv_close( $conn);
		//header("Location: http://localhost/Sanguine-Web/gpsdata.php");

?>