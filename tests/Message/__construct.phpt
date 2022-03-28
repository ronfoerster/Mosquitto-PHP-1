--TEST--
Mosquitto\Message::__construct()
--SKIPIF--
<?php if (!extension_loaded('mosquitto')) die('skip Mosquitto extension not available'); ?>
--FILE--
<?php
include(dirname(__DIR__) . '/setup.php');

$message = new Mosquitto\Message;
var_dump($message);

$message->topic = "Hello";
var_dump($message);

$message->payload = "Hello world";
var_dump($message);

$message->topic = false;
var_dump($message);

try {
    $message->topic = new stdClass;
    var_dump($message);
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}

$message->payload = false;
var_dump($message);

try {
    $message->payload = new stdClass;
    var_dump($message);
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}
?>
--EXPECTF--
object(Mosquitto\Message)#%d (5) {
  ["mid"]=>
  int(0)
  ["topic"]=>
  NULL
  ["payload"]=>
  string(0) ""
  ["qos"]=>
  int(0)
  ["retain"]=>
  bool(false)
}
object(Mosquitto\Message)#1 (5) {
  ["mid"]=>
  int(0)
  ["topic"]=>
  string(5) "Hello"
  ["payload"]=>
  string(0) ""
  ["qos"]=>
  int(0)
  ["retain"]=>
  bool(false)
}
object(Mosquitto\Message)#%d (5) {
  ["mid"]=>
  int(0)
  ["topic"]=>
  string(5) "Hello"
  ["payload"]=>
  string(11) "Hello world"
  ["qos"]=>
  int(0)
  ["retain"]=>
  bool(false)
}
object(Mosquitto\Message)#%d (5) {
  ["mid"]=>
  int(0)
  ["topic"]=>
  string(0) ""
  ["payload"]=>
  string(11) "Hello world"
  ["qos"]=>
  int(0)
  ["retain"]=>
  bool(false)
}
Object of class stdClass could not be converted to string
object(Mosquitto\Message)#%d (5) {
  ["mid"]=>
  int(0)
  ["topic"]=>
  string(0) ""
  ["payload"]=>
  string(0) ""
  ["qos"]=>
  int(0)
  ["retain"]=>
  bool(false)
}
Object of class stdClass could not be converted to string
