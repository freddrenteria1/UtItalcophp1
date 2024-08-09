<?php

include("conectar.php"); 
$conexion=conectar();

$user = $_GET["user"];

$sql = "SELECT * FROM docprov WHERE user = '$user'";
$eje = mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($eje);


if($cont != 0){

   
//     // Creamos un instancia de la clase ZipArchive
//  $zip = new ZipArchive();
//  // Creamos y abrimos un archivo zip temporal
//   $zip->open("documentos.zip",ZipArchive::CREATE);
//   // Añadimos un directorio
  $dir = 'archivos/';
//   $zip->addEmptyDir($dir);
  // Añadimos un archivo en la raid del zip.
 //  $zip->addFile("imagen1.jpg","mi_imagen1.jpg");
  //Añadimos un archivo dentro del directorio que hemos creado

 


    $obj = mysqli_fetch_object($eje);

    echo 'Contador ' . $dir. $obj->file1;

    // $zip->addFile($dir. $obj->file1, $dir. $obj->file1);
    // $zip->addFile($dir. $obj->file2, $dir. $obj->file2);
    // $zip->addFile($dir. $obj->file3, $dir. $obj->file3);
    // $zip->addFile($dir. $obj->file4, $dir. $obj->file4);
    // $zip->addFile($dir. $obj->file5, $dir. $obj->file5);
    // $zip->addFile($dir. $obj->file6, $dir. $obj->file6);

    //  $zip->addFile("imagen2.jpg",$dir."/mi_imagen2.jpg");


//  // Una vez añadido los archivos deseados cerramos el zip.
//  $zip->close();
//  // Creamos las cabezeras que forzaran la descarga del archivo como archivo zip.
//  header("Content-type: application/octet-stream");
//  header("Content-disposition: attachment; filename=documentos.zip");
//  // leemos el archivo creado
//  readfile('documentos.zip');
//  // Por último eliminamos el archivo temporal creado
//  unlink('documentos.zip');//Destruye el archivo temporal

}
 

?>