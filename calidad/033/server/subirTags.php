<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
header("Content-Type: text/html;charset=utf-8");

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$cadena = $fecha . '-';

// Ruta donde se guardar?n las im?genes
$directorio = 'csv/';
// Recibo los datos de la imagen
$nombre = $_FILES['excel']['name'];
$tipo = $_FILES['excel']['type'];
$tamano = $_FILES['excel']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['excel']['tmp_name'],$directorio.$cadena.$nombre);
$excel=$directorio.$cadena.$nombre;

$longitudDeLinea = 3000;
$delimitador = ";"; # Separador de columnas
$caracterCircundante = '"'; # A veces los valores son encerrados entre comillas
$nombreArchivo = $excel; #Ruta del archivo, en este caso está junto a este script

//$nombreArchivo = 'tags.csv';

# Abrir el archivo
$gestor = fopen($nombreArchivo, "r");
if (!$gestor) {
    $msn = "No se puede abrir el archivo " . $nombreArchivo;
}else{
    #  Comenzar a leer, $numeroDeFila es para llevar un índice
    $msn = 'Datos importados correctamente!!!';
    $numeroDeFila = 1;

    while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {

        if ($numeroDeFila > 1) {
            
            if($fila[0] != ''){

                unset($datos);

                $busqueda = "SELECT * FROM tags WHERE ods='024' AND lazo='$fila[0]' AND tag = '$fila[4]'";
                $ejeb = mysqli_query($conexion, $busqueda);
                $cont = mysqli_num_rows($ejeb);

                if($cont == 0){
                    $query = "INSERT INTO tags VALUES('', '024', 'U-2700', 'UOP I', 'TUBERÍA', 'PUNTOS DE INSPECCIÓN', 'ALISTAMIENTO', '$fila[0]', '$fila[4]', 'OS114')";
                    $eje = mysqli_query($conexion, $query);
                }

                // if(!$eje){
                //     $msn = mysqli_error($conexion);
                // }else{
                //     $totalcarg++;
                // }

                if($fila[5] != ""){
                    $datos[] = array(
                        'cml'=>$fila[5],
                        'accesorio'=>$fila[6],
                        'okna'=>''
                    );
                }

                if($fila[7] != ""){
                    $datos[] = array(
                        'cml'=>$fila[7],
                        'accesorio'=>$fila[8],
                        'okna'=>''
                    );
                }
                

                if($fila[9] != ""){
                    $datos[] = array(
                        'cml'=>$fila[9],
                        'accesorio'=>$fila[10],
                        'okna'=>''
                    );
                }
                

                if($fila[11] != ""){
                    $datos[] = array(
                        'cml'=>$fila[11],
                        'accesorio'=>$fila[12],
                        'okna'=>''
                    );
                }
                

                if($fila[13] != ""){
                    $datos[] = array(
                        'cml'=>$fila[13],
                        'accesorio'=>$fila[14],
                        'okna'=>''
                    );
                }
                

                if($fila[15] != ""){
                    $datos[] = array(
                        'cml'=>$fila[15],
                        'accesorio'=>$fila[16],
                        'okna'=>''
                    );
                }
                

                if($fila[17] != ""){
                    $datos[] = array(
                        'cml'=>$fila[17],
                        'accesorio'=>$fila[18],
                        'okna'=>''
                    );
                }
                
                if($fila[19] != ""){
                    $datos[] = array(
                        'cml'=>$fila[19],
                        'accesorio'=>$fila[20],
                        'okna'=>''
                    );
                }
                
                if($fila[21] != ""){
                    $datos[] = array(
                        'cml'=>$fila[21],
                        'accesorio'=>$fila[22],
                        'okna'=>''
                    );
                }
                
                if($fila[23] != ""){
                    $datos[] = array(
                        'cml'=>$fila[5],
                        'accesorio'=>$fila[23],
                        'okna'=>''
                    );
                }
                
                if($fila[25] != ""){
                    $datos[] = array(
                        'cml'=>$fila[25],
                        'accesorio'=>$fila[26],
                        'okna'=>''
                    );
                }
                
                if($fila[27] != ""){
                    $datos[] = array(
                        'cml'=>$fila[27],
                        'accesorio'=>$fila[28],
                        'okna'=>''
                    );
                }
                
                if($fila[29] != ""){
                    $datos[] = array(
                        'cml'=>$fila[29],
                        'accesorio'=>$fila[30],
                        'okna'=>''
                    );
                }
                
                $cmls = json_encode($datos);
                // echo $cmls;
                //echo json_encode($datos);

                $busqueda2 = "SELECT * FROM os114 WHERE ods='024' AND isometrico = '$fila[4]' AND lazo_corrosion ='$fila[0]'";
                $ejeb2 = mysqli_query($conexion, $busqueda2);
                $cont2 = mysqli_num_rows($ejeb2);

                if($cont2 == 0){
                    $query2 = "INSERT INTO os114 VALUES('', 'U-2700', '', 'UOP I', '024', '$fila[4]', '$fila[0]', '$cmls', '', '', '', '')";
                    $eje = mysqli_query($conexion, $query2);
                }else{
                    $query2 = "UPDATE os114 SET cml_inspeccionados = '$cmls' WHERE ods='024' AND lazo_corrosion = '$fila[0]' AND isometrico = '$fila[4]'";
                    $eje = mysqli_query($conexion, $query2);
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
 
echo json_encode($msn);