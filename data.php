<?php

require "vendor/autoload.php";

  $q = strtolower($_GET["suggest"]);
  $search_by = $_GET["search_by"];





try {
  $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
  $db = $m->pizza;
  $collection = $db->users;

  $cursor = $collection->find([strtolower($search_by) => new MongoDB\BSON\Regex(".*$q.*", 'i')], ['typeMap' => ['document' => 'array', 'root' => 'array']])->toArray();

  if (strtolower($search_by) == "address") {
  $cursor2 = $collection->find(["address.formatted_addr" => new MongoDB\BSON\Regex(".*$q.*", 'i')], ['typeMap' => ['document' => 'array', 'root' => 'array']])->toArray();
  $cursor = array_merge($cursor, $cursor2);
  }

?>


<div class="panel-group" id="accordion_users">

<?php

      echo "Found ". count($cursor);
      if (count($cursor) != 0 AND !empty($q)) {

      foreach ($cursor as $row) {

        ?>

        <div class="panel panel-default">
        <div class="panel-heading" style="cursor: pointer" data-toggle="collapse" data-parent="#accordion_users" data-target="<?php echo "#".$row['_id']; ?>">

          <h4 class="panel-title">
            <?php echo $row["fname"] . " " . $row["lname"]; ?>
          </h4>

          <?php echo '<p>'.$row['email'].'</p>'; ?>
        </div>
        <div id="<?php echo $row['_id']; ?>" class="panel-collapse collapse">
          <div class="panel-body">
            <div class="list-group">
              Address:

              <?php
              if ( isset($row["address"]) AND !empty($row["address"]) ) { ?>
              <?php
                if (is_array($row["address"])) {
                foreach($row["address"] as $entry) { ?>
              <a class="list-group-item"><?php if (isset( $entry["formatted_addr"] )) {echo $entry["formatted_addr"]; } else {echo $entry; } ?></a>
            <?php }
          } else { ?>
              <a class="list-group-item"><?php echo $row["address"]; ?></a>
        <?php  }
          } else { ?>
              <p>No Addresses Present!</p>
          <?php } ?>
            </div>

          <a class="list-group-item"><?php echo "Contact: ".$row["phoneno"]; ?></a>
        </div>
        </div>
      </div>


<?php
  }
} else {
  echo '<p>No Suggestions</p>';
}
 ?>
 </div>


<?php
} catch (Exception $e) {
  echo "Caught Exception ".$e->getMessage();
}
 ?>
