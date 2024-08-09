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

$msn = 'Ok';

//borra base de datos actual

$query = "TRUNCATE TABLE basetrab";
$ejeb = mysqli_query($conexion, $query);

while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {
    
    if ($numeroDeFila > 1) {

        if($fila[1] != ""){    

            $nombres = $fila[1] . ' ' . $fila[2];
            $ced = str_replace ( ".", '', $fila[3]);

            $sueldo = str_replace ( ".", '', $fila[16]);
            $sueldo = intval($sueldo);

            if($sueldo < 500000){
                $salario = $sueldo * 30;
            }else{
                $salario = $sueldo;
            }

             
                $finicio = $fila[20];
            

            
                $ffin = $fila[35];
             

             
            

            
            $query = "INSERT INTO basetrab VALUES('', '$fila[0]', '$nombres', '$ced', '$fila[12]', '$fila[14]', $salario, '$finicio', '$fila[21]', '$ffin', '$fila[22]')";
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