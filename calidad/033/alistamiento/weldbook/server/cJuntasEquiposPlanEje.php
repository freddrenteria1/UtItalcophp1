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

    $buscar="SELECT especialidad,  COUNT(*) as cant  FROM datoswp WHERE fecha = '$fecha' GROUP BY especialidad";   
    $ejeb = mysqli_query($conexion, $buscar);

    while($row = mysqli_fetch_object($ejeb)){

        $esp = $row->especialidad;

        $buscar2="SELECT  COUNT(*) as cant  FROM datoswp WHERE fecha = '$fecha' AND especialidad = '$esp' GROUP BY especialidad, estw1";   
        $ejeb2 = mysqli_query($conexion, $buscar2);

        $row2 = mysqli_fetch_object($ejeb2);

        $cantsold2 =  mysqli_num_rows($ejeb2);

        $sqlpg="SELECT especialidad, equipo, lugar, pulgadas, plano, SUM(cantw1) AS cantjuntas, SUM(pulgdiam) as totpulg, COUNT(numjunta) as cant  FROM datoswp WHERE fecha = '$fecha' AND especialidad = '$esp' GROUP BY especialidad";   
        $ejeb3 = mysqli_query($conexion, $sqlpg);
    
        while($obj = mysqli_fetch_object($ejeb3)){
    
            $redsold = $obj->totpulg / $cantsold2;
    
            $rendimiento[] = array(
                'especialidad'=>$obj->especialidad,
                'rendimiento'=>$redsold,
                'juntas'=>$obj->cant,
                'pulg'=>$obj->totpulg,
                'cansold'=>$cantsold2
            );
        }

    }






    $datos = array(
        'prog'=>$prog,
        'cantsold'=>$cantsold,
        'rend'=>$rend,
        'rendimiento'=>$rendimiento
    );





echo json_encode($datos);

