--TEST--
Mosquitto\Client::connect()
--SKIPIF--
<?php if (!extension_loaded('mosquitto')) die('skip Mosquitto extension not available'); ?>
--FILE--
<?php
include(dirname(__DIR__) . '/setup.php');

/* 1 No parameters */
try {
    $client = new Mosquitto\Client();
    $client->connect();
} catch (ArgumentCountError $e) {
    echo $e->getMessage() . PHP_EOL;
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}


/* 2 Invalid hostname */
try {
    $client = new Mosquitto\Client();
    $client->connect(false);
} catch (Exception $e) {
    writeException($e);
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}


/* 3 Invalid hostname */
try {
    $client = new Mosquitto\Client();
    $client->connect(":^(%^*:");
} catch (Exception $e) {
    writeException($e);
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}


/* 4 Invalid port */
/*
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, 0);
} catch (Exception $e) {
    writeException($e);
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}
*/

/* 5 Invalid port */
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

/* 6 Invalid keepalive */
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

/* 7 Invalid bind address */
/*
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, TEST_MQTT_PORT, 0, '^(%%^&*');
    var_dump($client);
} catch (Exception $e) {
    writeException($e);
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}
*/

/* 8 Zero keepalive (OK) */
/*
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, TEST_MQTT_PORT, 0);
    var_dump($client);
} catch (Exception $e) {
    writeException($e);
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}
*/

/* 9  10-second keepalive */
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, TEST_MQTT_PORT, 10);
    var_dump($client);
} catch (Exception $e) {
    writeException($e);
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}

/* 10 Bind to 127.0.0.1 - should work if connecting to localhost */
/*
try {
    $client = new Mosquitto\Client();
    $client->connect(TEST_MQTT_HOST, TEST_MQTT_PORT, 0, '127.0.0.1');
    var_dump($client);
} catch (Exception $e) {
    writeException($e);
} catch (Error $e) {
    echo $e->getMessage() . PHP_EOL;
}
*/

/* 11 Specify just the host */
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
Caught Mosquitto\Exception with code 0 and message: Lookup error.
Caught Mosquitto\Exception with code 0 and message: Lookup error.
Mosquitto\Client::connect(): Argument #2 ($port) must be of type int, stdClass given
Mosquitto\Client::connect(): Argument #3 ($keepalive) must be of type int, stdClass given
object(Mosquitto\Client)#%d (0) {
}
object(Mosquitto\Client)#%d (0) {
}
