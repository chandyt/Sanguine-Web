<?php
session_start();

 include('dbconnect.php');
$grpNotification=false;
 if( $_POST ){
	 $grpNotification=$_POST["NotificationType"];
	if ($grpNotification)
	 {
		 $xdata=$_SESSION["data"];
		 //echo $xdata;
		 $arr= json_encode($xdata);
		 $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($xdata, TRUE)), RecursiveIteratorIterator::SELF_FIRST);
		foreach ($jsonIterator as $key => $val) {
			if(is_array($val)) {
			} else {
				if ($key==="DeviceID")
				{
					$DeviceID=$val;
					$message=array("messageBody" => "Immediate Requirement of All types of blood");
					sendMessage($DeviceID,$message);
				}
			}
		}
	 }
	 
		 
}
else
{
	 $DeviceID = $_GET['DeviceId'];
	 $BloodType = $_GET['BloodType'];
	 //echo $BloodType;
	 //TODO: Change the message Text Add location information to message
	 $message=array("messageBody" => $BloodType . "blood needed urgent");
	 sendMessage($DeviceID,$message);
		  
 }   
 
 
function sendMessage($DeviceID, $Message)
{
	include('dbconnect.php');
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
				'data' => $Message,
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
	
}

		header("Location: http://localhost/Sanguine-Web/gpsdata.php");

?>