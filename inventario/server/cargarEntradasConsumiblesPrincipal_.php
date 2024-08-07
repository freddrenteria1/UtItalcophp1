<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$ubicacion = $_POST["ubicacion"];

$query = "TRUNCATE table consutmp";
$eje = mysqli_query($conexion, $query);

$sql = "SELECT * FROM ordensalidaconsu Where ods='024' OR ods='026'";
$exito = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $fecha = $obj->fecha;
    $num = $obj->id;

    $items = json_decode($obj->items);
    $cant = count($items);

    for($i=0; $i<$cant; $i++){
        

        $cantidad = $items[$i]->cant;
        $cod = $items[$i]->cod;
        $unidad = $items[$i]->unidad;
        $item = $items[$i]->item;

        if($cantidad !=  null){

            $sql2 = "SELECT * FROM items Where codigo='$cod'";
            $exito2 = mysqli_query($conexion, $sql2);

            $row = mysqli_fetch_object($exito2);

            $clase = $row->clase;
            $tipo = $row->tipo;


            $query = "INSERT INTO consutmp VALUES ('', $cantidad, '$cod', '$unidad', '$item', '$tipo', '$clase', '$ods', '$ubicacion', '$fecha', $num)";
            $ejec = mysqli_query($conexion, $query);
            
        }

    }

}

$sql = "SELECT SUM(cant) AS tot, cod, unidad, item, tipo, clase, ods, ubicacion, fecha, num FROM consutmp Where ods='$ods' AND ubicacion = '$ubicacion'  GROUP BY cod";
$exito = mysqli_query($conexion, $sql);


while($obj = mysqli_fetch_object($exito)){
    $datos[] = array(
        'num'=>$obj->num,
        'fecha'=>$obj->fecha,
        'tipo'=>$obj->tipo,
        'clase'=>$obj->clase,
        'cant'=>$obj->tot,
        'cod'=>$obj->cod,
        'unidad'=>$obj->unidad,
        'item'=>$obj->item
    );
}


echo json_encode($datos);