<meta charset="utf-8" />
<?php 
session_start();//Esto debes poner siempre que un fichero vallas a utilizar las $_SESSION

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


include("conectar.php");
$conexion=conectar();


$query1 = "SELECT * FROM inventario Where  clase = 'SERVICIO DE ALQUILER'";
$eje1 = mysqli_query($conexion, $query1);

while($row = mysqli_fetch_object($eje1)){

    $inventario[] = array(
        'id'=>$row->id,
        'codigo'=>$row->codigo,
        'unidad'=>$row->unidad,
        'articulo'=>$row->articulo,
        'ubicacion'=>$row->ubicacion,
        'cant'=>$row->cantidad
    );

}

$query = "SELECT * FROM inventario Where  clase = 'SERVICIO DE ALQUILER' Group by codigo";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){

    $coditem = $obj->codigo;
    $totalinv = 0;

    // echo 'cod ' . $coditem;
    // echo '<br>';

    $inv[] = array(
        'id'=>$obj->id,
        'codigo'=>$obj->codigo,
        'unidad'=>$obj->unidad,
        'ubicacion'=>$obj->ubicacion,
        'articulo'=>$obj->articulo
    );

}


$sql = "SELECT * FROM almacenes WHERE estado = 'Activo'";
$ejes = mysqli_query($conexion, $sql);

$ubicaciones[] = array(
    'almacen'=>'AP'
);

while($fila = mysqli_fetch_object($ejes)){
    $tipo = $fila->almacen;
    $odsalm = $fila->ods;
    $ubica = $fila->ubicacion;

    // echo $ubica;
    // echo '<br>';

    if($tipo ==  'Herramientas'){
        $almc =  'AH'.$odsalm.$ubica;
        $ubicaciones[] = array(
            'almacen'=>$almc
        );
    }
   

}


$cantcod = COUNT($inv);
$cantalm = COUNT($ubicaciones);
$cantinv = COUNT($inventario);

// echo 'Cantidad inv ' . $cantinv;
// echo '<br>';
 
for($a = 0; $a < $cantcod; $a++){
    
    $coditem =  $inv[$a]["codigo"];
    unset($itemsubi);
    $total = 0;
    $totalinv =0;

    for($i = 0; $i < $cantalm; $i++){

        $ubi =  $ubicaciones[$i]["almacen"];

        $cante=0;

        for($b = 0; $b < $cantinv; $b++){

            if($inventario[$b]["codigo"]==$coditem && $inventario[$b]["ubicacion"]==$ubi){
                $cante = $inventario[$b]["cant"];
            }

        }         

        $itemsubi[] = array(
            'ubicacion'=>$ubi,
            'cant'=>$cante
        );

        $totalinv += $cante;

        // echo 'cod: '.  $coditem  .  ' | Cant: ' . $cante .  ' | Alm: ' . $ubi;
        // echo '<br>';
         
    }

    //BUSCA INV activoss

    $buscaric = "SELECT SUM(cant) as tot FROM  invactivos Where codigo = '$coditem' Group by codigo";
    $ejebc = mysqli_query($conexion, $buscaric);
    
    $encbc = mysqli_num_rows($ejebc);

    if($encbc > 0){
        $filabc = mysqli_fetch_object($ejebc);
        $totinvactivos = $filabc->tot;
    }else{
        $totinvactivos = 0;
    }

    $itemsubi[] = array(
        'ubicacion'=>'ASIG. ACT. PREF.',
        'cant'=>$totinvactivos
    );

    //BUSCA INV activoss

    $buscaric2 = "SELECT SUM(cant) as tot FROM  invplanta Where codigo = '$coditem' Group by codigo";
    $ejebc2 = mysqli_query($conexion, $buscaric2);
    
    $encbc2 = mysqli_num_rows($ejebc2);

    if($encbc2 > 0){
        $filabc = mysqli_fetch_object($ejebc2);
        $totinvactivos2 = $filabc->tot;
    }else{
        $totinvactivos2 = 0;
    }

    $itemsubi[] = array(
        'ubicacion'=>'ASIG. TRAB. REF.',
        'cant'=>$totinvactivos2
    );


    $total = $totalinv + $totinvactivos + $totinvactivos2;

    $datos[] = array(
        'id'=>$inv[$a]["id"],
        'codigo'=>$inv[$a]["codigo"],
        'unidad'=>$inv[$a]["unidad"],
        'articulo'=>$inv[$a]["articulo"],
        'ubicaciones'=>$itemsubi,
        'total'=>$total
    );


    
}

//Inicio de exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=inv_alquileres_$fecha.xls"); //Indica el nombre del archivo resultante
header("Pragma: no-cache");
header("Expires: 0");
echo '<table border="1">
          <thead>
            <th>Código</th>
            <th width="500">Artículo</th>
            <th>Unidad</th>
        ';

        $cant = count($itemsubi);

        for($i = 0; $i<$cant; $i++){
            echo '<th>'.$itemsubi[$i]["ubicacion"].'</th>';
        }
        echo '<th>Total</th>';
        echo  ' </thead>';

        $cant2 = count($datos);

        echo  '<tbody>';

        for($i = 0; $i<$cant2; $i++){
            echo '<tr>';
            echo '<td>'.$datos[$i]["codigo"].'</td>';
            echo '<td width="500">'.$datos[$i]["articulo"].'</td>';
            echo '<td>'.$datos[$i]["unidad"].'</td>';

            $ubica = $datos[$i]["ubicaciones"];
            $cant3 = count($ubica);

            for($a = 0; $a<$cant3; $a++){
                echo '<td>'.$ubica[$a]["cant"].'</td>';
            }

            echo '<td>'.$datos[$i]["total"].'</td>';
            echo '</tr>';

        }

        echo  '</tbody>';

    echo '</table>';

 ?>

