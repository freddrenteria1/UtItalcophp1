<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d", strtotime("2023-05-23"));

$acumd = 0;
$acum = 0;

$query = "TRUNCATE  curvarspa";
$exito = mysqli_query($conexion, $query); 

for($i=0; $i<17; $i++){

    $cons = "SELECT * FROM rspaest";
    $ejec = mysqli_query($conexion, $cons);

    $acumd = 0;
  
    while($obj = mysqli_fetch_object($ejec)){

        if($obj->col1 == $fecha){
            $acumd += 2;
        }

        if($obj->col2 == $fecha){
            $acumd += 1;
        }
        
        if($obj->col3 == $fecha){
            $acumd += 1;
        }

        if($obj->col4 == $fecha){
            $acumd += 1;
        }

        if($obj->col5 == $fecha){
            $acumd += 1;
        }

        if($obj->col6 == $fecha){
            $acumd += 6;
        }

        if($obj->col7 == $fecha){
            $acumd += 2;
        }

        if($obj->col8 == $fecha){
            $acumd += 2;
        }

        if($obj->col9 == $fecha){
            $acumd += 2;
        }

        if($obj->col10 == $fecha){
            $acumd += 2;
        }

       
        

    }

    $acum += $acumd;

    $hitos[] = array(
        'fecha'=>$fecha,
        'acumd'=>$acumd,
        'acum'=>$acum
    );

    $query = "INSERT INTO curvarspa VALUES('','$fecha',$acumd,$acum)";
    $exito = mysqli_query($conexion, $query); 
    
    $fecha = date("Y-m-d",strtotime($fecha."+ 1 days")); 

}






// $cons = "SELECT * FROM rspaest ";
// $ejec = mysqli_query($conexion, $cons);

// while($obj = mysqli_fetch_object($ejec)){

//     $porc = round(($obj->firmasEje / $obj->firmasPlan) * 100);

//     $hitos[] = array(
//         'fecha'=>$obj->fecha,
//         'firmasPlan'=>$obj->firmasPlan,
//         'firmasEje'=>$obj->firmasEje,
//         'porc'=>$porc
//     );

// }

echo json_encode($hitos);
