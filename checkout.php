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
  session_start();
  $cart = json_decode($_SESSION["storecart"], true);
  var_dump($_SESSION["logged"]);

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
              <form action="" method="">
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
                                            <input type="radio" class="pull-right" value="<?php echo json_encode($entry['coord']); ?>" name="addr" <?php if($index == 1) {echo 'checked="checked"'; } ?>>
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

                          <div class="col-sm-3"></div>

                          <div class="col-sm-10 col-sm-offset-1" id="outlet_map_parent">
                            <div id="outlet_map" style="width: 100%; height: 300px;"></div>
                            <!--<div class="form-group label-floating">


                              <label class="control-label">Closest Outlet</label>

                              <select class="form-control" id="outlet_id">
                                <option disabled="" selected=""></option>
                                <option value="OL1">Outlet 2 </option>
                                <option value="OL2"> Outlet 1 </option>
                              </select>
                            </div>-->


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
                              <strong>Name</strong><p><?php echo $_SESSION["logged"]["username"]; ?></p>
                              <br>
                              <strong>Address</strong>
                              <br>
                              <strong>Phone</strong>
                              <br>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                              <p><em>Date: 25 October, 2017</em></p>
                              <p><em>Receipt #: 34522677W</em></p>
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
<!-- -->
           <form role="form" id="payment-form">
              <div class="row">
                <div class="col-xs-6">
                  <div class="form-group">
                  <label for="cardNumber">CARD NUMBER</label>
                    <div class="input-group">
                       <input type="tel" class="form-control" name="number" placeholder=" Valid Card Number" autocomplete="cc-number" required autofocus />

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
    <!-- <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-warning btn-lg btn-block" type="submit">Submit<span class="glyphicon glyphicon-chevron-right"></span></button>
        </div>
    </div> -->


</form>

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
                                      <input type='button' class='btn btn-finish btn-fill btn-warning btn-wd' name='finish' value='Payment' />
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
                  <input name="lat" type="text" id="lat-add" class="col-sm-4" readonly="readonly">
                  <label for="long" class="control-label col-sm-2"> Long: </label>
                  <input name="long" type="text" id="long-add" class="col-sm-4" readonly="readonly">
                </div>
                <input name="place_id" type="text" id="place_id"  readonly="readonly">
                <input name="place_name" type="text" id="place_name"  readonly="readonly">
                <input name="formatted_addr" type="text" id="formatted_addr"  readonly="readonly">
                <div id="addr_map" style="width: 100%; height: 300px;"></div>
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



</body>
  <!--   Core JS Files   -->
  <script src="js/jquery-2.2.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/js/jquery.bootstrap.js" type="text/javascript"></script>

  <!--  Plugin for the Wizard -->
  <script src="assets/js/material-bootstrap-wizard.js"></script>
  <script src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
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

    /*var user_marker = new google.maps.Marker({
          position: user_LatLng,
          map: map,
          animation: google.maps.Animation.DROP,
          title: 'Hello World!'
        });
    var outlet_marker = new google.maps.Marker({
          position: outlet_LatLng,
          map: map,
          animation: google.maps.Animation.DROP,
          title: 'Hello World!'
        });*/


    //map.setZoom(10);
    //map.panTo(user_marker.position);

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
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }

  }


}

function initMap_delivery() {
  console.log("delivery");
  var map = new google.maps.Map(document.getElementById('addr_map'), {
    zoom: 3,
    center: {lat: 36.6139, lng: 60.2090}
  });


  var geocoder = new google.maps.Geocoder();

  document.getElementById('add_addr').addEventListener('click', function() {
     geocodeAddress(geocoder, map, "add");
   });

  /* document.getElementById('map-submit-edit').addEventListener('click', function() {
     geocodeAddress(geocoder, map2, "edit");
   });*/

}


$('#addAddressModal').on('shown.bs.modal', function(){
  console.log("deliver");
initMap_delivery();
});






var modal;




function geocodeAddress(geocoder, resultsMap, modal_type) {
  var marker;
  var addr;


  var add_address = document.getElementById('full_address').value;
  //var edit_address = document.getElementById('outlet-edit-addr').value;
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
                      document.getElementById("place_name").value = place.name;
                     document.getElementById("formatted_addr").value = place.formatted_address;
                     document.getElementById("place_id").value = place.id;
                     console.log(place);
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

      //if (modal == "add_modal") {
      document.getElementById("lat-add").value = event.latLng.lat();
     document.getElementById("long-add").value = event.latLng.lng();
   /*} else {
     console.log("here");
     document.getElementById("lat-edit").value = event.latLng.lat();
    document.getElementById("long-edit").value = event.latLng.lng();
  }*/

 }


 $(document).ready(function() {
   $("#addAddress").on("submit", function(e) {
     e.preventDefault();
     console.log($(this).find("#place_name").val());
     if (!$(this).find("#place_name").val()) {
       alert("Please Verify your location on Map first");
     } else {

     var formData = new FormData(this);
     console.log(formData);
     $("#addAddressModal").modal('toggle');
     //e.stopPropagation();
     var new_div = $("<a class='list-group-item new'><div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'></div></div></a>");
     $.ajax({
       url: "add_addr.php", // Url to which the request is send
       type: "POST",             // Type of request to be send, called as method
       data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
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
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2nLH2Yr5OH-QJ8WxG5f-AZFmTLqtkC0I&libraries=places&callback=initMap_delivery">
</script>

</body>
</html>
