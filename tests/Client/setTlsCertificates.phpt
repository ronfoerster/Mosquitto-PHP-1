--TEST--
Mosquitto\Client::setTlsCertificates()
--SKIPIF--
<?php if (!extension_loaded('mosquitto')) die('skip Mosquitto extension not available'); ?>
--FILE--
<?php
include(dirname(__DIR__) . '/setup.php');
$client = new Mosquitto\Client;

try {
    $client->setTlsCertificates();
} catch (TypeError $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->setTlsCertificates('/does/not/exist');
} catch (Throwable $e) {
    writeException($e);
}

try {
    $client->setTlsCertificates(CERTIFICATE_DIR . 'ca.crt', '/does/not/exist');
} catch (Throwable $e) {
    writeException($e);
}

try {
    $client->setTlsCertificates(CERTIFICATE_DIR . 'ca.crt', __FILE__);
} catch (Throwable $e) {
    writeException($e);
}

try {
    $client->setTlsCertificates(CERTIFICATE_DIR . 'ca.crt', CERTIFICATE_DIR . 'client.crt');
} catch (Throwable $e) {
    writeException($e);
}

try {
    $client->setTlsCertificates(CERTIFICATE_DIR . 'ca.crt', CERTIFICATE_DIR . 'client.crt', CERTIFICATE_DIR . 'client.key');
} catch (Throwable $e) {
    writeException($e);
}

$client->setTlsCertificates(CERTIFICATE_DIR . 'ca.crt');

$client->onConnect(function() use ($client) {
    echo "Connected successfully\n";
    $client->disconnect();
});

$client->connect(TEST_MQTT_HOST, TEST_MQTT_TLS_PORT);
$client->loopForever();
unset($client);

$client2 = new Mosquitto\Client;
$client2->onConnect(function() use ($client2) {
    echo "Connected successfully\n";
    $client2->disconnect();
});

$client2->setTlsCertificates(CERTIFICATE_DIR . 'ca.crt', CERTIFICATE_DIR . 'client.crt', CERTIFICATE_DIR . 'client-enc.key', 'Mosquitto-PHP');

$client2->connect(TEST_MQTT_HOST, TEST_MQTT_TLS_CERT_PORT);
$client2->loopForever();

?>
--EXPECTF--
Mosquitto\Client::setTlsCertificates() expects at least 1 argument, 0 given
Caught Mosquitto\Exception with code 0 and message: Invalid %s provided.
Caught Mosquitto\Exception with code 0 and message: Invalid %s provided.
Caught Mosquitto\Exception with code 0 and message: Invalid %s provided.
Caught Mosquitto\Exception with code 0 and message: Invalid %s provided.
Connected successfully
Connected successfully
