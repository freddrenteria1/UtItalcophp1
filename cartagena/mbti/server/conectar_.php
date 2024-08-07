<?php

function conectar()

   {
	$servidor="localhost";
	$usuario="u602935505_italco";
	$password='U?4Iy|jQdw';
	$bd="u602935505_italco";

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
