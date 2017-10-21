<?php


    $id = $_POST["id"];



    try {
        $m = new MongoClient("mongodb://admin:EIIGMGVVORZLANRD@sl-eu-lon-2-portal.5.dblayer.com:20539,sl-eu-lon-2-portal.0.dblayer.com:20539/admin?ssl=true");
        $db = $m->Pizza;
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
