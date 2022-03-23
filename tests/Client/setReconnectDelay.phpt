--TEST--
Mosquitto\Client::setReconnectDelay()
--SKIPIF--
<?php if (!extension_loaded('mosquitto')) die('skip Mosquitto extension not available'); ?>
--FILE--
<?php
include(dirname(__DIR__) . '/setup.php');

$client = new Mosquitto\Client;
$client->setReconnectDelay(10);
var_dump($client);

$client->setReconnectDelay(0);
var_dump($client);

$client->setReconnectDelay("100");
var_dump($client);

try {
    $client->setReconnectDelay("foo");
    var_dump($client);
} catch (TypeError $e) {
    var_dump($e->getMessage());
}

try {
    $client->setReconnectDelay(new stdClass);
    var_dump($client);
} catch (TypeError $e) {
    var_dump($e->getMessage());
}
?>
--EXPECTF--
object(Mosquitto\Client)#%d (0) {
}
object(Mosquitto\Client)#%d (0) {
}
object(Mosquitto\Client)#%d (0) {
}
string(%d) "Mosquitto\Client::setReconnectDelay(): Argument #%d ($reconnectDelay) must be of type int, %s given"
string(%d) "Mosquitto\Client::setReconnectDelay(): Argument #%d ($reconnectDelay) must be of type int, %s given"
