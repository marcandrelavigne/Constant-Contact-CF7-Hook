<?php
/**
 * Manage Constant Contact subscription
 */

function newsletter_ajax() {
	$target_list = 'XXXXXXX';
	$apiKey = 'XXXXXXX';
	$accessToken = 'XXXXXXX';
	$endpoint = 'https://api.constantcontact.com/v2/contacts?action_by=ACTION_BY_OWNER&api_key=' . $apiKey;
		
	$data = array (
		'lists' => array( array( 'id'=>$target_list ) ),
		'email_addresses' => array( array( 'email_address' => $_POST['email'] ) ),
		'first_name' => $_POST['first_name'],
		'last_name' => $_POST['last_name'],
		'company_name' => $_POST['company_name'],
	);
	$jsonData = json_encode($data);
		
	//open connection
	$ch = curl_init();
		
	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $endpoint);
	curl_setopt($ch,CURLOPT_POST, true);
		
	//So that curl_exec returns the contents of the cURL; rather than echoing it
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		
	//Attach our encoded JSON string to the POST fields.
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
		
	$authBearer = 'Authorization: Bearer ' . $accessToken;
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		$authBearer,                                                                     
		'Content-Type: application/json'  
	));  

	//execute post
	$result = curl_exec($ch);

}

// creating Ajax call for WordPress
add_action('wp_ajax_nopriv_newsletter_ajax', 'newsletter_ajax');
add_action('wp_ajax_newsletter_ajax', 'newsletter_ajax');
    
// Add Hook for Contact Form 7
add_action('wpcf7_mail_sent', 'newsletter_ajax');
