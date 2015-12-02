<?php
session_start();
 $xdata=$_SESSION["data"];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sanguine-Donor Tracking</title>
	<meta charset="utf-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.css" />
	<link rel="stylesheet" type="text/css" href="css/styles.css">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Sanguine</title>
    <link href="css/bootstrap.css" rel="stylesheet">
</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" width="100%">
      <div class="container" style="margin-left:0;">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>

        </div>
      </div>
        <div   align="right" width="100%" style="padding-right:50px;color:#FFFFFF">
         Welcome <b> <?php echo $_SESSION["DisplayName"]; ?></b><br>
		  <a href="signout.php?logout">
            Sign Out
            </a>
        </div>


    </div>
 	
 	<div style="padding-top:50px;" class="btn-group btn-group-justified">
		  <a class="btn btn-default" href="maps.php">Send Blood Request</a>
		  <a class="btn btn-default" href="search_layout.php">Search</a>
		  <a class="btn btn-default" href="bloodbank_infoedit.php">Update Profile</a>
		  <a class="btn btn-default" href="#">Donation History</a>
	</div>
<div style="padding-left:50px;">
<div style="color:#FFFFFF; width:5000px; padding-top:10px;">

	Filter By Blood Type
		<select id="cmbBloodType" onchange="markerFilter()" style="color:#000000">
		  <option value="All">All</option>
		  <option value="Ap">A+</option>
		  <option value="An">A-</option>
		  <option value="Bp">B+</option>
		  <option value="Bn">B-</option>
		  <option value="ABp">AB+</option>
		  <option value="ABn">AB-</option>
		  <option value="Op">O+</option>
		  <option value="On">O-</option>
		  
		</select>
	
		<p style="padding-left:50px; display:inline">
		Filter By Radius
		<select id="cmbZoom" onchange="changeZoom()" style="color:#000000">
		  <option value="50">50</option>
		  <option value="25">25</option>
		  <option value="15">15</option>
		  <option value="10">10</option>
		  <option value="5">5</option>
		  <option value="4">4</option>
		  <option value="3">3</option>
		  <option value="2">2</option>
		  <option value="1">1</option>
		  
		</select> Miles
		</p>
</div>
	<br/>
	
	<div id="map" style="width:1200px; height: 800px"></div>

	<script src="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.js"></script>
	<script src="https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js"></script>
	<script>
		
		var map = L.map('map').setView([29.55, -82.44], 12);
		var donorMarkers = new L.markerClusterGroup();
			
		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6IjZjNmRjNzk3ZmE2MTcwOTEwMGY0MzU3YjUzOWFmNWZhIn0.Y8bhBaUMqFiPrDRW9hieoQ', {
			maxZoom: 18,attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
				'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
				'Imagery © <a href="http://mapbox.com">Mapbox</a>',
			id: 'mapbox.streets'
		}).addTo(map);
		
		dropMarkers('All');
		
		function markerFilter() {
			var x = document.getElementById("cmbBloodType").value;
			donorMarkers.clearLayers();
			dropMarkers(x);
		}
		
		
		function changeZoom() {
			var x = document.getElementById("cmbZoom").value;
			switch(x) {
				case "50":
					map.setZoom(9);
					break;
				case "25":
					map.setZoom(10);
					break;
				case "15":
					map.setZoom(11);
					break;
				case "10":
					map.setZoom(12);
					break;
				case "5":
					map.setZoom(13);
					break;
				case "4":
					map.setZoom(14);
					break;
				case "3":
					map.setZoom(15);
					break;
				case "2":
					map.setZoom(16);
					break;					
					
				case "1":
					map.setZoom(17);
					break;		

				default:
					map.setZoom(18);
			}
			
		}
		
		function dropMarkers(filter) {
			var xdata = <?php echo json_encode($xdata); ?>;
			var jsonData  = JSON.parse(xdata);
			//Parse JSON Data and create markers based on JSOn Data
			for (var i = 0; i < jsonData.length; i++) {
				var donors = jsonData[i];

				if (filter !='All')
				{
					if (donors.BloodType != filter)
						continue;
				}
				var bloodTpe=donors.BloodType;
				bloodTpe = bloodTpe.replace('p','+');
				bloodTpe = bloodTpe.replace('n','-');
				L.marker([donors.Latitude, donors.Longitude]).bindPopup("<b>" + donors.Name + "</b><br />Blood Type: " + bloodTpe +" <br />Verified:"+ donors.Verified).addTo(donorMarkers);
			}
			donorMarkers.addTo(map);
		}
		
	/*	map.on('click', onMapClick);
		function onMapClick(e) {
			popup
				.setLatLng(e.latlng)
				.setContent("You clicked the map at " + e.latlng.toString())
				.openOn(map);
		}
*/
		

	</script>
	
	</div>
</body>
</html>
