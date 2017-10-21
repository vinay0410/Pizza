<?php



    $name = strtolower($_POST["item_name"]);
    $ing = strtolower($_POST["toppings"]);
    $price = strtolower($_POST["item_price"]);





    try {
        $m = new MongoClient("mongodb://admin:EIIGMGVVORZLANRD@sl-eu-lon-2-portal.5.dblayer.com:20539,sl-eu-lon-2-portal.0.dblayer.com:20539/admin?ssl=true");
        $db = $m->Pizza;
        $collection = $db->menu;
    } catch (Exception $e) {
        die("Caught Exception failed to Connect".$e->getMessage()."\n");


    }

        $result = $collection->findOne(array('name' => $name));
        if ( empty($result) )  {



        //change password
            $collection->insert(array("name" => $name, "ingredients" => $ing, "price" => $price));
            $result = $collection->findOne(array('name' => $name ));


            if (isset($result["path"])) {
              $path = $result["path"];
            } else {
              $path = "menu/no_image.jpg";
            }
            ?>
            <div class="flip-container">
            <div class="flipper agile-products">
              <div class="front">
                <img src="<?php echo $path; ?>" class="img-responsive" alt="img">

                <div class="gallery-des">
                  <h3><?php echo $result["name"]; ?></h3>
                </div>


              </div>
              <div class="back">
                <input type="hidden" name="item_id" id="item_id" value="<?php echo $result["_id"]; ?>">
                <h4 class="editable"><?php echo $result["name"]; ?></h4>
                <p class="editable"><?php echo $result["ingredients"]; ?></p>
                <h6 class="editable"><?php echo $result["price"]; ?><sup>$</sup></h6>


                <button type="button" class="btn btn-danger btn-space bottomright" onclick="delete_item(this);"><span class="glyphicon glyphicon-remove"></span> </button>
                <button type="button" name="edit_modal" class="btn btn-default btn-space pull-right" onclick="editable(this);"><span class="glyphicon glyphicon-pencil"></span> </button>

                <!--ending button for cart -->
              </div>
              <!--back -->
            </div>
          </div>
<?php
        } else {
          echo "Pizza Name Already exists";
        }




?>
