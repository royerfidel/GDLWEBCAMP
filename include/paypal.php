<?php 

	require 'paypal/autoload.php';

	define('URL_SITIO', 'http://localhost/prueba/gdlwebcamp/');

	$apiContext=new \PayPal\Rest\ApiContext(
		new \PayPal\Auth\OAuthTokenCredential(
			'AT8N65IJhGDtLAQBWN-T4WEjpoXUo3JRdvNR5ZMK4mCTPkAHEonwFQ5L-js_cX6oTbc920WcmUaZYM6W',//cliente id
			'EGz_7Dc-BWG0wcg4kM81_SFWpmArWeF_9pP2MrjMdCmwWohA8rdYldPE3iy7Bb24lF2V2TxGTW1NpAQC'//secret
		)	
	);
	
?>
