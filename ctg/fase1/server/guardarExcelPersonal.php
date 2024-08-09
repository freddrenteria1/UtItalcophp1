<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


// Ruta donde se guardar?n las im?genes
$directorio = './';
// Recibo los datos de la imagen
$nombre = $_FILES['listado']['name'];
$tipo = $_FILES['listado']['type'];
$tamano = $_FILES['listado']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['listado']['tmp_name'],$directorio.$nombre);
$excel=$nombre;

$longitudDeLinea = 3000;
$delimitador = ";"; # Separador de columnas
$caracterCircundante = '"'; # A veces los valores son encerrados entre comillas
$nombreArchivo = $excel; #Ruta del archivo, en este caso está junto a este script

# Abrir el archivo
$gestor = fopen($nombreArchivo, "r");
if (!$gestor) {
    $msn = "No se puede abrir el archivo " . $nombreArchivo;
}

#  Comenzar a leer, $numeroDeFila es para llevar un índice
$numeroDeFila = 1;

$msn = 'Realizado...';


while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {
    
    if ($numeroDeFila > 1) {

        if($fila[0] != ""){

            $buscar = "SELECT * FROM certificadofase1 WHERE documento = '$fila[0]'";
            $exito = mysqli_query($conexion, $buscar);

            $enc = mysqli_num_rows($exito);

            if($enc == 0){

                $query = "INSERT INTO certificadofase1 VALUES('', '', '$fila[0]', '$fila[1]', '', 0)";
                $eje = mysqli_query($conexion, $query);
        
                if(!$eje){
                    $msn = mysqli_error($conexion);
                }
                
            }


        }else{
            break;  
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