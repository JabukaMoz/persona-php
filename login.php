<?php
	session_start();

	// Link para verificar o login
	$url = 'https://verifier.login.persona.org/verify';
	// Link do site onde o login está sendo realizado
	$audience = 'http://localhost:8080';
	
	$assert = filter_input(
		INPUT_POST,
		'assertion',
		FILTER_UNSAFE_RAW,
		FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH
	);
	
	$params = 'assertion=' . urlencode($assert) . '&audience=' .
			   urlencode($audience);
	$ch = curl_init();
	$options = array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_POST => 2,
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_SSL_VERIFYHOST => 2,
		CURLOPT_POSTFIELDS => $params
	);
	curl_setopt_array($ch, $options);
	$result = curl_exec($ch);
	curl_close($ch);
	
	$result = json_decode($result);
	
	if($result->{'status'} == 'okay'){
		$_SESSION["email"] = $result->{'email'};
		header("location: index.php");
	} else {
		header("location: index.php?erro=".$result->{'reason'});	
	}
?>