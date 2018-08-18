<?php
  session_start();
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <head>
  <meta charset="utf-8" />

  <title>Checkout</title>


    <link href="card/card.css" rel="stylesheet" type="text/css">
  <link rel="icon" type="image/png" href="assets/img/favicon.png" />
  <!--     Fonts and icons     -->

  <link rel="stylesheet" href="css/font-awesome.min.css" />

  <!-- CSS Files -->
  <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/material-bootstrap-wizard.css" rel="stylesheet">
  <style type="text/css">
  .form-group label{
    color: black;
  }
  .panel-default{
    border-color: #fff;
  }
  .image-container:before {
background: #fff;
  }

.btn-circle.btn-xl {
  width: 70px;
  height: 70px;
  padding: 10px 16px;
  font-size: 24px;
  line-height: 1.33;
  border-radius: 35px;
  margin: 15px 0px 0px 15px;
}


</style>
</head>

<body>

<?php

  $cart = json_decode($_SESSION["storecart"], true);


 ?>

<div class="image-container set-full-height" >
  <button type="button" onclick="window.location.href='.'" class="btn btn-warning btn-circle btn-xl"><i class="glyphicon glyphicon-home"></i></button>
      <!--   Big container   -->
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
                <!--      Wizard container        -->
        <div class="wizard-container" id="rootwizard">
          <div class="card wizard-card" data-color="orange" id="wizard">

                  <div class="wizard-header"></div>
                  <div class="wizard-navigation">
                        <ul>
                        <li><a href="#delivery" data-toggle="tab">Delivery</a></li>
                        <li><a id="outlet_link" href="#outlet" data-toggle="tab">Outlet</a></li>
                        <li><a href="#confirmation" data-toggle="tab">Confirmation</a></li>
                        <li><a href="#payment" data-toggle="tab">Payment</a></li>
                        </ul>
                  </div>

                  <div class="tab-content">
                    <div class="tab-pane" id="delivery">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="panel panel-default">
                              <div class="panel-heading"><h3>Addresses
                                <button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#addAddressModal" name="add_modal"><span class="glyphicon glyphicon-plus"></span>Add Address</button>
                              </h3></div>
                              <div class="panel-body">
                                <div class="list-group" id="user_addrs">

                                  <?php


                                      if (empty($_SESSION["logged"]["address"]) OR !isset($_SESSION["logged"]["address"])) {
                                        echo "<p class='empty_msg'>No addresses present, add address to continue!</p>";
                                      } else {
                                        $addrs = $_SESSION["logged"]["address"];
                                        $index = 1;
                                      foreach (array_reverse($addrs) as $entry) {  ?>

                                        <a class="list-group-item">
                            			    		<h4 class="list-group-item-heading accordion-toggle"><?php echo $entry["initial"]; ?>
                                            <input type="radio" class="pull-right" data-addr='<?php echo json_encode($entry) ?>' value="<?php echo json_encode($entry['coord']); ?>" name="addr" <?php if($index == 1) {echo 'checked="checked"'; } ?>>
                                            <button type="button" class="btn btn-danger btn-space pull-right" id="<?php echo $entry['place_id'] ?>" onclick="delete_addr(this);"><span class="glyphicon glyphicon-remove"></span> </button>
                            								<button type="button" name="edit_modal" class="btn btn-default btn-space pull-right" data-toggle="modal" data-target="#editAddressModal" onclick="putContents(this);" ><span class="glyphicon glyphicon-pencil"></span></button>
                                          </h4>
                                          <p class="list-group-item-text"><?php echo $entry['place_name']; ?></p>
                            			    		<p class="list-group-item-text"><?php echo $entry['formatted_addr']; ?></p>

                                        </a>


                                  <?php
                                    $index++;
                                    }
                                  }
                                   ?>



                               </div>
                                </div>





                              </div>




                          </div>




                        </div><!--ending row-->
                        <div class="wizard-footer">
                                <div class="pull-right">
                                      <input type='button' class='btn btn-next btn-fill btn-warning btn-wd' name='next' value='Next' />
                                      <input type='button' class='btn btn-finish btn-fill btn-warning btn-wd' name='finish' value='Finish' />
                                  </div>


                                  <div class="clearfix"></div>
                        </div>
                        <div class="col-sm-3"></div>
                    </div><!--tab-pane id: delivery-->

                    <div class="tab-pane" id="outlet">
                        <div class="row">
                          <div class="col-sm-12">
                          <h4 class="info-text">Nearest Outlet</h4>
                          </div>


                          <div class="col-sm-3 col-sm-offset-1" style="white-space:nowrap">
                            <label>Distance:</label><input style="width: 100%; border: none;" id="distance" readonly>
                            <label>Duration:</label><input style="width: 100%; border: none;" id="duration" readonly>
                          </div>

                          <div class="col-sm-10 col-sm-offset-1" id="outlet_map_parent">
                            <div id="outlet_map" style="width: 100%; height: 300px;"></div>



                          </div><!--ending col-sm-6 -->
                        </div><!--ending row-->
                        <div class="wizard-footer">
                                <div class="pull-right">
                                      <input type='button' class='btn btn-next btn-fill btn-warning btn-wd' name='next' value='Next' />
                                      <input type='button' class='btn btn-finish btn-fill btn-warning btn-wd' name='finish' value='Finish' />
                                  </div>
                                  <div class="pull-left">
                                      <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />

                                  </div>
                                  <div class="clearfix"></div>
                            </div>
                        <div class="col-sm-3"></div>
                    </div><!--tab-pane id: delivery-->


                    <div class="tab-pane" id="confirmation">
                      <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                        <!--starting receipt -->

                          <div class="row">

                            <div class="col-xs-6 col-sm-6 col-md-6">
                              <p><strong>Name: </strong><?php echo $_SESSION["logged"]["fname"]; ?></p>
                              <br>
                              <p id="display_address"></p>
                              <br>

                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                              <p id="date"><em>Date: </em></p>
                              <p id="time"><em>Time: </em></p>

                            </div>
                          </div>
                          <div class="row">
                            <div class="text-center">
                              <h1>Your Orders</h1>
                            </div>
                          <table class="table table-hover">
                            <thead>
                            <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>

                      <?php foreach($cart["products"] as $product) { ?>
                        <tr>
                            <td class="col-md-9"><em><?php echo $product["name"]; ?></em></h4></td>
                            <td class="col-md-1" style="text-align: center"><?php echo $product["quantity"]; ?></td>
                            <td class="col-md-1 text-center">$<?php echo $product["price"]; ?></td>
                            <td class="col-md-1 text-center">$<?php echo (int)$product["price"]*(int)$product["quantity"]; ?></td>
                        </tr>
                      <?php } ?>
                        <tr>
                            <td> &nbsp; </td>
                            <td> &nbsp; </td>
                            <td class="text-right"><h4><strong>Total:&nbsp;</strong></h4></td>
                            <td class="text-center text-warning"><h4><strong>$<?php echo $cart["totalPrice"]; ?></strong></h4></td>
                        </tr>
                    </tbody>
                </table>
               <!--  <button type="button" class="btn btn-warning nextBtn btn-lg pull-right">
                    Pay Now&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
                </button> --></td>
            </div>

