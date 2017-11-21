<?php

session_start();

require "vendor/autoload.php";



$coord = array_map('floatval', $_POST["coordinates"]);



try {
        $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
        $db = $m->pizza;
        $collection = $db->outlets;

        //var_dump($_SESSION["logged"]["_id"]);

        $result = $collection->findOne(["coord" => ['$near' => ['$geometry' => ['type' => 'Point', 'coordinates' => $coord ] ] ] ], ['typeMap' => ['document' => 'array', 'root' => 'array']]);
        $user_collection = $db->users;
        $supervisor = $user_collection->findOne(["_id" => $result["supervisor_id"]]);

    } catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        //die("Caught Exception failed to Connect".$e->getMessage()."\n");
        $var = array('error' => True, 'msg' => "Couldn't Connect to Database");
        echo json_encode($var);
        exit();
  } catch (Exception $e) {
    $var = array('error' => True, 'msg' => $e->getMessage());
    echo json_encode($var);
    exit();

  } ?>

  <a class="list-group-item">
    <h4 class="list-group-item-heading accordion-toggle"><?php echo $result["outlet"]; ?>
      <input type="hidden" class="pull-right" data-addr='<?php echo $result["_id"]; ?>' value="<?php echo json_encode($result['coord']); ?>" name="outlet_coordinates">
    </h4>
    <p class="list-group-item-text"><?php echo $result['outlet_addr']; ?></p>
    <p class="list-group-item-text"><?php echo $supervisor["fname"] . " " . $supervisor["lname"]; ?></p>

  </a>
