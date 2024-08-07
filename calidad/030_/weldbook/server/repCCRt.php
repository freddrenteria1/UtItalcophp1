<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$buscar = "SELECT * FROM ccrt GROUP BY especialidad";
$ejeb = mysqli_query($conexion, $buscar);

$test1=0;
$test2=0;
$test3=0;
$test4=0;
$tstot=0;

while($obj = mysqli_fetch_object($ejeb)){
    
    $esp = $obj->especialidad;

    $est1=0;
    $est2=0;
    $est3=0;
    $est4=0;

    $sql="SELECT * FROM ccrt WHERE especialidad = '$esp'";
    $exito=mysqli_query($conexion, $sql);

    while( $row = mysqli_fetch_object($exito)){  

        if($row->estadort == 'EJECUTADA'){
            $est1++;
        }
        if($row->estadort == 'EN EJECUCION'){
            $est2++;
        }
        if($row->estadort == 'PDTE EJECUTAR'){
            $est3++;
        }
        if($row->estadort == 'NA'){
            $est4++;
        }
         
    }

    $stot = $est1 + $est2 + $est3 + $est4;

    $espert[] = array(
        'esp'=>$esp,
        'est1'=>$est1,
        'est2'=>$est2,
        'est3'=>$est3,
        'est4'=>$est4,
        'stot'=>$stot
    );

    $test1 += $est1;
    $test2 += $est2;
    $test3 += $est3;
    $test4 += $est4;
    $tstot += $stot;


}

$espert[] = array(
    'esp'=>'TOTALES',
    'est1'=>$test1,
    'est2'=>$test2,
    'est3'=>$test3,
    'est4'=>$test4,
    'stot'=>$tstot
);

$test1=0;
$test2=0;
$test3=0;
$test4=0;
$tstot=0;


$buscar = "SELECT * FROM ccrt GROUP BY especialidad";
$ejeb = mysqli_query($conexion, $buscar);

while($obj = mysqli_fetch_object($ejeb)){
    
    $esp = $obj->especialidad;

    $est1=0;
    $est2=0;
    $est3=0;
    $est4=0;

    $sql="SELECT * FROM ccrt WHERE especialidad = '$esp'";
    $exito=mysqli_query($conexion, $sql);

    while( $row = mysqli_fetch_object($exito)){  

        if($row->estadodiag == 'EJECUTADO'){
            $est1++;
        }
        if($row->estadodiag == 'EN EJECUCIÓN'){
            $est2++;
        }
        if($row->estadodiag == 'PENDIENTE'){
            $est3++;
        }
        if($row->estadodiag == 'NA'){
            $est4++;
        }
         
    }

    $stot = $est1 + $est2 + $est3 + $est4;

    $espediag[] = array(
        'esp'=>$esp,
        'est1'=>$est1,
        'est2'=>$est2,
        'est3'=>$est3,
        'est4'=>$est4,
        'stot'=>$stot
    );

    $test1 += $est1;
    $test2 += $est2;
    $test3 += $est3;
    $test4 += $est4;
    $tstot += $stot;

}

$espediag[] = array(
    'esp'=>'TOTALES',
    'est1'=>$test1,
    'est2'=>$test2,
    'est3'=>$test3,
    'est4'=>$test4,
    'stot'=>$tstot
);

$datos =  array(
    'esprt'=>$espert,
    'espdiag'=>$espediag
);


echo json_encode($datos);   