<!-- ending receipt -->

                                        </div>
                                    </div>
<div class="wizard-footer">
                                <div class="pull-right">
                                      <input type='button' class='btn btn-next btn-fill btn-warning btn-wd' name='next' value='Confirm' />
                                      <input type='button' class='btn btn-finish btn-fill btn-warning btn-wd' name='finish' value='Finish' />
                                  </div>
                                  <div class="pull-left">
                                      <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />

                                  </div>
                                  <div class="clearfix"></div>
                            </div>


                                </div>
                                <div class="tab-pane" id="payment">
                                    <div class="row">

                                       <!-- -->
          <!-- CREDIT CARD FORM STARTS HERE -->
<div class="col-xs-10 col-md-offset-1">
        <div class="col-md-12">
           <div class="panel panel-default credit-card-box">
  <div class="demo-container">

        <div class="card-wrapper"></div>

        <div class="form-container active">

           <form method="post" action="order_redirect.php" onsubmit="return payment_order(this);">
             <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION["logged"]["_id"]; ?>" >
             <input type="hidden" id="user_address" name="user_address">
              <input type="hidden" id="outlet_id" name="outlet_id">
              <input type="hidden" id="cart_contents" name="cart_contents" value='<?php echo json_encode($cart); ?>' >
             <input type="hidden" >
              <div class="row">
                <div class="col-xs-6">
                  <div class="form-group">
                  <label for="cardNumber">CARD NUMBER</label>
                    <div class="input-group">
                       <input type="tel" class="form-control" name="number" placeholder=" Valid Card Number" autocomplete="cc-number" pattern='[0-9]{16}' title="Please enter a Valid Card Number" required>

                    </div>
                  </div>
                </div>
                <!-- -->
                <div class="col-xs-6 col-md-6">
                <div class="form-group">
                  <label for="cardName">NAME</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder=" Enter your full name" name="name"  required="required" autofocus />

                  </div>
                </div>
              </div>
                <!-- -->
            </div>



    <div class="row">
          <div class="col-xs-6 col-md-6">
            <div class="form-group">
              <label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
              <input type="tel" class="form-control" name="expiry"
                placeholder=" MM / YY" autocomplete="cc-exp" required />
            </div>
          </div>
          <div class="col-xs-6 col-md-6">
            <div class="form-group">
              <label for="cardCVC">CV CODE</label>
              <input type="tel" class="form-control" name="cvc" placeholder=" CVC" autocomplete="cc-csc" required />
            </div>
          </div>
    </div>
    <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="couponCode">COUPON CODE</label>
              <input type="text" class="form-control" name="couponCode" />
            </div>
          </div>
    </div>





