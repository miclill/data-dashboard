<?php header( 'Access-Control-Allow-Origin: *'); ?>
{
	"location": {
		"country": "Germany",
		"city": "Deutsche Bahn"
	},
	"portal": {
		"url": "http://data.deutschebahn.com/dataset/1cc0f0c6-f0fd-45a6-97f7-ca2061dc0eef",
		"title": "Parkplätze API (Beta)",
		"description": "BETADiese API stellt Parkrauminformationen zu Parkeinrichtungen an Bahnhöfen zur Verfügung. ",
		"license": "Creative Commons Namensnennung Lizenz",
		"licenseURL": "http://creativecommons.org/licenses/by/3.0/de/",
		"attribution": "Michael Binzen",
		"author": "DBOpenData@deutschebahn.com",
		"created": "2016-06-13",
		"updated": "<?php echo date("Y-m-d"); ?>"
	},
	"front": {
		"textTop": "An den Bahnhöfen sind",
		"textBottom": "Parkhäuser voll",
<?php
	$url = 'http://opendata.dbbahnpark.info/api/beta/occupancy/';

//	$json = file_get_contents( $url );
	$curl_handle = curl_init();
	curl_setopt( $curl_handle, CURLOPT_URL, $url );
	curl_setopt( $curl_handle, CURLOPT_CONNECTTIMEOUT, 2 );
	curl_setopt( $curl_handle, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $curl_handle, CURLOPT_USERAGENT, 'Datenwaben - daten-waben.tursics.de' );
	$json = curl_exec( $curl_handle );
	curl_close( $curl_handle );

	$data = json_decode($json, TRUE);
	$count = 0;

	foreach( $data['allocations'] as $lot ) {
		// 1: up to 10
		// 2: > 10
		// 3: > 30
		// 4: > 50
		if( array_key_exists('category', $lot['allocation']) && (intval($lot['allocation']['category']) <= 1)) {
			++$count;
		}
	}

	echo '"value": "'.$count.'",';
?>
		"unit": "",
		"changePerDay": "",
		"format": "int",
		"background": "img/map.svg",
		"color": "#c83737"
	},
	"back": {
		"text": "DB BahnPark stellt ein Live-API für die Parkhäuser und Parkplätze an Bahnhöfen bereit.",
		"color": "#000000",
		"cssClass": ""
	}
}