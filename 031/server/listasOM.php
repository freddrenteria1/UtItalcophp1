<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$semana = $_POST["semana"];

//$semana = $_GET["semana"];


$sql="SELECT *, COUNT(*) as cantom FROM ordenmant WHERE semana = $semana GROUP BY frente";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $frente = $obj->frente;
    $sem = $obj->semana;

    

    $sql2="SELECT *, COUNT(*) as cantom FROM ordenmant WHERE semana = $semana AND frente = '$frente' GROUP BY numom";
    $exito2=mysqli_query($conexion, $sql2);

    $cantOM = mysqli_num_rows($exito2);

    $sql3="SELECT * FROM ordenmant WHERE semana = $semana AND frente = '$frente' GROUP BY numom";
    $exito3=mysqli_query($conexion, $sql3);

    $totOM = 0;

    while($row = mysqli_fetch_object($exito3)){

        $numom = $row->numom;

        $totEje = 0;

        $query="SELECT * FROM ordenmant WHERE  numom = '$numom' AND frente = '$frente' AND semana = $semana";
        $eje=mysqli_query($conexion, $query);

        $enc = mysqli_num_rows($eje);

        if($enc != 0){

            while($fila = mysqli_fetch_object($eje)){

                $estado = $fila->estado;

                if($estado =='Ejecutado'){
                    $totEje++;
                }
            }

            $totOP = $enc;

        }else{
            $totOP = 0;
        }

        if($totOP == $totEje){
            $totOM++;
        }

    }

 

    $om[] = array(
        'id'=>$obj->id,
        'frente'=>$obj->frente,
        'semana'=>$obj->semana,
        'cantom'=>intval($cantOM),
        'cantomeje'=>intval($totOM)
    );

}

//busca OM de emergentes
$sql = "SELECT *,  COUNT(*) as cantom FROM emergentes WHERE semana = $semana GROUP BY frente";
$ejec = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($ejec)){

    $frente = $obj->frente;
    $sem = $obj->semana;
    $cantom = intval($obj->cantom);

    $datosemer[] = array(
        'frente'=>$frente,
        'sem'=>$semana,
        'cantom'=>$cantom
    );

}

//busca OM de emergentes
$sql = "SELECT * FROM emergentes WHERE semana = $semana";
$ejec = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($ejec)){

    $datosemerdet[] = array(
        'orden'=>$obj->orden,
        'op'=>$obj->op,
        'equipo'=>$obj->equipo, 
        'actividad'=>$obj->actividad, 
        'frente'=>$obj->frente, 
        'finicio'=>$obj->finicio, 
        'estado'=>$obj->estado
    );

}

$datos = array(
    'om'=>$om,
    'datosemer'=>$datosemer,
    'datosemerdet'=>$datosemerdet
);

echo json_encode($datos);