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
echo $msg;
$deviceName = $_GET['deviceName'];
$red = $_GET['red'];
$green = $_GET['green'];
$blue = $_GET['blue'];

if ($deviceName != "")
{
if($red == 'on')$red = 'ON';
else $red = 'OFF';

if($green == 'on')$green = 'ON';
else $green = 'OFF';

if($blue == 'on')$blue = 'ON';
else $blue = 'OFF';

$output = shell_exec('curl -v -S -u tenantDeveloper1:tenantDeveloper1 -X POST -H \'Content-Type: application/json\' -d\'{"applicationId":"32768","schemaId":"65538","endpointGroupId":"32768","majorVersion":"3","minorVersion":"0","description":"Test Configuration","body": "{\\"RaspSchema\\":{\\"array\\":[{\\"name\\":\\" ' . $deviceName .' \\",\\"red\\":\\"' . $red .'\\",\\"green\\":\\"' . $green .'\\",\\"blue\\":\\"' . $blue .'\\",\\"__uuid\\":{\\"org.kaaproject.configuration.uuidT\\":\\"\\\\u0000\\u00b1Z:\\u008f\\u00cfB\\u00ab\\u00b82^\\u00b6S\\\\\\"\\u007f\\u00a3\\"}}]},\\"__uuid\\":{\\"org.kaaproject.configuration.uuidT\\":\\"\\\\u001A?i\\u008a\\u0097\\u0092J\\u00ca\\u00a5\\u00d1 \\u00d5X\\\\u001F\\\\u0001\\u00a6\\"}}"}\' "http://88.85.224.107:8080/kaaAdmin/rest/api/configuration" | python -mjson.tool');

$output = json_decode($output);
$confID =  $output->id;
//echo $confID;
$output = shell_exec('curl -v -S -u tenantDeveloper1:tenantDeveloper1 -X POST -H \'Content-Type: text/plain\' -d\'' . $confID . '\' "http://88.85.224.107:8080/kaaAdmin/rest/api/activateConfiguration" | python -mjson.tool');
}
//echo $output;
//print_r(array_keys($output));
/**
$output = shell_exec('rm msg.json');
$file = 'msg.json';

$current = array("message" => $msg);
// Write the contents back to the file
file_put_contents($file, json_encode($current));

$output = shell_exec('curl -v -S -u tenantDeveloper1:tenantDeveloper1 -F\'notification={"applicationId":"32768","schemaId":"32771","topicId":"65538","type":"USER"};type=application/json\' -F file=@msg.json "http://88.85.224.107:8080/kaaAdmin/rest/api/sendNotification" | python -mjson.tool');
//echo "<pre>$output</pre>";
**/


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

<div style="position:relative;width:50%;float:left;">
<h1>Sending Notifications </h1>
<form class="cf" method="GET" action="">
    <h4>Notifications Should Appear HERE!$resp</h4>
    <textarea name="message" type="text" id="input-message" placeholder="Message"></textarea>
    <input type="submit" value="Submit" id="input-submit">
</form>
</div>


<div style="position:relative;width:50%;float:left;">
<form class="cf" method="GET" action="">
<h1> Configuration Testing </h1>
<input type="text" name="deviceName" placeholder="Device Name">  

<table>
<tr>
<td>Red</td>
<td>
<label class="switch">
  <input type="checkbox" name="red">
  <div class="slider round"></div>
</label>
</td>
</tr>

<tr>
<td>Green</td>
<td>
<label class="switch">
  <input type="checkbox" name="green">
  <div class="slider round"></div>
</label>
</td>
</tr>

<tr>
<td>Blue</td>
<td>
<label class="switch">
  </p><input type="checkbox" name="blue">
  <div class="slider round"></div>
</label>
</td>
</tr>
</table>
<input type="submit" value="Submit" id="input-submit">

</form>
</div>
  
</body>
</html>
_HTML_;

?>
