 <?php
// Licensed under the Apache License. See footer for details.


 //We need to pull in the Sag PHP library. SAG is an open API used to connect to the Cloudant database.
 //We only need to do this once!
 echo "Started";
 require('vendor/autoload.php');
 echo "I didn't reach here";

//Get Connection Variables from VCAPS_SERVICES. We first need to pull in our Cloudant database
//connection variables from the VCAPS_SERVICES environment variable. This environment variable
//will be put in your project by Bluemix once you add the Cloudant database to your Bluemix
//application.

// vcap_services Extraction
$services_json = json_decode(getenv('VCAP_SERVICES'),true);
$VcapSvs = $services_json["cloudantNoSQLDB"][0]["credentials"];

//Debug: If you want to see all the variables returned you can use this line of code.
var_dump($services_json);
echo "above is debugging";
// Extract the VCAP_SERVICES variables for Cloudant connection.
 $myUsername = $VcapSvs["username"];
 $myPassword = $VcapSvs["password"];

 try {
  // Let's login to the database.
  $sag = new Sag($myUsername . ".cloudant.com");
  $sag->login($myUsername, $myPassword);

  // Now that we are logged in, we can create a database to use
  $sag->createDatabase("mydatabase");
  $sag->setDatabase("mydatabase");

  if(!$sag->put("myId", '{"myKey":"Hello World from Cloudant!"}')->body->ok) {

    error_log('Unable to post a document to Cloudant.');

  } else {

	  // We are now going to read a document from our cloudant database. We are going
	  // to retrieve the value associated with myKey from the body of the document.
  	  //The SAG PHP library takes care of all the gory details and only retrieves the value.
	  $resp = $sag->get('myId')->body->myKey;

	  echo $resp;
    }

  // Assuming everything above was executed without error, we now are connected to the
  // database and have retrieved the value.

  //NOTE: Since we have a connection to the database, we can query the database for other
  //      documents and retrieve other variables at a later time. We do not need to connect
  //      to the database again.


}
  catch(Exception $e) {
  //We sent something to Sag that it didn't expect.
  echo '<p>There Was an Error Getting Data from Cloudant!!!</p>';
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
