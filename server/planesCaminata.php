<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];

// $ods = substr($ods, 4);


$sql="SELECT * FROM caminata WHERE  ods like '%$ods%'  order by semana DESC";
$exito=mysqli_query($conexion, $sql);


while ($row = mysqli_fetch_object($exito)){

    $fecha = $row->fcierre;
    $inspeccion = $row->inspeccion;
    $item = $row->item;
    $odsinsp = $row->ods;

    unset($fotos);

    if($row->plan != ''){

        //busca las fotos de la auditoria
        $query="SELECT * FROM fotosrct WHERE iteminsp = '$item' AND  ods = '$odsinsp'";
        $cons=mysqli_query($conexion, $query);

        $enc = mysqli_num_rows($cons);

        if($enc != 0){

            while($file = mysqli_fetch_object($cons)){
    
                $archivo = 'https://utitalco.tk/server/'.$file->foto;
                $extension = pathinfo($archivo, PATHINFO_EXTENSION);
    
                $fotos[] =  array(
                    'foto' => $file->foto,
                    'extension' => $extension
                );
                
            }
        }

    }

    $datos[] = array(
        'id' => $row->id,
        'ods' => $row->ods,
        'item' => $row->item,
        'fecha'=>$row->fcierre,
        'responsable'=>$row->resp,
        'oportunidad'=>$row->oportunidad,
        'plan'=>$row->plan,
        'fotos'=>$fotos
    );
        
    

}

echo json_encode($datos);