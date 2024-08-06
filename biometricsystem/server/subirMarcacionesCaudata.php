<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$cadena = $fecha . '-';
$fecha = $_POST["fecha"];

// Ruta donde se guardar?n las im?genes
$directorio = 'csv/';
// Recibo los datos de la imagen
$nombre = $_FILES['excel']['name'];
$tipo = $_FILES['excel']['type'];
$tamano = $_FILES['excel']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['excel']['tmp_name'],$directorio.$cadena.$nombre);
$excel=$cadena.$nombre;

$longitudDeLinea = 3000;
$delimitador = ";"; # Separador de columnas
$caracterCircundante = '"'; # A veces los valores son encerrados entre comillas
$nombreArchivo = $excel; #Ruta del archivo, en este caso está junto a este script

# Abrir el archivo
$gestor = fopen($directorio.$nombreArchivo, "r");
if (!$gestor) {
    $msn = "No se puede abrir el archivo " . $nombreArchivo;
}else{
    #  Comenzar a leer, $numeroDeFila es para llevar un índice
    $msn = 'Ok';
    $cont = 0;

    while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {
            
            if($fila[0] != ''){

                
                $fecha = $fila[0];
                $hora = $fila[1];
                $tipo = $fila[7];

                $ced = $fila[5];
            
                $sqlb = "SELECT * FROM trabajadores Where cedula = '$ced'";
                $ejeb = mysqli_query($conexion, $sqlb);
                $cantb = mysqli_num_rows($ejeb);

                if($cantb != 0){
                    $row = mysqli_fetch_object($ejeb);
                    $doc = $row->id;

                    // $borrar = "DELETE FROM marcaciones Where fecha='$fecha' AND doc = '$doc' And tipo = '$tipo'";
                    // $ejeb = mysqli_query($conexion, $borrar);
    
                    $query = "INSERT INTO marcaciones VALUES('', '$doc', '$fila[4]','$fecha','$hora','$tipo','$fila[2]')";
                    $eje = mysqli_query($conexion, $query);
    
                    if(!$eje){
                        $msn = mysqli_error($conexion);
                    }else{
                        $cont++;
                    }
                }

               
                
            }
          
    }

    # Al finar cerrar el gestor
    fclose($gestor);
}

$datos = array(
    'msn' => $msn,
    'cant'=>$cont
);
 
echo json_encode($datos);