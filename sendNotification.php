<?php
session_start();

 include('dbconnect.php');
 $grpNotification=false;
 
 // Generate Address
  $username = $_SESSION["UserName"];
  $sql = "SELECT TOP 1 U.UserName as [username], * FROM  [User] U 
  			Left Join UserDetail UD ON  U.UserName= UD.UserName
  			WHERE  ( UD.UserName = '$username') ";
 $stmt = sqlsrv_query( $conn, $sql);
 if( $stmt === false)
{
     echo "Error in query preparation/execution.\n";
     die( print_r( sqlsrv_errors(), true));
}
 while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
 {
	 
	 $Name= $row['Name'];
	 $PhoneNumber= $row['PhoneNumber'];
	 $Address1 =$row['Address1'];
	 $Address2 = $row['Address2'];
 }

 $BloodBankAddress = $Name . "\n" .$Address1. "\n". $Address2. "\n" . $PhoneNumber;
 
 if( $_POST ){
	 $grpNotification=$_POST["NotificationType"];
	 $BloodType = $_POST['BloodType'];
	if ($grpNotification)
	 {
		 $xdata=$_SESSION["data"];
		 //echo $xdata;
		 $arr= json_encode($xdata);
		 $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($xdata, TRUE)), RecursiveIteratorIterator::SELF_FIRST);
		foreach ($jsonIterator as $key => $val) {
			if(is_array($val)) {
			} else {
				//echo $key ."-->". $val;
				//echo $BloodType;
				$DeviceID="";
				if ($key==="DeviceID")
				{
					//echo $val;
					$DeviceID=$val;
					$message=array("messageBody" => "Immediate Requirement for All types of blood. Please Contact: " . $BloodBankAddress);
					if ($BloodType == 'All')
					{
						//echo $DeviceID."   ". "Send Message to All";
						sendMessage($DeviceID,$message);
					}
					
				}
				
				if ($BloodType != 'All')
				{
					if ($key==="Type")
					{
						If ($BloodType==$val)
						{
							//echo $val;
							//echo $DeviceID."   ". "Send Message to ". $val;
							$message=array("messageBody" => "Immediate Requirement for All types of blood. Please Contact: " . $BloodBankAddress);	
							sendMessage($DeviceID,$message);
						}
			
					}
				}
			}
		}
	 }
	 
		 
}
else
{
	 $DeviceID = $_GET['DeviceId'];
	 $BloodType = $_GET['BloodType'];
	 
	 $message=array("messageBody" => "Your blood type is needed urgently. Please Contact: " . $BloodBankAddress);
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