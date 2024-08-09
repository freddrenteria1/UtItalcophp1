<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$esp = $_POST["esp"];


$numlazo=1;

$firmastotalesut = 0;
$firmastotalesuteje = 0;
$firmastotalesutfalt = 0;
$firmastotalesecp = 0;
$firmastotalesecpeje = 0;
$firmastotalesecpfalt = 0;

$sql="SELECT * FROM tags WHERE ods='$ods' AND esp='$esp' GROUP BY fequipo";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $sumequipo = 0;
    $totalequipos = 0;

    $canitems = 0;
    $cantotfirm = 0;
    $totfirmfal = 0;
    $ecpop = 0;
    $ecpg = 0;
    $ut = 0;
    $totfim = 0;
    
    $fequipo = $obj->fequipo;
    

    $totalequipos=0;
    $poruttot = 0;
    $porecptot = 0;
    $totejetot = 0;
    $portotfimtot = 0;
    $firmfaltot = 0;
    $cantfirmutTotal=0;
    $cantfirmecpTotal=0;
    $cantotfirmasesp = 0;
    $cantfirmecpc = 0;
    $cantfirmecpg = 0;

    $ecptot = 0;
    $totfimesp = 0;
    $uttot = 0;
    $numrcatot = 0;
    
    $ecpc = 0;
    $ecpg = 0;

    $datatargetcab = ".esp".$numlazo;
    $datatarget = "esp".$numlazo;

    $buscar = "SELECT * FROM tags Where fequipo = '$fequipo' GROUP BY tag";
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

            $tag = $row->tag;

            $bus = "SELECT * FROM tags Where tag = '$tag' group by tag";
            $ejet = mysqli_query($conexion, $bus);

            $canttag = mysqli_num_rows($ejet);

            $busr = "SELECT * FROM tags Where tag = '$tag'";
            $ejer = mysqli_query($conexion, $busr);

            $cantrca = mysqli_num_rows($ejer);

            $cantfirmut = 0;
            $cantfirmutTotal += 0;
            // $porut = round(($ut / $cantfirmut)*100, 2);
            $porut = 0;
            
            $cantfirmecp = 0;
            $cantfirmecpc += 0;
            $cantfirmecpg += 0;
            $cantfirmecpTotal += 0;
            // $porecp = round(($ecp / $cantfirmecp)*100, 2);
            $porecp = 0;

            $totfirmas = 0;
            $cantotfirmasesp += $totfirmas;

            $toteje = $ut + $ecp;
            // $portotfim = round(($toteje / $totfirmas)*100, 2);
            $portotfim = 0;

            if($toteje == 0){
                $numrca = 0;
                $numrcatot=0;
            }else{
                $numrca = 0;
            }

            $firmfalt = $totfirmas - $toteje;
            $sumequipo += $cantrca;
            $totalequipos += $canttag;
         
            $htmltr .= '<tr style="text-align: center;"><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$tag.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$canttag.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$cantrca.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$cantfirmut.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">0</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">0</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$cantfirmut.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$ut.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$porut.'%</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">0</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">0</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">0</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">0</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">0</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$cantfirmecp.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$ecp.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$porecp.'%</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$totfirmas.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$toteje.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$portotfim.'%</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$numrca.'</div></td><td class="hiddenRow"><div class="collapse '.$datatarget.'">'.$firmfalt.'</div></td></tr>';

        }

         
        // $poruttot = round(($uttot / $cantfirmutTotal)*100, 2);
        // $porecptot = round(($ecptot / $cantfirmecpTotal)*100, 2);
        // $portotfimtot = round(($totejetot / $cantotfirmasesp)*100, 2);
        $poruttot = 0;
        $porecptot = 0;
        $portotfimtot = 0;

        $totejetot = $uttot + $ecptot;

        $firmfaltot = $cantotfirmasesp - $totejetot;

        $firmastotalesecp += $cantfirmecpTotal;
        $firmastotalesut += $cantfirmutTotal;

        $firmastotalesecpeje += $ecptot;
        $firmastotalesuteje += $uttot;

        
        $htmltrcab .= '<tr  onclick="cargando2()" data-toggle="collapse" data-target="'.$datatargetcab.'" style="text-align: center; background-color: #5DADE2;"><td>'.$fequipo.'</td><td>'.$totalequipos.'</td><td>'.$sumequipo.'</td><td>'.$cantfirmutTotal.'</td><td>0</td><td>0</td><td>'.$cantfirmutTotal.'</td><td>'.$uttot.'</td><td>'.$poruttot.'%</td><td>0</td><td>0</td><td>'.$cantfirmecpc.'</td><td>'.$cantfirmecpg.'</td><td>0</td><td>'.$cantfirmecpTotal.'</td><td>'.$ecptot.'</td><td>'.$porecptot.'%</td><td>'.$cantotfirmasesp.'</td><td>'.$totejetot.'</td><td>'.$portotfimtot.'%</td><td>'.$numrcatot.'</td><td>'.$firmfaltot.'</td></tr>';

        $htmltrcab .= $htmltr;

        $numlazo++;

         
    }

    $firmastotalesecpfalt = $firmastotalesecp - $firmastotalesecpeje;
    $firmastotalesutfalt = $firmastotalesut - $firmastotalesuteje;
    $firmastotales = $firmastotalesecp + $firmastotalesut;

    $datos[] = array(
        'id'=>$obj->id,
        'planta'=>$obj->planta,
        'unidad'=>$obj->unidad,
        'esp'=>$obj->esp,
        'equipo'=>$obj->fequipo,
        'alcance'=>$obj->alcance,
        'formato'=>'FRM-BCA-19.370.3.'.$obj->rca,
        'tag'=>$obj->tag,
        'cantfirmecpop'=>$ecpop,
        'cantfirmecpg'=>$ecpg,
        'cantfirmut'=>$ut,
        'totfim'=>$totfim,
        'firmfalt'=>$totfirmfal
    );

    
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
