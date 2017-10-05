<?php

session_start();



if (isset($_POST["edit_username"])) {
  $id = $_POST["doc_id"];
  $username = $_POST["edit_username"];
  $email = $_POST["edit_email"];
  $phoneno = $_POST["edit_phoneno"];



  $error_msg;
  try {

   $m = new MongoClient("mongodb://admin:EIIGMGVVORZLANRD@sl-eu-lon-2-portal.5.dblayer.com:20539,sl-eu-lon-2-portal.0.dblayer.com:20539/admin?ssl=true");
   $db = $m->Pizza;
   $collection = $db->users;

  } catch(Exception $e) {
    #die("Caught Exception failed to Connect".$e->getMessage()."\n");
    $error_msg =  "Couldn't Connect to Database";
    $_SESSION["pop_profile"] = $error_msg;

    header("Location: .");

  }
  if (empty($error_msg)) {

    $result = $collection->findOne(array('_id' => new MongoId($id)));
    if (($result["username"] == $username) || (!$collection->findOne(array('username' => $username)))) {

        //change password
        $collection->update(array('_id' => new MongoId($id)), array('$set'=>array("username" => $username, "email" => $email, "phoneno" => $phoneno)));
        $result = $collection->findOne(array('_id' => new MongoId($id)));
        $_SESSION["pop_profile"] = array("type" => "success", "msg" => "Details Updated Successfully!");

        $_SESSION["logged"] = $result;
        header("Location: .");
      } else {
        $_SESSION["pop_profile"] = array("type" => "danger", "msg" => "Username already exists!");
        header("Location: .");
      }


  }



} else {
  echo "Access Denied, You, shouldn't be here";
  header("Location: .");

}


 ?>
