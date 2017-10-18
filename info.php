<?php
require "vendor/autoload.php";
echo phpinfo();

try {
  $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");

  //$m = new MongoDB\Client();
  
} catch (Exception $e) {
  echo "Error ".$e->getMessage();
}
