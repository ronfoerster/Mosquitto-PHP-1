--TEST--
Mosquitto\Client::setWill()
--SKIPIF--
<?php if (!extension_loaded('mosquitto')) die('skip Mosquitto extension not available'); ?>
--FILE--
<?php
include(dirname(__DIR__) . '/setup.php');

$client = new Mosquitto\Client();

try {
    $client->setWill();
    echo "Done\n";
} catch (ArgumentCountError $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->setWill(new stdClass);
    echo "Done\n";
} catch (ArgumentCountError $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->setWill(new stdClass, new stdClass);
    echo "Done\n";
} catch (ArgumentCountError $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->setWill('#');
    echo "Done\n";
} catch (ArgumentCountError $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->setWill('topic');
    echo "Done\n";
} catch (ArgumentCountError $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->setWill('topic', 'payload');
    echo "Done\n";
} catch (ArgumentCountError $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->setWill('topic', 'payload', new stdClass);
    echo "Done\n";
} catch (ArgumentCountError $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->setWill('topic', 'payload', 1);
    echo "Done\n";
} catch (ArgumentCountError $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->setWill('topic', 'payload', 1, new stdClass);
    echo "Done\n";
} catch (TypeError $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->setWill('topic', 'payload', 1, false);
    echo "Done\n";
} catch (Mosquitto\Exception $e) {
    echo $e->getMessage(), "\n";
}

try {
    $client->setWill('topic', 'payload', 1, true);
    echo "Done\n";
} catch (Mosquitto\Exception $e) {
    echo $e->getMessage(), "\n";
}

?>
--EXPECTF--
Mosquitto\Client::setWill() expects exactly 4 arguments, 0 given
Mosquitto\Client::setWill() expects exactly 4 arguments, 1 given
Mosquitto\Client::setWill() expects exactly 4 arguments, 2 given
Mosquitto\Client::setWill() expects exactly 4 arguments, 1 given
Mosquitto\Client::setWill() expects exactly 4 arguments, 1 given
Mosquitto\Client::setWill() expects exactly 4 arguments, 2 given
Mosquitto\Client::setWill() expects exactly 4 arguments, 3 given
Mosquitto\Client::setWill() expects exactly 4 arguments, 3 given
Mosquitto\Client::setWill(): Argument #4 ($retain) must be of type bool, %s given
Done
Done
