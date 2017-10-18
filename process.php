<?php

session_start();

echo "to be printed";

if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $addr = $_POST["address"];
    $password = $_POST["password"];
    $phoneno = $_POST["phoneno"];



    $error_msg;
    try {
        $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
        $db = $m->pizza;
        $collection = $db->users;
        var_dump($collection);
    } catch (Exception $e) {
        #die("Caught Exception failed to Connect".$e->getMessage()."\n");

        $error_msg = "Couldn't Connect to Database";
        $_SESSION["signup-error"] = array(
        "username" => $username,
        "email" => $email,
        "address" => $addr,
        "password" => $password,
        "phoneno" => $phoneno,
        "error_msg" => $error_msg
     );

        header("Location: .");
    }


    if (empty($_SESSION["signup-error"])) {
        echo "to be printed 1";
        $result_username = $collection->findOne(array('username' => $username));
        $result_email = $collection->findOne(array('email' => $email));
        if (empty($result_username) and empty($result_email)) {
            $document = array(
        "username" => $username,
        "email" => $email,
        "address" => $addr,
        "password" => $password,
        "phoneno" => $phoneno,
     );

            $collection->insertOne($document);
            echo "Document Inserted Successfully";
            $_SESSION["reg-success"] = true;
            header("Location: .");
        } elseif (!empty($result_username)) {
            $error_msg = "Username Already Exists";
            $_SESSION["signup-error"] = array(
        "username" => $username,
        "email" => $email,
        "address" => $addr,
        "password" => $password,
        "phoneno" => $phoneno,
        "error_msg" => $error_msg
     );
            echo "Already exists";
            header("Location: .");
        } else {
            $error_msg = "Email Address Already Registered";
            $_SESSION["signup-error"] = array(
        "username" => $username,
        "email" => $email,
        "address" => $addr,
        "password" => $password,
        "phoneno" => $phoneno,
        "error_msg" => $error_msg
     );
            echo "Already exists";
            header("Location: .");
        }
    }
} else {
    echo "Access Denied, You, shouldn't be here";
    header("Location: .");
}
