--TEST--
Mosquitto\Client::setTlsPSK()
--SKIPIF--
<?php if (!extension_loaded('mosquitto')) die('skip Mosquitto extension not available'); ?>
--FILE--
<?php
include(dirname(__DIR__) . '/setup.php');

$client = new Mosquitto\Client;

try {
    $client->setTlsPSK();
} catch (ArgumentCountError $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->setTlsPsk('1234567890abcdef');
} catch (ArgumentCountError $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->setTlsPsk("This is invalid hex", "Username");
} catch (\Mosquitto\Exception $e) {
    echo $e->getMessage(), "\n";
}

/* This actually doesn't fail */
try {
    $client->setTlsPsk('1234567890abcdef', 'username', "This is not a cipher string");
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}

$client->setTlsPsk('1234567890abcdef', 'testuser');
var_dump($client);

$client->setTlsPsk('1234567890abcdef', 'testuser', 'DEFAULT');
var_dump($client);

$client->onConnect(function() use ($client) {
    echo "Connected successfully\n";
    $client->disconnect();
});

$client->connect(TEST_MQTT_HOST, TEST_MQTT_TLS_PSK_PORT);
$client->loopForever();

?>
--EXPECTF--
Mosquitto\Client::setTlsPSK() expects at least 2 arguments, 0 given
Mosquitto\Client::setTlsPSK() expects at least 2 arguments, 1 given
Invalid %s provided.
object(Mosquitto\Client)#%d (0) {
}
object(Mosquitto\Client)#%d (0) {
}
Connected successfully
