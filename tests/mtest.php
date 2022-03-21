<?php
use Mosquitto\Client;
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Europe/Berlin');

var_dump(extension_loaded('mosquitto'));

function mqtt_error_log($level, $message)
{
    if($level==Mosquitto\Client::LOG_WARNING || $level==Mosquitto\Client::LOG_ERR) echo $message;
}

function rec_msg($message)
{
    var_dump($message);
}

function con($rc, $message)
{
    echo "rc: $rc";
    var_dump($message);
}

try {
    $c = new Mosquitto\Client();
    $c->onLog('mqtt_error_log');
    $c->onMessage('rec_msg');
    $c->onConnect('con');
    
    $c->setCredentials("foo", "bar");
    $c->connect("localhost");
    $c->subscribe("#",0);
    for ($i = 0; $i < 10; $i++) {
    $c->loop();
}
    
}
catch (Mosquitto\Exception $e) {
    error_log($e->getMessage());
} catch (\Exception $e) { //The leading slash means the Global PHP Exception class will be caught
    error_log($e->getMessage());
}


