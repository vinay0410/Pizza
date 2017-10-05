<?php

require("vendor/autoload.php");
//Get authentication Variables from VCAPS_SERVICES. We first need to pull in our Sendgrid
//connection variables from the VCAPS_SERVICES environment variable. This environment variable
//will be put in your project by Bluemix once you bind the Sendgrid service to your Bluemix
//application.
// vcap_services Extraction
$services_json = json_decode(getenv('VCAP_SERVICES'),true);
$VcapSvs = $services_json["sendgrid"][0]["credentials"];
//Debug: If you want to see all the variables returned you can use this line of code.
//var_dump($services_json);
// Extract the VCAP_SERVICES variables for Sendgrid connection.
 $myUsername = $VcapSvs["username"];
 $myPassword = $VcapSvs["password"];
 $mySmtpHostname = $VcapSvs["hostname"];

 try {
  $sendgrid = new SendGrid("yjCiLKQCij", "CZyHi2OJ5orv9542", array("turn_off_ssl_verification" => true));
  $email = new SendGrid\Email();
  $email->addTo("vinay0410sharma@gmail.com")->
         setFrom("someone@pizzavilla.com")->
         setSubject('Greetings')->
         setText('<strong>Hello from SendGrid!</strong>');
  // Assuming everything above was executed without error, we have sent the email
  // and the $response variable has a success string
  $response = $sendgrid->send($email);
  echo "<p>Email sent. Sendgrid reply: ";
  var_dump($response);
  echo " If the email already arrived, you can read it <a href='http://bluemix.mailinator.com'>here</a></p>";
}
  catch(Exception $e) {
  //We sent something to Sag that it didn't expect.
  echo '<p>There was an error sending an email using SendGrid!!!</p>';
  echo $e->getMessage();
}
?>
