<?php
include("header.php");
?>

<?php



try {
    $m = new MongoDB\Client;
    $collection = $m->selectCollection("pizza", "orders");
    $orders_cursor = $collection->find(["user_id" => new MongoDB\BSON\ObjectID($_SESSION["logged"]["_id"])])->toArray();

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
                        foreach (array_reverse($orders_cursor) as $document) {

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
            <div id="<?php echo $document["_id"]->getTimeStamp(); ?>" class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
            <span id="current-progress"></span>
            </div>
            <script>
              setTimeout(function() {update_bar("<?php echo $document["_id"]->getTimeStamp(); ?>", "<?php echo $document["orderStatus"]; ?>") }, 1000);
            </script>
          </div>
          <?php if($document["orderStatus"] == 80) { ?>
            <button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#trackMyOrder" data-addr="<?php echo $document["user_address"]["formatted_addr"]; ?>" data-coord="<?php echo json_encode($document["user_address"]["coord"]); ?>" data-id="<?php echo $document["_id"] ?>" name="add_modal"><span class="glyphicon glyphicon-road"></span>Track Order</button>
          <?php } ?>
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

<div id="trackMyOrder" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal_heading">Live Directions</h4>

      </div>
      <div class="modal-body">

        <input type="hidden" id="user_coord">
        <div class="pull-right">
        <button class="btn btn-warning" onclick="start_delivery('refresh', this);"><span class="glyphicon glyphicon-recycle"></span>Refresh</button>
         <div class="loader" style="display: none;"></div>
       </div>
        <div class="input-group col-md-8">
          <label>Customer Address:</label><input style="width: 100%; border: none;" id="user_address" readonly/>
          <label>Distance:</label><input style="width: 100%; border: none;" id="distance" readonly/>
          <label>Duration:</label><input style="width: 100%; border: none;" id="duration" readonly/>

        </div>

        <div id="map" style="height: 300px;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">



function update_bar(elm, updated_progress) {
console.log(elm);
console.log(updated_progress);
var current_progress = 0;

var interval = setInterval(function() {
  current_progress += 20;
  $("#" + elm)
  .css("width", current_progress + "%")
  .attr("aria-valuenow", current_progress)
  .text(current_progress + "% Complete");
  if(current_progress == 20)
  {
    $("#" + elm)
  .css("width", current_progress + "%")
  .attr("aria-valuenow", current_progress)
  .text("Order Placed");
  }
  else if(current_progress == 40)
  {
    $("#" + elm)
  .css("width", current_progress + "%")
  .attr("aria-valuenow", current_progress)
  .text("Getting Ready");
  }
  else if(current_progress == 60)
  {
    $("#" + elm)
  .css("width", current_progress + "%")
  .attr("aria-valuenow", current_progress)
  .text("Prepared");
  }
  else if(current_progress == 80)
  {
    $("#" + elm)
  .css("width", current_progress + "%")
  .attr("aria-valuenow", current_progress)
  .text("On The Way");
  }
  else if(current_progress == 100)
  {
    $("#" + elm)
  .css("width", current_progress + "%")
  .attr("aria-valuenow", current_progress)
  .text("Delivered");
  }
  if (current_progress >= updated_progress)
      clearInterval(interval);
}, 1000);
}
</script>


<script>
    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.
    var map, order_location, delivery_marker, customer_marker;
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -34.397, lng: 150.644},
        zoom: 6
      });

      console.log("here");

      // Try HTML5 geolocation.
    }

    function updatePosition(orderID, callback) {
      console.log("updating position");

            $.ajax({
                data: {order: orderID},
                url: 'get_location.php',
                beforeSend : function()    {
                  console.log("getting location from server");
                },
                success: function(result) {

                  order_location = JSON.parse(result);
                  console.log(order_location);
                  order_location = {lat: parseFloat(order_location["lat"]), lng: parseFloat(order_location["lng"]) };
                  console.log(order_location);
                  if (delivery_marker) {
                    console.log("! " + delivery_marker.icon);
                    delivery_marker.setPosition(order_location);
                  } else {
                    delivery_marker = new google.maps.Marker({
                            position: order_location,
                            map: map,
                            icon: "./delivery.png",
                            title: "Pizza's here"
                        });
                  }
                  if (callback) {
                    callback();
                  }
                }

            });

        setTimeout(function() { updatePosition(orderID); }, 10000);
    }


    $('#trackMyOrder').on('shown.bs.modal', function(e){
      var user_coord = JSON.parse($(e.relatedTarget).attr('data-coord'));
      $("#user_coord").val(user_coord);
      var user_addr = $(e.relatedTarget).attr('data-addr');
      $("#user_address").val(user_addr);
      var data_id = $(e.relatedTarget).attr('data-id');



      console.log(user_addr);
      console.log(user_coord);
      initMap();
      updatePosition(data_id, function() {
        start_delivery(user_coord);
      });


    });


    function start_delivery(user_coord, elm) {

      if(elm) {
        $(elm).hide();
        var loader = $(elm).next();
        loader.show();
      }
      if(user_coord == "refresh") {
        console.log("in refresh");
        user_coord = JSON.parse($("#user_coord").val());
      }


      var user_LatLng = {lat: user_coord[1], lng: user_coord[0]};
      console.log(user_coord + "!");

      console.log(user_LatLng);
      if (!customer_marker) {
        customer_marker = new google.maps.Marker({
                position: user_LatLng,
                map: map,
                icon: "./customer.png",
                title: "Customer's here"
            });
      }

      //console.log(myLatLng);
      if (!(user_coord == "none")) {


        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        directionsDisplay.setMap(map);

        calculateAndDisplayRoute(directionsService, directionsDisplay);

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            directionsService.route({
              origin: order_location,
              destination: user_LatLng,
              travelMode: 'DRIVING'
            }, function(response, status) {
              if (status === 'OK') {
                new google.maps.DirectionsRenderer({
                    map: map,
                    directions: response,
                    suppressMarkers: true
                });
                var leg = response.routes[0].legs[0];
                var distance = leg.distance;
                var duration = leg.duration;
                $("#distance").val(distance.text);
                $("#duration").val(duration.text);
                console.log(delivery_marker.icon);
                console.log(customer_marker.icon);
                delivery_marker.setPosition(leg.start_location);
                customer_marker.setPosition(leg.end_location);
                
                if (loader) {
                  loader.hide();
                  $(elm).fadeIn();
                }
              } else {
                window.alert('Directions request failed due to ' + status);
              }
            });
          }

      }


    }



  </script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2nLH2Yr5OH-QJ8WxG5f-AZFmTLqtkC0I&callback=initMap">
</script>




<?php include('modals.php'); ?>
<?php include("footer.php"); ?>
