<?php

function conectar()

   {
	$servidor="localhost";
	$usuario="utitalco_caladmin";
	$password="@Aa3142141645";
	$bd="utitalco_cal030";

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
