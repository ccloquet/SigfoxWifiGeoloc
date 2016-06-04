<?php
	// this code includes an example code from Unwired Labs
	
 	if ( (!isset($_POST['id'])) & (!isset($_POST['data'])) ) die('Sigfox: NO DATA');

	$id     = $_POST['id'];	 
	$data   = $_POST['data']; 
 
	$myret  = send_to_locationmagic($data);

	// now, you can do something with $myret
	
function send_to_locationmagic($mystring)
{
	// separate mystring in two
	// each two, insert a ':'
 
	$curl   = curl_init();

	$output = str_split($mystring, 12);

	$id1    = join(':', str_split($output[0], 2));
	$id2    = join(':', str_split($output[1], 2));

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://us1.unwiredlabs.com/v2/process.php",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "{\"token\": \"00000000000000\",\"wifi\": [{\"bssid\": \"".$id1."\"}, {\"bssid\": \"".$id2."\"}]}",
	));

	$response = curl_exec($curl);
	$err 	  = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  echo $response;
	}

	return json_decode($response, true);
}
?>
