<?php

ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
$from = "comunicados@utitalco.tk";
$to = "jairocruzprogramador@gmail.com";
$subject = "Checking PHP mail";
$message = "PHP mail works just fine";
$headers[] = 'Content-type: text/html; charset=iso-8859-1';
$headers[] = "From:" . $from;
mail($to,$subject,$message, implode("\r\n", $headers));
echo "The email message was sent.";