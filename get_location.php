<?php
  require "vendor/autoload.php";

  $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
  $db = $m->pizza;
  $collection = $db->orders;

  $order = $collection->findOne(["_id" => new MongoDB\BSON\ObjectID($_GET["order"])]);
  echo $order["currentLocation"];

 ?>
