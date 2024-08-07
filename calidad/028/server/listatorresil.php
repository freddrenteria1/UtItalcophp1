<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

include("conectar.php"); 
$conexion=conectar();

$cons = "SELECT * FROM os2234";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

// Creamos un instancia de la clase ZipArchive
$zip = new ZipArchive();
// Creamos y abrimos un archivo zip temporal
 $zip->open("torresilenciadora.zip",ZipArchive::CREATE);

while($obj = mysqli_fetch_object($ejec)){

    $tag = $obj->tag;

     // Añadimos un directorio
    $dir = $tag;
    $zip->addEmptyDir($dir);

    $doc =  json_decode($obj->doc);
    $cant = COUNT($doc);
    
    for($i=0; $i<$cant;$i++){

        $archivo = $doc[$i]->archivo;

        $myfile = "archivos/".$archivo;

        if(file_exists($myfile)){

            //Añadimos un archivo dentro del directorio que hemos creado
            $zip->addFile("archivos/".$archivo, $dir."/".$archivo);

            $lista[] = array(
                'tag'=>$tag,
                'archivo'=>$archivo
            );
            
        }
    }

}

// Una vez añadido los archivos deseados cerramos el zip.
$zip->close();
 // Creamos las cabezeras que forzaran la descarga del archivo como archivo zip.
 header("Content-type: application/octet-stream");
 header("Content-disposition: attachment; filename=torresilenciadora.zip");
 // leemos el archivo creado
 readfile('torresilenciadora.zip');
 // Por último eliminamos el archivo temporal creado
//  unlink('torresilenciadora.zip');//Destruye el archivo temporal

echo json_encode($lista);