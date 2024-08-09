<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$ruta = './archivos/';

// Se comprueba que realmente sea la ruta de un directorio
if (is_dir($ruta)){
    // Abre un gestor de directorios para la ruta indicada
    $gestor = opendir($ruta);

    // Recorre todos los elementos del directorio
    while (($archivo = readdir($gestor)) !== false)  {
            
        $ruta_completa = $ruta . "/" . $archivo;

        // Se muestran todos los archivos y carpetas excepto "." y ".."
        if ($archivo != "." && $archivo != "..") {
            // Si es un directorio se recorre recursivamente
            if (is_dir($ruta_completa)) {
                $datos[] = array(
                    'archivo'=>$archivo
                );
                 
                obtener_estructura_directorios($ruta_completa);
            } else {
                $datos[] = array(
                    'archivo'=>$archivo
                );
            }
        }
    }
    
    // Cierra el gestor de directorios
    closedir($gestor);
     
} else {
    echo "No es una ruta de directorio valida<br/>";
}

echo json_encode($datos);