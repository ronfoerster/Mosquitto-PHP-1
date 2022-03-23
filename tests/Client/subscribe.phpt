--TEST--
Mosquitto\Client::subscribe()
--SKIPIF--
<?php if (!extension_loaded('mosquitto')) die('skip Mosquitto extension not available'); ?>
--FILE--
<?php
include(dirname(__DIR__) . '/setup.php');

/* No params */
try {
    $client = new Mosquitto\Client;
    $client->subscribe();
} catch (ArgumentCountError $e) {
    echo $e->getMessage(), "\n";
}

/* Null param */
try {
    $client = new Mosquitto\Client;
    $client->subscribe(null);
} catch (TypeError $e) {
    echo $e->getMessage(), "\n";
}

/* Only one param */
try {
    $client = new Mosquitto\Client;
    $client->subscribe('#');
} catch (ArgumentCountError $e) {
    echo $e->getMessage(), "\n";
}

/* Not connected */
try {
    $client = new Mosquitto\Client;
    $client->subscribe('#', 0);
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}

/* Daft params */
try {
    $client = new Mosquitto\Client;
    $client->subscribe(new stdClass, 0);
} catch (TypeError $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client = new Mosquitto\Client;
    $client->subscribe('#', new stdClass);
} catch (TypeError $e) {
    echo $e->getMessage(), "\n";
}

$client = new Mosquitto\Client;

$client->onConnect(function() use ($client) {
    $client->subscribe('#', 0);
});

$client->onSubscribe(function() use ($client) {
    var_dump(func_get_args());
    $client->disconnect();
});

$client->connect(TEST_MQTT_HOST);
$client->loopForever();
?>
--EXPECTF--
Mosquitto\Client::subscribe() expects exactly 2 arguments, 0 given
Mosquitto\Client::subscribe() expects exactly 2 arguments, 1 given
Mosquitto\Client::subscribe() expects exactly 2 arguments, 1 given
The client is not currently connected.
Mosquitto\Client::subscribe(): Argument #1 ($topic) must be of type string, %s given
Mosquitto\Client::subscribe(): Argument #2 ($qos) must be of type int, %s given
array(3) {
  [0]=>
  int(%d)
  [1]=>
  int(1)
  [2]=>
  int(0)
}
