<?php
header('Access-Control-Allow-Origin: *');


include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

setlocale(LC_ALL,"es_ES");

$frente = $_GET["frente"];
$ods = $_GET["ods"];

$directos = 0;
$indirectos = 0;

echo '<h1>Cargando datos...</h1>';

$query = "SELECT * FROM trabajadores Where ods='$ods' AND frentetrab = '$frente' AND estado = 'Activo'";
$ejeq = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($ejeq)){
    $idtrab = $obj->id;
    $cedtrab = $obj->cedula;
    $fechainicio = $obj->fingreso;
    $turno = $obj->turno;

    $color = '#EDBDFF';

        $color = '';

        if($turno == 'F'){
            $fechabuscar = date("Y-m-d",strtotime($fecha."- 1 days"));
        }else{
            $fechabuscar = $fecha;
        }

        $cantdias = 15;
        $contador = 0;       
    
        for($i=0; $i<$cantdias; $i++){

            $cons = "SELECT * FROM marcaciones Where fecha = '$fechabuscar' AND doc='$idtrab' AND tipo='Entrada'";
            $eje = mysqli_query($conexion, $cons);
            $enc = mysqli_num_rows($eje);
            if($enc != 0){
                $contador++;
            }else{
                // $contador=0;
                break;
            }
            
            $fechabuscar = date("Y-m-d",strtotime($fechabuscar."- 1 days"));
             
        }


    if($contador >= 6){
        $color = '#F9A65C';
    }


    $datos[] = array(
        'idtrab'=>$idtrab,
        'ced'=>$cedtrab,
        'nombres'=>$obj->nombres . ' ' . $obj->apellidos,
        'fingreso'=>$obj->fingreso,
        'dias'=>$contador,
        'color'=>$color
    );



}

$html = '<h4 class="mt-3">Personal ODS ' .  $ods .' </h4>';
$html .= '<table class="table table-striped"><thead>';
$html .= '<th>DOCUMENTO</th>';
$html .= '<th>TRABAJADOR</th>';
$html .= '<th>CARGO</th>';
$html .= '<th>INGRESO</th>';
$html .= '<th>FRENTE</th>';
$html .= '<th>DIAS ACUM</th>';
$html .= '</tdead>';
$html .= '<tbody>';

$canreg = count($datos);

for($i = 0; $i<$canreg; $i++){

    $html .= '<tr style="background-color: '. $datos[$i]["color"] . ';">';
    $html .= '<td>'  . $datos[$i]['ced'] . '</td>';
    $html .= '<td>'  . $datos[$i]['nombres'] . '</td>';
    $html .= '<td>'  . $datos[$i]['cargo'] . '</td>';
    $html .= '<td>'.$frente.'</td>';
    $html .= '<td>'  . $datos[$i]['fingreso'] . '</td>';
    $html .= '<td class="text-center">'  . $datos[$i]['dias'] . '</td>';
    $html .= '</tr>';

}

$html .= '</tbody>';
$html .= '</table>';



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Descansos</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">

    <style>
        body{
            font-size: 12px;
        }
    </style>

</head>
<body>
    <div id="tablarep" class="m-2">
        <?= $html ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>
    <!--<link rel="stylesheet" href="https://code.highcharts.com/css/themes/dark-unica.css"> -->
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/cylinder.js"></script>
    <script src="https://code.highcharts.com/modules/funnel3d.js"></script>
    <script src="https://code.highcharts.com/modules/pyramid3d.js"></script>
    <!-- <script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.svg.js"></script>

</body>
</html>