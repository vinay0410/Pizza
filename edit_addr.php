<?php

session_start();

require "vendor/autoload.php";

$user_id = $_SESSION["logged"]["_id"];
$orig_place_id = $_POST["orig_place_id"];





    try {
        $m = new MongoDB\Client;
        $db = $m->pizza;
        $collection = $db->users;
        $document = [ "place_id" => $_POST["place_id"],  "initial" => $_POST["addr_name"], "full_address" => $_POST["edit_full_address"], "place_name" => $_POST["place_name"], "formatted_addr" => $_POST["formatted_addr"], "coord" => [(float)$_POST['long'], (float)$_POST['lat'] ] ];
        $collection->updateOne([ '_id' =>  new MongoDB\BSON\ObjectID($user_id), 'address.place_id' => $orig_place_id], [ '$set' => [ 'address.$.place_id' => $document["place_id"], 'address.$.initial' => $document["initial"], 'address.$.full_address' => $document['full_address'], 'address.$.place_name' => $document["place_name"], 'address.$.formatted_addr' => $document["formatted_addr"], 'address.$.coord' => $document["formatted_addr"] ] ]);
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
        <h4 class="list-group-item-heading "><?php echo $document["initial"]; ?>
          <input type="radio" class="pull-right" name="addr" checked="checked" data-addr='<?php echo json_encode($document); ?>' value="<?php echo json_encode($document["coord"]); ?>">
          <button type="button" class="btn btn-danger btn-space pull-right" id="<?php echo $document['place_id'] ?>" onclick="delete_addr(this);"><span class="glyphicon glyphicon-remove"></span> </button>
          <button type="button" name="edit_modal" class="btn btn-default btn-space pull-right" data-toggle="modal" data-target="#editAddressModal" onclick="putContents(this);" ><span class="glyphicon glyphicon-pencil"></span></button>
        </h4>
        <p class="list-group-item-text"><?php echo $document['place_name']; ?></p>
        <p class="list-group-item-text"><?php echo $document['formatted_addr']; ?></p>
