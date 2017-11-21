<?php

require "vendor/autoload.php";

session_start();


    $fname = $_POST["staff-fname"];
    $lname = $_POST["staff-lname"];
    $email = $_POST["staff-email"];
    $password = $_POST["password"];
    $phoneno = $_POST["staff-phone"];
    $role = $_POST["role"];


    $error_msg;
    try {
        $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
        $db = $m->pizza;
        $collection = $db->users;

    } catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        //die("Caught Exception failed to Connect".$e->getMessage()."\n");
        $var = array('error' => True, 'msg' => "Couldn't Connect to Database");
        echo json_encode($var);
        exit();
  } catch (Exception $e) {
    $var = array('error' => True, 'msg' => $e->getMessage());
    echo json_encode($var);
    exit();

  }





        $result_email = $collection->findOne(['email' => $email]);
        if (empty($result_email)) {
            $document = array(
        "fname" => $fname,
        "lname" => $lname,
        "email" => $email,
        "address" => array(),
        "password" => $password,
        "phoneno" => $phoneno,
        "role" => $role,
        "ofOutlet" => new MongoDB\BSON\ObjectID($_SESSION["logged"]["ofOutlet"])
     );

            $inserted_id = $collection->insertOne($document)->getInsertedId();
            $document["_id"] = $inserted_id;

        }  else {

            $var = array('error' => True, 'msg' => "Email Address already exists");
            echo json_encode($var);
            exit();
        }

?>
<h4 class="list-group-item-heading accordion-toggle"><?php echo $document["fname"] . " " . $document["lname"]; ?>

  <button type="button" class="btn btn-danger btn-space pull-right" id="<?php echo $document["_id"]; ?>" onclick="delete_staff(this);" data-role="<?php echo $document['role']; ?>"><span class="glyphicon glyphicon-remove"></span></button>
  <button type="button" name="edit_modal" class="btn btn-default btn-space pull-right" data-toggle="modal" data-target="#editStaff" data-staff='<?php echo json_encode($document); ?>' onclick="putContents(this);" data-title="<?php echo $role; ?>" ><span class="glyphicon glyphicon-pencil"></span></button>
</h4>
<p class="list-group-item-text"><?php echo $document['email']; ?></p>
<p class="list-group-item-text"><?php echo $document['phoneno']; ?></p>
