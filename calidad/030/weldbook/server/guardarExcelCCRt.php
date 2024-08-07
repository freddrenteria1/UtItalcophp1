<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d h:m:s");

$user = $_POST["user"];

// Ruta donde se guardar?n las im?genes
$directorio = 'csv/';
// Recibo los datos de la imagen
$nombre = $_FILES['excel']['name'];
$tipo = $_FILES['excel']['type'];
$tamano = $_FILES['excel']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['excel']['tmp_name'],$directorio.$nombre);
$excel=$nombre;

$longitudDeLinea = 15000;
$delimitador = ";"; # Separador de columnas
$caracterCircundante = '"'; # A veces los valores son encerrados entre comillas
$nombreArchivo = $excel; #Ruta del archivo, en este caso está junto a este script

# Abrir el archivo
$gestor = fopen($directorio.$nombreArchivo, "r");
if (!$gestor) {
    $msn = "No se puede abrir el archivo " . $nombreArchivo;
}

#  Comenzar a leer, $numeroDeFila es para llevar un índice
$numeroDeFila = 0;
$contb = 0;

$msn = 'Realizado...';

while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {
    
    if ($numeroDeFila > 7) {

        if($contb == 0){
            $sql = "DELETE FROM ccrt";
            $exit = mysqli_query($conexion, $sql);
            
            $contb++;
        } 

       
        $cons = $fila[0];
    
        if($cons != ''){
            $tempcons = $cons;
        }else{
            $cons = $tempcons;
        }

        $numrt = $fila[1];
    
        if($numrt != ''){
            $tempnumrt = $numrt;
        }else{
            $numrt = $tempnumrt;
        }

        $estrt = trim($fila[2]);
    
        if($estrt != ''){
            $tempestrt = $estrt;
        }else{
            $estrt = $tempestrt;
        }

        $esp = $fila[3];
    
        if($esp != ''){
            $tempesp = $esp;
        }else{
            $esp = $tempesp;
        }

        $equipo = $fila[5];
    
        if($equipo != ''){
            $tempequipo = $equipo;
        }else{
            $equipo = $tempequipo;
        }
        
        $comp = $fila[6];
    
        if($comp != ''){
            $tempcomp = $comp;
        }else{
            $comp = $tempcomp;
        }

        $estdiag = trim($fila[15]);
     

        if($fila[4] != ''){

            $query = "INSERT INTO ccrt VALUES('', '$cons', '$numrt', '$estrt', '$esp', '$fila[4]', '$equipo', '$comp', '$fila[7]', '$fila[8]', '$fila[9]', '$fila[10]', '$fila[11]', '$fila[12]', '$fila[13]', '$fila[14]', '$estdiag', '$fila[16]', '$fila[17]', '$fila[18]', '$fila[19]', '$fila[20]', '$fila[21]', '$fila[22]', '$fila[23]', '$fila[24]')";
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

$sql = "INSERT INTO bitacoraccrt VALUES('', '$user', '$fecha', '$excel')";
$exito = mysqli_query($conexion, $sql);


$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);