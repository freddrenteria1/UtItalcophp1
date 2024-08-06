<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$fecha = $_POST["fecha"];
$turno = $_POST["turno"];
$personal = $_POST["personal"];
$observaciones = $_POST["observaciones"];


$cadena = 'permisostrab' . $ods . $fecha;

// Ruta donde se guardar?n las im?genes
$directorio = './';
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
$gestor = fopen($nombreArchivo, "r");
if (!$gestor) {
    $msn = "No se puede abrir el archivo " . $nombreArchivo;
}

#  Comenzar a leer, $numeroDeFila es para llevar un índice
$numeroDeFila = 1;

$msn = 'Realizado...';

//echo 'Cargando.... un momento por favor...';
$sql = "DELETE FROM permisostrab WHERE ods='$ods' AND fecha='$fecha' AND turno='$turno'";
$exito = mysqli_query($conexion, $sql);

$sql = "DELETE FROM observacionespermisos WHERE ods='$ods' AND fecha='$fecha' AND turno='$turno'";
$exito = mysqli_query($conexion, $sql);

while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {
    
    if ($numeroDeFila > 1) {

        $num = intval($fila[0]);

        if($num != 0){

            $pfrio = intval($fila[2]);
            $pcaliente = intval($fila[3]);
            $pelectrico = intval($fila[4]);
    
            $raml = intval($fila[13]);
            $ramm = intval($fila[14]);
            $ramh = intval($fila[15]);
            $ramvh = intval($fila[16]);
    
            $ca1 = intval($fila[17]);
            $ca2 = intval($fila[18]);
            $ca3 = intval($fila[19]);
            $ca5 = intval($fila[20]);
            $ca6 = intval($fila[21]);
            $ca7 = intval($fila[22]);
            $sas = intval($fila[23]);
            $saes = intval($fila[24]);
    
            $pra = intval($fila[25]);
            $prc = intval($fila[26]);
            $prg = intval($fila[27]);
    
            $cvias = intval($fila[28]);
            $pizaje = intval($fila[29]);
            $agua = intval($fila[30]);
            $prevalidados = intval($fila[31]);
            $pnuevos = intval($fila[32]);
            $pcerrados = intval($fila[33]);
            $numpcerrado = intval($fila[34]);
            $personas = intval($fila[35]);


            $det = $fila[5];

            $det = str_replace("'", "", $det);
    
            $query = "INSERT INTO permisostrab VALUES('', $num, '$fila[1]', $pfrio, $pcaliente, $pelectrico,'$det','$fila[6]','$fila[7]', '$fila[8]', '$fila[9]', '$fila[10]', '$turno','$fila[12]', $raml, $ramm, $ramh, $ramvh, $ca1, $ca2, $ca3, $ca5, $ca6, $ca7, $sas, $saes, $pra, $prc, $prg, $cvias, $pizaje, $agua, $prevalidados, $pnuevos, $pcerrados, $numpcerrado, $personas, '$fecha', '$ods', '$fila[36]', '$fila[37]')";
            $eje = mysqli_query($conexion, $query);
    
            if(!$eje){
                $msn = mysqli_error($conexion);
            }

            $buscar = "SELECT * FROM infpermisos WHERE numper = $num AND ods = '$ods' AND frente = '$fila[12]'";
            $eje = mysqli_query($conexion, $buscar);

            $enc = mysqli_num_rows($eje);

            if($eje != 0){
                $query = "INSERT INTO infpermisos VALUES('', $num, '$ods', '$fila[12]', '$fila[36]', '$fila[37]', '')";
                $eje = mysqli_query($conexion, $query);
            }else{
                $query = "UPDATE infpermisos SET estado =  '$fila[36]', fecha = '$fecha' WHERE numper = $num AND ods = '$ods' AND frente = '$fila[12]'";
                $eje = mysqli_query($conexion, $query);
            }

        }

    }
    
    # Aumentar el índice
    $numeroDeFila++;
}
# Al finar cerrar el gestor
fclose($gestor);

$sql = "INSERT INTO observacionespermisos VALUES('', '$fecha', '$observaciones', $personal, '$ods', '$turno')";
$exito = mysqli_query($conexion, $sql);

if(!$exito){
    //$msn = mysqli_error($conexion);
    $msn = $sql;
}


$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);