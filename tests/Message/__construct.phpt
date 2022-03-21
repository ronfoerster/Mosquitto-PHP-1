--TEST--
Mosquitto\Message::__construct()
--FILE--
<?php
include(dirname(__DIR__) . '/setup.php');

echo "Hi";
?>
--EXPECTF--
Hi
