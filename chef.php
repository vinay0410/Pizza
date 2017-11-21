<?php
include("header.php");
foreach($_POST as $key => $value)
{
   $ostatus=$value;
   $orid=$key;
}

try {
    $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
    $db = $m->pizza;
    $collection = $db->orders;
    if(isset($ostatus) && isset($orid)){
          $collection->updateOne(['_id' => new MongoDB\BSON\ObjectID($orid)], ['$set'=> [ "orderStatus" => (int)$ostatus]]);
          unset($ostatus);
          unset($orid);
    }
    else{
          echo "Not Updated";
    }
$cursor= $collection->find(array(
    'orderStatus' => array('$in' => array(20,40,60))
    ))->toArray();
  //  $cursor = $collection->find($rangeQuery)->toArray();
    $collection1 = $db->users;
    $order_count = count($cursor);
    var_dump($order_count);
    $collection2=$db->menu;
    echo "i m here ! ";
    }
catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
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
 <link rel="stylesheet" type="text/css" href="css/checkbox.css">
 <?php if (isset($error_order_msg)) {
      ?>
      <script type="text/javascript">
        alert("<?php echo $error_order_msg; ?>");
      </script>
<?php
  } ?>
<div class="container">



<div class="row">
<div class="col-md-12">
  <table class="table table-hover " style="margin-top: 150px;">
    <thead>
      <tr>
        <th class="col-md-3">
         ORDER ID
        </th>
        <th class="col-md-2">
          EMAIL-ID
        </th>
        <th class="col-md-3" style="text-align:center;">
          ORDER
        </th>
        <th class="col-md-4">
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
        <td><?php echo $document["_id"]->getTimeStamp(); ?></td>

        <td>
        <?php

          foreach ($user_cursor as $documentT)
            {
              echo $documentT["email"];
            }

        ?>

          </td>

        <td>
<table>
        <?php
            foreach($document["cart_contents"]["products"] as $item) { ?>
              <tr>

              <td class="col-md-1"><?php echo $item["name"]; ?></td>
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
                              <h5 style="color:orange;"> INGREDIENTS  </h5>
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

                          <td>

                           <form action="#" id="<?php echo $document["_id"]."form";?>" method="post">
                              <input class="checkbox" type="radio" name="<?php echo $document["_id"];?>" id="<?php echo $document["_id"]."o";?>" <?php if($document["orderStatus"]==20) echo 'checked="checked"';?>  value="20"/>
                                  <label for="<?php echo $document["_id"] . "o";?>">Ordered</label>
                              <input class="checkbox" type="radio" name="<?php echo $document["_id"];?>" id="<?php echo $document["_id"] ."g";?>"  <?php if($document["orderStatus"]==40) echo 'checked="checked"';?> value="40" />
                                  <label for="<?php echo $document["_id"]."g";?>">Getting Ready</label>
                             <input class="checkbox" type="radio" name="<?php echo $document["_id"];?>" id="<?php echo $document["_id"]."r";?>"  <?php if($document["orderStatus"]==60) echo 'checked="checked"';?> value="60"/>
                                  <label for="<?php echo $document["_id"]."r";?>">Ready</label>
                            </form>
                          </td>

      </tr>
     <?php }
      }  ?>
    </tbody>
  </table>
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
<script type="text/javascript">

$( "input[type='radio']" ).change(function() {
  var id = $(this).attr('id');
  var oid=id.substr(0, id.length-1);
  var formid=oid+"form";

  $('#'+formid).attr("action", "chef.php");
     $( "#"+formid ).submit();

});
</script>

<?php include('comment.php'); ?>
<?php include('modals.php'); ?>
<?php include("footer.php"); ?>
