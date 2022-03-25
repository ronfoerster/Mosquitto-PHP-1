--TEST--
Mosquitto\Client::publish()
--SKIPIF--
<?php if (!extension_loaded('mosquitto')) die('skip Mosquitto extension not available'); ?>
--FILE--
<?php
include(dirname(__DIR__) . '/setup.php');

$client = new Mosquitto\Client();

try {
    $client->publish();
    echo "Done\n";
} catch (Throwable $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->publish(new stdClass);
    echo "Done\n";
} catch (Throwable $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->publish(new stdClass, new stdClass);
    echo "Done\n";
} catch (Throwable $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->publish('#');
    echo "Done\n";
} catch (Throwable $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->publish('topic');
    echo "Done\n";
} catch (Throwable $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->publish('topic', 'payload', new stdClass);
    echo "Done\n";
} catch (Throwable $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->publish('topic', 'payload', 1, new stdClass);
    echo "Done\n";
} catch (Throwable $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->publish('topic', 'payload', 1);
    echo "Done\n";
} catch (Throwable $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->publish('topic', 'payload', 1, true);
    echo "Done\n";
} catch (Throwable $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->publish('topic', 'payload', 1, false);
    echo "Done\n";
} catch (Throwable $e) {
    echo $e->getMessage(), "\n";
}


try {
    $client->publish('topic', 'payload');
    echo "Done\n";
} catch (Throwable $e) {
    echo $e->getMessage(), "\n";
}

$client2 = new Mosquitto\Client();
$looping = true;

$client2->onConnect(function() use ($client2) {
    $client2->subscribe('publish', 0);
    $client2->publish('publish', 'hello', 0);
});

$client2->onMessage(function($m) use ($client2, &$looping) {
    var_dump($m);
    $client2->disconnect();
    $looping = false;
});

$client2->connect(TEST_MQTT_HOST);

for ($i = 0; $i < 10; $i++) {
    if (!$looping) break;
    $client2->loop(50);
}

?>
--EXPECTF--
Mosquitto\Client::publish() expects at least 2 arguments, 0 given
Mosquitto\Client::publish() expects at least 2 arguments, 1 given
Mosquitto\Client::publish(): Argument #1 ($topic) must be of type string, stdClass given
Mosquitto\Client::publish() expects at least 2 arguments, 1 given
Mosquitto\Client::publish() expects at least 2 arguments, 1 given
Mosquitto\Client::publish(): Argument #3 ($qos) must be of type int, stdClass given
Mosquitto\Client::publish(): Argument #4 ($retain) must be of type bool, stdClass given
Done
Done
Done
The client is not currently connected.
object(Mosquitto\Message)#%d (5) {
  ["mid"]=>
  int(%d)
  ["topic"]=>
  string(7) "publish"
  ["payload"]=>
  string(5) "hello"
  ["qos"]=>
  int(0)
  ["retain"]=>
  bool(false)
}
