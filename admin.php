<?php include("header.php"); ?>


<?php
	if (isset($_POST["outlet"])) {
		$outlet = $_POST["outlet"];
		$outlet_addr = $_POST["outlet-addr"];
		$supervisor_name = $_POST["supervisor-name"];
		$supervisor_email = $_POST["supervisor-email"];
		$supervisor_phone = $_POST["supervisor-phone"];

		   try {

		    $m = new MongoClient("mongodb://admin:EIIGMGVVORZLANRD@sl-eu-lon-2-portal.5.dblayer.com:20539,sl-eu-lon-2-portal.0.dblayer.com:20539/admin?ssl=true");
		    $db = $m->Pizza;
		    $collection = $db->outlets;

		   } catch(Exception $e) {
		     #die("Caught Exception failed to Connect".$e->getMessage()."\n");


		     $error_msg = "Couldn't Connect to Database";

		   }

			 if (empty($error_msg)) {
				 $result = $collection->findOne(array('outlet' => $outlet));
		     #var_dump($result);

		       if (empty($result)) {


						     $document = array(
						         "outlet" => $outlet,
						         "outlet_addr" => $outlet_addr,
						         "supervisor_name" => $supervisor_name,
						         "supervisor_email" => $supervisor_email,
										 "supervisor_phone" => $supervisor_phone
						      );

						      $collection->insert($document);
									

		       } else {

		         $error_msg = "Outlet Already Exists";
		       }


			 }

	}



?>

<div class="container pb-modalreglog-container">


<div class="panel panel-default">
      <div class="panel-heading"><h3>Outlets
				<button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#outletModal"><span class="glyphicon glyphicon-plus"></span>Add Outlet</button>
			</h3>


			</div>
      <div class="panel-body">
				<div class="list-group">
  			<a href="#" class="list-group-item">
	    		<h4 class="list-group-item-heading">Outlet Name</h4>
	    		<p class="list-group-item-text">Details</p>
  			</a>
  			<a href="#" class="list-group-item">
    <h4 class="list-group-item-heading">Outlet Name</h4>
    <p class="list-group-item-text">Outlet Details</p>
  </a>
  <a href="#" class="list-group-item">
    <h4 class="list-group-item-heading">Outlet Name</h4>
    <p class="list-group-item-text">Outlet Details</p>
  </a>
</div>
			</div>
</div>

</div>

<!-- Outlet Modal start -->

<div id="outletModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Outlet</h4>
      </div>
      <div class="modal-body">
				<form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="outlet">Outlet Name: </label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" name="outlet" id="outlet" placeholder="Outlet NickName">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="outlet-addr">Outlet Address</label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="outlet-addr" name="outlet-addr" placeholder="Enter Outlet Address">
				      <input id="map-submit" type="button" class="btn btn-default" value="See on Map">
				      <div id="map" style="width: 400px; height: 400px;"></div>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="supervisor-name">Supervisor Name: </label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" id="supervisor-name" name="sup-name" placeholder="Supervisor's name">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="supervisor-email">Supervisor Email: </label>
				    <div class="col-sm-5">
				      <input type="email" class="form-control" id="supervisor-email" name="sup-email" placeholder="Supervisor's email">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="supervisor-phone">Supervisor Contact No.: </label>
				    <div class="col-sm-5">
				      <input type="email" class="form-control" id="supervisor-phone" name="sup-phone" placeholder="Supervisor's phone">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-default">Submit</button>
				    </div>
				  </div>
				</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Outlet Modal End -->

	<script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 3,
          center: {lat: 36.6139, lng: 60.2090}
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('map-submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });

				$("#outletModal").on("shown.bs.modal", function(e) {
      google.maps.event.trigger(map, "resize");
      return map.setCenter(markerLatLng);
    	});

      }

      function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('outlet-addr').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
						if (results[0].geometry.viewport)
        				resultsMap.fitBounds(results[0].geometry.viewport);
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });

				console.log(results[0].geometry.location);
      }


			$('#outletModal').on('shown.bs.modal', function(){
    initMap();
    });
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2nLH2Yr5OH-QJ8WxG5f-AZFmTLqtkC0I&callback=initMap">
    </script>




<?php include("modals.php"); ?>
<button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#outletModal">Add Outlet</button>
<?php include("footer.php"); ?>
