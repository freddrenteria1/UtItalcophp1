<meta charset="utf-8" />
<?php 
session_start();//Esto debes poner siempre que un fichero vallas a utilizar las $_SESSION

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


include("conectar.php");
$conexion=conectar();



$query = "SELECT * FROM inventario Where codtipo = '03' Or clase = 'SERVICIO DE ALQUILER' Group by codigo";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){

    $coditem = $obj->codigo;
    $totalinv = 0;

    unset($itemsubi);

    //BUSCO EL ITEM EN CADA UBICACION

    $cons = "SELECT * FROM inventario Where codtipo = '03' Or clase = 'SERVICIO DE ALQUILER' GROUP BY ubicacion";
    $ejec = mysqli_query($conexion, $cons);

    while($rowu = mysqli_fetch_object($ejec)){

        $ubi = $rowu->ubicacion;

        if($ubi != 'AHLOGISTICA CENTRALALMACEN CENTRAL HTAS/EQUIPOS'){

            $buscari = "SELECT * FROM  inventario Where codigo = '$coditem' And ubicacion = '$ubi'";
            $ejeb = mysqli_query($conexion, $buscari);

            $encb = mysqli_num_rows($ejeb);

            if($encb > 0){
                $filab = mysqli_fetch_object($ejeb);
                $cante = $filab->cantidad;
            }else{
                $cante = 0;
            }

            $itemsubi[] = array(
                'ubicacion'=>$ubi,
                'cant'=>$cante
            );

            $totalinv += $cante;
        }
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
        'id'=>$obj->id,
        'codigo'=>$obj->codigo,
        'unidad'=>$obj->unidad,
        'articulo'=>$obj->articulo,
        'ubicaciones'=>$itemsubi,
        'total'=>$total
    );

}

//Inicio de exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=inv_herramientas_$fecha.xls"); //Indica el nombre del archivo resultante
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

