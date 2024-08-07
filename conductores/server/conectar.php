<?php

function conectar()

   {
	$servidor="localhost";
	$usuario="utitalco_admingen";
	$password="HwZK37b6N|8";
	$bd="utitalco_veh";

	$conexion=mysqli_connect($servidor,$usuario,$password,$bd);

	if (!$conexion)

	{
		echo"ERROR AL CONECTARCE CON EL SERVIDOR";
		exit();
	}
		mysqli_set_charset($conexion, "utf8");
     	return ($conexion);
   }

?>
