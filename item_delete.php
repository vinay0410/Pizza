<?php


    $id = $_POST["id"];



    try {
        $m = new MongoClient("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
        $db = $m->pizza;
        $collection = $db->menu;
    } catch (Exception $e) {
        die("Caught Exception failed to Connect".$e->getMessage()."\n");


    }
        $item = $collection->findOne(array('_id' => new MongoId($id)));
        $result = $collection->remove(array('_id' => new MongoId($id)));
        if (isset($item["path"])) {
          unlink($item["path"]);
        }
        ?>
        <div id="success" class="alert alert-success" role="alert"><?php echo "Item Deleted Successfully"; ?></div>
