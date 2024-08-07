<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


// Ruta donde se guardar?n las im?genes
$directorio = 'csv/';
// Recibo los datos de la imagen
$nombre = $_FILES['excel']['name'];
$tipo = $_FILES['excel']['type'];
$tamano = $_FILES['excel']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['excel']['tmp_name'],$directorio.$fecha.$nombre);
$excel=$fecha.$nombre;

$longitudDeLinea = 3000;
$delimitador = ";"; # Separador de columnas
$caracterCircundante = '"'; # A veces los valores son encerrados entre comillas
$nombreArchivo = $excel; #Ruta del archivo, en este caso está junto a este script

# Abrir el archivo
$gestor = fopen($directorio.$nombreArchivo, "r");
if (!$gestor) {
    $msn = "NO se puede abrir el archivo " . $nombreArchivo;
}

#  Comenzar a leer, $numeroDeFila es para llevar un índice
$numeroDeFila = 1;

$msn = 'Ok';


while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {
    
    if ($numeroDeFila > 1) {

                
        if($fila[0] != ''){

            if($fila[8]=='1'){
                $color = 'Azul';
            }else{
                $color = 'Rojo';
            }

            if($fila[10]=='1'){
                $estado = 'Aprobado';
            }else{
                $estado = 'Rechazado';
            }

            if($fila[12]=='1'){
                $mantenimiento = 'SI';
            }else{
                $mantenimiento = 'NO';
            }

            if($fila[14]=='1'){
                $partemetal = 'Conforme';
            }else{
                $partemetal = 'NO Conforme';
            }

            if($fila[16]=='1'){
                $partepasta = 'Conforme';
            }else{
                $partepasta = 'NO Conforme';
            }

            if($fila[18]=='1'){
                $partetextil = 'Conforme';
            }else{
                $partetextil = 'NO Conforme';
            }

            if($fila[20]=='1'){
                $indicadoresimpacto = 'Conforme';
            }else{
                $indicadoresimpacto = 'NO Conforme';
            }

            if($fila[22]=='1'){
                $costura = 'Conforme';
            }else{
                $costura = 'NO Conforme';
            }

            if($fila[24]=='1'){
                $estadofichatec = 'Conforme';
            }else{
                $estadofichatec = 'NO Conforme';
            }

            if($fila[26]=='1'){
                $estadogeneral = 'Conforme';
            }else{
                $estadogeneral = 'NO Conforme';
            }

            $componentes = array(
                'partemetal'=>$partemetal,
                'partepasta'=>$partepasta,
                'partetextil'=>$partetextil,
                'indicadoresimpacto'=>$indicadoresimpacto,
                'costura'=>$costura,
                'estadofichatec'=>$estadofichatec,
                'estadogeneral'=>$estadogeneral
            );

            if($fila[28]=='1'){
                $oxidometal = 'SI';
            }else{
                $oxidometal = 'NO';
            }

            if($fila[30]=='1'){
                $argollasimpactadas = 'SI';
            }else{
                $argollasimpactadas = 'NO';
            }

            if($fila[32]=='1'){
                $rupturapastas = 'SI';
            }else{
                $rupturapastas = 'NO';
            }

            if($fila[34]=='1'){
                $corrometal = 'SI';
            }else{
                $corrometal = 'NO';
            }

            if($fila[36]=='1'){
                $riatasimpactadas = 'SI';
            }else{
                $riatasimpactadas = 'NO';
            }

            if($fila[38]=='1'){
                $hebillasimpactadas = 'SI';
            }else{
                $hebillasimpactadas = 'NO';
            }

            if($fila[40]=='1'){
                $contactoquimicos = 'SI';
            }else{
                $contactoquimicos = 'NO';
            }

            if($fila[42]=='1'){
                $quemaduras = 'SI';
            }else{
                $quemaduras = 'NO';
            }

            if($fila[44]=='1'){
                $indicadorimpactado = 'SI';
            }else{
                $indicadorimpactado = 'NO';
            }

            $criterios = array(
                'oxidometal'=>$oxidometal,
                'argollasimpactadas'=>$argollasimpactadas,
                'rupturapastas'=>$rupturapastas,
                'corrometal'=>$corrometal,
                'riatasimpactadas'=>$riatasimpactadas,
                'hebillasimpactadas'=>$hebillasimpactadas,
                'contactoquimicos'=>$contactoquimicos,
                'quemaduras'=>$quemaduras,
                'indicadorimpactado'=>$indicadorimpactado
            );

            $componentes = json_encode($componentes);
            $criterios = json_encode($criterios);           

            $query = "INSERT INTO insp VALUES('', '$fila[3]', '$fila[1]','$fila[2]','$fila[4]','$fila[5]','$fila[6]','$fila[7]','$color','$estado','$mantenimiento','$componentes','$criterios','$fila[50]','','$fila[49]')";
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