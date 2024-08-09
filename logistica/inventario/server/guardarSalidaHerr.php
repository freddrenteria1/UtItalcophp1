<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ced = $_POST["ced"];
$nombres = $_POST["nombres"];
$ods = $_POST["ods"];
$ubicacion = $_POST["ubicacion"];
$items = $_POST["items"];
$observaciones = $_POST["observaciones"];
$user = $_POST["user"];

$alm = 'AH'.$ods.$ubicacion;

//GUARDA LA ENTRADA

$sql = "INSERT INTO salidaherramientas VALUES('','$fecha','$ced','$nombres','$ods','$ubicacion','$items','$observaciones','$user')";
$gent = mysqli_query($conexion, $sql);


$numsalida = mysqli_insert_id($conexion); 

//se carga los consumibles al inventario del trabajador

// $query = "INSERT INTO remiconsumibles VALUES('', '$fecha', '$ods', '$items', '$nombres', '$ced', '$observaciones', '')";
// $ejeq = mysqli_query($conexion, $query);

$items = json_decode($items);
$canti = count($items);

for($i = 0; $i<$canti; $i++){

    $cod = $items[$i]->cod;
    $cant = $items[$i]->cant;
    $artitem = $items[$i]->item . ' - ' . $items[$i]->detalles;

    //BUSCAR SI EXISTE HERRAMIENTA A NOMBRE DEL TRABAJADOR Y SUMA LA CANTIDAD

    $buscar = "SELECT * FROM invplanta Where codigo = '$cod' And ced = '$ced' And ods='$ods' And almacen = 'Herramientas' And ubicacion = '$ubicacion'";
    $ejeb = mysqli_query($conexion, $buscar);

    $cantb = mysqli_num_rows($ejeb);

    if($cantb > 0){
        $filab = mysqli_fetch_object($ejeb);
        $cantb = $filab->cant;
        $ncant = $cantb + $cant;

        $query2 = "UPDATE invplanta SET cant = $ncant Where codigo = '$cod' And ced = '$ced' And ods='$ods' And almacen = 'Herramientas' And ubicacion = '$ubicacion'";
        $realizar = mysqli_query($conexion, $query2);
    }else{
        $query2 = "INSERT INTO invplanta VALUES('','$fecha', $numsalida, '$ced', '$nombres', '$cod', '$artitem', $cant, '$ods', 'Herramientas', '$ubicacion')";
        $realizar = mysqli_query($conexion, $query2);
    }


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
    'id'=>$numsalida
);

echo json_encode($datos);