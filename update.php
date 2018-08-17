<?php

session_start();

require "vendor/autoload.php";


if (isset($_POST["edit_fname"])) {
    $id = $_POST["doc_id"];
    $fname = $_POST["edit_fname"];
    $lname = $_POST["edit_lname"];
    $email = $_POST["edit_email"];
    $addr = $_POST["edit_address"];
    $phoneno = $_POST["edit_phoneno"];



    $error_msg;
    try {
        $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
        $db = $m->pizza;
        $collection = $db->users;
    } catch (Exception $e) {
        #die("Caught Exception failed to Connect".$e->getMessage()."\n");
        $error_msg =  "Couldn't Connect to Database";
        $_SESSION["pop_profile"] = $error_msg;

        header("Location: .");
    }
    if (empty($error_msg)) {
        $result = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
        if (($result["email"] == $email) || (!$collection->findOne(array('email' => $email)))) {



            $collection->updateOne(['_id' => new MongoDB\BSON\ObjectID($id)], ['$set'=> ["fname" => $fname, "lname" => $lname,  "email" => $email, "address" => $addr, "phoneno" => $phoneno]]);
            $result = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
            $_SESSION["pop_profile"] = array("type" => "success", "msg" => "Details Updated Successfully!");

            $_SESSION["logged"] = $result;
            header("Location: .");
        }  else {
            $_SESSION["pop_profile"] = array("type" => "danger", "msg" => "Email Address already registered!");
            header("Location: .");
        }
    }
} else {
    //echo "Access Denied, You, shouldn't be here";
    header("Location: .");
}
