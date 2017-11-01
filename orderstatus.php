<?php
include("header.php");
?>
<div class="container">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <table class="table table-hover " style="margin-top: 150px;">
        <thead>
          <tr>
            <th class="col-md-2">
             Order Id
            </th>
            <th class="col-md-2">
              Products
            </th>
            <th class="col-md-8">
              Order Status
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td> 1</td>
            <td>
              
            </td>
            <td>
              <!--progress bar -->
             <div class="progress">
                <div id="dynamic" class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                <span id="current-progress"></span>
                </div>
              </div>
              <!-- -->
            </td>
          </tr>  
          <tr>
            <td> 1</td>
            <td>
              
            </td>
            <td>
              <!--progress bar -->
             <div class="progress">
                <div id="dynamic" class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                <span id="current-progress"></span>
                </div>
              </div>
              <!-- -->
            </td>
          </tr>  
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $(function() {
  var current_progress = 0;
  var interval = setInterval(function() {
      current_progress += 20;
      $(".progress-bar")
      .css("width", current_progress + "%")
      .attr("aria-valuenow", current_progress)
      .text(current_progress + "% Complete");
      if(current_progress == 20)
      {
        $(".progress-bar")
      .css("width", current_progress + "%")
      .attr("aria-valuenow", current_progress)
      .text("Order Placed");
      }
      else if(current_progress == 40)
      {
        $(".progress-bar")
      .css("width", current_progress + "%")
      .attr("aria-valuenow", current_progress)
      .text("Getting Ready");
      }
      else if(current_progress == 60)
      {
        $(".progress-bar")
      .css("width", current_progress + "%")
      .attr("aria-valuenow", current_progress)
      .text("Prepared");
      }
      else if(current_progress == 80)
      {
        $(".progress-bar")
      .css("width", current_progress + "%")
      .attr("aria-valuenow", current_progress)
      .text("On The Way");
      }
      else if(current_progress == 100)
      {
        $(".progress-bar")
      .css("width", current_progress + "%")
      .attr("aria-valuenow", current_progress)
      .text("Delivered");
      }
      if (current_progress >= 100)
          clearInterval(interval);
  }, 1000);
});
    </script>

<?php include("footer.php"); ?>
