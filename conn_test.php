<?php
require "vendor/autoload.php";

try {
    $m = new MongoDB\Client;
    $db = $m->pizza;
    $collection = $db->menu;
} catch (Exception $e) {
    die("Caught Exception failed to Connect".$e->getMessage()."\n");

}

    $result = $collection->find([], ['typeMap' => ['document' => 'array', 'root' => 'array']]);
    foreach($result as $entry) {
      var_dump($entry);
    }


?>
