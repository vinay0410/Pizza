<?php
include("header.php");
?>

<?php

if (isset($_POST["user_address"])) {
    try {
        $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
        $collection = $m->selectCollection("pizza", "orders");
        $document = ["user_id" => new MongoDB\BSON\ObjectID($_POST["user_id"]), "outlet_id" => new MongoDB\BSON\ObjectID($_POST["outlet_id"]), "user_address" => json_decode($_POST["user_address"]), "cart_contents" => json_decode($_POST["cart_contents"]) ];
        $collection->insertOne($document);

    } catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        //die("Caught Exception failed to Connect".$e->getMessage()."\n");
        $error_order_msg = "Couldn't Connect to Database, Please try again";
    } catch (Exception $e) {
        $error_order_msg  = $e->getMessage();
    }

}

try {
    $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
    $collection = $m->selectCollection("pizza", "orders");
    $orders_cursor = $collection->find(["user_id" => new MongoDB\BSON\ObjectID($_POST["user_id"])], ['_id' => -1])->toArray();

    $order_count = count($orders_cursor);

} catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
    //die("Caught Exception failed to Connect".$e->getMessage()."\n");
$error_order_msg = "Couldn't Connect to Database, Please try again";
} catch (Exception $e) {
$error_order_msg  = $e->getMessage();
}


?>



<div class="container">
<div class="container-fluid">

  <?php if (isset($error_order_msg)) {
      ?>
  <div id="error" class="alert alert-danger" role="alert"><?php echo $error_order_msg; ?></div>
<?php
  } ?>
<div class="row">
<div class="col-md-12">
  <table class="table table-hover " style="margin-top: 150px;">
    <thead>
      <tr>
        <th class="col-md-2">
         Order Id
        </th>
        <th class="col-md-3">
          Products
        </th>
        <th class="col-md-1">
          Total Price
        </th>
        <th class="col-md-7">
          Order Status
        </th>
      </tr>
    </thead>
    <tbody>
      <?php
                if (isset($order_count) or isset($orders_cursor)) {
                    if ($order_count == 0 && empty($error_order_msg)) {
                        echo "<p>Oh, You haven't ordered anything yet!</p>";
                    } else {
                        $index = 0;

                      ?>
                      <div class="list-group" id="orders">
                        <?php
                        foreach ($orders_cursor as $document) {

                          $collection = $m->selectCollection("pizza", "outlets");

                          $outlet = $collection->findOne(["_id" => $document["outlet_id"]], ['typeMap' => ['document' => 'array', 'root' => 'array']]);
                          $collection = $m->selectCollection("pizza", "users");

                          $user = $collection->findOne(["_id" => $document["user_id"]], ['typeMap' => ['document' => 'array', 'root' => 'array']]);

                             ?>
      <tr>
        <td> <?php echo $document["_id"]->getTimeStamp(); ?></td>
        <td>
          <div class="list-group" id="orders">
            <?php
            foreach($document["cart_contents"]["products"] as $item) { ?>
              <a class="list-group-item">
                <h6 class="list-group-item-heading accordion-toggle"><?php echo $item["name"]; ?></h6>
              </a>

      <?php      }
             ?>
        </td>
        <td>
          <?php echo $document["cart_contents"]["totalPrice"]; ?>
        </td>
        <td>

          <!--progress bar -->
         <div class="progress">
            <div id="dynamic" class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
            <span id="current-progress"></span>
            </div>
          </div>
          <!-- -->
        </td>
      </tr>

<?php }
}
}
?>

    </tbody>
  </table>
</div>
</div>
</div>

</div>
<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(function() {
var current_progress = 0;
var interval = setInterval(function() {
  current_progress += 20;
  $(".progress-bar")
  .css("width", current_progress + "%")
  .attr("aria-valuenow", current_progress)
  .text(current_progress + "% Complete");
  if(current_progress == 20)
  {
    $(".progress-bar")
  .css("width", current_progress + "%")
  .attr("aria-valuenow", current_progress)
  .text("Order Placed");
  }
  else if(current_progress == 40)
  {
    $(".progress-bar")
  .css("width", current_progress + "%")
  .attr("aria-valuenow", current_progress)
  .text("Getting Ready");
  }
  else if(current_progress == 60)
  {
    $(".progress-bar")
  .css("width", current_progress + "%")
  .attr("aria-valuenow", current_progress)
  .text("Prepared");
  }
  else if(current_progress == 80)
  {
    $(".progress-bar")
  .css("width", current_progress + "%")
  .attr("aria-valuenow", current_progress)
  .text("On The Way");
  }
  else if(current_progress == 100)
  {
    $(".progress-bar")
  .css("width", current_progress + "%")
  .attr("aria-valuenow", current_progress)
  .text("Delivered");
  }
  if (current_progress >= 100)
      clearInterval(interval);
}, 1000);
});
</script>
<?php include('modals.php'); ?>
<?php include("footer.php"); ?>
