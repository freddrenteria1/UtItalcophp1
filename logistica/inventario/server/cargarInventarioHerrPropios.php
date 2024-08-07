<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$query = "SELECT * FROM inventario Where codtipo = '03' order by articulo";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){

    if($obj->ubicacion == 'AP'){

        $coditem = $obj->codigo;
        $totinvplanta = 0;
    
        //BUSCA INV EN PLANTA
    
        $buscari = "SELECT ubicacion, SUM(cant) as tot FROM  invplantaalm Where codigo = '$coditem' Group by codigo, ubicacion";
        $ejeb = mysqli_query($conexion, $buscari);
        
        $encb = mysqli_num_rows($ejeb);

        unset($planta);
    
        if($encb > 0){

            

            while($filab = mysqli_fetch_object($ejeb)){
                if($filab->tot > 0){

                    $ubica = $filab->ubicacion;

                    $sqlu = "SELECT * FROM almacenes WHERE ubicacion = '$ubica' AND estado = 'Activo'";
                    $ejeu = mysqli_query($conexion,  $sqlu);

                    $contu = mysqli_num_rows($ejeu);

                    if($contu > 0){

                        $planta[] = array(
                            'ubicacion'=>$filab->ubicacion,
                            'cant'=>$filab->tot
                        );
                        $totinvplanta += $filab->tot;
                    }


                }
            }

            
        }else{
            $planta[] = array(
                'ubicacion'=>'',
                'cant'=>''
            );
            $totinvplanta=0;
        }
    
        //busca inventario en bodega de mantenimiento y bajas
        $buscari = "SELECT SUM(cant) as tot FROM  invactivos Where codigo = '$coditem' Group by codigo";
        $ejeb = mysqli_query($conexion, $buscari);
        
        $encb = mysqli_num_rows($ejeb);
    
        if($encb > 0){
            $filab = mysqli_fetch_object($ejeb);
            $totinvactivos = $filab->tot;
        }else{
            $totinvactivos = 0;
        }
    
        $total = $obj->cantidad + $totinvplanta + $totinvactivos;
    
        $datos[] = array(
            'id'=>$obj->id,
            'codigo'=>$obj->codigo,
            'clase'=>$obj->clase,
            'unidad'=>$obj->unidad,
            'cantidad'=>$obj->cantidad,
            'cantsalida'=>$planta,
            'cantinvact'=>$totinvactivos,
            'total'=>$total,
            'articulo'=>$obj->articulo
        );
    }

}

echo json_encode($datos);