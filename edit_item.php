<?php




    $id = $_POST["item_id"];
    $name = $_POST["name"];
    $ing = $_POST["ingredients"];
    $price = $_POST["price"];

    if (!empty($_FILES["image"]["name"])) {
    $target_dir = "menu/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      } else {
        die("Failed to Upload file");
      }

      }




    try {
        $m = new MongoClient("mongodb://admin:EIIGMGVVORZLANRD@sl-eu-lon-2-portal.5.dblayer.com:20539,sl-eu-lon-2-portal.0.dblayer.com:20539/admin?ssl=true");
        $db = $m->Pizza;
        $collection = $db->menu;
    } catch (Exception $e) {
        die("Caught Exception failed to Connect".$e->getMessage()."\n");


    }

        $result = $collection->findOne(array('_id' => new MongoId($id)));
        if ( ($result["name"] == $name) || (!$collection->findOne(array('name' => $name))) )  {
          $document = array("name" => $name, "ingredients" => $ing, "price" => $price);
          if (!empty($_FILES["image"]["name"])) {
            $document["path"] = $target_file;
            if (isset($result["path"])) {
              unlink($result["path"]);
          }
        }

        //change password
            $collection->update(array('_id' => new MongoId($id)), array('$set'=>array("name" => $name, "ingredients" => $ing, "price" => $price)));
            $result = $collection->findOne(array('_id' => new MongoId($id))); ?>

            <div class="flipper agile-products">
              <div class="front">
                <img src="<?php echo $result["path"]; ?>" class="img-responsive" alt="img">

                <div class="gallery-des">
                  <h3><?php echo $result["name"]; ?></h3>
                </div>


              </div>
              <div class="back">
                <input type="hidden" name="item_id" id="item_id" value="<?php echo $result["_id"]; ?>">
                <h4 class="editable"><?php echo $result["name"]; ?></h4>
                <p class="editable"><?php echo $result["ingredients"]; ?></p>
                <h6 class="editable"><?php echo $result["price"]; ?><sup>$</sup></h6>



                  <button type="button" class="btn btn-danger btn-space bottomright" id=""><span class="glyphicon glyphicon-remove"></span> </button>
                  <button type="button" name="edit_modal" class="btn btn-default btn-space pull-right" onclick="editable(this);"><span class="glyphicon glyphicon-pencil"></span> </button>


                <!--ending button for cart -->
              </div>
              <!--back -->
            </div>

<?php
        } else {
          echo "Pizza Name Already exists";
        }



?>
