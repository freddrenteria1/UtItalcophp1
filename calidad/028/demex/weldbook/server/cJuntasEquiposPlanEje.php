<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$fecha = $_POST["fecha"];

$fecha = date("d/m/Y", strtotime($fecha));

$sql="SELECT equipo  FROM datoswp GROUP BY equipo ORDER BY equipo";
$exito=mysqli_query($conexion, $sql);

   
    while( $obj = mysqli_fetch_object($exito)){

        $equipo = $obj->equipo;

        $sqle="SELECT equipo, fecha, plano  FROM datoswp WHERE equipo = '$equipo' AND fecha = '$fecha' GROUP BY plano ORDER BY plano";   
        $exitoe=mysqli_query($conexion, $sqle);

        while($obje = mysqli_fetch_object($exitoe)){

            $plano = $obje->plano;

            $sqlp="SELECT especialidad, equipo, lugar, pulgadas, plano, SUM(cantw1) AS juntasp, SUM(pulgdiam) as pulgadasp, COUNT(*) as cant FROM datoswp WHERE equipo = '$equipo' AND plano = '$plano' AND fecha = '$fecha' GROUP BY pulgadas ORDER BY pulgdiam";   
            $exitop=mysqli_query($conexion, $sqlp);

            while($objp = mysqli_fetch_object($exitop)){

                $pulgd = $objp->pulgadas;

                $sumjpt=0;
                $sumppt=0;

                $sumjpc=0;
                $sumppc=0;

                $sumjet=0;
                $sumpet=0;

                $sumjec=0;
                $sumpec=0;


                 

                $sqlpe="SELECT especialidad, equipo, lugar, pulgadas, plano, SUM(cantw1) AS juntasp, SUM(pulgdiam) as pulgadasp, COUNT(*) as cant  FROM datoswp WHERE equipo = '$equipo' AND plano = '$plano' AND pulgadas = '$pulgd' AND lugar='T' and fecha = '$fecha' GROUP BY pulgadas ORDER BY pulgdiam";   
                
                $exitope=mysqli_query($conexion, $sqlpe);

                while($objpe = mysqli_fetch_object($exitope)){
                    
                        $sumjet =  floatval($objpe->cant);
                        $sumpet =  floatval($objpe->pulgadasp);
                     

                }

                 

                $sqlpe="SELECT especialidad, equipo, lugar, pulgadas, plano, SUM(cantw1) AS juntasp, SUM(pulgdiam) as pulgadasp, COUNT(*) as cant  FROM datoswp WHERE equipo = '$equipo' AND plano = '$plano' AND pulgadas = '$pulgd' AND lugar='C' and fecha = '$fecha' GROUP BY pulgadas ORDER BY pulgdiam";   
                
                $exitope=mysqli_query($conexion, $sqlpe);

                while($objpe = mysqli_fetch_object($exitope)){
                     
                     
                        $sumjec =  floatval($objpe->cant);
                        $sumpec =  floatval($objpe->pulgadasp);
                     

                }

  
                $jetot = $sumjet + $sumjec;
                $petot = $sumpet + $sumpec;
  

                $prog[] = array(
                    'equipo'=>$objp->equipo,
                    'plano'=>$objp->plano,
                    'pulgadas'=>$objp->pulgadas,
                    'jet'=>$sumjet,
                    'pet'=>$sumpet,
                    'jec'=>$sumjec,
                    'pec'=>$sumpec,
                    'jetot'=>$jetot,
                    'petot'=>$petot,
                );

                

            }


        }

       
    }

    $buscar="SELECT  COUNT(*) as cant  FROM datoswp WHERE fecha = '$fecha' GROUP BY estw1";   
    $ejeb = mysqli_query($conexion, $buscar);

    $row = mysqli_fetch_object($ejeb);

    $cantsold = mysqli_num_rows($ejeb);

    $cont = count($prog);

    $totp = 0;

    for($i=0; $i<$cont; $i++){
        $totp += $prog[$i]["petot"];
    }

    $rend = $totp / $cantsold;

    $datos = array(
        'prog'=>$prog,
        'cantsold'=>$cantsold,
        'rend'=>$rend
    );





echo json_encode($datos);

