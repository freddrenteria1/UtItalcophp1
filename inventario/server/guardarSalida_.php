<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$almacen = $_POST["almacen"];
$ods = $_POST["ods"];
$items = $_POST["items"];
$observaciones = $_POST["observaciones"];
$user = $_POST["user"];

//GUARDA LA ENTRADA

$sql = "INSERT INTO ordensalida VALUES('','$fecha','$almacen','$ods','$items','$observaciones','$user')";
$gent = mysqli_query($conexion, $sql);

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

    //verifica si ya existe el articulo en almacen principal y resta cantidades de lo contrario lo agrega

    $consultar  = "SELECT * FROM inventario Where codigo = '$cod' And ubicacion = 'AP'";
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

    if($almacen == 'Consumibles'){
        $alm = 'AC'.$ods;
    }else{
        $alm = 'AH'.$ods;
    }

    $cons  = "SELECT * FROM inventario Where codigo = '$cod' And ubicacion = '$alm'";
    $bcons = mysqli_query($conexion, $cons);
    $enc2 = mysqli_num_rows($bcons);

    if($enc2 != 0){
        $row = mysqli_fetch_object($bcons);
        $idinv = $row->id;
        $acant = $row->cantidad;
        $ncant = $row + $cant;

        $actcant2 = "UPDATE inventario SET cantidad = $ncant Where id= $idinv";
        $ejeact2 = mysqli_query($conexion, $actcant2);

    }else{
        $query2 = "INSERT INTO inventario VALUES('', '$tipo', '$codtipo', '$clase', '$codclase','$articulo','$cod', '$unidad', $cant, '$alm','Existente')";
        $guardar = mysqli_query($conexion, $query2);
        
        if(!$guardar){
            $msn = mysqli_error($conexion);
        }
    }

    
}

echo json_encode($datos);