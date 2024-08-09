<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$proveedor = $_POST["proveedor"];
$remision = $_POST["remision"];
$ordencompra = $_POST["ordencompra"];
$ods = $_POST["odsdestino"];
$items = $_POST["items"];
$observaciones = $_POST["observaciones"];
$user = $_POST["user"];

$cadena = 'adjent-';

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

//BUSCA LA ORDEN DE COMPRA

$cantic = null;
$estcomp = "Elaborado";
$est = 0;
$totpend = 0;
$totparc = 0;

$sql = "SELECT * FROM compras Where id=$ordencompra";
$exito = mysqli_query($conexion, $sql);

$enc = mysqli_num_rows($exito);

if($enc != 0){
    $obj = mysqli_fetch_object($exito);
    
    $compra = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'items'=>$obj->items,
        'msn'=>'Ok'
    );

    $itemsComp = json_decode($obj->items, false, 512, JSON_UNESCAPED_UNICODE);
    $cantic = count($itemsComp);

}


//GUARDA LA ENTRADA

$sql = "INSERT INTO ordenentradatmp VALUES('','$fecha','$proveedor','$remision','$ordencompra','$ods','$items','$observaciones', '$archivo','$user')";
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

        //SI TIENE ORDEN DE COMPRA MARCA LOS INTEMS ENTREGADOS

        if($cantic != null){

            $encitem = false;

            //busca el item y verifica las cantidad

            for($a = 0; $a < $cantic; $a++){

                $coditemcomp = $itemsComp[$a]->cod;

                if($cod == $coditemcomp){

                    $cantcomp = $itemsComp[$a]->cant;

                    if($cant == $cantcomp){
                        $estitem = 'Recibido';
                        $itemsComp[$a]->cantp = 0;
                    }else{

                        $cantp = $itemsComp[$a]->cantp;

                        if($cantp != 0){
                            
                            if($cant == $cantp){
                                $estitem = 'Recibido';
                                $itemsComp[$a]->cantp = 0;
                            }else{
                                $estitem = 'Parcial';
                                $ncant = $cantp - $cant;
                                $itemsComp[$a]->cantp = $ncant;
                            }

                        }else{

                            $estitem = 'Parcial';
                            $ncant = $cantcomp - $cant;
                            $itemsComp[$a]->cantp = $ncant;

                        }


                    }
                    $encitem = true;
                    $itemsComp[$a]->estado = $estitem;
                }
            }

            //si encuentra el item actualiza el estado
            if($encitem){

                for($a = 0; $a < $cantic; $a++){
                    if($itemsComp[$a]->cantp == 0){
                        $estcomp = 'Recibido';
                    } 
                }
                
                
                $itemsg = json_encode($itemsComp, JSON_UNESCAPED_UNICODE);

                $actcomp = "UPDATE compras SET items = '$itemsg', estado = '$estcomp' WHERE id = $ordencompra";
                $ejea = mysqli_query($conexion, $actcomp);
            }


        }

        //FIN
    
    
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

        //verifica si todos los items y cantidades fueron cargadas
    
        //verifica si ya existe el articulo en almacen y suma cantidades de lo contrario lo agrega
    
        // $consultar  = "SELECT * FROM inventario Where codigo = '$cod' And ubicacion = 'AP'";
        // $bcon = mysqli_query($conexion, $consultar);
        // $enc = mysqli_num_rows($bcon);
    
        // if($enc != 0){
        //     $file = mysqli_fetch_object($bcon);
        //     $idinv = $file->id;
        //     $acant = $file->cantidad;
        //     $ncant = $acant + $cant;
    
        //     $actcant = "UPDATE inventario SET cantidad = $ncant Where id= $idinv";
        //     $ejeact = mysqli_query($conexion, $actcant);
    
        // }else{
        //     $query2 = "INSERT INTO inventario VALUES('', '$tipo', '$codtipo', '$clase', '$codclase','$articulo','$cod', '$unidad', $cant, 'AP','Existente')";
        //     $guardar = mysqli_query($conexion, $query2);
            
        //     if(!$guardar){
        //         $msn = mysqli_error($conexion);
        //     }
        // }
        
    }
}


$datos = array(
    'id'=>$lastid
);

echo json_encode($datos);