--TEST--
Mosquitto\Client::setTlsOptions()
--SKIPIF--
<?php if (!extension_loaded('mosquitto')) die('skip Mosquitto extension not available'); ?>
--FILE--
<?php
include(dirname(__DIR__) . '/setup.php');
$client = new Mosquitto\Client;

try {
    $client->setTlsOptions();
} catch (ArgumentCountError $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->setTlsOptions(new stdClass);
} catch (TypeError $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->setTlsOptions(Mosquitto\Client::SSL_VERIFY_PEER, new stdClass);
} catch (TypeError $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->setTlsOptions(Mosquitto\Client::SSL_VERIFY_PEER, 'tlsv1.2', new stdClass);
} catch (TypeError $e) {
    echo $e->getMessage(), "\n";
}

$client->setTlsOptions(Mosquitto\Client::SSL_VERIFY_PEER);
$client->setTlsOptions(Mosquitto\Client::SSL_VERIFY_PEER, 'tlsv1.2');
$client->setTlsOptions(Mosquitto\Client::SSL_VERIFY_PEER, 'tlsv1.2', 'DEFAULT');

?>
--EXPECTF--
Mosquitto\Client::setTlsOptions() expects at least 1 argument, 0 given
Mosquitto\Client::setTlsOptions(): Argument #%d ($verify_peer) must be of type int, stdClass given
Mosquitto\Client::setTlsOptions(): Argument #%d ($tls_version) must be of type %s, stdClass given
Mosquitto\Client::setTlsOptions(): Argument #%d ($ciphers) must be of type %s, stdClass given