</div></div>

</div>
</div>

<!-- CREDIT CARD FORM ENDS HERE -->
 <!-- -->

                            <!-- -->
          <!-- -->
                                    </div>
                                </div>
                                <div class="wizard-footer">
                                <div class="pull-right">
                                      <input type='button' class='btn btn-next btn-fill btn-warning btn-wd' name='next' value='Next' />
                                      <input type='submit' class='btn btn-finish btn-fill btn-warning btn-wd' name='finish' value='Payment' />
                                  </div>
                                  <div class="pull-left">
                                      <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />

                                  </div>
                                  <div class="clearfix"></div>
                            </div>
                            </div>

</form>
                    </div>
                </div> <!-- wizard container -->
            </div>
        </div> <!-- row -->
    </div> <!--  big container -->


  </div>

  <div id="addAddressModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="modal_heading">Add Address</h4>

        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="post" id="addAddress">
  					<input type="hidden" id="dummy">
  				  <div class="form-group">
  				    <label class="control-label col-sm-2" for="outlet">Address Nickname: </label>
  				    <div class="col-sm-5">
  				      <input type="text" class="form-control" name="addr_name" id="addr_name" placeholder="Address Nickname" required>
  				    </div>
  				  </div>
  				  <div class="form-group">
  				    <label class="control-label col-sm-2" for="outlet-addr">Address: </label>
  				    <div class="col-sm-5">
                <textarea class="form-control" name="full_address" id="full_address" placeholder="Full Address" rows="2" required></textarea>
  				    </div>
  				  </div>
  				  <div class="form-group">
  				    <label class="control-label col-sm-2" for="supervisor-name">Map: </label>
  				    <div class="col-sm-5">
                <input id="add_addr" type="button" class="btn btn-default" value="See on Map & Drag">
                <div>
                  <label for="lat" class="control-label col-sm-2"> Lat: </label>
                  <input name="lat" type="text" id="lat-add" class="form-control" readonly="readonly">
                  <label for="long" class="control-label col-sm-2"> Long: </label>
                  <input name="long" type="text" id="long-add" class="form-control" readonly="readonly">
                </div>
                <input name="place_id" type="text" id="place_id"  readonly="readonly">
                <input name="place_name" type="text" id="place_name"  readonly="readonly">
                <input name="formatted_addr" type="text" id="formatted_addr"  readonly="readonly">
                <div id="addr_map" style="width: 400px; height: 400px;"></div>
  				    </div>
  				  </div>


  				  <div class="form-group">
  				    <div class="col-sm-offset-2 col-sm-10">
  				      <button type="submit" class="btn btn-warning" id="modal_submit">Add</button>
                <input type="reset" class="btn btn-default" value="Reset">
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



  <div id="editAddressModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="modal_heading">Edit Address</h4>

        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="post" id="editAddress">
            <input type="hidden" id="dummy" name="dummy">
            <div class="form-group">
              <label class="control-label col-sm-2" for="outlet">Address Nickname: </label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="addr_name" id="addr_name" placeholder="Address Nickname" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="outlet-addr">Address: </label>
              <div class="col-sm-5">
                <textarea class="form-control" name="edit_full_address" id="edit_full_address" placeholder="Full Address" rows="2" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="supervisor-name">Map: </label>
              <div class="col-sm-5">
                <input id="edit_addr" type="button" class="btn btn-default" value="See on Map & Drag">
                <div>
                  <label for="lat" class="control-label col-sm-2"> Lat: </label>
                  <input name="lat" type="text" id="lat-edit" class="form-control" readonly="readonly">
                  <label for="long" class="control-label col-sm-2"> Long: </label>
                  <input name="long" type="text" id="long-edit" class="form-control" readonly="readonly">
                </div>
                <input name="place_id" type="text" id="place_id_edit"  readonly="readonly">
                <input name="place_name" type="text" id="place_name_edit"  readonly="readonly">
                <input name="formatted_addr" type="text" id="formatted_addr_edit"  readonly="readonly">
                <div id="edit_addr_map" style="width: 400px; height: 400px;"></div>
              </div>
            </div>


            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-warning" id="modal_submit">Update</button>
                <input type="reset" class="btn btn-default" value="Reset">
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
  <!--   Core JS Files   -->
  <script src="js/jquery-2.2.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/js/jquery.bootstrap.js" type="text/javascript"></script>

  <!--  Plugin for the Wizard -->
  <script src="assets/js/material-bootstrap-wizard.js"></script>
  <script src="assets/js/jquery.validate.min.js"></script>

  <script>
  var currentTime = new Date();

  var currentOffset = currentTime.getTimezoneOffset();
  var monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
  ];
  var ISTOffset = 330;   // IST offset UTC +5:30

  var ISTTime = new Date(currentTime.getTime() + (ISTOffset + currentOffset)*60000);


  var date_string = ISTTime.getDate() + ", " + monthNames[ISTTime.getMonth()] + " " + ISTTime.getFullYear();
  var hours = ISTTime.getHours() > 12 ? ISTTime.getHours() - 12 : ISTTime.getHours();
  var am_pm = ISTTime.getHours() >= 12 ? "PM" : "AM";
  var minutes = ISTTime.getMinutes() < 10 ? "0" + ISTTime.getMinutes() : ISTTime.getMinutes();
  hours = hours < 10 ? "0" + hours : hours;

  var time_string = hours + ":" + minutes + " " + am_pm;

  $("#date").find("em").append(date_string);
  $("#time").find("em").append(time_string);

  </script>

