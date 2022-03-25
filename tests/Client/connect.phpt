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
} catch (ArgumentCountError $e) {
    echo $e->getMessage() . PHP_EOL;
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}


/* Invalid hostname */
try {
    $client = new Mosquitto\Client();
    $client->connect(false);
} catch (Exception $e) {
    writeException($e);
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}


/* Invalid hostname */
try {
    $client = new Mosquitto\Client();
    $client->connect(":^(%^*:");
} catch (Exception $e) {
    writeException($e);
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}


/* Invalid port */
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, 0);
} catch (Exception $e) {
    writeException($e);
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}


/* Invalid port */
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, new stdClass);
} catch (TypeError $e) {
    echo $e->getMessage() . PHP_EOL;
} catch (Exception $e) {
    writeException($e);
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}

/* Invalid keepalive */
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, TEST_MQTT_PORT, new stdClass);
    var_dump($client);
} catch (TypeError $e) {
    echo $e->getMessage() . PHP_EOL;
} catch (Exception $e) {
    writeException($e);
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}

/* Invalid bind address */
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, TEST_MQTT_PORT, 0, '^(%%^&*');
    var_dump($client);
} catch (Exception $e) {
    writeException($e);
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}

/* Zero keepalive (OK) */
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, TEST_MQTT_PORT, 0);
    var_dump($client);
} catch (Exception $e) {
    writeException($e);
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}

/* 10-second keepalive */
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, TEST_MQTT_PORT, 10);
    var_dump($client);
} catch (Exception $e) {
    writeException($e);
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}

/* Bind to 127.0.0.1 - should work if connecting to localhost */
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, TEST_MQTT_PORT, 0, '127.0.0.1');
    var_dump($client);
} catch (Exception $e) {
    writeException($e);
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}

/* Specify just the host */
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST);
    var_dump($client);
} catch (Exception $e) {
    writeException($e);
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
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

