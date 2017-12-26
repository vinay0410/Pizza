<?php

  session_start();

  require "vendor/autoload.php";


  if (isset($_POST["name"])) {
      $name = $_POST["name"];
      $email = $_POST["email"];
      $subject = $_POST["subject"];
      $message = $_POST["message"];
      try {
          $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
          $db = $m->pizza;
          $collection = $db->feedback;
      } catch (Exception $e) {


          $error_msg = "Couldn't Connect to Database";
      }

      if (empty($error_msg)) {
          $document = array(
              "name" => $name,
              "email" => $email,
              "subject" => $subject,
              "message" => $message,
           );


          $collection->insertOne($document);
          $_SESSION["feedback_msg"] = "Feedback Submitted Successfully, Thanks for your time!";
          header("Location: .");
      }
  }
