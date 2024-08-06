<?php 
session_start();//Esto debes poner siempre que un fichero vallas a utilizar las $_SESSION

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


include("conectar.php");
$conexion=conectar();

$delimiter = ",";
$fecha = $_GET["fecha"];

$filename = "marcaciones_manuales.csv";

//create a file pointer
$f = fopen('php://memory', 'w');

//set column headers
$fields = array('Fecha', 'Hora', 'ID de Terminal', 'ID de usuario', 'Nombre', 'Documento', 'Clase', 'Modo', 'Tipo', 'Serial de tarjeta No', 'Resultado', 'Propiedad', 'Dispositivo externo', 'Coordinar');
fputcsv($f, $fields, $delimiter);


        
        $cons = "SELECT * FROM turnoscc";
        $exitoq = mysqli_query($conexion, $cons);

        while($fila = mysqli_fetch_object($exitoq)){

            $ced = $fila->ced;
            $hora = $fila->hora;

            $query = "SELECT * FROM trabajadores Where cedula='$ced'";
            $eje = mysqli_query($conexion, $query);

            $enc = mysqli_num_rows($eje);

            $obj = mysqli_fetch_object($eje);

                
            $id = $obj->id;
            $nombres = $obj->nombres . ' ' . $obj->apellidos;

            $modo = "Inicio";
            

            $lineData = array($fecha, $hora, 'Manual', $id, $nombres, $ced, 'Usuario', $modo, '1: N', '', 'Éxito', '1100', '', '0 / 0');
            fputcsv($f, $lineData, $delimiter);

        }
        


        //move back to beginning of file
fseek($f, 0);

//set headers to download file rather than displayed
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');

//output all remaining data on a file pointer
fpassthru($f);

exit;


?>