<script type="text/javascript">

function payment_order(param) {
  $("#user_address").val($("input[name='addr']:checked").attr('data-addr'));
  $("#outlet_id").val($(".outlet_search_result").find("input[name='outlet_coordinates']").attr('data-addr'));
  console.log("payment");
  return true;
}





$(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-warning').addClass('btn-default');
          $item.addClass('btn-warning');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      if (isValid)
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-warning').trigger('click');
});
</script>
<script src="card/jquery.card.js"></script>


    <script>
      $('form').card({
    // a selector or DOM element for the container
    // where you want the card to appear
    container: '.card-wrapper', // *required*

});


$(document).ready(function(){
  $(this).scrollTop(0);
});
    </script>

<script>

function initMap_outlet(user_coord, outlet_coord) {
  console.log(outlet_coord);
  var map = new google.maps.Map(document.getElementById('outlet_map'), {
    zoom: 3,
    center: {lat: 36.6139, lng: 60.2090}
  });
  var user_LatLng = {lat: user_coord[1], lng: user_coord[0]};
  var outlet_LatLng = {lat: outlet_coord[1], lng: outlet_coord[0]};
  //console.log(myLatLng);
  if (!(user_coord == "none")) {


    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    directionsDisplay.setMap(map);

    calculateAndDisplayRoute(directionsService, directionsDisplay);

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        directionsService.route({
          origin: user_LatLng,
          destination: outlet_LatLng,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            var leg = response.routes[0].legs[0];
            var distance = leg.distance;
            var duration = leg.duration;
            $("#distance").val(distance.text);
            $("#duration").val(duration.text);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }

  }


}

function initMap_delivery() {
  console.log("delivery");
  var map1 = new google.maps.Map(document.getElementById('addr_map'), {
    zoom: 3,
    center: {lat: 36.6139, lng: 60.2090}
  });

  var map2 = new google.maps.Map(document.getElementById('edit_addr_map'), {
    zoom: 3,
    center: {lat: 36.6139, lng: 60.2090}
  });

  var geocoder = new google.maps.Geocoder();

  document.getElementById('add_addr').addEventListener('click', function() {
     geocodeAddress(geocoder, map1, "add");
   });

   document.getElementById('edit_addr').addEventListener('click', function() {
     geocodeAddress(geocoder, map2, "edit");
   });

}


$('#addAddressModal').on('shown.bs.modal', function(){
  console.log("deliver");
initMap_delivery();
});

$('#editAddressModal').on('shown.bs.modal', function(){
  console.log("deliveredit");
initMap_delivery();
});





var modal;




function geocodeAddress(geocoder, resultsMap, modal_type) {
  var marker;
  var addr;


  var add_address = document.getElementById('full_address').value;
  var edit_address = document.getElementById('edit_full_address').value;
  if (modal_type == "add") {
    addr = add_address;
    modal = "add_modal";
  } else {
    addr = edit_address;
    modal = "edit_modal";
  }
  geocoder.geocode({'address': addr}, function(results, status) {
    if (status === 'OK') {
      resultsMap.setCenter(results[0].geometry.location);
        marker = new google.maps.Marker({
        map: resultsMap,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: results[0].geometry.location,
        title: "Drag Me!"
      });

      marker.addListener('click', toggleBounce);
      google.maps.event.addListener(marker, 'dragend', fill_coord);
      var mouseEvent1 = {
        stop: null,
        latLng: results[0].geometry.location
      }
      google.maps.event.trigger(marker, 'dragend', mouseEvent1);
      if (results[0].geometry.viewport)
          resultsMap.fitBounds(results[0].geometry.viewport);


          var service = new google.maps.places.PlacesService(resultsMap);

                  service.getDetails({
                    placeId: results[0].place_id
                  }, function(place, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                      if (modal_type == 'add') {
                      document.getElementById("place_name").value = place.name;
                     document.getElementById("formatted_addr").value = place.formatted_address;
                     document.getElementById("place_id").value = place.id;
                     console.log(place);
                   } else {
                     document.getElementById("place_name_edit").value = place.name;
                    document.getElementById("formatted_addr_edit").value = place.formatted_address;
                    document.getElementById("place_id_edit").value = place.id;
                    console.log(place);
                   }
                    }
                  });

    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }

  });
  function toggleBounce() {
    if (marker.getAnimation() !== null) {
      marker.setAnimation(null);
    } else {
      marker.setAnimation(google.maps.Animation.BOUNCE);
    }
  }

}

