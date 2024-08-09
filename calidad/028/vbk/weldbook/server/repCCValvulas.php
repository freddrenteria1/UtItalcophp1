<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM ccvalvulas";
$exito=mysqli_query($conexion, $sql);

$retiroprog=0;
    $instbridasprog=0;
    $trastalletprog=0;
    $retvalvulatallerprog=0;
    $instvalvulaprog=0;
    $etiquetaprog=0;
    $rcaprog=0;

    $retiroeje=0;
    $instbridaseje=0;
    $trastalleteje=0;
    $retvalvulatallereje=0;
    $instvalvulaeje=0;
    $etiquetaeje=0;
    $rcaeje=0;


while( $obj = mysqli_fetch_object($exito)){  

    

        if($obj->retiro != 'NA' && $obj->retiro != ''){
            $retiroprog++;
        }
        if($obj->retiro != 'NA' && $obj->retiro != 'X' && $obj->retiro != ''){
            $retiroeje++;
        }

        if($obj->instbridas != 'NA' && $obj->instbridas != ''){
            $instbridasprog++;
        }
        if($obj->instbridas != 'NA' && $obj->instbridas != 'X' && $obj->instbridas != ''){
            $instbridaseje++;
        }

        if($obj->trastaller != 'NA' && $obj->trastaller != ''){
            $trastalletprog++;
        }
        if($obj->trastaller != 'NA' && $obj->trastaller != 'X' && $obj->trastaller != ''){
            $trastalleteje++;
        }

        if($obj->retvalvulataller != 'NA' && $obj->retvalvulataller != ''){
            $retvalvulatallerprog++;
        }
        if($obj->retvalvulataller != 'NA' && $obj->retvalvulataller != 'X' && $obj->retvalvulataller != ''){
            $retvalvulatallereje++;
        }

        if($obj->instvalvula != 'NA' && $obj->instvalvula != ''){
            $instvalvulaprog++;
        }
        if($obj->instvalvula != 'NA' && $obj->instvalvula != 'X' && $obj->instvalvula != ''){
            $instvalvulaeje++;
        }

        if($obj->etiqueta != 'NA' && $obj->etiqueta != ''){
            $etiquetaprog++;
        }
        if($obj->etiqueta != 'NA' && $obj->etiqueta != 'X' && $obj->etiqueta != ''){
            $etiquetaeje++;
        }

        if($obj->rca != 'NA' && $obj->rca != ''){
            $rcaprog++;
        }
        if($obj->rca != 'NA' && $obj->rca != 'X' && $obj->rca != ''){
            $rcaeje++;
        }

         

}

$datos = array(
    'retiroprog'=>$retiroprog,
    'retiroeje'=>$retiroeje,
    'instbridasprog'=>$instbridasprog,
    'instbridaseje'=>$instbridaseje,
    'trastalletprog'=>$trastalletprog,
    'trastalleteje'=>$trastalleteje,
    'retvalvulatallerprog'=>$retvalvulatallerprog,
    'retvalvulatallereje'=>$retvalvulatallereje,
    'instvalvulaprog'=>$instvalvulaprog,
    'instvalvulaeje'=>$instvalvulaeje,
    'etiquetaprog'=>$etiquetaprog,
    'etiquetaeje'=>$etiquetaeje,
    'rcaprog'=>$rcaprog,
    'rcaeje'=>$rcaeje
);



echo json_encode($datos);