<?php

// Timezone1
date_default_timezone_set("Asia/Manila");
//ini_set('display_errors', 1);
//error_reporting(E_ALL ^ E_NOTICE);

// Chikka Settings
define("CHIKKA_URL","https://post.chikka.com/smsapi/request");
define("CHIKKA_CLIENT_ID", "f425c39deff1c7d688f96670df193f0144e26490163049092bcb22dfd9fb51a5");
define("CHIKKA_CLIENT_SECRET","c9d85dad4577df1d0e5d1ad09190c7fc3504652585e8271e162af353cd97ac35");
define("CHIKKA_ACCESSCODE","2929077771");


	// Send / Broadcast SMS
function sendSMS($mobile_number, $message)
	{
		$post = array( 	"message_type" 	=> "SEND",
						"mobile_number" => $mobile_number,
						"shortcode" 	=> CHIKKA_ACCESSCODE,
						"message_id"	=> date('YmdHis'),
						"message"       => urlencode($message),
						"client_id" 	=> CHIKKA_CLIENT_ID,
						"secret_key" 	=> CHIKKA_CLIENT_SECRET );

		$result = curl_request(CHIKKA_URL, $post);
		$result = json_decode($result, true);
		if ($result['status'] == '200') {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	// Reply SMS
  function replySMS($mobile_number, $request_id, $message, $price = 'P2.50')
	{
	  $message_id = date('YmdHis');
		$post = array( 	"message_type" 	=> "REPLY",
						"mobile_number" => $mobile_number,
						"shortcode" 	=> CHIKKA_ACCESSCODE,
						"message_id"	=> $message_id,
						"message" 	=> urlencode($message),
						"request_id" 	=> $request_id,
						"request_cost" 	=> $price,
						"client_id" 	=> CHIKKA_CLIENT_ID,
						"secret_key" 	=> CHIKKA_CLIENT_SECRET );

		$result = curl_request(CHIKKA_URL, $post);
		$result = json_decode($result, true);
		if ($result['status'] == '200') {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	// Reply SMS
	function replySMS2($mobile_number, $request_id, $message, $price = 'P2.50')
	{
	        $message_id = date('YmdHis');
		$post = array( 	"message_type" 	=> "REPLY",
						"mobile_number" => $mobile_number,
						"shortcode" 	=> CHIKKA_ACCESSCODE,
						"message_id"	=> $message_id,
						"message" 	=> urlencode($message),
						"request_id" 	=> $request_id,
						"request_cost" 	=> $price,
						"client_id" 	=> CHIKKA_CLIENT_ID,
						"secret_key" 	=> CHIKKA_CLIENT_SECRET );

		$result = curl_request(CHIKKA_URL, $post);
		$result = json_decode($result, true);
		if ($result['status'] == '200') {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	// Basic Curl Request
  function curl_request( $URL, $arr_post_body)
	{
		$query_string = "";
		foreach($arr_post_body as $key => $frow) {
			$query_string .= '&'.$key.'='.$frow;
		}

		$curl_handler = curl_init();
		curl_setopt($curl_handler, CURLOPT_URL, $URL);
		curl_setopt($curl_handler, CURLOPT_POST, count($arr_post_body));
		curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $query_string);
		curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, TRUE);
		$response = curl_exec($curl_handler);
		if(curl_errno($curl_handler))
		{
			$info = curl_getinfo($curl_handler);
		}
		curl_close($curl_handler);
		return $response;
	}


$number = "639471729649";
$message = "Successfully deployed your DEV to TEST.";
  if ( sendSMS($number, $message) == TRUE) {
    echo "Successfully sent SMS to $number";
  } else {
    echo "ERROR";
  }

?>
