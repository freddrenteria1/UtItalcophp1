<?php

include("conectar.php"); 
$conexion=conectar();

/*
    Ejemplo de lectura de CSV
    desde PHP
    Visita parzibyte.me/blog
*/
# La longitud máxima de la línea del CSV. Si no la sabes,
# ponla en 0 pero la lectura será un poco más lenta

$longitudDeLinea = 3000;
$delimitador = ";"; # Separador de columnas
$caracterCircundante = '"'; # A veces los valores son encerrados entre comillas
$nombreArchivo = "personal.csv"; #Ruta del archivo, en este caso está junto a este script

# Abrir el archivo
$gestor = fopen($nombreArchivo, "r");
if (!$gestor) {
    exit("No se puede abrir el archivo $nombreArchivo");
}

#  Comenzar a leer, $numeroDeFila es para llevar un índice
$numeroDeFila = 1;

echo 'Cargando.... un momento por favor...';

while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {
    
    if ($numeroDeFila > 1) {


        $query = "INSERT INTO personal VALUES('', '$fila[0]', '$fila[1]', '$fila[2]', '$fila[3]', '$fila[4]', '$fila[5]', '$fila[6]', '$fila[7]', '$fila[8]')";
        $eje = mysqli_query($conexion, $query);

    }
    
    # Aumentar el índice
    $numeroDeFila++;
}
# Al finar cerrar el gestor
fclose($gestor);

echo 'Finalizado... ' . $numeroDeFila . ' Registros almacenados...' ;