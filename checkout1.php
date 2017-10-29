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
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/material-bootstrap-wizard.css" rel="stylesheet" />
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
  body{
    color: #fff;
  }
</style>
</head>

<body>
<div class="image-container set-full-height" >
      <!--   Big container   -->
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
                <!--      Wizard container        -->
        <div class="wizard-container">
          <div class="card wizard-card" data-color="orange" id="wizard">
              <form action="" method="">
                  <div class="wizard-header"></div> 
                  <div class="wizard-navigation">
                        <ul>
                        <li><a href="#delivery" data-toggle="tab">Delivery</a></li>
                        <li><a href="#confirmation" data-toggle="tab">Confirmation</a></li>
                        <li><a href="#payment" data-toggle="tab">Payment</a></li>
                        </ul>
                  </div>

                  <div class="tab-content">
                    <div class="tab-pane" id="delivery">
                        <div class="row">
                          <div class="col-sm-12">
                          <h4 class="info-text">Some text here</h4>
                          </div>

                          <div class="col-sm-3"></div>
                          
                          <div class="col-sm-6"> 
                            <div class="form-group label-floating">
                              <label class="control-label">Closest Outlet</label>
                              <select class="form-control" id="outlet_id">
                                <option disabled="" selected=""></option>
                                <option value="OL1">Outlet 2 </option>
                                <option value="OL2"> Outlet 1 </option>
                              </select>
                            </div>

                            <div class="form-group label-floating">
                                <label class="control-label">Address</label>
                                <div class="input-group">
                                  <textarea class="form-control" id="address" placeholder="" rows="2"   style="min-width:100%;font-size:14pt;">
                                  </textarea>
                                </div>
                            </div> 
                          </div><!--ending col-sm-6 -->
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
                    <div class="tab-pane" id="confirmation">
                      <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                        <!--starting receipt -->
 
                          <div class="row">

                            <div class="col-xs-6 col-sm-6 col-md-6">
                              <strong>Name</strong>
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
                        <tr>
                            <td class="col-md-9"><em>Product 1</em></h4></td>
                            <td class="col-md-1" style="text-align: center"> 2 </td>
                            <td class="col-md-1 text-center">$13</td>
                            <td class="col-md-1 text-center">$26</td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><em>Product 2</em></h4></td>
                            <td class="col-md-1" style="text-align: center"> 1 </td>
                            <td class="col-md-1 text-center">$8</td>
                            <td class="col-md-1 text-center">$8</td>
                        </tr>
                        <tr>
                            <td class="col-md-9"><em>Product 3</em></h4></td>
                            <td class="col-md-1" style="text-align: center"> 3 </td>
                            <td class="col-md-1 text-center">$16</td>
                            <td class="col-md-1 text-center">$48</td>
                        </tr>
                        
                        <tr>
                            <td> &nbsp; </td>
                            <td> &nbsp; </td>
                            <td class="text-right"><h4><strong>Total:&nbsp;</strong></h4></td>
                            <td class="text-center text-warning"><h4><strong>$31.53</strong></h4></td>
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

</body>
  <!--   Core JS Files   -->
  <script src="assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
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
</body> 
</html>
