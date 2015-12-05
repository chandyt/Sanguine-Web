<?php
 include('dbconnect.php');

//include('sql2json.php');

//if( $_POST )
//{
  
	//$users_Latitude=$_POST['Latitude'];
	//$users_Longitude=$_POST['Longitude'];
	//$users_distance=$_POST('Radius');
	$users_Latitude='27.62';
	$users_Longitude='-86.32';
	$users_distance='40';
	list($lat1,$lat2,$lon1,$lon2)=getBoundingBox($users_Latitude,$users_Longitude,$users_distance);
	echo " ",$lat1," ",$lat2," ",$lon1," ",$lon2;
	$lat1=$users_Latitude-0.1*$users_distance;
	$lon1=$users_Longitude-0.1*$users_distance;
	$lat2=$users_Latitude+0.1*$users_distance;
	$lon2=$users_Longitude+0.1*$users_distance;
	$users_UserName='';
	$users_Latitude1='';
	$users_Longitude1='';
	$date = new DateTime('2000-01-01');
	$result = $date->format('Y-m-d H:i:s');
	function getBoundingBox($lat_degrees,$lon_degrees,$distance_in_miles) 
	{

	$radius = 3963.1; // of earth in miles

	// bearings
	$due_north = 0;
	$due_south = 180;
	$due_east = 90;
	$due_west = 270;

	// convert latitude and longitude into radians
	$lat_r = deg2rad($lat_degrees);
	$lon_r = deg2rad($lon_degrees);

	// find the northmost, southmost, eastmost and westmost corners $distance_in_miles away
	// original formula from
	// http://www.movable-type.co.uk/scripts/latlong.html

	$northmost  = asin(sin($lat_r) * cos($distance_in_miles/$radius) + cos($lat_r) * sin ($distance_in_miles/$radius) * cos($due_north));
	$southmost  = asin(sin($lat_r) * cos($distance_in_miles/$radius) + cos($lat_r) * sin ($distance_in_miles/$radius) * cos($due_south));

	$eastmost = $lon_r + atan2(sin($due_east)*sin($distance_in_miles/$radius)*cos($lat_r),cos($distance_in_miles/$radius)-sin($lat_r)*sin($lat_r));
	$westmost = $lon_r + atan2(sin($due_west)*sin($distance_in_miles/$radius)*cos($lat_r),cos($distance_in_miles/$radius)-sin($lat_r)*sin($lat_r));


	$northmost = rad2deg($northmost);
	$southmost = rad2deg($southmost);
	$eastmost = rad2deg($eastmost);
	$westmost = rad2deg($westmost);

	// sort the lat and long so that we can use them for a between query
	if ($northmost > $southmost) {
		$lat1 = $southmost;
		$lat2 = $northmost;

	} else {
		$lat1 = $northmost;
		$lat2 = $southmost;
	}


	if ($eastmost > $westmost) {
		$lon1 = $westmost;
		$lon2 = $eastmost;

	} else {
		$lon1 = $eastmost;
		$lon2 = $westmost;
	}

	return array($lat1,$lat2,$lon1,$lon2);
	
}
	//$query1="SELECT * FROM [Location] WHERE Latitude BETWEEN '$lat1' and '$lat2' AND  Longitude BETWEEN '$lon1' and '$lon2'";
	$query1="SELECT [L].[UserName], UD.Name,G.DeviceID,  COALESCE( UD.Isvalidated,0,1) as IsValidated,[Type],[Latitude],[Longitude],CONVERT(VARCHAR(10), LastUpdatedOn, 101) as LastUpdatedOn FROM [Location] [L] INNER JOIN [BloodType] [B] ON [L].[UserName]=[B].[UserName] LEFT JOIN UserDetail UD ON L.UserName=UD.UserName Inner JOIN GCMRegKey G on G.UserName=L.UserName WHERE Latitude BETWEEN '$lat1' and '$lat2' AND  Longitude BETWEEN '$lon1' and '$lon2' "; //" AND Type = 'B+'";

	//$query1="SELECT [UserName], [Latitude],[Longitude],CONVERT(VARCHAR(10), LastUpdatedOn, 121) as LastUpdatedOn FROM [Location] WHERE Latitude BETWEEN '$lat1' and '$lat2' AND  Longitude BETWEEN '$lon1' and '$lon2'";
    $param1= array($users_UserName,$users_Latitude1,$users_Longitude1,$date );
	//$query2="SELECT COUNT(*) (SELECT * FROM [Location] (UserName,Latitude,Longitude,LastUpdatedOn) VALUES (?,?,?,?) WHERE Latitude BETWEEN $lat1 and $lat2 AND WHERE Longitude BETWEEN $lon1 and $lon2) x";
	
	$sql=sqlsrv_query($conn, $query1,$param1);
	
	//$json_str = json_encode($sql);
	//$sql1=sqlsrv_query($conn, $query2, $param1);// If an error has occurred, 
            //    make the error a js comment so that a javascript error will NOT be invoked
    $json_str = ""; //Init the JSON string.
    //if($total = $sql1) { //See if there is anything in the query
        $json_str .= "[\n";

        $row_count = 0;    
		while($data = sqlsrv_fetch_array($sql)) 
		{
            if(count($data) > 1) $json_str .= "{\n";

            $count = 0;
            foreach($data as $key => $value) 
			{
                //If it is an associative array we want it in the format of "key":"value"
                if(count($data) > 1) $json_str .= "\"$key\":\"$value\"";
                else $json_str .= "\"$value\"";

                //Make sure that the last item don't have a ',' (comma)
                $count++;
                if($count < count($data)) $json_str .= ",\n";
            }
            $row_count++;
            if(count($data) > 1) $json_str .= "},\n";

            //Make sure that the last item don't have a ',' (comma)
            if($row_count < $total) $json_str .= ",\n";
        }
        $str=substr($json_str,0,-2);
		$json_str=$str;
		$json_str .= "]\n";
    //}

    //Replace the '\n's - make it faster - but at the price of bad redability.
    $json_str = str_replace("\n","",$json_str); //Comment this out when you are debugging the script

	session_start();
	$_SESSION["data"] =$json_str;
	//echo $json_str;
	header("Location: http://localhost/Sanguine-Web/maps.php");
	//sqlsrv_close( $conn);
//}

?>

