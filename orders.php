<?php include("header.php"); ?>


<script>
$("#signup").on('shown.bs.modal', function() {
  console.log('toggle');
  $("#login").modal('toggle');
})
</script>


<?php
    var_dump($_POST);
    if (isset($_POST["user_address"])) {
        try {
            $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
            $collection = $m->selectCollection("pizza", "orders");
            $document = ["user_id" => new MongoDB\BSON\ObjectID($_POST["user_id"]), "outlet_id" => new MongoDB\BSON\ObjectID($_POST["outlet_id"]), "user_address" => $_POST["user_address"], "cart_contents" => $_POST["cart_contents"] ];
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
        $orders_cursor = $collection->find([], ['_id' => -1])->toArray();

        $order_count = count($orders_cursor);

    } catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        //die("Caught Exception failed to Connect".$e->getMessage()."\n");
    $error_order_msg = "Couldn't Connect to Database, Please try again";
  } catch (Exception $e) {
    $error_order_msg  = $e->getMessage();
  }


?>


<div class="container pb-modalreglog-container">



<div class="panel panel-default">
      <div class="panel-heading"><h3>Your Orders</h3>

		<?php if (isset($error_order_msg)) {
        ?>
		<div id="error" class="alert alert-danger" role="alert"><?php echo $error_order_msg; ?></div>
	<?php
    } ?>


			</div>
      <div class="panel-body" id="accordion">



				<div class="panel list-group">

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

                          <a class="list-group-item">
                            <h4 class="list-group-item-heading"><div class="progress">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
  aria-valuemin="0" aria-valuemax="100" style="width:40%">
    40% Complete (success)
  </div>
</div></h4>
                            <p class="list-group-item-text"><?php echo $outlet['outlet']; ?></p>
                            <p class="list-group-item-text"><?php echo $user['username']; ?></p>

                          </a>




<?php
                    }
                  }
                }
 ?>
  </div>
<?php include("footer.php"); ?>
