<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$fechai = $_POST["fechai"];
$fechaf = $_POST["fechaf"];
$ods = $_POST["ods"];

// $fechai = '2021-04-01';
// $fechaf = '2021-06-28';
// $ods = '016';


$sql="SELECT * FROM aseguramientos WHERE (fecharep between '$fechai' AND '$fechaf') and ods = '$ods' AND criticidad != 'N/A'";
$exito=mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_object($exito)){

    $fecharep = $row->fecharep;
    $fcierre = $row->fcierre;

    $item = $row->item;
    $itemplan = 0;


        //se busca el plan para el riesgo si lo tiene
        $item = $row->item;

        $query = "SELECT * FROM planacriesgo Where itemacr = '$item' and ods='$ods'";
        $eje = mysqli_query($conexion, $query);
        $cont = mysqli_num_rows($eje);

        if($cont != 0){
            $fila = mysqli_fetch_object($eje);
            $plan = $fila->plan;
            $fcierre = $fila->fcierre;

            $query2 = "SELECT * FROM fotosriesgos Where itemriesgo = '$item' AND ods='$ods'";
            $eje2 = mysqli_query($conexion, $query2);
            $cont2 = mysqli_num_rows($eje2);
            if($cont2 != 0){

                

                while ($fila2 =  mysqli_fetch_object($eje2)){

                    $fotoplanacr[] = array(
                        'foto' => $fila2->foto
                    );
                }
            }


        }else{
            $plan = '';
            $fcierre = '';
        }


        $datos[] = array(
            'id' => $row->id,
            'item' => $row->item,
            'fecharep'=>$row->fecharep,
            'fechaevento'=>$row->fechaevento,
            'reporta'=>$row->reporta,
            'detalles'=>$row->detalles,
            'tipificacion'=>$row->tipificacion,
            'criticidad'=>$row->criticidad,
            'nivel1'=>$row->nivel1,
            'nivel2'=>$row->nivel2,
            'plan'=>$plan,
            'fcierre'=>$fcierre,
            'foto'=>$fotoplanacr,
            'ods'=>$row->ods
        );
   

} 

echo json_encode($datos);