function fill_coord(event) {
      console.log(event);

      if (modal == "add_modal") {
      document.getElementById("lat-add").value = event.latLng.lat();
     document.getElementById("long-add").value = event.latLng.lng();
   } else {
     console.log("here");
     document.getElementById("lat-edit").value = event.latLng.lat();
    document.getElementById("long-edit").value = event.latLng.lng();
  }

 }

var edit_address_div;

 function putContents(param) {

   var addr = JSON.parse($(param).parent().find("input[name=addr]").attr('data-addr'));
   console.log(addr);
   $("#editAddressModal input[name=addr_name]").val(addr["initial"]);
   $("#editAddressModal #edit_full_address").html(addr["full_address"]);
   edit_address_div = $(param).parent().parent();
 }


 function delete_addr(el) {


     var place_id = el.id;
     console.log(place_id);
     var div = $(el).parent().parent();
     var copy_div = div.clone();

     var progress_bar = $("<div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'></div></div>");

       $.ajax({
         url: "delete_addr.php", // Url to which the request is send
         type: "POST",             // Type of request to be send, called as method
         data: {place_id :place_id},
         beforeSend: function() {
           $(div).html(progress_bar);
         },
         success: function(data) {
           try {
           var value = JSON.parse(data);
           $(copy_div).prepend("<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + value.msg + "</div>");
           console.log(copy_div);
           $(div).html(copy_div.children());
         } catch (e) {

           $(div).html(data).fadeIn("slow");
           $("#user_addrs").find(".list-group-item").each(function() {
             if($(this).children().length == 3) {
               $(this).find("input[name=addr]").click();
             }
           });
           setTimeout(function(){
             $(div).slideUp("slow");
             setTimeout(function() {
               $(div).remove();

               if ($("#user_addrs").find(".list-group-item").length == 0) {

                 $("#user_addrs").prepend("<p class='empty_msg'>No addresses present, add address to continue!</p>").slideDown('slow');
               }

             }, 1000);
           }, 4000);


          }
         }
     });
   }


   $(document).ready(function() {
     $("#editAddress").on("submit", function(e) {
       e.preventDefault();
       console.log($(this).find("#place_name_edit").val());
       if (!$(this).find("#place_name_edit").val()) {
         alert("Please Verify your location on Map first");
       } else {
       var dummy = edit_address_div;
       var orig_place_id = JSON.parse($(dummy).find("input[name=addr]").attr("data-addr"))["place_id"];
       var copy_dummy = dummy.clone();
       console.log(dummy);
       var formData = new FormData(this);
       formData.append("orig_place_id", orig_place_id);
       console.log(formData);
       $("#editAddressModal").modal('toggle');
       //e.stopPropagation();
       var progress_bar = $("<div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'></div></div>");
       $.ajax({
         url: "edit_addr.php", // Url to which the request is send
         type: "POST",             // Type of request to be send, called as method
         data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
         contentType: false,       // The content type used when sending data to the server.
         cache: false,             // To unable request pages to be cached
         processData:false,
         beforeSend : function()    {
            $(dummy).html(progress_bar);



         },
         success: function(data) {
           try {
           var value = JSON.parse(data);
           $(copy_dummy).prepend("<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + value.msg + "</div>");

           $(dummy).html(copy_dummy.children());
           //$(new_div).remove();
         } catch (e) {
           $("#editAddress")[0].reset();
           console.log(data);

           $(dummy).html(data).fadeIn("slow");

           }

         }
     });
  }
   });
   });




 $(document).ready(function() {
   $("#addAddress").on("submit", function(e) {
     e.preventDefault();
     console.log($(this).find("#place_name").val());
     if (!$(this).find("#place_name").val()) {
       alert("Please Verify your location on Map first");
     } else {


     $("#addAddressModal").modal('toggle');
     //e.stopPropagation();
     var new_div = $("<a class='list-group-item new'><div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'></div></div></a>");
     $.ajax({
       url: "add_addr.php", // Url to which the request is send
       type: "POST",             // Type of request to be send, called as method
       data: $(this).serialize(), // Form data Data sent to server, a set of key/value pairs (i.e. form fields and values)
       contentType: false,       // The content type used when sending data to the server.
       cache: false,             // To unable request pages to be cached
       processData:false,
       beforeSend : function()    {
         console.log($('.menu').children().eq(1));


          $("#user_addrs").find(".empty_msg").remove();
           $('#user_addrs').prepend(new_div);


       },
       success: function(data) {
         try {
         var value = JSON.parse(data);
         $(new_div).html("<div class='alert alert-danger fade in'>" + value.msg + "</div>");
         setTimeout(function(){
           $(new_div).slideUp("slow");

         }, 4000);
         //$(new_div).remove();
       } catch (e) {
         $("#addAddress")[0].reset();
         console.log(data);

         $(new_div).html(data).fadeIn("slow");
         $(new_div).removeClass("new");
         }

       }
   });
}
 });
 });


</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3lEgGvL9pua9l3Rp-ocHzLn4KyYeCMT8&libraries=places&callback=initMap_delivery">
</script>

</body>
</html>
