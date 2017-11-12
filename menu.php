<?php

require "vendor/autoload.php";

$category = $_GET["category"];

if (isset($_GET["admin"])) {
$admin = $_GET["admin"];
}
    try {
        $m = new MongoDB\Client;
        $collection = $m->selectCollection("pizza", "menu");
        $menu_cursor = $collection->find(["type" => $category])->toArray();

        $menu_count = count($menu_cursor);

    } catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        //die("Caught Exception failed to Connect".$e->getMessage()."\n");
    $error_menu_msg = "Couldn't Connect to Database, Please try again";
  } catch (Exception $e) {
    $error_menu_msg  = $e->getMessage();
  }





 ?>




       <div class="col-md-12">

          <?php if (isset($error_menu_msg)) { ?>
					<div id="error" class="alert alert-danger" role="alert"><?php echo $error_menu_msg ?></div>

					<?php } ?>
        </div>
        <!-- -->

        <?php
                  if (isset($menu_count) or isset($menu_cursor)) {
                      if ($menu_count == 0 && empty($error_menu_msg)) {
                          echo "<div class='products-row menu-row'><p class='empty-message'>Oh, Your menu has no ".$category." yet!</p></div>";
                      } else {
                          $index = 0;
                          foreach (array_reverse($menu_cursor) as $document) {
                              //array_push($outlet_array, $document);
                              if ($index%3 == 0) { ?>

                                <div class="products-row menu-row">

                            <?php
                              }

                              if (isset($document["path"])) {
                                $path = $document["path"];
                              } else {
                                $path = "menu/no_image.jpg";
                              }

                              ?>

                              <div class="col-xs-8 col-md-4 col-sm-6 product-grids">
                                <div class="flip-container">
                                  <div class="flipper agile-products">
                                    <div class="front">
                                      <img src="<?php echo $path; ?>" class="img-responsive" alt="img">

                                      <div class="gallery-des">
                                        <h3><?php echo $document["name"]; ?></h3>
                                      </div>


                                    </div>
                                    <div class="back">
                                      <input type="hidden" name="item_id" id="item_id" value="<?php echo $document["_id"]; ?>">
                                      <h4 class="editable"><?php echo $document["name"]; ?></h4>
                                      <p class="editable"><?php echo $document["ingredients"]; ?></p>
                                      <h6 class="editable"><?php echo $document["price"]; ?><sup>$</sup></h6>


                                      <!-- button for cart -->
                                      <?php if (isset($admin) AND $admin) { ?>
                                        <button type="button" class="btn btn-danger btn-space bottomright" onclick="delete_item(this);"><span class="glyphicon glyphicon-remove"></span> </button>
                        								<button type="button" name="edit_modal" class="btn btn-default btn-space pull-right" onclick="editable(this);"><span class="glyphicon glyphicon-pencil"></span> </button>

                                    <?php } else { ?>
                                      <button class="w3ls-cart pw3ls-cart my-cart-btn" data-id="<?php echo $document["_id"]; ?>" data-name="<?php echo $document['name']; ?>" data-summary="<?php echo $document['ingredients']; ?>" data-price="<?php echo $document['price']; ?>" data-quantity="1" data-image="<?php echo $path; ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i>Add to Cart</button>
                                    <?php } ?>
                                      <!--ending button for cart -->
                                    </div>
                                    <!--back -->
                                  </div>
                                  <!--flipper agileproducts -->
                                </div>
                                <!--flip container-->
                              </div>




                              <?php

                              if ($index%3 == 2) { ?>
                                <br><br><br><br>
                                </div>

                              <?php }

                                $index++;
                              }
                            }
                          }
                              ?>



                <div class="back" id="back-edit-form" style="display: none;">
                  <form class="form-horizontal" id="edititem">
                    <input type="hidden" name="item_id" id="item_id">
                    <div class="input-group">
                    <label for="name" class="col-xs-3 control-label">Name:</label>
                    <div class="col-xs-8">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                  </div>
                  </div>
                  <div class="input-group">
                    <label for="ingredients" class="col-xs-3 control-label">Toppings:</label>
                    <div class="col-xs-8">
                    <input type="text" class="form-control" id="ingredients" name="ingredients" placeholder="Ingredients" required>
                  </div>
                  </div>
                  <div class="input-group">
                    <label for="price" class="col-xs-3 control-label">Price:</label>
                    <div class="col-xs-8">
                  <input type="text" class="form-control" id="price" name="price" placeholder="Price" required>
                </div>
                </div>
                <div class="input-group">
                  <label for="image" class="col-xs-3 control-label">Image:</label>
                  <div class="col-xs-8">
                <input type="file" name="image" id="imageToUpload">
              </div>
              </div>
                  <!-- button for cart -->

                    <button type="button" class="btn btn-danger btn-space pull-right" onclick="$(this).parent().parent().remove();">Cancel</button>
                    <button type="button" name="edit_modal" class="btn btn-default btn-space pull-right" onclick="update(this)">Update</button>
                  </form>

                  <!--ending button for cart -->

                </div>
