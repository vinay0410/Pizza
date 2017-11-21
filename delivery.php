<?php include("header.php"); ?>
<style>
.loader {
    border: 5px solid #f3f3f3; /* Light grey */
    border-top: 5px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>



<?php
try {
    $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
    $collection = $m->selectCollection("pizza", "orders");
    $orders_cursor = $collection->find(["outlet_id" => $_SESSION["logged"]["ofOutlet"], "orderStatus" => ['$in' => [60, 80] ]])->toArray();

    $order_count = count($orders_cursor);

} catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
    //die("Caught Exception failed to Connect".$e->getMessage()."\n");
    $error_order_msg = "Couldn't Connect to Database, Please try again";
} catch (Exception $e) {
    $error_order_msg  = $e->getMessage();
}


?>
<link href="assets/css/material-bootstrap-wizard.css" rel="stylesheet">
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
                  <button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#startTrack" data-addr="<?php echo $document["user_address"]["formatted_addr"]; ?>" data-coord="<?php echo json_encode($document["user_address"]["coord"]); ?>" data-id="<?php echo $document["_id"] ?>" name="add_modal"><span class="glyphicon glyphicon-road"></span>Start Delivery</button>
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


<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>


<script>
    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.
    var map, current_location, delivery_marker, customer_marker;
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
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          current_location = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          console.log(current_location);
          if (callback) {
            callback();
        }
        if (delivery_marker) {
          delivery_marker.setPosition(current_location);
        } else {
          delivery_marker = new google.maps.Marker({
                  position: current_location,
                  map: map,
                  icon: "./delivery.png",
                  title: "You're here"
              });
        }

            $.ajax({
                data: {location:  current_location, order: orderID},
                type: "POST",
                url: 'update_delivery.php',
                beforeSend : function()    {
                  console.log("sending location to server");
                },
                success: function(result) {
                    console.log(result);
                }

            });


        }, function() {
          alert("Geolocation Service Failed");
        });
      } else {
        // Browser doesn't support Geolocation
        alert("Browser, doesn't support Geolocation");
      }


        setTimeout(function() { updatePosition(orderID); }, 10000);
    }


    $('#startTrack').on('shown.bs.modal', function(e){
    var user_coord = $(e.relatedTarget).attr('data-coord');
    $("#user_coord").val(user_coord);
    var user_addr = $(e.relatedTarget).attr('data-addr');
    $("#user_address").val(user_addr);
    var data_id = $(e.relatedTarget).attr('data-id');
    var status = $("<p class='status'>Updating Order Status to On the Way</p>");

    if(!$('#startTrack').find("#modal_heading .status").length == 1) {
      $('#startTrack').find("#modal_heading").append(status);

    $.ajax({
        data: {ontheway: true, order: data_id},
        url: 'update_delivery.php',
        success: function(result) {
            $(status).html("Order is on the Way now!");
        }

    });
  }


    console.log(user_addr);
    console.log(user_coord);
    initMap();
    updatePosition(data_id, function() {
      start_delivery(JSON.parse(user_coord));
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
              origin: current_location,
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
                delivery_marker.setPosition(leg.start_location);
                customer_marker.setPosition(leg.end_location);
                if(customer_marker) {

                }
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

<?php include("modals.php"); ?>
<?php include("footer.php"); ?>
