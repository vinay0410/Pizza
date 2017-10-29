<?php include("header.php"); ?>

<?php


    try {
        $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
        $collection = $m->selectCollection("pizza", "orders");
        $orders_cursor = $collection->find([], ['_id' => -1])->toArray();

        $order_count = count($order_cursor);

    } catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        //die("Caught Exception failed to Connect".$e->getMessage()."\n");
    $error_order_msg = "Couldn't Connect to Database, Please try again";
  } catch (Exception $e) {
    $error_order_msg  = $e->getMessage();
  }


?>


<div class="container pb-modalreglog-container">



<div class="panel panel-default">
      <div class="panel-heading"><h3>Your Orders
				<button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#outletModal" name="add_modal" onclick="construct_search(this)"><span class="glyphicon glyphicon-plus"></span>Add Outlet</button>
			</h3>

		<?php if (isset($error_order_msg)) {
        ?>
		<div id="error" class="alert alert-danger" role="alert"><?php echo $error_order_msg; ?></div>
	<?php
    } ?>


			</div>
      <div class="panel-body" id="accordion">



				<div class="panel list-group">

					<?php
                    if (isset($order_count) or isset($order_cursor)) {
                        if ($outlet_count == 0 && empty($error_order_msg)) {
                            echo "<p>Oh, You haven't ordered anything yet!</p>";
                        } else {
                            $index = 0;
                            foreach ($order_cursor as $document) {
                                 ?>

						<a class="list-group-item" data-toggle="collapse" data-target="<?php echo "#".$document['_id']; ?>" data-parent="#accordion">
			    		<h4 class="list-group-item-heading accordion-toggle"><?php echo $document['outlet']?>
								<button type="button" class="btn btn-danger btn-space pull-right" id="<?php echo $index; ?>" onclick="deleteOutlet(this);"><span class="glyphicon glyphicon-remove"></span> </button>
								<button type="button" name="edit_modal" class="btn btn-default btn-space pull-right" data-toggle="modal" data-target="#outletEditModal" onclick="putContents(this); " id="<?php echo $index; ?>" ><span class="glyphicon glyphicon-pencil"></span> </button>
							</h4>
              <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
                    40%
                </div>
                </div>
			    		<p class="list-group-item-text"><?php echo $document['outlet_addr']?></p>
		  			</a>
						<div id="<?php echo $document['_id']; ?>" class="sublinks collapse">
					   <a class="list-group-item"><?php echo "Supervisor's Name: ".$document["supervisor_name"] ?></a>
					   <a class="list-group-item"><?php echo "Supervisor's EmailID: ".$document["supervisor_email"] ?></a>
						 <a class="list-group-item"><?php echo "Supervisor's PhoneNo: ".$document["supervisor_phone"] ?></a>
					  </div>

					<?php
                    $index++;
                            }
                        }
                    }?>



				</div>
			</div>

</div>

</div>


<?php include("footer.php"); ?>
