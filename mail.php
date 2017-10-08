<?php
// using SendGrid's PHP Library
// https://github.com/sendgrid/sendgrid-php
// If you are using Composer (recommended)
require 'vendor/autoload.php';
// If you are not using Composer
// require("path/to/sendgrid-php/sendgrid-php.php");
$from = new SendGrid\Email("Example User", "someone@pizzavilla.com");
$subject = "Sending with SendGrid is Fun";
$to = new SendGrid\Email("Example User", "vinay0410sharma@gmail.com");
$content = new SendGrid\Content("text/plain", "and easy to do anywhere, even with PHP");
$mail = new SendGrid\Mail($from, $subject, $to, $content);
$apiKey = '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';
$sg = new \SendGrid($apiKey);
$response = $sg->client->mail()->send()->post($mail);
var_dump($response);
echo "<p>First</p>";
echo $response->statusCode();
echo "<p>Second</p>";
print_r($response->headers());
echo "<p>third</p>";
echo $response->body();
