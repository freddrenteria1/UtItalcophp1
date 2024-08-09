<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

include("conectar.php"); 
$conexion=conectar();

// Creamos un instancia de la clase ZipArchive
$zip = new ZipArchive();
// Creamos y abrimos un archivo zip temporal
 $zip->open("torres.zip",ZipArchive::CREATE);

$cons = "SELECT * FROM os2702";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

while($obj = mysqli_fetch_object($ejec)){

    $tag = $obj->tag;

     // Añadimos un directorio
    $dir = $tag;
    $zip->addEmptyDir($dir);

    $doc =  json_decode($obj->doc);
    $cant = COUNT($doc);
    
    for($i=0; $i<$cant;$i++){

        $archivo = $doc[$i]->archivo;

         //Añadimos un archivo dentro del directorio que hemos creado
        $zip->addFile("archivos/".$archivo, $dir."/".$archivo);

        $lista[] = array(
            'tag'=>$tag,
            'archivo'=>$archivo
        );
    }

}

$cons = "SELECT * FROM os2703";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

while($obj = mysqli_fetch_object($ejec)){

    $tag = $obj->tag;

     // Añadimos un directorio
    $dir = $tag;
    $zip->addEmptyDir($dir);

    $doc =  json_decode($obj->doc);
    $cant = COUNT($doc);
    
    for($i=0; $i<$cant;$i++){

        $archivo = $doc[$i]->archivo;

         //Añadimos un archivo dentro del directorio que hemos creado
        $zip->addFile("archivos/".$archivo, $dir."/".$archivo);

        $lista[] = array(
            'tag'=>$tag,
            'archivo'=>$archivo
        );
    }

}

// Una vez añadido los archivos deseados cerramos el zip.
$zip->close();
 // Creamos las cabezeras que forzaran la descarga del archivo como archivo zip.
 header("Content-type: application/octet-stream");
 header("Content-disposition: attachment; filename=torres.zip");
 // leemos el archivo creado
 readfile('torres.zip');
 // Por último eliminamos el archivo temporal creado
 unlink('torres.zip');//Destruye el archivo temporal

echo json_encode($lista);