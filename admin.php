<!DOCTYPE html>
<html>
<head>


	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="css/font-awesome.min.css">

	<link rel="stylesheet" href="css/templatemo-style.css">
	<!-- google font -->
	<link href='//fonts.googleapis.com/css?family=Signika:400,300,600,700' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Chewy' rel='stylesheet' type='text/css'>

	<script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: -34.397, lng: 150.644}
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });

				$("#myModal").on("shown.bs.modal", function(e) {
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
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }


			$('#outletModal').on('shown.bs.modal', function(){
    initMap();
    });
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2nLH2Yr5OH-QJ8WxG5f-AZFmTLqtkC0I&callback=initMap">
    </script>

</head>
<body>

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#outletModal">Add Outlet</button>
<div id="outletModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Outlet</h4>
      </div>
      <div class="modal-body">
				<form class="form-horizontal">
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="outlet">Outlet Name: </label>
				    <div class="col-sm-3">
				      <input type="email" class="form-control" id="outlet" placeholder="Outlet NickName">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="outlet-addr">Outlet Address</label>
				    <div class="col-sm-3">
				      <input type="text" class="form-control" id="outlet-addr" placeholder="Enter Outlet Address">
				      <input id="submit" type="button" class="btn btn-default" value="See on Map">
				      <div id="map" style="width: 400px; height: 400px;"></div>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="supervisor-name">Supervisor Name: </label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" id="supervisor-name" placeholder="Supervisor's name">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="supervisor-email">Supervisor Email: </label>
				    <div class="col-sm-5">
				      <input type="email" class="form-control" id="supervisor-email" placeholder="Supervisor's email">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="supervisor-phone">Supervisor Contact No.: </label>
				    <div class="col-sm-5">
				      <input type="email" class="form-control" id="supervisor-phone" placeholder="Supervisor's phone">
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

</body>
</html>
