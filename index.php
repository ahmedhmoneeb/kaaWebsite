<?php

$serverIP = '88.85.224.107:8080';
$applicationToken = '92530120388823781258';
$applicationID = '32768';
$schemaID = '32771';
$topicID = '65538';
$notification = array('applicationId' => $applicationID, 'schemaId' => $schemaID, 'topicId' => $topicID, 'type' => 'USER');
$file = '@' . realpath('msg.json');
$URL = '/kaaAdmin/rest/api/sendNotification';
$userNamePass = 'tenantDeveloper1:tenantDeveloper1';
$fullURL = 'http://' . $serverIP . $URL;

/**
// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_USERPWD => $userNamePass,
    CURLOPT_URL => $fullURL
));
**/
/**
// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
// Create a CURLFile object
$cfile = new CURLFile('msg.json','application/octet-stream','');
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_USERPWD => $userNamePass,
    CURLOPT_URL => $fullURL,
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => array(
        'notification' => json_encode($notification),
        'type'=> 'application/json',
        'file' => $cfile
    )
));
**/
// Send the request & save response to $resp
//$responseJSON = curl_exec($curl);
// Close request to clear up some resources
//curl_close($curl);

//echo $responseJSON;

// outputs the username that owns the running php/httpd process
// (on a system with the "whoami" executable in the path)
$msg = $_GET['message'];
$output = shell_exec('rm msg.json');
$file = 'msg.json';

$current = array("message" => $msg);
// Write the contents back to the file
file_put_contents($file, json_encode($current));

$output = shell_exec('curl -v -S -u tenantDeveloper1:tenantDeveloper1 -F\'notification={"applicationId":"32768","schemaId":"32771","topicId":"65538","type":"USER"};type=application/json\' -F file=@msg.json "http://88.85.224.107:8080/kaaAdmin/rest/api/sendNotification" | python -mjson.tool');
//echo "<pre>$output</pre>";



print <<<_HTML_
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Curpha</title>  
      <link rel="stylesheet" href="css/style.css">
</head>

<body>
<h1>Curpha IOT Control Dashboard</h1>
<table>
<tr>
<td>
  <h1>Sending Notifications </h1>
<form class="cf" method="GET" action="">
  <div class="half left cf">
    <h4>Notifications Should Appear HERE!$resp</h4>

  </div>
  <div class="half right cf">
    <textarea name="message" type="text" id="input-message" placeholder="Message"></textarea>
    <input type="submit" value="Submit" id="input-submit">
  </div>  
  </td>
<td>
</form>
 
<form class="cf">
  <div class="half left cf">


  </div>
  <div class="half right cf">
    
  </div>  
</form>
</td>
</tr>
</table>
</body>
</html>
_HTML_;

?>
