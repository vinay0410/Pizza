<?php

session_start();

require "vendor/autoload.php";





    try {
        $m = new MongoDB\Client;
        $db = $m->pizza;
        $collection = $db->users;
        $document = [ "place_id" => $_POST["place_id"],  "initial" => $_POST["addr_name"], "full_address" => $_POST["full_address"], "place_name" => $_POST["place_name"], "formatted_addr" => $_POST["formatted_addr"], "coord" => [(float)$_POST['long'], (float)$_POST['lat'] ] ];
        //var_dump($_SESSION["logged"]["_id"]);

        $collection->updateOne([ "_id" => new MongoDB\BSON\ObjectID($_SESSION["logged"]["_id"]) ], [ '$push' => ['address' => $document] ]);

    } catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        //die("Caught Exception failed to Connect".$e->getMessage()."\n");
        $var = array('error' => True, 'msg' => "Couldn't Connect to Database");
        echo json_encode($var);
        exit();
  } catch (Exception $e) {
    $var = array('error' => True, 'msg' => $e->getMessage());
    echo json_encode($var);
    exit();

  }
      if (!isset($_SESSION["logged"]["address"]) OR $_SESSION["logged"]["address"] == NULL) {
        $_SESSION["logged"]["address"] = [$document];
      } else {
        array_push($_SESSION["logged"]["address"], $document);
      }
            ?>
            <h4 class="list-group-item-heading "><?php echo $document["initial"]; ?>
              <input type="radio" class="pull-right" name="addr" checked="checked" data-addr='<?php echo json_encode($document); ?>' value="<?php echo json_encode($document["coord"]); ?>">
              <button type="button" class="btn btn-danger btn-space pull-right" id="<?php echo $document['place_id'] ?>" onclick="delete_addr(this);"><span class="glyphicon glyphicon-remove"></span> </button>
              <button type="button" name="edit_modal" class="btn btn-default btn-space pull-right" data-toggle="modal" data-target="#editAddressModal" onclick="putContents(this);" ><span class="glyphicon glyphicon-pencil"></span></button>
            </h4>
            <p class="list-group-item-text"><?php echo $document['place_name']; ?></p>
            <p class="list-group-item-text"><?php echo $document['formatted_addr']; ?></p>


              <!--  <button type="button" class="btn btn-danger btn-space bottomright" onclick="delete_item(this);"><span class="glyphicon glyphicon-remove"></span> </button>
                <button type="button" name="edit_modal" class="btn btn-default btn-space pull-right" onclick="editable(this);"><span class="glyphicon glyphicon-pencil"></span> </button>
              -->
                <!--ending button for cart -->
