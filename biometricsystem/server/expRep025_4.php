<?php 
header('Content-type: application/json');

header('Access-Control-Allow-Origin: *');

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


include("conectar.php");
$conexion=conectar();

$finicio = $_GET["finicio"];
$ffin = $_GET["ffin"];



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

                $sql = "SELECT * FROM marcaciones Where fecha  between '$finicio' AND '$ffin' GROUP BY  doc, tipo";
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

                   $info[] = array(
                       'contrato'=>$personal[$i]["contrato"],
                       'doc'=>$docp,
                        'nombres'=>$personal[$i]["nombres"],
                        'cargo'=>$personal[$i]["cargo"],
                        'tiponomina'=>$personal[$i]["tiponomina"],
                        'sistemaprecio'=>$personal[$i]["sistemaprecio"],
                        'acargo'=>$personal[$i]["acargo"],
                        'detallepago'=>$personal[$i]["detallepago"],
                        'frente'=>$personal[$i]["frente"],
                        'turno'=>$personal[$i]["turno"],
                        'hht'=>$personal[$i]["hht"],
                        'fecha'=>$fecha,
                        'Entrada'=>$horae,
                        'biometricoe'=>$terminale,
                        'Salida'=>$horas,
                        'biometricos'=>$terminals                        
                   );

                 

                }

                echo json_encode($info);
?>