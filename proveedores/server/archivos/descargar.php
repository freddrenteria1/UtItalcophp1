<?php

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

   
// Creamos un instancia de la clase ZipArchive
$zip = new ZipArchive();
// // Creamos y abrimos un archivo zip temporal
// $zip->open("documentos.zip",ZipArchive::CREATE);
// Añadimos un directorio
//   $dir = 'archivos/';
//   $zip->addEmptyDir($dir);
// Añadimos un archivo en la raid del zip.

//  $zip->addFile("imagen1.jpg","mi_imagen1.jpg");

//Añadimos un archivo dentro del directorio que hemos creado

$user = $_GET["user"];

$sqlc = "SELECT * FROM datosprov WHERE user = '$user'";
$ejec = mysqli_query($conexion, $sqlc);

$row = mysqli_fetch_object($ejec);

$emp = $row->razon;

// Creamos y abrimos un archivo zip temporal
$zip->open($emp.".zip",ZipArchive::CREATE);

$sql = "SELECT * FROM docprov WHERE user = '$user'";
$eje = mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($eje);

if($cont != 0){

    $obj = mysqli_fetch_object($eje);

    $zip->addFile($obj->file1,  $obj->file1);
    $zip->addFile($obj->file2,  $obj->file2);
    $zip->addFile($obj->file3,  $obj->file3);
    $zip->addFile($obj->file4,  $obj->file4);
    $zip->addFile($obj->file5,  $obj->file5);
    $zip->addFile($obj->file6,  $obj->file6);

}

$sql = "SELECT * FROM anexoa WHERE user = '$user'";
$eje = mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($eje);

if($cont != 0){
    $obj = mysqli_fetch_object($eje);

    $zip->addFile($obj->archivo,  $obj->archivo);

}

$sql = "SELECT * FROM anexob WHERE user = '$user'";
$eje = mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($eje);

if($cont != 0){
    
    while($obj = mysqli_fetch_object($eje)){

        $zip->addFile($obj->archivo,  $obj->archivo);

    }
}
 

//  $zip->addFile("imagen2.jpg",$dir."/mi_imagen2.jpg");
// Una vez añadido los archivos deseados cerramos el zip.
$zip->close();
// Creamos las cabezeras que forzaran la descarga del archivo como archivo zip.
header("Content-type: application/octet-stream");
header("Content-disposition: attachment; filename=".$emp.".zip");
// leemos el archivo creado
readfile($emp.'.zip');
// Por último eliminamos el archivo temporal creado
unlink($emp.'.zip');//Destruye el archivo temporal

?>