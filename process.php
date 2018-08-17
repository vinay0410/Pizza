<?php

session_start();

require "vendor/autoload.php";


if (isset($_POST["fname"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phoneno = $_POST["phoneno"];



    $error_msg;
    try {
        $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
        $db = $m->pizza;
        $collection = $db->users;
        //var_dump($collection);
    } catch (Exception $e) {
        #die("Caught Exception failed to Connect".$e->getMessage()."\n");

        $error_msg = "Couldn't Connect to Database";
        $_SESSION["signup-error"] = array(
        "fname" => $fname,
        "lname" => $lname,
        "email" => $email,
        "password" => $password,
        "phoneno" => $phoneno,
        "error_msg" => $error_msg
     );

        header("Location: .");
    }


    if (empty($_SESSION["signup-error"])) {


        $result_email = $collection->findOne(['email' => $email]);
        if (empty($result_email)) {
            $document = array(
        "fname" => $fname,
        "lname" => $lname,
        "email" => $email,
        "address" => array(),
        "password" => $password,
        "phoneno" => $phoneno,
     );

            $collection->insertOne($document);
            //echo "Document Inserted Successfully";
            $_SESSION["reg-success"] = true;
            header("Location: .");
        }  else {
            $error_msg = "Email Address Already Registered";
            $_SESSION["signup-error"] = array(
        "fname" => $fname,
        "lname" => $lname,
        "email" => $email,
        "address" => array(),
        "password" => $password,
        "phoneno" => $phoneno,
        "error_msg" => $error_msg
     );
            //echo "Already exists";
            header("Location: .");
        }
    }
} else {
    //echo "Access Denied, You, shouldn't be here";
    header("Location: .");
}
