<?php
//header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
//$fecha=date("Y-m-d");

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
    $numeroDeFila = 1;

    //borra todas las marcaciones de la fecha
    $borrar = "DELETE FROM marcaciones Where fecha='$fecha' and terminal != 'Manual'";
    $ejeb2 = mysqli_query($conexion, $borrar);

    $buscart = "SELECT * FROM codturnos order by turno";
    $ejeb = mysqli_query($conexion, $buscart);

    while($row = mysqli_fetch_object($ejeb)){
        $turnos[] = array(
            'turno'=>$row->turno,
            'entrada'=>$row->entrada,
            'salida'=>$row->salida
        );
    }

    $cantturnos = count($turnos);

    while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {

        if ($numeroDeFila > 1) {
            
            if($fila[0] != ''){

                $idtrab = intval($fila[0]);

                $sql = "SELECT * FROM trabajadores Where id=$idtrab";
                $ejes = mysqli_query($conexion, $sql);

                $obj = mysqli_fetch_object($ejes);
                $turno = $obj->turno;

                for($i=0; $i<$cantturnos; $i++){
                    if($turno == $turnos[$i]["turno"]){
                        $entrada = $turnos[$i]["entrada"];
                        $salida = $turnos[$i]["salida"];
                    }
                }

                $hentradat=new DateTime($entrada);
                $hsalidat=new DateTime($salida);

                $fecha = $fila[6];
                $hora = $fila[7];
                $horamarca = new DateTime($hora);

                $tipom = $fila[8];

                $difhoras = $hentradat->diff($horamarca);
                $horas = $difhoras->format('%H');
                $canth = intval($horas);

                if($canth <= 2){
                    $tipo = 'Entrada';
                }else{
                    $tipo = 'Salida';
                }

                $query = "INSERT INTO marcaciones VALUES('', '$fila[0]', '$fila[1]','$fecha','$hora','$tipo','$fila[11]')";
                $eje = mysqli_query($conexion, $query);

                if(!$eje){
                    $msn = mysqli_error($conexion);
                }else{
                    $totalcarg++;
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
    'msn' => $msn,
    'totalcarg' => $totalcarg
);
 
echo json_encode($datos);