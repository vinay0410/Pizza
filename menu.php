<?php

require "vendor/autoload.php";

    try {
        $m = new MongoClient("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
        $db = $m->pizza;
        $collection = $db->menu;
    } catch (Exception $e) {
        #die("Caught Exception failed to Connect".$e->getMessage()."\n");
    $error_menu_msg = "Couldn't Connect to Database, Please try again";
    }

    if (empty($error_menu_msg)) {
        $menu_cursor = $collection->find();
        $menu_count = $collection->count();
    }




 ?>


<section id="menu" class="templatemo-section templatemo-light-gray-bg">
  <div class="product">

    <div class="container">
      <div class="row">

        <div class="col-md-12">
          <h2 class="text-center text-uppercase">Menu</h2>
          <hr>
          <?php if (isset($error_menu_msg)) { ?>
					<div id="error" class="alert alert-danger" role="alert"><?php echo $error_menu_msg ?></div>
				
					<?php } ?>
        </div>
        <!-- -->

        <?php
                  if (isset($menu_count) or isset($menu_cursor)) {
                      if ($menu_count == 0 && empty($error_menu_msg)) {
                          echo '<p>Oh, Your menu has no items yet!</p>';
                      } else {
                          $index = 0;
                          foreach ($menu_cursor as $document) {
                              //array_push($outlet_array, $document);
                              if ($index%3 == 0) { ?>

                                <div class="products-row">

                            <?php
                              }
                              ?>

                              <div class="col-md-4 col-sm-4 product-grids">
                                <div class="flip-container">
                                  <div class="flipper agile-products">
                                    <div class="front">
                                      <img src="<?php echo $document["path"]; ?>" class="img-responsive" alt="img">

                                      <div class="gallery-des">
                                        <h3><?php echo $document["name"]; ?></h3>
                                      </div>


                                    </div>
                                    <div class="back">
                                      <h4><?php echo $document["name"]; ?></h4>
                                      <p><?php echo $document["ingredients"]; ?></p>
                                      <h6><?php echo $document["price"]; ?><sup>$</sup></h6>

                                      <!-- button for cart -->
                                      <button class="w3ls-cart pw3ls-cart my-cart-btn" data-id="1" data-name="Voluptate " data-summary="Cheese, tomato, mushrooms, onions." data-price="50" data-quantity="1" data-image="menu/1.jpg"><i class="fa fa-cart-plus" aria-hidden="true"></i>Add to Cart</button>
                                      <span class="w3-agile-line"> </span>
                                      <a href="#" data-toggle="modal" data-target="#myModal1">Explore</a>
                                      <!--ending button for cart -->
                                    </div>
                                    <!--back -->
                                  </div>
                                  <!--flipper agileproducts -->
                                </div>
                                <!--flip container-->
                              </div>




                              <?php

                              if ($index%3 == 0) { ?>
                                <br><br><br><br>
                                </div>

                              <?php }

                                $index++;
                              }
                            }
                          }
                              ?>



        	   </div>
           </div> <!--container-->
          </div>
              <!--product -->
</section>
