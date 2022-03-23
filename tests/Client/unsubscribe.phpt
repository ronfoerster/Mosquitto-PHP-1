--TEST--
Mosquitto\Client::unsubscribe()
--SKIPIF--
<?php if (!extension_loaded('mosquitto')) die('skip Mosquitto extension not available'); ?>
--FILE--
<?php
include(dirname(__DIR__) . '/setup.php');

/* No params */
try {
    $client = new Mosquitto\Client;
    $client->unsubscribe();
} catch (ArgumentCountError $e) {
    echo $e->getMessage(), "\n";
}

/* Null param */
try {
    $client = new Mosquitto\Client;
    $client->unsubscribe(null);
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}

/* One param */
try {
    $client = new Mosquitto\Client;
    $client->unsubscribe('#');
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}

/* Daft params */
try {
    $client = new Mosquitto\Client;
    $client->unsubscribe(new stdClass);
} catch (TypeError $e) {
    echo $e->getMessage(), "\n";
}

$client = new Mosquitto\Client;

$client->onConnect(function() use ($client) {
    $client->subscribe('#', 0);
});

$client->onSubscribe(function() use ($client) {
    $client->unsubscribe('#');
});

$client->onUnsubscribe(function() use ($client) {
    var_dump(func_get_args());
    $client->disconnect();
});

$client->connect(TEST_MQTT_HOST);
$client->loopForever();
?>
--EXPECTF--
Mosquitto\Client::unsubscribe() expects exactly 1 argument, 0 given

Deprecated: Mosquitto\Client::unsubscribe(): Passing null to parameter #1 ($topic) of type string is deprecated %s
The client is not currently connected.
The client is not currently connected.
Mosquitto\Client::unsubscribe(): Argument #1 ($topic) must be of type string, stdClass given
array(1) {
  [0]=>
  int(2)
}
