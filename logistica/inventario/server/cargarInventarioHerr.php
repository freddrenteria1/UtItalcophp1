<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$almacen = $_POST["alm"];
$ubicacion = $_POST["ubicacion"];

$alm = 'AH'.$ods.$ubicacion;

$query = "SELECT * FROM inventario Where ubicacion='$alm' order by articulo";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){

    if($obj->codtipo == '03' || $obj->clase == 'SERVICIO DE ALQUILER'){


        $coditem = $obj->codigo;
        $cantitemsal = 0;
        $cantitemdev = 0;

        //BUSCA INV DE TRABA

        $buscari = "SELECT ods, almacen, codigo, ubicacion, SUM(cant) as tot FROM  invplanta Where codigo = '$coditem' And ods='$ods' And almacen = 'Herramientas' And ubicacion = '$ubicacion' Group by codigo";
        $ejeb = mysqli_query($conexion, $buscari);
        
        $encb = mysqli_num_rows($ejeb);

        if($encb > 0){
            $filab = mysqli_fetch_object($ejeb);
            $totinvplanta = $filab->tot;
        }else{
            $totinvplanta = 0;
        }


        $tottrab = $totinvplanta;

        $total = $obj->cantidad + $tottrab;


        //BUSCA INV DE TRABA

        $buscari2 = "SELECT odsorigen, almacenorigen, codigo, ubicacionorigen, SUM(cant) as tot FROM  invtraslados Where codigo = '$coditem' And odsorigen='$ods' And almacenorigen = 'Herramientas' And ubicacionorigen = '$ubicacion' AND ubicacion != 'ALMACEN CENTRAL HTAS/EQUIPOS' Group by codigo";
        $ejeb2 = mysqli_query($conexion, $buscari2);
        
        $encb2 = mysqli_num_rows($ejeb2);

        if($encb2 > 0){
            $filab = mysqli_fetch_object($ejeb2);
            $totinvtras = $filab->tot;
        }else{
            $totinvtras = 0;
        }

        //BUSCA INV DE TRABA

        $buscari3 = "SELECT ods, almacen, codigo, ubicacion, SUM(cant) as tot FROM  invtraslados Where codigo = '$coditem' And ods='$ods' And almacen = 'Herramientas' And ubicacion = '$ubicacion' Group by codigo";
        $ejeb3 = mysqli_query($conexion, $buscari3);
        
        $encb3 = mysqli_num_rows($ejeb3);

        if($encb3 > 0){
            $filab = mysqli_fetch_object($ejeb3);
            $totinvtrasE = $filab->tot;
        }else{
            $totinvtrasE = 0;
        }
         
        $total = $obj->cantidad + $tottrab;

        $datos[] = array(
            'id'=>$obj->id,
            'codigo'=>$obj->codigo,
            'unidad'=>$obj->unidad,
            'cant'=>$obj->cantidad,
            'cantsal'=>$tottrab,
            'totinvtras'=>$totinvtras,
            'totinvtrasE'=>$totinvtrasE,
            'total'=>$total,
            'articulo'=>$obj->articulo
        );
    }

}

echo json_encode($datos);