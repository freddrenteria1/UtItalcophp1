<?php
date_default_timezone_set("America/Bogota");
$fechadia=date("Y-m-d");

$fecha = '2022-12-20';

$date1 = new DateTime($fecha);
$date2 = new DateTime($fechadia);

$diff = $date1->diff($date2);
// will output 2 days
echo $diff->days . ' días ';