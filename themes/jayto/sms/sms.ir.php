<?php


$tmplid = $body_id; // شناسه قالب
$YOURAPIKEY = sms_username; // کلید API
$output_array = array();

$txts = explode(';', $txt);

// بررسی اگر پارامترها بیشتر از یک باشد
if (is_array($txts) && count($txts) > 1) {
	foreach ($txts as $index => $value) {
		$parameter_name = "NO" . ($index + 1) . "PARAMETR"; // نام‌گذاری پارامتر
		$output_array[] = array(
			"name" => $parameter_name,
			"value" => $value
		);
	}
} else {
	// فقط یک مقدار برای جایگزینی هست
	$output_array[] = array(
		"name" => "PARAMETER",
		"value" => $txt
	);
}




// تبدیل به JSON
$json_output = json_encode([
	"mobile" => $mobile_number,
	"templateId" => $tmplid,
	"parameters" => $output_array
], JSON_PRETTY_PRINT);

// تنظیمات CURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.sms.ir/v1/send/verify');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_output);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HTTP_VERSION, 'CURL_HTTP_VERSION_1_1');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
	'Content-Type: application/json',
	'Accept: text/plain',
	'x-api-key: ' . $YOURAPIKEY
]);

// اجرای درخواست CURL
$response = curl_exec($ch);





// بستن اتصال CURL
curl_close($ch);

// پاسخ درخواست
echo $response;
error_log($response);
