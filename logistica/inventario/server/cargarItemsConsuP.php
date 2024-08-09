<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$ubicacion = $_POST["ubicacion"];


$sql="SELECT * FROM items Where codtipo != '03' order by articulo";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){

    $codtipo = $row->codtipo;
    $codclase = $row->codclase;
    $codigo = $row->codigo;
    
    $ex = $codtipo.$codclase;

    if($ex != '0405'){
        $query = "SELECT * FROM inventario Where codigo='$codigo' and cantidad > 0 and ubicacion = 'AP'";
        $eje = mysqli_query($conexion, $query);
        $cant = mysqli_num_rows($eje);

        if($cant != 0){
            $datos[] = array(
                'id'=>$row->id,
                'tipo'=>$row->tipo,
                'codtipo'=>$row->codtipo,
                'clase'=>$row->clase,
                'codclase'=>$row->codclase,
                'item'=>$row->articulo,
                'codigo'=>$row->codigo,
                'unidad'=>$row->unidad
            );
        }
    }

}

echo json_encode($datos);