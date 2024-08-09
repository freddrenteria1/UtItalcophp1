<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");
$ip = $_SERVER['REMOTE_ADDR'];

$msn = 'Ok';

$items = $_POST["items"];
$obs = $_POST["observaciones"];
 
$ods = $_POST["ods"];
$solicitada = $_POST["solicitada"];
$estado = 'Despachada';

$cadena = 'adjrm-' . $fecha;

// Ruta donde se guardar?n las im?genes
$directorio = '../../archivos/';

// Recibo los datos de la imagen
$nombre = $_FILES['adjunto']['name'];
$tipo = $_FILES['adjunto']['type'];
$tamano = $_FILES['adjunto']['size'];

if(isset($_FILES['adjunto'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['adjunto']['tmp_name'],$directorio.$cadena.$nombre);
    $archivo=$cadena.$nombre;
}else{
    $archivo = '';
}

$destino = $_POST["destino"];
$transp = $_POST["transp"];
$cargo = $_POST["cargo"];
$contrato =  $_POST["contrato"];
$idrda =  $_POST["idrda"];

$sql="INSERT INTO remisiones VALUES('','$fecha','$ods', $idrda, '$items','$solicitada','$archivo','$obs', '$destino', '$transp', '$cargo', '$contrato','$estado')";
$exito=mysqli_query($conexion, $sql);

//se descarga de inventario de almacen general

$items = json_decode($items);
$canti = count($items);

for($i = 0; $i<$canti; $i++){

    $cod = $items[$i]->cod;
    $cant = $items[$i]->cant;

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

    $consultar  = "SELECT * FROM inventario Where codigo = '$cod' And ubicacion = '$destino'";
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
        $query2 = "INSERT INTO inventario VALUES('', '$tipo', '$codtipo', '$clase', '$codclase','$articulo','$cod', '$unidad', $cant, '$destino','Existente')";
        $guardar = mysqli_query($conexion, $query2);
        
        if(!$guardar){
            $msn = mysqli_error($conexion);
        }
    }

    //se descuenta del inventario al Almacén general

    $consultar2  = "SELECT * FROM inventario Where codigo = '$cod' And ubicacion = 'AG'";
    $bcon2 = mysqli_query($conexion, $consultar2);
    $enc2 = mysqli_num_rows($bcon2);

    if($enc2 != 0){
        $file2 = mysqli_fetch_object($bcon2);
        $idinv = $file2->id;
        $acant = $file2->cantidad;
        $ncant = $acant - $cant;

        $actcant = "UPDATE inventario SET cantidad = $ncant Where id= $idinv";
        $ejeact = mysqli_query($conexion, $actcant);

    }

}

//actualiza estado de rda

$actrda = "UPDATE rda SET estado='Entregado' Where id = $idrda";
$ejerda = mysqli_query($conexion, $actrda);


$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);