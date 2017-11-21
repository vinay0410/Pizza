<?php
session_start();

require "vendor/autoload.php";

if (isset($_POST["user_address"])) {
    try {
        $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
        $collection = $m->selectCollection("pizza", "orders");
        $document = ["user_id" => new MongoDB\BSON\ObjectID($_POST["user_id"]), "outlet_id" => new MongoDB\BSON\ObjectID($_POST["outlet_id"]), "user_address" => json_decode($_POST["user_address"]), "cart_contents" => json_decode($_POST["cart_contents"]), "orderStatus" => 20 ];
        $collection->insertOne($document);

    } catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        //die("Caught Exception failed to Connect".$e->getMessage()."\n");
        $error_order_msg = "Couldn't Connect to Database, Please try again";
    } catch (Exception $e) {
        $error_order_msg  = $e->getMessage();
    }

}

header("Location: orderstatus.php");

 ?>
