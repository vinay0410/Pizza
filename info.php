<?php
require "vendor/autoload.php";

try {
  $m = new MongoDB\Client("mongodb://admin:EIIGMGVVORZLANRD@sl-eu-lon-2-portal.5.dblayer.com:20539,sl-eu-lon-2-portal.0.dblayer.com:20539/admin?ssl=true");
  //$m = new MongoDB\Client();
  $db = $m->Pizza;
  $collection = $db->users;
  $result = $collection->find();
  foreach($result as $doc) {
    var_dump($doc["username"]);
  }

} catch (Exception $e) {
  echo "Error ".$e->getMessage();
}
