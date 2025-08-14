<?php
// اطلاعات مربوط به حساب کاربری کاوه نگار
$username = sms_username;
$password = sms_password;
$pattern_code = $body_id;

// شماره گیرنده و پارامترهای پترن
$mobile_numbers = $mobile_number; // شماره گیرنده
$params = trim($txt);
function sendPatternedSms($apiKey, $receptor, $token, $template) {
	// URL وب‌سرویس کاوه نگار
	$url = "https://api.kavenegar.com/v1/$apiKey/verify/lookup.json";

	// داده‌های POST
	$data = [
		'receptor' => $receptor,
		'token' => $token,
		'template' => $template,
	];

	// ایجاد درخواست cURL
	$ch = curl_init($url);

	// تنظیمات cURL
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

	// ارسال درخواست و دریافت پاسخ
	$response = curl_exec($ch);

	// بررسی خطاهای cURL
//	if (curl_errno($ch)) {
//		echo 'Error:' . curl_error($ch);
//	} else {
//		// نمایش پاسخ
//		echo $response;
//	}

	// بستن cURL
	curl_close($ch);
}

$apiKey = $password ; // جایگزین با API Key خود
$receptor = $mobile_numbers; // شماره گیرنده
$token = $txt; // مقدار متغیر
$template = $pattern_code; // نام الگو

// فراخوانی تابع برای ارسال پیامک
sendPatternedSms($apiKey, $receptor, $token, $template);


