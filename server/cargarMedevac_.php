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
$nombreArchivo = "medevaccompleto.csv"; #Ruta del archivo, en este caso está junto a este script

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

        $doc = $fila[3];

        $buscar = "SELECT * FROM medevaccomp WHERE documento = '$doc'";
        $exito = mysqli_query($conexion, $buscar);
        $enc = mysqli_num_rows($exito);

        if($enc == 0){
            $query = "INSERT INTO medevaccomp VALUES('', '$fila[0]', '$fila[1]', '$fila[2]', '$fila[3]', '$fila[4]', '$fila[5]', '$fila[6]', '$fila[7]', '$fila[8]', '$fila[9]', '$fila[10]', '$fila[11]', '$fila[12]', '$fila[13]', '$fila[14]', '$fila[15]', '$fila[16]', '$fila[17]', '$fila[18]', '$fila[19]')";
            $eje = mysqli_query($conexion, $query);
        }


    }
    
    # Aumentar el índice
    $numeroDeFila++;
}
# Al finar cerrar el gestor
fclose($gestor);

echo 'Finalizado... ' . $numeroDeFila . ' Registros almacenados...' ;