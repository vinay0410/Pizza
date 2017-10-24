<?php



    $name = strtolower($_POST["item_name"]);
    $ing = strtolower($_POST["toppings"]);
    $price = strtolower($_POST["item_price"]);

    if (!empty($_FILES["image"]["name"])) {
      $target_dir = "menu/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      } else {
        $var = array('error' => True, 'msg' => "Failed to Upload File");
        echo json_encode($var);
        exit();
      }

      }

    try {
        $m = new MongoClient("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
        $db = $m->pizza;
        $collection = $db->menu;
    } catch (Exception $e) {
      $var = array('error' => True, 'msg' => "Couldn't Connect to Database");
      echo json_encode($var);
      exit();


    }

        $result = $collection->findOne(array('name' => $name));
        if ( empty($result) )  {

          $document = array("name" => $name, "ingredients" => $ing, "price" => $price);
          if (!empty($_FILES["image"]["name"])) {
            $document["path"] = $target_file;
          }
        //change password
            $collection->insert($document);
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
          $var = array('error' => True, 'msg' => "Item Name Already Exists");
          echo json_encode($var);
          exit();
        }




?>
