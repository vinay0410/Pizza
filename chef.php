<?php
include("header.php");
?>

<?php



try {
    $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
    $db = $m->pizza;
    $collection = $db->orders;
//$otletid=from session
//$cursor= $collection->find(["outlet_id" => $outletid ])->toArray();
    $cursor = $collection->find()->toArray();
    $collection1 = $db->users;
    $order_count = count($cursor);
    $collection2=$db->menu; 
    }
catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
    //die("Caught Exception failed to Connect".$e->getMessage()."\n");
    $error_order_msg = "Couldn't Connect to Database, Please try again";
  } 
catch (Exception $e) {
$error_order_msg  = $e->getMessage();
}


?>
 <style type="text/css">
  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    font-size: 0.9em;
    color: #0e0d0d;
    border-top: none !important;
}
.carousel-inner > .item > a > img, .carousel-inner > .item > img, .img-responsive, .thumbnail a > img, .thumbnail > img {
    
    max-width: 32%;
    height: auto;
}
 </style>

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
        <th class="col-md-3">
         ORDER ID
        </th>
        <th class="col-md-2">
          USERNAME
        </th>
        <th class="col-md-4" style="text-align:center;">
          ORDER
        </th>
        <th class="col-md-3">
          ORDER STATUS
        </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cursor as $document) { 
          $userid= $document["user_id"];
          $user_cursor = $collection1->find(["_id" => $userid ])->toArray();
          $user_count = count($user_cursor);

        ?>
        <?php if($user_count != 0)
        {
          ?>
      <tr>
        <td><?php echo $document["_id"] ?></td>

        <td>
        <?php  
          
          foreach ($user_cursor as $documentT) 
            {
              echo $documentT["username"] . "\n";
            }
          
        ?>

          </td>
        <td>
<table>
        <?php
            foreach($document["cart_contents"]["products"] as $item) { ?>
              <tr>
                
              <td class="col-md-2"><?php echo $item["name"]; ?></td>
              <td class="col-md-1"> <?php echo $item["quantity"]; ?></td>
              <td style="text-align:center;" class="col-md-1">
                
  
                <!-- Trigger the modal with a button -->
                <?php
                $product=$item["name"];
                $product_cursor=$collection2->find(["name" => $product ])->toArray();
                foreach( $product_cursor as $pr) {
                   $ingredients=$pr["ingredients"];
                   $path=$pr["path"];
                }
                ?>
                  <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myOrder" data-yourparameter="<?php echo strtoupper($item["name"]); ?>+++<?php echo $path; ?>+++<?php echo $ingredients; ?>">View</button>

                <!-- Modal -->
                  <div class="modal fade" id="myOrder" role="dialog">
                    <div class="modal-dialog modal-md">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title" id="pizzaname" ></h4>
                        </div>
                        <div class="modal-body">
                          <table>
                          <tr>
                            <td style="width: 352px;"><img class="img-responsive img-circle" id="pizzaimage" src=""> 
                            </td>    
                            <td>
                            <h6 id="summary" style="font-size:20px;"></h6>
                            </td>
                          </tr>
                          </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
               </td>
              </tr>
             
      <?php      
           }

      ?>
    </table>
</td>

                          <td></td>
      </tr>
      <?php } ?>
      <?php }  ?>
    </tbody>
  </table>
</div>
</div>
</div>

</div>
<script src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
$('#myOrder').on('show.bs.modal', function(e) {
  var yourparameter = e.relatedTarget.dataset.yourparameter;
var res = yourparameter.split("+++");
document.getElementById("pizzaname").innerHTML = res[0];
document.getElementById("pizzaimage").src = res[1];
document.getElementById("summary").innerHTML = res[2];
});
</script>
<?php include('comment.php'); ?>
<?php include('modals.php'); ?>
<?php include("footer.php"); ?>
