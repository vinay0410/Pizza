<?php


echo "Started";
require('vendor/autoload.php');
echo "I didn't reach here";

//Get Connection Variables from VCAPS_SERVICES. We first need to pull in our Cloudant database
//connection variables from the VCAPS_SERVICES environment variable. This environment variable
//will be put in your project by Bluemix once you add the Cloudant database to your Bluemix
//application.

// vcap_services Extraction
$services_json = json_decode(getenv('VCAP_SERVICES'),true);
$VcapSvs = $services_json["compose-for-mongodb"][0]["credentials"];

$link = $VcapSvs["uri"];

//Debug: If you want to see all the variables returned you can use this line of code.
var_dump($services_json);


echo "above is debugging";

var_dump($link);


$mongo = new MongoClient($link);
    // Choose the database and collection
    $db = $mongo->my_db_name;
    $coll = $db->my_collection_name;

    // Same a document to the collection
    $coll->save(array(
        "name" => "Jack Sparrow",
        "age" => 34,
        "occupation" => "Pirate"
    ));

    // Retrieve the document and display it
    $item = $coll->findOne();

    echo "My name is " . $item['name'] . ". I am " . $item['age'] . " years old and work full-time as a " . $item['occupation'] . ".";

    ?>
