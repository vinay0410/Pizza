<?php

session_start();



if (isset($_POST["username"])) {

  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $phoneno = $_POST["phoneno"];



  $error_msg;
  try {

   $m = new MongoClient("mongodb://admin:EIIGMGVVORZLANRD@sl-eu-lon-2-portal.5.dblayer.com:20539,sl-eu-lon-2-portal.0.dblayer.com:20539/admin?ssl=true");
   $db = $m->Pizza;
   $collection = $db->users;

  } catch(Exception $e) {
    #die("Caught Exception failed to Connect".$e->getMessage()."\n");

    $error_msg = "Couldn't Connect to Database";
    $_SESSION["signup-error"] = array(
        "username" => $username,
        "email" => $email,
        "password" => $password,
        "phoneno" => $phoneno,
        "error_msg" => $error_msg
     );
     header("Location: .");

  }


  if (!isset($_SESSION["signup-error"])) {

    $result = $collection->findOne(array('username' => $username));
    if (empty($result)) {

    $document = array(
        "username" => $username,
        "email" => $email,
        "password" => $password,
        "phoneno" => $phoneno,
     );

     $collection->insert($document);
     echo "Document Inserted Successfully";
     $_SESSION["reg-success"] = True;
     header("Location: .");
  }

  } else {
    $error_msg = "Username Already Exists";
    $_SESSION["signup-error"] = array(
        "username" => $username,
        "email" => $email,
        "password" => $password,
        "phoneno" => $phoneno,
        "error_msg" => $error_msg
     );
     header("Location: .");
  }

} else {
  echo "Access Denied, You, shouldn't be here";
  header("Location: .");

}


 ?>
