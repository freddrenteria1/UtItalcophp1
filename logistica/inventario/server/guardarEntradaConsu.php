<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$remision = $_POST["remision"];
$rda = $_POST["rda"];
$items = $_POST["items"];
$observaciones = $_POST["observaciones"];
$user = $_POST["user"];
$ods = $_POST["ods"];
$ubicacion = $_POST["ubicacion"];

$alm = 'AC'.$ods.$ubicacion;

$msn = 'Ok';

$cadena = 'adjrda-';

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
$lastid = null;

$sql = "INSERT INTO entradaconsumibles VALUES('','$fecha','$remision','$rda','$ods','$ubicacion','$items','$observaciones','$archivo','$user')";
$gent = mysqli_query($conexion, $sql);

if(!$gent){
    $msn = mysqli_error($conexion);
}else{

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
}


$datos = array(
    'msn'=>$msn,
    'id'=>$lastid
);

echo json_encode($datos);