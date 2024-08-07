<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];

$numlazo=1;

$firmastotalesut = 0;
$firmastotalesuteje = 0;
$firmastotalesutfalt = 0;
$firmastotalesecp = 0;
$firmastotalesecpeje = 0;
$firmastotalesecpfalt = 0;

$sql="SELECT * FROM tags WHERE ods='$ods' GROUP BY lazo";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){
    $canitems = 0;
    $cantotfirm = 0;
    $totfirmfal = 0;
    $ecpop = 0;
    $ecpg = 0;
    $ut = 0;
    $totfim = 0;
    
    $lazo = $obj->lazo;
    

    $totalequipos=0;
    $poruttot = 0;
    $porecptot = 0;
    $totejetot = 0;
    $portotfimtot = 0;
    $firmfaltot = 0;
    $cantfirmutTotal=0;
    $cantfirmecpTotal=0;
    $cantotfirmaslazo = 0;
    $cantfirmecpc = 0;
    $cantfirmecpg = 0;

    $ecptot = 0;
    $totfimlaz = 0;
    $uttot = 0;
    $numrcatot = 0;
    
    $ecpc = 0;
    $ecpg = 0;

    $datatargetcab = ".lazo".$numlazo;
    $datatarget = "lazo".$numlazo;

    $buscar = "SELECT * FROM os114 Where lazo_corrosion = '$lazo'";
    $ejeb = mysqli_query($conexion, $buscar);
    
    $encb = mysqli_num_rows($ejeb);

    if($encb != 0){

        $htmltr = '';

        while($row = mysqli_fetch_object($ejeb)){

            $ecp = 0;
            $ut = 0;
            $ecpc = 0;
            $ecpg = 0;
            $totfim = 0;

            $items = json_decode($row->limp_faci_insp);
            $canitems = count($items);

            if($canitems > 0){
                for($i=0; $i<$canitems; $i++){
                    $rev = $items[$i]->fechaec;
                    if($rev != ''){
                        $ecp++;
                        $ecpc++;
                        $totfim++;

                        $ecptot++;
                        $totfimlaz++;
                    }
                    $rev = $items[$i]->fechaut;
                    if($rev != ''){
                        $ut++;
                        $totfim++;

                        $uttot++;
                        $totfimlaz++;
                    }
                }
            }

            $items = json_decode($row->recom_post_inspec);
            $canitems = count($items);
            if($canitems > 0){
                for($i=0; $i<$canitems; $i++){
                    $rev = $items[$i]->fechaec;
                    if($rev != ''){
                        $ecp++;
                        $ecpc++;
                        $totfim++;

                        $ecptot++;
                        $totfimlaz++;
                    }
                    $rev = $items[$i]->fechaut;
                    if($rev != ''){
                        $ut++;
                        $totfim++;

                        $uttot++;
                        $totfimlaz++;
                    }
                }
            }
            $items = json_decode($row->pintura_aislami_termico);
            $canitems = count($items);
            if($canitems > 0){
                for($i=0; $i<$canitems; $i++){
                    $rev = $items[$i]->fechaec;
                    if($rev != ''){
                        $ecp++;
                        $copg++;
                        $totfim++;

                        $ecptot++;
                        $totfimlaz++;
                    }
                    $rev = $items[$i]->fechaut;
                    if($rev != ''){
                        $ut++;
                        $totfim++;

                        $uttot++;
                        $totfimlaz++;
                    }
                }
            }

            $tag = $row->isometrico;
            $cantfirmut = 3;
            $cantfirmutTotal += 3;
            $porut = round(($ut / $cantfirmut)*100, 2);
            
            $cantfirmecp = 3;
            $cantfirmecpc += 2;
            $cantfirmecpg += 1;
            $cantfirmecpTotal += 3;
            $porecp = round(($ecp / $cantfirmecp)*100, 2);

            $totfirmas = 6;
            $cantotfirmaslazo += $totfirmas;

            $toteje = $ut + $ecp;
            $portotfim = round(($toteje / $totfirmas)*100, 2);

            if($toteje == 6){
                $numrca = 1;
                $numrcatot++;
            }else{
                $numrca = 0;
            }

            $firmfalt = $totfirmas - $toteje;
            $sumequipo++;
            $totalequipos++;
         
            $htmltr .= '<tr style="text-align: center;"><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$tag.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">1</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">1</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$cantfirmut.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">0</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">0</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$cantfirmut.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$ut.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$porut.'%</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">0</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">0</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">2</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">1</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">0</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$cantfirmecp.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$ecp.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$porecp.'%</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$totfirmas.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$toteje.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$portotfim.'%</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$numrca.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$firmfalt.'</div></td></tr>';

        }

         
        $poruttot = round(($uttot / $cantfirmutTotal)*100, 2);
        $porecptot = round(($ecptot / $cantfirmecpTotal)*100, 2);
        $totejetot = $uttot + $ecptot;

        $portotfimtot = round(($totejetot / $cantotfirmaslazo)*100, 2);

        $firmfaltot = $cantotfirmaslazo - $totejetot;

        $firmastotalesecp += $cantfirmecpTotal;
        $firmastotalesut += $cantfirmutTotal;

        $firmastotalesecpeje += $ecptot;
        $firmastotalesuteje += $uttot;

        
        $htmltrcab .= '<tr data-toggle="collapse" data-target="'.$datatargetcab.'" style="text-align: center;"><td>'.$lazo.'</td><td>'.$totalequipos.'</td><td>'.$totalequipos.'</td><td>'.$cantfirmutTotal.'</td><td>0</td><td>0</td><td>'.$cantfirmutTotal.'</td><td>'.$uttot.'</td><td>'.$poruttot.'%</td><td>0</td><td>0</td><td>'.$cantfirmecpc.'</td><td>'.$cantfirmecpg.'</td><td>0</td><td>'.$cantfirmecpTotal.'</td><td>'.$ecptot.'</td><td>'.$porecptot.'%</td><td>'.$cantotfirmaslazo.'</td><td>'.$totejetot.'</td><td>'.$portotfimtot.'%</td><td>'.$numrcatot.'</td><td>'.$firmfaltot.'</td></tr>';

        $htmltrcab .= $htmltr;

        $numlazo++;

         
    }

    $firmastotalesecpfalt = $firmastotalesecp - $firmastotalesecpeje;
    $firmastotalesutfalt = $firmastotalesut - $firmastotalesuteje;
    $firmastotales = $firmastotalesecp + $firmastotalesut;

    // $datos[] = array(
    //     'id'=>$obj->id,
    //     'planta'=>$obj->planta,
    //     'unidad'=>$obj->unidad,
    //     'esp'=>$obj->esp,
    //     'equipo'=>$obj->fequipo,
    //     'alcance'=>$obj->alcance,
    //     'formato'=>'FRM-BCA-19.370.3.'.$obj->rca,
    //     'tag'=>$obj->tag,
    //     'cantfirmecpop'=>$ecpop,
    //     'cantfirmecpg'=>$ecpg,
    //     'cantfirmut'=>$ut,
    //     'totfim'=>$totfim,
    //     'firmfalt'=>$totfirmfal
    // );

    
}

$datos = array(
    'datos'=>$htmltrcab,
    'firmastotalesecp'=>$firmastotalesecp,
    'firmastotalesecpeje'=>$firmastotalesecpeje,
    'firmastotalesecpfalt'=>$firmastotalesecpfalt,
    'firmastotalesut'=>$firmastotalesut,
    'firmastotalesuteje'=>$firmastotalesuteje,
    'firmastotalesutfalt'=>$firmastotalesutfalt,
    'firmastotales'=>$firmastotales
);

echo json_encode($datos);