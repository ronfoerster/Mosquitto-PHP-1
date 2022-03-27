--TEST--
Mosquitto\Client::setCredentials()
--SKIPIF--
<?php if (!extension_loaded('mosquitto')) die('skip Mosquitto extension not available'); ?>
--FILE--
<?php
include(dirname(__DIR__) . '/setup.php');

$client = new Mosquitto\Client;

$client->setCredentials('foo', 'bar');
var_dump($client);

$client->setCredentials(null, null);
var_dump($client);

$client->setCredentials('foo', null);
var_dump($client);

$client->setCredentials(null, 'foo');
var_dump($client);

try {
    $client->setCredentials(new stdClass, 'foo');
    var_dump($client);
} catch (TypeError $e) {
    var_dump($e->getMessage());
}

try {
    $client->setCredentials('foo', new stdClass);
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
object(Mosquitto\Client)#%d (0) {
}
string(98) "Mosquitto\Client::setCredentials(): Argument #1 ($username) must be of type string, stdClass given"
string(98) "Mosquitto\Client::setCredentials(): Argument #2 ($password) must be of type string, stdClass given"

