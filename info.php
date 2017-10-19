<?php
require "vendor/autoload.php";
echo phpinfo();

try {
  $m = new MongoClient("mongodb://admin:EIIGMGVVORZLANRD@sl-eu-lon-2-portal.5.dblayer.com:20539,sl-eu-lon-2-portal.0.dblayer.com:20539/admin?ssl=true");

  //$m = new MongoClient();

} catch (Exception $e) {
  echo "Error ".$e->getMessage();
}
