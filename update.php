<?php

session_start();



if (isset($_POST["edit_username"])) {
    $id = $_POST["doc_id"];
    $username = $_POST["edit_username"];
    $email = $_POST["edit_email"];
    $addr = $_POST["edit_address"];
    $phoneno = $_POST["edit_phoneno"];



    $error_msg;
    try {
        $m = new MongoDB\Client("mongodb://admin:EIIGMGVVORZLANRD@sl-eu-lon-2-portal.5.dblayer.com:20539,sl-eu-lon-2-portal.0.dblayer.com:20539/admin?ssl=true");
        $db = $m->Pizza;
        $collection = $db->users;
    } catch (Exception $e) {
        #die("Caught Exception failed to Connect".$e->getMessage()."\n");
        $error_msg =  "Couldn't Connect to Database";
        $_SESSION["pop_profile"] = $error_msg;

        header("Location: .");
    }
    if (empty($error_msg)) {
        $result = $collection->findOne(array('_id' => new MongoId($id)));
        if ((($result["username"] == $username) || (!$collection->findOne(array('username' => $username)))) and  (($result["email"] == $email) || (!$collection->findOne(array('email' => $email))))) {



        //change password
            $collection->update(array('_id' => new MongoId($id)), array('$set'=>array("username" => $username, "email" => $email, "address" => $addr, "phoneno" => $phoneno)));
            $result = $collection->findOne(array('_id' => new MongoId($id)));
            $_SESSION["pop_profile"] = array("type" => "success", "msg" => "Details Updated Successfully!");

            $_SESSION["logged"] = $result;
            header("Location: .");
        } elseif ($result["username"] != $username) {
            $_SESSION["pop_profile"] = array("type" => "danger", "msg" => "Username already exists!");
            header("Location: .");
        } else {
            $_SESSION["pop_profile"] = array("type" => "danger", "msg" => "Email Address already registered!");
            header("Location: .");
        }
    }
} else {
    echo "Access Denied, You, shouldn't be here";
    header("Location: .");
}
