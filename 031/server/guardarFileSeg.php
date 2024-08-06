<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$archivo = $_POST["archivo"];
$fecha = $_POST["fecha"];
$semana = $_POST["semana"];

// Ruta donde se guardar?n las im?genes
$directorio = 'archivos/';
// Recibo los datos de la imagen
$nombre = $_FILES['archivo']['name'];
$tipo = $_FILES['archivo']['type'];
$tamano = $_FILES['archivo']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['archivo']['tmp_name'],$directorio.$nombre);
$nombreArchivo=$nombre;

$longitudDeLinea = 15000;
$delimitador = ";"; # Separador de columnas
$caracterCircundante = '"'; # A veces los valores son encerrados entre comillas

# Abrir el archivo
$gestor = fopen($directorio.$nombreArchivo, "r");
if (!$gestor) {
    $msn = "No se puede abrir el archivo " . $nombreArchivo;
}

#  Comenzar a leer, $numeroDeFila es para llevar un índice
$numeroDeFila = 1;
$contb = 0;


$msn = 'Ok';


$sql = "DELETE FROM ordenmant Where semana = $semana";
$exito = mysqli_query($conexion, $sql);



while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {
    
    if($numeroDeFila >= 8){

    
        if($fila[3] != ''){

            $query = "INSERT INTO ordenmant VALUES('', '$fila[11]', $semana, '$fila[6]', '$fila[8]', '$fila[2]', '$fila[13]', '$fila[7]', '$fila[9]', '$fila[12]',  '$fila[14]', '$fila[1]', '$fila[5]')";
            $eje = mysqli_query($conexion, $query);
    
            if(!$eje){
                $msn = mysqli_error($conexion);
            }
            
        }

    }

    
    
    # Aumentar el índice
    $numeroDeFila++;
}


# Al finar cerrar el gestor
fclose($gestor);




$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);