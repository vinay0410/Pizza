<?php


try {
    $m = new MongoClient("mongodb://admin:EIIGMGVVORZLANRD@sl-eu-lon-2-portal.5.dblayer.com:20539,sl-eu-lon-2-portal.0.dblayer.com:20539/admin?ssl=true");
    $db = $m->Pizza;
    $collection = $db->users;
    echo "Connection Successfull";
} catch (Exception $e) {
    die("Caught Exception failed to Connect".$e->getMessage()."\n");



}
?>
