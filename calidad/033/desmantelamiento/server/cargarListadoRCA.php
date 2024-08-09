<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];

$sql="SELECT * FROM tags WHERE ods='$ods' order by esp";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){
    $canitems = 0;
    $cantotfirm = 0;
    $totfirmfal = 0;
    $ecpop = 0;
    $ecpg = 0;
    $ut = 0;
    $totfim = 0;

    if($obj->rca == 'OS86'){
        $tag = $obj->tag;
        $buscar = "SELECT * FROM os86 Where ods = '$ods' and tag = '$tag'";
        $ejeb = mysqli_query($conexion, $buscar);

        $encb = mysqli_num_rows($ejeb);

        if($encb != 0){
            while($row = mysqli_fetch_object($ejeb)){
                $items = json_decode($row->revitems);
                $canitems = count($items);
                if($canitems > 0){
                    for($i=0; $i<$canitems; $i++){
                        $rev = $items[$i]->revision;
                        if($rev == 'ecopetrol'){
                            $ecp++;
                            $totfim++;
                        }
                        if($rev == 'italco'){
                            $ut++;
                            $totfim++;
                        }
                    }
                }
            }
        }

        $cantotfirm = 6;
        $totfirmfal = $cantotfirm - $totfim;
    }

    if($obj->rca == 'OS114'){
        $tag = $obj->tag;
        $buscar = "SELECT * FROM os114 Where ods = '$ods' and isometrico = '$tag'";
        $ejeb = mysqli_query($conexion, $buscar);

        $encb = mysqli_num_rows($ejeb);

        if($encb != 0){
            while($row = mysqli_fetch_object($ejeb)){
                $items = json_decode($row->limp_faci_insp);
                $canitems = count($items);
                if($canitems > 0){
                    for($i=0; $i<$canitems; $i++){
                        $rev = $items[$i]->fechaec;
                        if($rev != ''){
                            $ecpop++;
                            $totfim++;
                        }
                        $rev = $items[$i]->fechaut;
                        if($rev != ''){
                            $ut++;
                            $totfim++;
                        }
                    }
                }

                $items = json_decode($row->recom_post_inspec);
                $canitems = count($items);
                if($canitems > 0){
                    for($i=0; $i<$canitems; $i++){
                        $rev = $items[$i]->fechaec;
                        if($rev != ''){
                            $ecpop++;
                            $totfim++;
                        }
                        $rev = $items[$i]->fechaut;
                        if($rev != ''){
                            $ut++;
                            $totfim++;
                        }
                    }
                }
                $items = json_decode($row->pintura_aislami_termico);
                $canitems = count($items);
                if($canitems > 0){
                    for($i=0; $i<$canitems; $i++){
                        $rev = $items[$i]->fechaec;
                        if($rev != ''){
                            $ecpg++;
                            $totfim++;
                        }
                        $rev = $items[$i]->fechaut;
                        if($rev != ''){
                            $ut++;
                            $totfim++;
                        }
                    }
                }
            }
        }

        $cantotfirm = 6;
        $totfirmfal = $cantotfirm - $totfim;
    }

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

echo json_encode($datos);