<?php
require "vendor/autoload.php";

try {
    $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
    $db = $m->pizza;
    $collection = $db->users;
    echo "Connection Successfull";
} catch (Exception $e) {
    die("Caught Exception failed to Connect".$e->getMessage()."\n");



}

var_dump($collection);

?>
