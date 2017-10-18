<?php
require "vendor/autoload.php";
echo phpinfo();

try {
  $m = new MongoClient("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");

  //$m = new MongoClient();

} catch (Exception $e) {
  echo "Error ".$e->getMessage();
}
