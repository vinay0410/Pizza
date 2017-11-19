<?php include("header.php"); ?>

<?php
try {
    $m = new MongoDB\Client;
    $collection = $m->selectCollection("pizza", "orders");
    $orders_cursor = $collection->find(["outlet_id" => $_SESSION["logged"]["ofOutlet"], "orderStatus" => 60 ])->toArray();

    $order_count = count($orders_cursor);

} catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
    //die("Caught Exception failed to Connect".$e->getMessage()."\n");
    $error_order_msg = "Couldn't Connect to Database, Please try again";
} catch (Exception $e) {
    $error_order_msg  = $e->getMessage();
}


?>

<div class="container pb-modalreglog-container">

    <!--<div id="map" class="col-md-6" style="height: 400px;"></div>-->

    <div class="panel panel-default">
          <div class="panel-heading"><h3>Ready Orders</h3>
        </div>
        <div class="panel-body">
          <div class="list-group" id="readyOrders">
              <?php

              if (count($orders_cursor) == 0) {
                ?>
                <p class="empty_msg">Oops!, Orders aren't ready yet</p>

              <?php
              } else {
              foreach (array_reverse($orders_cursor) as $document) {

                 ?>
                 <a class="list-group-item">
                <h4 class="list-group-item-heading accordion-toggle"><?php echo $document["user_address"]["place_name"]; ?>
                  <button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#startTrack" name="add_modal"><span class="glyphicon glyphicon-road"></span>Start Delivery</button>
                </h4>
                <p class="list-group-item-text"><?php echo $document["user_address"]["formatted_addr"]; ?></p>
                <p class="list-group-item-text">$<strong><?php echo $document["cart_contents"]["totalPrice"]; ?></strong></p>
              </a>
              <?php
                }
              } ?>
          </div>
        </div>
      </div>






</div>

<div id="startTrack" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal_heading">Live Directions</h4>

      </div>
      <div class="modal-body">
        <div id="map" style="height: 300px;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>


<script>
    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.
    var map, infoWindow;
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -34.397, lng: 150.644},
        zoom: 6
      });


      // Try HTML5 geolocation.
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          var marker = new google.maps.Marker({
              position: pos,
              map: map,
              title: "You're here"
            });

          map.setCenter(pos);
        }, function() {
          alert("Geolocation Service Failed");
        });
      } else {
        // Browser doesn't support Geolocation
        alert("Browser, doesn't support Geolocation");
      }
    }


  </script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2nLH2Yr5OH-QJ8WxG5f-AZFmTLqtkC0I&callback=initMap">
</script>

<?php include("modals.php"); ?>
<?php include("footer.php"); ?>
