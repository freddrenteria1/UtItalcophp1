<?php 
// header('Content-type: application/json');
// header('Access-Control-Allow-Origin: *');

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


include("conectar.php");
$conexion=conectar();

$finicio = $_GET["finicio"];
$ffin = $_GET["ffin"];

// //Inicio de exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=marcaciones_$fecha.xls"); //Indica el nombre del archivo resultante
header("Pragma: no-cache");
header("Expires: 0");
echo '<table border="1">
          <thead>
            <th>DOCUMENTO</th>
            <th>NOMBRES</th>
            <th>FECHA</th>
            <th>HORA</th>
            <th>TIPO</th>
            <th>TERMINAL</th>
          </thead>';

            $sql = "SELECT * FROM marcaciones Where fecha  between '$finicio' AND '$ffin' GROUP BY fecha, doc, tipo";
            $exito = mysqli_query($conexion, $sql);

                while($rowm = mysqli_fetch_object($exito)){

                    $docm = $rowm->doc;

                    $query = "SELECT * FROM trabajadores WHERE id=$docm";
                    $eje = mysqli_query($conexion, $query);

                    $obj = mysqli_fetch_object($eje);

                    $docm = $obj->cedula;

                    $marcaciones[] = array(
                        'doc'=>$docm,
                        'nombre'=>$rowm->nombre,
                        'fecha'=>$rowm->fecha,
                        'hora'=>$rowm->hora,
                        'tipo'=>$rowm->tipo,
                        'terminal'=>$rowm->terminal
                    );

                    echo '<tr>
                        <td>'.$docm.'</td>
                        <td>'.$rowm->nombre.'</td>
                        <td>'.$rowm->fecha.'</td>
                        <td>'.$rowm->hora.'</td>
                        <td>'.$rowm->tipo.'</td>
                        <td>'.$rowm->terminal.'</td>
                    </tr>
                    ';


                }
                  
                  
                  

                

             
?>