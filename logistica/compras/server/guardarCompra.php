<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$items = $_POST["items"];

$obs = $_POST["observaciones"];
$ip = $_SERVER['REMOTE_ADDR'];
 
$elaborado = $_POST["elaborado"];
$proveedor = $_POST["proveedor"];

$lugarentrega = $_POST["lugarentrega"];
$lugarobra = $_POST["lugarobra"];
$destino = $_POST["destino"];
$lugartransporte = $_POST["lugartransporte"];
$terminospago = $_POST["terminospago"];

$estado = 'Elaborado';

$cadena = 'adjcp-' . $fecha;

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

$sql="INSERT INTO compras VALUES('','$fecha','$proveedor', '$lugarentrega', '$lugarobra', '$destino', '$lugartransporte', '$terminospago', '$obs','$elaborado','$archivo','$items','$estado','$ip')";
$exito=mysqli_query($conexion, $sql);

// $ultimo_id = mysqli_insert_id($conexion);

// //adjunta el número de orden de compra en los items de la rda
// $items = json_decode($_POST["items"]);

// $cant = count($items);

// for($i = 0; $i<$cant; $i++){

//     $cod = $items[$i]->cod;
//     $rda = $items[$i]->rda;

//     //Actualiza el # de orden de compra en el item de la rda
//     $query = "SELECT * FROM rda Where id=$rda";
//     $eje = mysqli_query($conexion, $query);
//     $fila = mysqli_fetch_object($eje);

//     $itemsRda = json_decode($fila->items);
//     $cantIR = count($itemsRda);

//     for($a = 0; $a<$cantIR; $a++){
//         if($itemsRda[$a]->cod == $cod){
//             $itemsRda[$a]->orden = $ultimo_id;
//         }
//     }

//     $itemsRda = json_encode($itemsRda);

//     $act = "UPDATE rda SET items = '$itemsRda' Where id=$rda";
//     $rea = mysqli_query($conexion, $act);

    
// }

$datos = array(
    'msn'=>'Ok'
);

echo json_encode($datos);