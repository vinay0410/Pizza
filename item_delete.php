<?php

require "vendor/autoload.php";

    $id = $_POST["id"];



    try {
        $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
        $db = $m->pizza;
        $collection = $db->menu;
    } catch (Exception $e) {
        #die("Caught Exception failed to Connect".$e->getMessage()."\n");

        echo json_encode(array('error' => True, 'msg' => "Couldn't Connect to Database"));
        exit();

    }
        $item = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($id)] );
        $result = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($id)] );
        if (isset($item["path"])) {
          unlink($item["path"]);
        }
        ?>
        <div id="success" class="alert alert-success" role="alert"><?php echo "Item Deleted Successfully"; ?></div>
