<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$proveedor = $_POST["proveedor"];
$ods = $_POST["ods"];
$ciudad = $_POST["ciudad"];
$items = $_POST["items"];
$observaciones = $_POST["observaciones"];
$user = $_POST["user"];

$msn = 'Ok';

$cadena = 'adjsalh-';

// Ruta donde se guardar?n las im?genes
$directorio = 'archivos/';

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

//GUARDA LA ENTRADA
if($items != ''){

    $sql = "INSERT INTO devprov VALUES('','$fecha','$proveedor','$ciudad','$ods','$items','$observaciones','$archivo','$user')";
    $gent = mysqli_query($conexion, $sql);
    
    $lastid = mysqli_insert_id($conexion);
    
    if(!$gent){
        $msn = mysqli_error($conexion);
    }else{
        $numsalida = mysqli_insert_id($conexion); 
    }
    
    $items = json_decode($items);
    $canti = count($items);
    
    for($i = 0; $i<$canti; $i++){
    
        $cod = $items[$i]->cod;
        $cant = $items[$i]->cant;
        $artitem = $items[$i]->item;
    
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
    
    }
}else{
    $msn = 'Error';
}

$datos = array(
    'msn'=>$msn,
    'id'=>$lastid
);

echo json_encode($datos);