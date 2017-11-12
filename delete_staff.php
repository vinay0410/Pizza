<?php

session_start();

require "vendor/autoload.php";

$staff_id = $_POST["staff_id"];
$role = $_POST["role"];




    try {
        $m = new MongoDB\Client;
        $db = $m->pizza;
        $collection = $db->users;
        $collection->deleteOne(["_id" => new MongoDB\BSON\ObjectID($staff_id) ]);

    } catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
      echo json_encode(array('error' => True, 'msg' => "Couldn't Connect to Database"));
      exit();

    }  catch (Exception $e) {
        #die("Caught Exception failed to Connect".$e->getMessage()."\n");
        echo json_encode(array('error' => True, 'msg' => $e->getMessage()));
        exit();


    }

      if ($role == "chef") {
        ?>
        <div id="success" class="alert alert-success" role="alert"><?php echo "Chef removed Successfully"; ?></div>
      <?php } else { ?>
        <div id="success" class="alert alert-success" role="alert"><?php echo "Delivery Staff removed Successfully"; ?></div>
    <?php  } ?>
