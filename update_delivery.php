<?php
  require "vendor/autoload.php";

  $m = new MongoDB\Client;
  $db = $m->pizza;
  $collection = $db->orders;

  if (isset($_POST["ontheway"])) {
    $collection->updateOne(["_id" => new MongoDB\BSON\ObjectID($_POST["order"])], ['$set' => ["orderStatus" => 80]]);

  } else {
    $collection->updateOne(["_id" => new MongoDB\BSON\ObjectID($_POST["order"])], ['$set' => ['currentLocation' => json_encode($_POST["location"])]]);
  }
