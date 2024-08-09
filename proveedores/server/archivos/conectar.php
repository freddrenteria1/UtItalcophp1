<?php

function conectar()

   {
	$servidor="localhost";
	$usuario="u141293123_gbien";
	$password="@Aa3142141645";
	$bd="u141293123_gbien";

	$conexion=mysqli_connect($servidor,$usuario,$password,$bd);

	if (!$conexion)

	{
		echo"ERROR AL CONECTARCE CON EL SERVIDOR";
		exit();
	}
     	return ($conexion);
   }

?>