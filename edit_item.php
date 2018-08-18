<?php

require "vendor/autoload.php";


    $id = strtolower($_POST["item_id"]);
    $name = strtolower($_POST["name"]);
    $ing = strtolower($_POST["ingredients"]);
    $price = strtolower($_POST["price"]);

    $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);

    $hasimage = false;

    if (isset($_FILES['image']['tmp_name']) and in_array(exif_imagetype($_FILES['image']['tmp_name']), $allowedTypes)) {
    $target_dir = "menu/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $hasimage = true;
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      } else {
        $var = array('error' => True, 'msg' => "Failed to upload file");
        echo json_encode($var);
        exit();
      }

      }




    try {
        $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
        $db = $m->pizza;
        $collection = $db->menu;
    } catch (Exception $e) {
      $var = array('error' => True, 'msg' => "Couldn't Connect to Database");
      echo json_encode($var);
      exit();

    }

        $result = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID( $id )]);

        if ( ($result["name"] == $name) || (!$collection->findOne(array('name' => $name))) )  {
          $document = array("name" => $name, "ingredients" => $ing, "price" => $price);
          if ($hasimage) {
            $document["path"] = $target_file;
            if (isset($result["path"]) and (strpos($result_path, 'no_image') === false)) {
              unlink($result["path"]);
          }
        }


            $collection->updateOne(array('_id' => new MongoDB\BSON\ObjectID($id)), array('$set'=>$document));
            $result = $collection->findOne(array('_id' => new MongoDB\BSON\ObjectID($id)));

            ?>

            <div class="flipper agile-products">
              <div class="front">
                <img src="<?php echo $result['path']; ?>" class="img-responsive" alt="img">

                <div class="gallery-des">
                  <h3><?php echo $result["name"]; ?></h3>
                </div>


              </div>
              <div class="back">
                <input type="hidden" name="item_id" id="item_id" value="<?php echo $result["_id"]; ?>">
                <h4 class="editable"><?php echo $result["name"]; ?></h4>
                <p class="editable"><?php echo $result["ingredients"]; ?></p>
                <h6 class="editable"><?php echo $result["price"]; ?><sup>$</sup></h6>



                  <button type="button" name="edit_modal" class="btn btn-default btn-space" onclick="editable(this);"><span class="glyphicon glyphicon-pencil"></span> </button>
                  <button type="button" class="btn btn-danger btn-space bottomright" onclick="delete_item(this);"><span class="glyphicon glyphicon-remove"></span> </button>


                <!--ending button for cart -->
              </div>
              <!--back -->
            </div>

<?php
        } else {
          $var = array('error' => True, 'msg' => 'Item Name Already exists');
          echo json_encode($var);
        }



?>
