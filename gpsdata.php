<?php
 include('dbconnect.php');
 include('sql2json.php');

if( $_POST )
{
  
	//$users_Latitude=$_POST['Latitude'];
	//$users_Longitude=$_POST['Longitude'];
	//$users_distance=$_POST('Radius');
	$users_Latitude='4.00';
	$users_Longitude='4.00';
	$users_distance='8';
	$lat1=$users_Latitude-0.1*$users_distance;
	$lon1=$users_Longitude-0.1*$users_distance;
	$lat2=$users_Latitude+0.1*$users_distance;
	$lon2=$users_Longitude+0.1*$users_distance;
	
	$query1="SELECT * FROM [Location] (UserName,Latitude,Longitude,LastUpdatedOn) VALUES (?,?,?,?) WHERE Latitude BETWEEN $lat1 and $lat2 AND WHERE Longitude BETWEEN $lon1 and $lon2";
    $param1= array($users_UserName,$users_password,$users_type);
	$query2="SELECT COUNT(*) (SELECT * FROM [Location] (UserName,Latitude,Longitude,LastUpdatedOn) VALUES (?,?,?,?) WHERE Latitude BETWEEN $lat1 and $lat2 AND WHERE Longitude BETWEEN $lon1 and $lon2) x";
	
	$sql=sqlsrv_query($conn, $query1, $param1);
	//$sql1=sqlsrv_query($conn, $query2, $param1);// If an error has occurred, 
            //    make the error a js comment so that a javascript error will NOT be invoked
    $json_str = ""; //Init the JSON string.
    if($total = $sql1) { //See if there is anything in the query
        $json_str .= "[\n";

        $row_count = 0;    
        while($data = sqlsrv_fetch_array($data_sql)) {
            if(count($data) > 1) $json_str .= "{\n";

            $count = 0;
            foreach($data as $key => $value) {
                //If it is an associative array we want it in the format of "key":"value"
                if(count($data) > 1) $json_str .= "\"$key\":\"$value\"";
                else $json_str .= "\"$value\"";

                //Make sure that the last item don't have a ',' (comma)
                $count++;
                if($count < count($data)) $json_str .= ",\n";
            }
            $row_count++;
            if(count($data) > 1) $json_str .= "}\n";

            //Make sure that the last item don't have a ',' (comma)
            if($row_count < $total) $json_str .= ",\n";
        }

        $json_str .= "]\n";
    }

    //Replace the '\n's - make it faster - but at the price of bad redability.
    $json_str = str_replace("\n","",$json_str); //Comment this out when you are debugging the script
	echo $json_str;
	
	sqlsrv_close( $conn);
}
?>