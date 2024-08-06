<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$cadena = $fecha . '-';
$fecha = $_POST["fecha"];
$ods = $_POST["ods"];

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

    $query = "DELETE FROM asistencias Where fecha = '$fecha' And ods = '$ods'";
    $exito = mysqli_query($conexion, $query);

    $numeroDeFila = 1;

    while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {

        if ($numeroDeFila > 1) {

            
            if($fila[1] != ''){
                
                $turno = $fila[16];

                if($turno == 'D.DO' || $turno == 'D'  || $turno == 'DISP' || $turno == 'INC' || $turno == 'LIC.L' || $turno == 'LM' || $turno == 'PNR' || $turno == 'PR'  || $turno == 'REN' || $turno == 'REN' || $turno == 'REST' || $turno == 'TEST'){
                    $novedad = $fila[17];
                }else{
                    $novedad = '';
                }

                $sqlg = "INSERT INTO asistencias VALUES('','$fila[1]','$fila[2]','$fila[3]','$fila[4]','$fila[12]','$fila[11]','$fila[10]','$fila[13]','$fecha','$turno', $fila[19],'$fila[14]','$fila[22]','$fila[15]','$novedad','$ods')";
                $ejeg = mysqli_query($conexion, $sqlg);
        
                if(!$ejeg){
                    $msn =$sqlg;
                }
                
            }

        }

        # Aumentar el índice
     $numeroDeFila++;
          
    }

    # Al finar cerrar el gestor
    fclose($gestor);
}

$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);