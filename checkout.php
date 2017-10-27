<?php include("header.php"); ?>

<?php $data = $_GET["data"];
      var_dump($data); ?>

<link rel="stylesheet" href="css/card.css">

<style type="text/css">
    body {
margin-top:40px;
}
.stepwizard-step p {
margin-top: 10px;
}
.stepwizard-row {
display: table-row;
}
.stepwizard {
display: table;
width: 50%;
position: relative;
}
.stepwizard-step button[disabled] {
opacity: 1 !important;
filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
top: 24px;
bottom: 0;
position: absolute;
content: " ";
width: 100%;
height: 1px;
background-color: #ccc;
z-order: 0;
}
.stepwizard-step {
display: table-cell;
text-align: center;
position: relative;
}
.btn-circle {
width: 45px;
height: 45px;
text-align: center;
padding: 6px 0;
font-size: 12px;
line-height: 2.428571;
border-radius: 50%;
}
</style>

<body>
<div class="container">

<div class="stepwizard col-md-offset-3">
    <div class="stepwizard-row setup-panel">
      <div class="stepwizard-step">
        <a href="#step-1" type="button" class="btn btn-warning btn-circle"><strong>1</strong></a>
        <p><strong>Delivery</strong></p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
        <p><strong>Confirmation</strong></p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
        <p><strong>Payment</strong></p>
      </div>

    </div>
  </div>

          <form role="form" action="" method="post">

              <div class="row setup-content" id="step-1">
                 <div class="col-xs-6 col-md-offset-3">
                    <div class="col-md-12">
<div class="panel panel-default">

<div class="panel-body">
                    <div class="form-group">
                      <label for="outlet_id" class="control-label">Closest Outlet</label>
                      <select class="form-control" id="outlet_id">
                        <option value="OL1">Outlet 1</option>
                        <option value="OL2">Outlet 2</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Address</label>
                      <textarea required="required" class="form-control" placeholder="Enter your shipping address" ></textarea>
                    </div>

                    <button class="btn btn-warning nextBtn btn-lg pull-right" type="button" >Confirmation &nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                  </div>
                </div>
              </div>
</div></div>
    <div class="row setup-content" id="step-2">
      <div class="col-xs-6 col-md-offset-3">
        <div class="panel panel-default">

<div class="panel-body">
      <div class="row">

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>

                        <strong>Name</strong>
                        <br>
                        <strong>Address </strong>
                        <br>
                        <strong>Phone Number</strong>
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date: 25 October, 2017</em>
                    </p>
                    <p>
                        <em>Receipt #: 34522677W</em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>Your Orders</h1>
                </div>
                </span>
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
                            <td class="text-center text-danger"><h4><strong>$31.53</strong></h4></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-warning nextBtn btn-lg pull-right">
                    Payment&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
                </button></td>
            </div>
          </div>
        </div></div>
      <!--ending receipt -->
    </div>
    <div class="row setup-content" id="step-3">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <!-- -->



          <!-- CREDIT CARD FORM STARTS HERE -->
          <div class="panel panel-default credit-card-box">
            <div class="panel-heading display-table" >
              <div class="row display-tr" >
                <h1 class="panel-title display-td" >Payment Details</h1>
                <div class="display-td" >
                  <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                </div>
              </div>
            </div>
            <div class="panel-body">
<!-- -->
  <div class="demo-container">

        <div class="card-wrapper"></div>

        <div class="form-container active">
<!-- -->
            <form role="form" id="payment-form">
              <div class="row">
               <div class="col-xs-12">
                <div class="form-group">
                  <label for="cardNumber">CARD NUMBER</label>
                  <div class="input-group">
                    <input type="tel" class="form-control" name="number" placeholder="Valid Card Number" autocomplete="cc-number" required autofocus />
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
               <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label for="cardName">NAME</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter your full name" name="name"  required="required" autofocus />
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>

                  </div>
                </div>
              </div>
            </div>

    <div class="row">
          <div class="col-xs-7 col-md-7">
            <div class="form-group">
                <label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
              <input type="tel" class="form-control" name="expiry"
                placeholder="MM / YY" autocomplete="cc-exp" required />
            </div>
          </div>
          <div class="col-xs-5 col-md-5 pull-right">
            <div class="form-group">
              <label for="cardCVC">CV CODE</label>
                <input type="tel" class="form-control" name="cvc" placeholder="CVC" autocomplete="cc-csc" required />
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
    <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-warning btn-lg btn-block" type="submit">Submit<span class="glyphicon glyphicon-chevron-right"></span></button>
        </div>
    </div>

</form>
</div></div>
</div>
</div>
<!-- CREDIT CARD FORM ENDS HERE -->
          <!-- -->

        </div>
      </div>
    </div>
  </form>

</div>
<script src="js/bootstrap.min.js"></script>
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
    </script>
</body>
</html>
