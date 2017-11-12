<?php

session_start();

require "vendor/autoload.php";

    $staff_id = $_POST["staff_id"];
    $fname = $_POST["edit-staff-fname"];
    $lname = $_POST["edit-staff-lname"];
    $email = $_POST["edit-staff-email"];
    $password = $_POST["password"];
    $phoneno = $_POST["edit-staff-phone"];







    try {
        $m = new MongoDB\Client;
        $db = $m->pizza;
        $collection = $db->users;
        $document = array(
          "fname" => $fname,
          "lname" => $lname,
          "email" => $email,
          "address" => array(),
          "password" => $password,
          "phoneno" => $phoneno
        );
        $collection->updateOne([ '_id' =>  new MongoDB\BSON\ObjectID($staff_id)], [ '$set' => $document ]);
        $document["_id"] = $staff_id;



    } catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
      echo json_encode(array('error' => True, 'msg' => "Couldn't Connect to Database"));
      exit();

    }  catch (Exception $e) {
        #die("Caught Exception failed to Connect".$e->getMessage()."\n");
        echo json_encode(array('error' => True, 'msg' => $e->getMessage()));
        exit();


    }


        ?>

       <h4 class="list-group-item-heading accordion-toggle"><?php echo $document["fname"] . " " . $document["lname"]; ?>

         <button type="button" class="btn btn-danger btn-space pull-right" id="<?php echo $document["_id"]; ?>" onclick="delete_staff(this);" data-role="<?php echo $document['role']; ?>"><span class="glyphicon glyphicon-remove"></span></button>
         <button type="button" name="edit_modal" class="btn btn-default btn-space pull-right" data-toggle="modal" data-target="#editStaff" data-staff='<?php echo json_encode($document); ?>' onclick="putContents(this);" ><span class="glyphicon glyphicon-pencil"></span></button>
       </h4>
       <p class="list-group-item-text"><?php echo $document['email']; ?></p>
       <p class="list-group-item-text"><?php echo $document['phoneno']; ?></p>
