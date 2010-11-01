<?php

// Establish a DB connection
$rsrcLink = mysql_connect('localhost', 'dbusername', 'dbpassword');
mysql_select_db('dbname');

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">

	<head>
	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<title>Google Maps Plotting by Zip Code</title>
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	
		<script type="text/javascript" src="http://www.google.com/jsapi?key=YOUR_API_KEY_HERE"></script>
		<script type="text/javascript">
		
			// Initialize the map
			google.load("maps", "2.x");

			// Initialize a JS object that will hold all the lat & longs
			var MapLocations = {};

			<?php

			// Here is an array of zip codes we want to plot
			$arrDistinctZips = array('30012','32177','36420','67801','80701','86426');

			// Now perform the query to get the geocordinates for each zip code
			$rsrcQuery = mysql_query("SELECT zip, latitude, longitude FROM us_zip_codes WHERE zip IN ('".implode("','", $arrDistinctZips)."')") or die(mysql_error());
			if(mysql_num_rows($rsrcQuery) > 0) {
				while($arrRow = mysql_fetch_array($rsrcQuery)) {
					echo "MapLocations['{$arrRow['zip']}'] = {'lat':'{$arrRow['latitude']}', 'long':'{$arrRow['longitude']}'};\n";					
				}
			}	

			?>
		</script>
		<script type="text/javascript" src="map.js"></script>

	</head>

	<body>
		
		<!-- This div will be re-written by the JS with the Google Map -->
		<div id="map" style="width: 600px; height: 400px;"></div>

	</body>

</html>