<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

function conectar()

   {
	$servidor="localhost";
	$usuario="utitalco_admingen";
	$password="HwZK37b6N|8";
	$bd="utitalco_general";

	$conexion=mysqli_connect($servidor,$usuario,$password,$bd);

	if (!$conexion)

	{
		echo"ERROR AL CONECTARCE CON EL SERVIDOR";
		exit();
	}
		mysqli_set_charset($conexion, "utf8");
     	return ($conexion);
   }

$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$fecha = $_POST["fecha"];


//$semana = $_GET["semana"];


$sql="SELECT * FROM personaldiario WHERE fecha = '$fecha' AND ods = '031'";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant != 0){

    while($obj = mysqli_fetch_object($exito)){

        $pdir+= $obj->pdir;
        $pindir += $obj->pindir;
    
    }

    $totp = $pdir + $pindir;

    $personal = array(
        'pdir'=>$pdir,
        'pindir'=>$pindir,
        'totp'=>$totp
    );

}

$sql="SELECT * FROM permisostrab WHERE fecha = '$fecha' AND ods LIKE '%031%' GROUP BY  num";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant != 0){

    while($obj = mysqli_fetch_object($exito)){

        if(trim($obj->estado) == 'ABIERTO'){

            $pabiertos++;

        }

        if(trim($obj->estado) == 'CERRADO'){

            $pcerrados++;

        }

         
    
    }

    $permisos = array(
        'pabiertos'=>$pabiertos,
        'pcerrados'=>$pcerrados,
        'totp'=>$cant
    );

}

$datos = array(
    'personal'=>$personal,
    'permisos'=>$permisos
);

echo json_encode($datos);