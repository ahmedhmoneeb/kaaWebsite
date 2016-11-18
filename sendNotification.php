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



// outputs the username that owns the running php/httpd process
// (on a system with the "whoami" executable in the path)
$msg = $_GET['message'];

$output = shell_exec('rm msg.json');
$file = 'msg.json';

$current = array("message" => $msg);
// Write the contents back to the file
file_put_contents($file, json_encode($current));

$output = shell_exec('curl -v -S -u tenantDeveloper1:tenantDeveloper1 -F\'notification={"applicationId":"32768","schemaId":"32771","topicId":"65538","type":"USER"};type=application/json\' -F file=@msg.json "http://88.85.224.107:8080/kaaAdmin/rest/api/sendNotification" | python -mjson.tool');
echo "<pre>$output</pre>";


?>
