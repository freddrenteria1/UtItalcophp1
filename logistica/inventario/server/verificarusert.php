<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$user = $_POST["usuario"];
$clave = $_POST["clave"];
$alma = $_POST["alma"];
$ubica = $_POST["ubica"];
$ods = $_POST["ods"];

$ip = $_SERVER['REMOTE_ADDR'];

$sql="SELECT * FROM usuarioslogistica WHERE email = '$user' AND clave = '$clave'";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);
$enc = 'Null';

if($cont > 0 ){
    $row = mysqli_fetch_object($exito);
    
    $permiso = $row->permiso;
     

    if($permiso == 1){
        $msn = 'Ok';
        $query = "UPDATE usuarioslogistica SET ultimo_ingreso='$fecha', ip='$ip' WHERE email = '$user'";
        $eje = mysqli_query($conexion, $query);
    }else{
        $almacenes = json_decode($row->almacenes);
        $cant = count($almacenes);

        for($i=0;$i<$cant;$i++){
            if($almacenes[$i]->ods == $ods && $almacenes[$i]->almacen == $alma && $almacenes[$i]->ubicacion == $ubica){

                $enc = 'Ok';

            }
        }
        if($enc == 'Ok'){
            $msn = 'Ok';
            $query = "UPDATE usuarioslogistica SET ultimo_ingreso='$fecha', ip='$ip' WHERE email = '$user'";
            $eje = mysqli_query($conexion, $query);
        }else{
            $msn = 'Sin permisos para este almacen';
        }
    }

    

}else{
    
    $msn = 'ERROR';
}

$datos = array(
    'msn' => $msn
);

echo json_encode($datos);