<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$odsdest = $_POST["odsdest"];
$ubicadest = $_POST["ubicadest"];
$ods = $_POST["ods"];
$items = $_POST["items"];
$observaciones = $_POST["observaciones"];
$user = $_POST["user"];
$ubicacion = $_POST["ubicacion"];

$alm = 'AC'.$ods.$ubicacion;
$almorigen = 'Consumibles ODS '.$ods. ' ' . $ubicacion;
$almdest = 'AC'.$odsdest.$ubicadest;

//GUARDA LA ENTRADA

$sql = "INSERT INTO traslados VALUES('','$fecha','Consumibles','$odsdest','$ubicadest','$items','$observaciones','$almorigen','$user')";
$gent = mysqli_query($conexion, $sql);

$lastid = mysqli_insert_id($conexion);

$items = json_decode($items);
$canti = count($items);

for($i = 0; $i<$canti; $i++){

    $cod = $items[$i]->cod;
    $cant = $items[$i]->cant;


    //busca el item
    $query = "SELECT * FROM items Where codigo = '$cod'";
    $eje = mysqli_query($conexion, $query);
    $fila = mysqli_fetch_object($eje);

    $tipo = $fila->tipo;
    $codtipo = $fila->codtipo;
    $clase = $fila->clase;
    $codclase = $fila->codclase;
    $articulo = $fila->articulo;
    $unidad = $fila->unidad;

    //VERIFICA SI EL ITEM EXISTE EN EL INVENTARIO DEL ALMACEN DESTINO Y LE SUMA DE LO CONTRARIO LO AGREGA

    $consultar  = "SELECT * FROM inventario Where codigo = '$cod' And ubicacion = '$almdest'";
    $bcon = mysqli_query($conexion, $consultar);
    $enc = mysqli_num_rows($bcon);

    if($enc != 0){
        $file = mysqli_fetch_object($bcon);
        $idinv = $file->id;
        $acant = $file->cantidad;
        $ncant = $acant + $cant;

        $actcant = "UPDATE inventario SET cantidad = $ncant Where id= $idinv";
        $ejeact = mysqli_query($conexion, $actcant);

    }else{
        $actcant = "INSERT INTO inventario VALUES('', '$tipo', '$codtipo', '$clase', '$codclase', '$articulo', '$cod', '$unidad', $cant, '$almdest', 'Existente')";
        $ejeact = mysqli_query($conexion, $actcant);
    }

     //VERIFICA SI EL ITEM EXISTE EN EL INVENTARIO DEL ALMACEN ORIGEN Y LE RESTA 

     $consultar  = "SELECT * FROM inventario Where codigo = '$cod' And ubicacion = '$alm'";
     $bcon = mysqli_query($conexion, $consultar);
     $enc = mysqli_num_rows($bcon);
 
    if($enc != 0){
        $file = mysqli_fetch_object($bcon);
        $idinv = $file->id;
        $acant = $file->cantidad;
        $ncant = $acant - $cant;

        $actcant = "UPDATE inventario SET cantidad = $ncant Where id= $idinv";
        $ejeact = mysqli_query($conexion, $actcant);

    }
   
}

$datos = array(
    'id'=>$lastid
);

echo json_encode($datos);