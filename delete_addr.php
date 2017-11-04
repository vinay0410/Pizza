<?php

session_start();

require "vendor/autoload.php";

$user_id = $_SESSION["logged"]["_id"];
$place_id = $_POST["place_id"];





    try {
        $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
        $db = $m->pizza;
        $collection = $db->users;
        $collection->updateOne([ '_id' =>  new MongoDB\BSON\ObjectID($user_id)], [ '$pull' => [ 'address' => [ 'place_id' => $place_id ] ] ]);
        $result = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($user_id)], ['typeMap' => ['document' => 'array', 'root' => 'array']]);

        $_SESSION["logged"] = $result;
        
    } catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
      echo json_encode(array('error' => True, 'msg' => "Couldn't Connect to Database"));
      exit();

    }  catch (Exception $e) {
        #die("Caught Exception failed to Connect".$e->getMessage()."\n");
        echo json_encode(array('error' => True, 'msg' => $e->getMessage()));
        exit();


    }


        ?>
        <div id="success" class="alert alert-success" role="alert"><?php echo "Item Deleted Successfully"; ?></div>
