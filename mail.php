<?php
// Licensed under the Apache License. See footer for details.
//We need the Sendgrid PHP library. The library is used to send email.
//We only need to do this once!
echo "I am here";
require("vendor/autoload.php");
//Get authentication Variables from VCAPS_SERVICES. We first need to pull in our Sendgrid
//connection variables from the VCAPS_SERVICES environment variable. This environment variable
//will be put in your project by Bluemix once you bind the Sendgrid service to your Bluemix
//application.
// vcap_services Extraction
echo "loaded vendor files"
$services_json = json_decode(getenv('VCAP_SERVICES'),true);
$VcapSvs = $services_json["sendgrid"][0]["credentials"];
//Debug: If you want to see all the variables returned you can use this line of code.
//var_dump($services_json);
// Extract the VCAP_SERVICES variables for Sendgrid connection.
 $myUsername = $VcapSvs["username"];
 $myPassword = $VcapSvs["password"];
 $mySmtpHostname = $VcapSvs["hostname"];

 try {
  $sendgrid = new SendGrid($myUsername, $myPassword, array("turn_off_ssl_verification" => true));
  $email = new SendGrid\Email();
  $email->addTo("bluemix@mailinator.com")->
         setFrom("foo.bar.com")->
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
//-------------------------------------------------------------------------------
// Copyright IBM Corp. 2014
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
// http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.
//-------------------------------------------------------------------------------
?>
