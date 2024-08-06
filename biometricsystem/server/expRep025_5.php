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
            <th>CONTRATO</th>
            <th>DOCUMENTO</th>
            <th>NOMBRES</th>
            <th>CARGO</th>
            <th>TIPO NOMINA</th>
            <th>SIST  PRECIO</th>
            <th>A CARGO</th>
            <th>DET PAGO</th>
            <th>FRENTE</th>
            <th>TURNO</th>
            <th>HHT</th>
            <th>FECHA</th>
            <th>HORA ENTRADA</th>
            <th>BIO MARC</th>
            <th>HORA SALIDA</th>
            <th>BIO MARC</th>
            <th>NOVEDAD</th>
          </thead>';



          $query = "SELECT  rep025.contrato, rep025.doc, rep025.nombres, rep025.cargo, rep025.tiponomina, rep025.sistemaprecio, rep025.acargo, rep025.detallepago, rep025.fecha, rep025.turno, rep025.hht, rep025.frente, rep025.grupo, rep025.supervisor, rep025.novedad, rep025.ods, trabajadores.id, trabajadores.cedula FROM rep025  LEFT JOIN trabajadores ON rep025.doc = trabajadores.cedula   WHERE rep025.fecha between '$finicio' AND '$ffin'   ";
          $eje = mysqli_query($conexion, $query);

          
            while($row = mysqli_fetch_object($eje)){

               
                $fecha = $row->fecha;
                $doc = $row->doc;
                $id = $row->id;

                $personal[] = array(
                    'id'=>$row->id,
                    'contrato'=>$row->contrato,
                    'doc'=>$row->doc,
                    'nombres'=>$row->nombres,
                    'cargo'=>$row->cargo,
                    'tiponomina'=>$row->tiponomina,
                    'sistemaprecio'=>$row->sistemaprecio,
                    'acargo'=>$row->acargo,
                    'detallepago'=>$row->detallepago,
                    'fecha'=>$row->fecha,
                    'turno'=>$row->turno,
                    'hht'=>$row->hht,
                    'frente'=>$row->frente,
                    'grupo'=>$row->grupo,
                    'supervisor'=>$row->supervisor,
                    'novedad'=>$row->novedad,
                    'ods'=>$row->ods
                );
                     
            }

            $sql = "SELECT * FROM marcaciones Where fecha  between '$finicio' AND '$ffin' GROUP BY fecha, doc, tipo";
                $exito = mysqli_query($conexion, $sql);

                while($rowm = mysqli_fetch_object($exito)){
                    $marcaciones[] = array(
                        'doc'=>$rowm->doc,
                        'nombre'=>$rowm->nombre,
                        'fecha'=>$rowm->fecha,
                        'hora'=>$rowm->hora,
                        'tipo'=>$rowm->tipo,
                        'terminal'=>$rowm->terminal
                    );
                }
                

                $datos = array(
                    'personal'=>$personal,
                    'marcaciones'=>$marcaciones
                );

                $num_p = count($personal);
                $num_m = count($marcaciones);

                for ($i = 0; $i < $num_p; ++$i){
                   $docp = $personal[$i]["doc"];
                   $idp = $personal[$i]["id"];
                   $nombres = $personal[$i]["nombres"];
                   $fecha = $personal[$i]["fecha"];
                   $turno = $personal[$i]["turno"];

                  
                   $horae = '';
                   $terminale='';
                   $horas = '';
                   $terminals='';

                   for ($a = 0; $a < $num_m; ++$a){

                   
                    $docm = $marcaciones[$a]["doc"];
                    $fecham = $marcaciones[$a]["fecha"];

                    if($docm == $idp  && $fecha == $fecham){

                        $tipo = $marcaciones[$a]["tipo"];

                        if($tipo == 'Entrada'){
                            $horae = $marcaciones[$a]["hora"];
                            $terminale = $marcaciones[$a]["terminal"];
                        }

                        if($tipo == 'Salida'){
                            $horas = $marcaciones[$a]["hora"];
                            $terminals = $marcaciones[$a]["terminal"];
                        }
                        
                    }

               }

                  
                   echo '<tr>
                            <td>'.$personal[$i]["contrato"].'</td>
                            <td>'.$docp.'</td>
                            <td>'.$personal[$i]["nombres"].'</td>
                            <td>'.$personal[$i]["cargo"].'</td>
                            <td>'.$personal[$i]["tiponomina"].'</td>
                            <td>'.$personal[$i]["sistemaprecio"].'</td>
                            <td>'.$personal[$i]["acargo"].'</td>
                            <td>'.$personal[$i]["detallepago"].'</td>
                            <td>'.$personal[$i]["frente"].'</td>
                            <td>'.$personal[$i]["turno"].'</td>
                            <td>'.$personal[$i]["hht"].'</td>
                            <td>'.$fecha.'</td>
                            <td>'.$horae.'</td>
                            <td>'.$terminale.'</td>
                            <td>'.$horas.'</td>
                            <td>'.$terminals.'</td>
                            <td>'.$personal[$i]["novedad"].'</td>
                        </tr>
                        ';

                 

                }

             
?>