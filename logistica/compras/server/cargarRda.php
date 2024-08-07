<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");
 
$ods = $_POST["ods"];
// $tipo = $_POST["tipo"];
// $estado = $_POST["estado"];

// if($ods == "Todos" and $tipo != "Todos" and $estado != "Todos"){
//     $sql="SELECT * FROM rda Where tipo = '$tipo' And estado = '$estado'";
// }else{
//     if($ods != "Todos" and $tipo == "Todos" and $estado != "Todos"){
//         $sql="SELECT * FROM rda Where ods = '$ods' And estado = '$estado'";
//     }else{
//         if($ods != "Todos" and $tipo != "Todos" and $estado == "Todos"){
//             $sql="SELECT * FROM rda Where ods = '$ods' And tipo = '$tipo'";
//         }else{
//             if($ods != "Todos" and $tipo == "Todos" and $estado == "Todos"){
//                 $sql="SELECT * FROM rda Where ods = '$ods'";
//             }else{
//                 if($ods == "Todos" and $tipo == "Todos" and $estado != "Todos"){
//                     $sql="SELECT * FROM rda Where estado = '$estado'";
//                 }else{
//                     if($ods == "Todos" and $tipo != "Todos" and $estado == "Todos"){
//                         $sql="SELECT * FROM rda Where tipo = '$tipo'";
//                     }else{
//                         if($ods == "Todos" and $tipo == "Todos" and $estado == "Todos"){
//                             $sql="SELECT * FROM rda";
//                         }else{
//                             $sql="SELECT * FROM rda Where ods = '$ods' And tipo = '$tipo' And estado = '$estado'";
//                         }
//                     }
//                 }
//             }
//         }
//     }
// }

if($ods!='Todos'){
    $sql="SELECT * FROM rda Where ods = '$ods'";
}else{
    $sql="SELECT * FROM rda";
}



// $sql="SELECT * FROM rda Where ods = '$ods' And tipo = '$tipo' And estado = '$estado'";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $ced = $obj->cedsol;

    $query = "SELECT * FROM usersrda Where cedula = '$ced'";
    $eje = mysqli_query($conexion, $query);
    $row = mysqli_fetch_object($eje);

    
    $datos[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'ods'=>$obj->ods,
        'solicitado'=>$obj->solicitado,
        'cargo'=>$row->cargo,
        'items'=>$obj->items,
        'fecharev'=>$obj->fecharev,
        'fechaaprob'=>$obj->fechaaprob,
        'estado'=>$obj->estado
    );
}

echo json_encode($datos);