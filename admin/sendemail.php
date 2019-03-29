<?php
include "sendEmail-v156.php";
 
$to       = 'oong.julian@yahoo.co.id';
$subject  = 'PERL & PHP --- LOCALHOST';
$message  = 'Halo pesan ini saya kirimkan dari localhost';
 
// user dan password gmail
$sender   = 'oong.julian@gmail.com';
$password = 'OONG2016804234';
 
if(email_localhost($to, $subject, $message, $sender, $password))
    echo "Email sent";
else
    echo "Email sending failed";
?>