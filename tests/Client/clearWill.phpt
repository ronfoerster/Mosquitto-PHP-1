--TEST--
Mosquitto\Client::setWill()
--SKIPIF--
<?php if (!extension_loaded('mosquitto')) die('skip Mosquitto extension not available'); ?>
--FILE--
<?php
include(dirname(__DIR__) . '/setup.php');

$client = new Mosquitto\Client();
$client->clearWill();

try {
    $client->clearWill(true);
} catch (Throwable $e) {
    echo $e->getMessage(), "\n";
}

?>
--EXPECTF--
Mosquitto\Client::clearWill() expects exactly 0 arguments, 1 given
