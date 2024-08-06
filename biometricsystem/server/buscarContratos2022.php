<meta charset="utf-8" />
<?php
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");


$per = 2022;


//Inicio de exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=contratos_$per.xls"); //Indica el nombre del archivo resultante
header("Pragma: no-cache");
header("Expires: 0");
echo '<table border="1">
          <thead>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Días</th>
            <th>Contratos</th>
          </thead>';


$query = "SELECT * FROM contratos Where YEAR(finicio) = $per GROUP BY documento";
$eje = mysqli_query($conexion, $query);

while($row = mysqli_fetch_object($eje)){

    $doc = $row->documento;

    $sql = "SELECT * FROM contratos WHERE documento = '$doc' AND YEAR(finicio) = $per";
    $cons = mysqli_query($conexion, $sql);

    $dias = 0;
    $contratos = '';
    $tipo = '';
    $tiempo = 0;

    while($obj =  mysqli_fetch_object($cons)){

        $inicio =$obj->finicio;
        $fin = $obj->ffin;

        if($fin == '0000-00-00'){
          $fin = $fecha;
        }

        $datetime1 = date_create($inicio);
        $datetime2 = date_create($fin);

        $contador = date_diff($datetime2, $datetime1);

        //$dias += $contador;

        $differenceFormat = '%a';

        $dias += $contador->format($differenceFormat);
        $d = $contador->format($differenceFormat);

        $contratos .= $obj->contrato . ' - '  . $obj->finicio . ' - '  . $obj->ffin  . ' - '  .  $obj->cargo .  ' - Días:  '  . $d  . '<br>';
        $tipo .=  $obj->tipo . '<br>';
        $tiempo .=  $d  . '<br>';

    }

    // $datos[] = array(
    //     'doc'=>$row->documento,
    //     'nombres'=>$row->nombres .  ' ' . $row->apellidos,
    //     'contratos'=>$contratos,
    //     'dias'=>$dias
        
    // );

    echo '<tr>
            <td>'.$row->documento.'</td>
            <td>'.$row->nombres .  ' ' . $row->apellidos.'</td>
            <td>'.$dias.'</td>
            <td>'.$contratos.'</td>
            <td>'.$tipo.'</td>
            <td>'.$tiempo.'</td>
        </tr>';


}

// echo json_encode($datos);