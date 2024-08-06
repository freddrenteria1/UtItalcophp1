<?php


	$servidor="localhost";
	$usuario="utitalco_admingen";
	$password="HwZK37b6N|8";
	$bd="utitalco_general";

	$conexion=mysqli_connect($servidor,$usuario,$password,$bd);

	if (!$conexion)

	{
		echo"ERROR AL CONECTARCE CON EL SERVIDOR";
		
	}
		mysqli_set_charset($conexion, "utf8");
        echo"OK CONECTARCE CON EL SERVIDOR";

?>
