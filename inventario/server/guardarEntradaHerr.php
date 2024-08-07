<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$remision = $_POST["remision"];
$rda = $_POST["rda"];
$items = $_POST["items"];
$observaciones = $_POST["observaciones"];
$user = $_POST["user"];
$ods = $_POST["ods"];
$ubicacion = $_POST["ubicacion"];

$alm = 'AH'.$ods.$ubicacion;

$msn = 'Ok';

//GUARDA LA ENTRADA

$sql = "INSERT INTO entradaherramientas VALUES('','$fecha','$remision','$rda','$ods','$ubicacion','$items','$observaciones','$user')";
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

    //verifica si ya existe el articulo en almacen y suma cantidades de lo contrario lo agrega

    $consultar  = "SELECT * FROM inventario Where codigo = '$cod' And ubicacion = '$alm'";
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
        $query2 = "INSERT INTO inventario VALUES('', '$tipo', '$codtipo', '$clase', '$codclase','$articulo','$cod', '$unidad', $cant, '$alm','Existente')";
        $guardar = mysqli_query($conexion, $query2);
        
        if(!$guardar){
            $msn = mysqli_error($conexion);
        }
    }
    
}

$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);