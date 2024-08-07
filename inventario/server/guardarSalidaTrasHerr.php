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

$alm = 'AH'.$ods.$ubicacion;
$almorigen = 'Herramientas ODS '.$ods. ' ' . $ubicacion;
$almdest = 'AH'.$odsdest.$ubicadest;

//GUARDA LA ENTRADA

$sql = "INSERT INTO traslados VALUES('','$fecha','Herramientas','$odsdest','$ubicadest','$items','$observaciones','$almorigen','$user','Pendiente')";
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

    //VERIFICA SI EL ITEM EXISTE EN EL INVENTARIO DE TRASLADOS DEL ALMACEN DESTINO Y LE SUMA DE LO CONTRARIO LO AGREGA

    //PRIMERO VERIFICA SI EXISTE EL PRODUCTO EN TRALASDOS ENTRANTES Y LO DESCUENTA DE LO CONTRARIO LO SUMA COMO TRASLADO SALIENTE

    
    $consultar2  = "SELECT * FROM invtraslados Where codigo = '$cod' AND ods ='$ods' AND ubicacion = '$ubicacion' AND almacen = 'Herramientas' AND odsorigen = '$odsdest' AND almacenorigen = 'Herramientas' AND ubicacionorigen = '$ubicadest'";
    $bcon2 = mysqli_query($conexion, $consultar2);
    $enc2 = mysqli_num_rows($bcon2);

    if($enc2 != 0){
        $file = mysqli_fetch_object($bcon2);
        $idinv = $file->id;
        $acant = $file->cant;

        if($cant > $acant){
            $nncant = $cant - $acant;
            $actcant = "INSERT INTO invtraslados VALUES('', '$fecha', $lastid, '$ods', 'Herramientas', '$ubicacion', '$cod', '$articulo', $nncant, '$odsdest', 'Herramientas', '$ubicadest')";
            $ejeact = mysqli_query($conexion, $actcant);

            $ncant = 0;
            //elimina el item
            $actcant = "DELETE FROM invtraslados Where id= $idinv";
            $ejeact = mysqli_query($conexion, $actcant);

        }else{
            $ncant = $acant - $cant;

            $actcant = "UPDATE invtraslados SET cant = $ncant Where id= $idinv";
            $ejeact = mysqli_query($conexion, $actcant);
        }

        
       

    }else{
        $actcant = "INSERT INTO invtraslados VALUES('', '$fecha', $lastid, '$ods', 'Herramientas', '$ubicacion', '$cod', '$articulo', $cant, '$odsdest', 'Herramientas', '$ubicadest')";
        $ejeact = mysqli_query($conexion, $actcant);
    }

   
}

$datos = array(
    'id'=>$lastid
);

echo json_encode($datos);