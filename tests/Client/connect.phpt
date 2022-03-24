--TEST--
Mosquitto\Client::connect()
--SKIPIF--
<?php if (!extension_loaded('mosquitto')) die('skip Mosquitto extension not available'); ?>
--FILE--
<?php
include(dirname(__DIR__) . '/setup.php');

/* No parameters */
try {
    $client = new Mosquitto\Client();
    $client->connect();
} catch (Throwable $e) {
    writeException($e);
}

/* Invalid hostname */
try {
    $client = new Mosquitto\Client();
    $client->connect(false);
} catch (Throwable $e) {
    writeException($e);
}

/* Invalid hostname */
try {
    $client = new Mosquitto\Client();
    $client->connect(":^(%^*:");
} catch (Throwable $e) {
    writeException($e);
}

/* Invalid port */
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, 0);
} catch (Throwable $e) {
    writeException($e);
}

/* Invalid port */
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, new stdClass);
} catch (Throwable $e) {
    writeException($e);
}

/* Invalid keepalive */
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, TEST_MQTT_PORT, new stdClass);
    var_dump($client);
} catch (Throwable $e) {
    writeException($e);
}

/* Invalid bind address */
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, TEST_MQTT_PORT, 0, '^(%%^&*');
    var_dump($client);
} catch (Throwable $e) {
    writeException($e);
}

/* Zero keepalive (OK) */
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, TEST_MQTT_PORT, 0);
    var_dump($client);
} catch (Throwable $e) {
    writeException($e);
}

/* 10-second keepalive */
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, TEST_MQTT_PORT, 10);
    var_dump($client);
} catch (Throwable $e) {
    writeException($e);
}

/* Bind to 127.0.0.1 - should work if connecting to localhost */
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, TEST_MQTT_PORT, 0, '127.0.0.1');
    var_dump($client);
} catch (Throwable $e) {
    writeException($e);
}

/* Specify just the host */
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST);
    var_dump($client);
} catch (Throwable $e) {
    writeException($e);
}

?>
--EXPECTF--
Mosquitto\Client::connect() expects at least 1 argument, 0 given
%s error.
%s error.
Mosquitto\Client::connect(): Argument #%d ($%s) must be of type int, stdClass given
Mosquitto\Client::connect(): Argument #%d ($%s) must be of type int, stdClass given
%s error.
object(Mosquitto\Client)#%d (%d) {
}
object(Mosquitto\Client)#%d (%d) {
}
object(Mosquitto\Client)#%d (%d) {
}
object(Mosquitto\Client)#%d (%d) {
}

