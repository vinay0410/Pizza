<?php
  require "vendor/autoload.php";

  $m = new MongoDB\Client;
  $db = $m->pizza;
  $collection = $db->orders;

  $order = $collection->findOne(["_id" => new MongoDB\BSON\ObjectID($_GET["order"])]);
  echo $order["currentLocation"];

 ?>
