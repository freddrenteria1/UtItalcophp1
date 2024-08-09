<?php

function conectar()

   {
	$servidor="localhost";
	$usuario="u141293123_utitalco";
	$password="HwZK37b6N|8";
	$bd="u141293123_utitalco";

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
