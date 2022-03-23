--TEST--
Mosquitto\Client::setTlsInsecure()
--SKIPIF--
<?php if (!extension_loaded('mosquitto')) die('skip Mosquitto extension not available'); ?>
--FILE--
<?php
include(dirname(__DIR__) . '/setup.php');

$client = new Mosquitto\Client;
$client->setTlsInsecure(true);
var_dump($client);

$client->setTlsInsecure(false);
var_dump($client);

try {
$client->setTlsInsecure(new stdClass);
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
string(%d) "Mosquitto\Client::setTlsInsecure(): Argument #1 (%s) must be of type bool, stdClass given"
