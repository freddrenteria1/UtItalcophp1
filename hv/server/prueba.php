<?php
header('Content-type: application/json');
//header('Content-type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');



$data = '{"perfil":"Gestionar y realizar seguimiento al cumplimiento de la normatividad y legislación vigente relacionada con los El Sistemas de Gestión de Seguridad y Salud en el Trabajo (SG-SST), Realizar actividades de mantenimiento y mejora continua de los sistemas de gestión. Apoyar el programa de auditorías del sistema integrado de gestión y Plan HSE establecido aplicado por le cliente.","sitlabact":"Desempleado","proptransp":"NO"}';

echo $data;

$str = "Is your name O'Reilly?";

// Outputs: Is your name O\'Reilly?
echo addslashes($str);