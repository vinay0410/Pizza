<?php

  session_start();

  if(isset($_POST["name"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    try {

     $m = new MongoClient("mongodb://admin:EIIGMGVVORZLANRD@sl-eu-lon-2-portal.5.dblayer.com:20539,sl-eu-lon-2-portal.0.dblayer.com:20539/admin?ssl=true");
     $db = $m->Pizza;
     $collection = $db->feedback;

    } catch(Exception $e) {
      #die("Caught Exception failed to Connect".$e->getMessage()."\n");

      $error_msg = "Couldn't Connect to Database";

    }

    if(empty($error_msg)) {

          $document = array(
              "name" => $name,
              "email" => $email,
              "subject" => $subject,
              "message" => $message,
           );


    	$collection->insert($document);
      $_SESSION["feedback_msg"] = "Feedback Submitted Successfully, Thanks for your time!";
      header("Location: .");
    }

  }

?>
