<?php


class CurlController{

	/*=============================================
	Peticiones a la API
	=============================================*/	

	static public function request($url,$method,$fields){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://api.ecommerce.com/'.$url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $method,
		  CURLOPT_POSTFIELDS => $fields,
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: SSDFzdg235dsgsdfAsa44SDFGDFDadg'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$response = json_decode($response);
		return $response;

	}

	/*=============================================
	Peticiones a la API de PAYPAL
	=============================================*/	

	static public function paypal($url, $method, $fields){

		$endpoint = "https://api-m.sandbox.paypal.com/"; //TEST
		$clientId = ""; //TEST
		$secretClient = ""; //TEST

		$basic = base64_encode($clientId.":".$secretClient);

		/*=============================================
		ACCESS TOKEN
		=============================================*/	

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $endpoint."v1/oauth2/token",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/x-www-form-urlencoded',
		    'Authorization: Basic '.$basic,
		    'Cookie: cookie_check=yes'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$response = json_decode($response);
		
		$token = $response->access_token;

		if(!empty($token)){

			/*=============================================
			CREAR ORDEN
			=============================================*/	

			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => $endpoint.$url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => $method,
			  CURLOPT_POSTFIELDS => $fields,
			  CURLOPT_HTTPHEADER => array(
			    'Content-Type: application/json',
			    'Authorization: Bearer '.$token,
			    'Cookie: cookie_check=yes'
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			
			$response = json_decode($response);
			return $response;

		}

	}

	/*=============================================
	Peticiones a la API de DLOCAL
	=============================================*/	

	static public function dlocal($url, $method, $fields){

		$endpoint = "https://api-sbx.dlocalgo.com/"; //TEST
		$apiKey = ""; //TEST
		$secretKey = ""; //TEST


		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $endpoint.$url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $method,
		  CURLOPT_POSTFIELDS => $fields,
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json',
		    'Authorization: Bearer '.$apiKey.':'.$secretKey
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		
		$response = json_decode($response);
		return $response;

	}

	/*=============================================
	Peticiones a la API de MERCADO PAGO
	=============================================*/	

	static public function mercadoPago($url, $method, $fields){

		$endpoint = "https://api.mercadopago.com/"; //TEST Y LIVE
		$accessToken = ""; //TEST

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $endpoint.$url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $method,
		  CURLOPT_POSTFIELDS => $fields,
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json',
		    'Authorization: Bearer '.$accessToken
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		
		$response = json_decode($response);
		return $response;

	}


}