
<?php
$username = sms_username;
$password = sms_password;
$from = sms_send_line;
$pattern_code = $body_id;
$to = array($mobile_number);
$output_array=array();
if (sizeof($txt) > 1){

	foreach ($txt as $index => $value) {
		$indx = $index + 1;
		$output_array[] = array(
			"name" => 'code'.$indx,
			"value" => $value
		);
	}
	
}else{



		$parameter_name ="code" ;
		$output_array[] = array(
			"code" => $txt,

		);


}
$input_data = $output_array[0];
$url = "https://ippanel.com/patterns/pattern?username=" . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
$handler = curl_init($url);
curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($handler);
//echo $response;
//print_r($response)
?>