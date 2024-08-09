<?php

function conectar()

   {
	$servidor="localhost";
	$usuario="utitalco_vcfadmin";
	$password="I&z8+j$&aHz";
	$bd="utitalco_vcf";

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
