<?php
require "vendor/autoload.php";

try {
    $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
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
