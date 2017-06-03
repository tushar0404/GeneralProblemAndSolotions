<?php 

/* Script to mail through mailgun api in cakephp */

$email = "email-to-send";

$view = new View($this, false);
// Render you view
$html = $view->render('/Elements/subscriber_email');
$this->set('data_for_view_if_any');

$curl_post_data=array(
    'from'    => 'From-Name<From-Email>',
    // can include multiple emails with comma separate 
    'to'      => $email,
    'subject' => 'Subjecy',
    'html'    => $html,
    // in case to send only text message : 'text'    => "Your Text",
    // 'attachment[1]' => $filePath_of_attachment, If any !!
);

$service_url = 'https://api.mailgun.net/v3/mg.domain.com/messages';
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_USERPWD, "your-mailgun-api"); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
$curl_response = curl_exec($curl);  
$response = json_decode($curl_response);
curl_close($curl);

	/*
		Respose will be 
		stdClass Object
					(
					    [id] => <20170603093346.118659.0D85EECAF7F32B400@mg.domain.com>
					    [message] => Queued. Thank you.
					)
		or blank in case of failed
	*/

?>