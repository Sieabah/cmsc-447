<?php

function Basecamp($end){
	$basecamp_url = "https://basecamp.com/2979808/api/v1/$end";
	$appName = 'UMBCSGAiTracker';
	$appContact = 'joshua.massey@umbc.edu';
	
	$helloHeader = "User-Agent: $appName ($appContact)";
	$xheaders = array(                                                'Content-Type: application/json'
	);

	include "/afs/umbc.edu/public/web/sites/sga/dev/cgi-bin/bc_cred.php";
	
	$session = curl_init();
 		
	curl_setopt($session, CURLOPT_URL, $basecamp_url);
	curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($session, CURLOPT_HTTPGET, 1);
	curl_setopt($session, CURLOPT_HTTPHEADER, array($helloHeader, 'Content-Type: application/json'));
	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($session,CURLOPT_USERPWD, $credentials);
	curl_setopt($session,CURLOPT_SSL_VERIFYPEER,false);
	 
	$response = curl_exec($session);
	curl_close($session);
//	$final = json_decode($response, true);
	return $response;
}

function compareName($a, $b){
	return strnatcmp($a['name'], $b['name']);
}
?>