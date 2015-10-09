<!DOCTYPE html>
<html>
<head>
	<title>Sanguine-Donor Tracking</title>
	<meta charset="utf-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.css" />
</head>
<body>
	<p>
	Filter By Blood Type
		<select name="bloodType">
		  <option value="All">All</option>
		  <option value="ap">A+</option>
		  <option value="an">A-</option>
		  <option value="bp">B+</option>
		  <option value="bn">B-</option>
		  <option value="abp">AB+</option>
		  <option value="abn">AB-</option>
		  <option value="op">O+</option>
		  <option value="on">O-</option>
		  
		</select>
	</p>
	<div id="map" style="width:1200px; height: 800px"></div>

	<script src="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.js"></script>
	<script>


		var map = L.map('map').setView([29.55, -82.44], 13);

		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6IjZjNmRjNzk3ZmE2MTcwOTEwMGY0MzU3YjUzOWFmNWZhIn0.Y8bhBaUMqFiPrDRW9hieoQ', {
			maxZoom: 18,attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
				'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
				'Imagery © <a href="http://mapbox.com">Mapbox</a>',
			id: 'mapbox.streets'
		}).addTo(map);


		L.marker([29.55, -82.44]).addTo(map)
			.bindPopup("<b>Timmy Chandy</b><br />Blood Type:AB+ <br />Verified").openPopup();
		
		L.marker([29.58, -82.44]).addTo(map)
			.bindPopup("<b>John Doe</b><br />Blood Type:A+ <br />Not Verified").openPopup();
			
		L.marker([29.58, -82.34]).addTo(map)
			.bindPopup("<b>Jane Doe</b><br />Blood Type:O- <br />Not Verified").openPopup();

		function onMapClick(e) {
			popup
				.setLatLng(e.latlng)
				.setContent("You clicked the map at " + e.latlng.toString())
				.openOn(map);
		}

		map.on('click', onMapClick);

	</script>
</body>
</html>
