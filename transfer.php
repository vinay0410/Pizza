<?php

session_start();

$data = $_GET["data"];

if (isset($_SESSION["logged"])) {
  //var_dump($_SESSION["logged"]);
  $_SESSION["storecart"] = $data;
  header("Location: checkout.php");

} else {
  $_SESSION["pop_login"] = array("type" => "danger", "msg" => "PLease Login to Checkout");
  $_SESSION["storecart"] = $data;
  //var_dump($_SESSION["cart"]);
  header("Location: .");

}
 ?>
