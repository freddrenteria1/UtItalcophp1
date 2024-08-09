<?php

include("conectar.php"); 
$conexion=conectar();

echo 'Comprimiendo...';


$sql="SELECT * FROM cedv";
$exito=mysqli_query($conexion, $sql);

$zip = new ZipArchive(); // Load zip library 
$zip_name = "formatosMonicaGab.zip"; // Nombre de Fichero ZIP

if ($zip->open($zip_name, ZipArchive::CREATE) === TRUE) {

    while($obj = mysqli_fetch_object($exito)){

        $ced = $obj->ced;

        echo "Ced: " . $ced;

        // $query="SELECT * FROM documentos WHERE doc = '$ced' AND clase = 'Paquete Certificados Laborales'";
        // $eje=mysqli_query($conexion, $query);

        // $enc = mysqli_num_rows($eje);

        // if($enc != 0){
        //     $row = mysqli_fetch_object($eje);

        //     $file_name = $row->file;

        //     // Agregamos ficheros al comprimido
        //     $zip->addFile("archivos/" . $file_name);

        // }

        // $query="SELECT * FROM documentos WHERE doc = '$ced' AND clase = 'Paquete Certificados Educativos'";
        // $eje=mysqli_query($conexion, $query);

        // $enc = mysqli_num_rows($eje);

        // if($enc != 0){
        //     $row = mysqli_fetch_object($eje);

        //     $file_name = $row->file;

        //     // Agregamos ficheros al comprimido
        //     $zip->addFile("archivos/" . $file_name);

        // }

        // $query="SELECT * FROM documentos WHERE doc = '$ced' AND clase = 'Paquete Documentos de Identidad'";
        // $eje=mysqli_query($conexion, $query);

        // $enc = mysqli_num_rows($eje);

        // if($enc != 0){
        //     $row = mysqli_fetch_object($eje);

        //     $file_name = $row->file;

        //     // Agregamos ficheros al comprimido
        //     $zip->addFile("archivos/" . $file_name);

        // }

       

        $query="SELECT * FROM documentos WHERE doc = '$ced' AND clase = 'Certificación cumplimiento de perfiles ECP GAB-F-214'";
        $eje=mysqli_query($conexion, $query);

        $enc = mysqli_num_rows($eje);

        if($enc != 0){
            $row = mysqli_fetch_object($eje);

            $file_name = $row->file;

            echo '<br>';

            echo $file_name;

            echo '<br>';

            // Agregamos ficheros al comprimido
            $zip->addFile("archivos/" . $file_name);

        }

        


    }


    // Cerramos la compresion
    $zip->close();
    // Declaramos una variable para mostrar mensaje 
    $resultado = "ok";
  } else {
    $resultado = "no";
  }

echo $resultado;

?>