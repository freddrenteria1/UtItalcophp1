<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");



$sql="SELECT especialidad  FROM datoswp GROUP BY especialidad ORDER BY especialidad";
$exito=mysqli_query($conexion, $sql);

   
    while( $obj = mysqli_fetch_object($exito)){

        $esp = $obj->especialidad;

        $sqle="SELECT equipo  FROM datoswp WHERE especialidad = '$esp' GROUP BY equipo ORDER BY equipo";   
        $exitoe=mysqli_query($conexion, $sqle);

        while($obje = mysqli_fetch_object($exitoe)){

            $equipo = $obje->equipo;

            $sqlp="SELECT especialidad, equipo, lugar, pulgadas, SUM(cantw1) AS juntasp, SUM(pulgdiam) as pulgadasp, COUNT(*) as cant   FROM datoswp WHERE especialidad = '$esp' AND equipo = '$equipo' GROUP BY pulgadas ORDER BY pulgdiam";   
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


                $sqlpe="SELECT especialidad, equipo, lugar, pulgadas, SUM(cantw1) AS juntasp, SUM(pulgdiam) as pulgadasp, COUNT(*) as cant  FROM datoswp WHERE especialidad = '$esp' AND equipo = '$equipo' AND pulgadas = '$pulgd' AND lugar='T' GROUP BY pulgadas ORDER BY pulgdiam";   
                
                $exitope=mysqli_query($conexion, $sqlpe);

                while($objpe = mysqli_fetch_object($exitope)){
                    
                        $sumjpt = floatval($objpe->cant);
                        $sumppt =  floatval($objpe->pulgadasp);
                     

                }

                $sqlpe="SELECT especialidad, equipo, lugar, pulgadas, SUM(cantw1) AS juntasp, SUM(pulgdiam) as pulgadasp, COUNT(*) as cant  FROM datoswp WHERE especialidad = '$esp' AND equipo = '$equipo' AND pulgadas = '$pulgd' AND lugar='T' and fecha != '' GROUP BY pulgadas ORDER BY pulgdiam";   
                
                $exitope=mysqli_query($conexion, $sqlpe);

                while($objpe = mysqli_fetch_object($exitope)){
                    
                        $sumjet =  floatval($objpe->cant);
                        $sumpet =  floatval($objpe->pulgadasp);
                     

                }

                $sqlpe="SELECT especialidad, equipo, lugar, pulgadas, SUM(cantw1) AS juntasp, SUM(pulgdiam) as pulgadasp, COUNT(*) as cant  FROM datoswp WHERE especialidad = '$esp' AND equipo = '$equipo' AND pulgadas = '$pulgd' AND lugar='C' GROUP BY pulgadas ORDER BY pulgdiam";   
                
                $exitope=mysqli_query($conexion, $sqlpe);

                while($objpe = mysqli_fetch_object($exitope)){
                     
                     
                        $sumjpc =  floatval($objpe->cant);
                        $sumppc =  floatval($objpe->pulgadasp);
                     

                }

                $sqlpe="SELECT especialidad, equipo, lugar, pulgadas, SUM(cantw1) AS juntasp, SUM(pulgdiam) as pulgadasp, COUNT(*) as cant  FROM datoswp WHERE especialidad = '$esp' AND equipo = '$equipo' AND pulgadas = '$pulgd' AND lugar='C' and fecha != '' GROUP BY pulgadas ORDER BY pulgdiam";   
                
                $exitope=mysqli_query($conexion, $sqlpe);

                while($objpe = mysqli_fetch_object($exitope)){
                     
                     
                        $sumjec =  floatval($objpe->cant);
                        $sumpec =  floatval($objpe->pulgadasp);
                     

                }


                //avance taller

                if($sumjpt != 0){
                    $ajt = round((($sumjet/$sumjpt)*100), 0);
                    if(is_nan($ajt)){
                        $ajt = 0;
                    }
                }else{
                    $ajt = 0;
                }

                if($sumjpt != 0){
                    $apt = round((($sumpet/$sumppt)*100), 0);
                    if(is_nan($apt)){
                        $apt = 0;
                    }
                }else{
                    $apt = 0;
                }

                //avance campo

                if($sumjpc != 0){
                    $ajc = round((($sumjec/$sumjpc)*100), 0);
                    if(is_nan($ajc)){
                        $ajc = 0;
                    }
                }else{
                    $ajc = 0;
                }

                if($sumjpc != 0){
                    $apc = round((($sumpec/$sumppc)*100), 0);
                    if(is_nan($apc)){
                        $apc = 0;
                    }
                }else{
                    $apc = 0;
                }

                $jptot = floatval($objp->cant);
                $pptot = floatval($objp->pulgadasp);

                $jetot = $sumjet + $sumjec;
                $petot = $sumpet + $sumpec;

                $ajtot = round((($jetot/$jptot)*100), 0);
                if(is_nan($ajtot)){
                    $ajtot = 0;
                }

                $aptot = round((($petot/$pptot)*100), 0);
                if(is_nan($aptot)){
                    $aptot = 0;
                }

                $jpdt = $sumjpt - $sumjet;
                $ppdt = $sumppt - $sumpet;

                $jpdc = $sumjpc - $sumjec;
                $ppdc = $sumppc - $sumpec;

                $jtpdc = $jptot - $jetot;
                $ptpdc = $pptot - $petot;
                

                $prog[] = array(
                    'especialidad'=>$objp->especialidad,
                    'equipo'=>$objp->equipo,
                    'pulgadas'=>$objp->pulgadas,
                    'jpt'=>$sumjpt,
                    'jet'=>$sumjet,
                    'jpdt'=>$jpdt,
                    'ajt'=>$ajt,
                    'ppt'=>$sumppt,
                    'pet'=>$sumpet,
                    'ppdt'=>$ppdt,
                    'apt'=>$apt,
                    'jpc'=>$sumjpc,
                    'jec'=>$sumjec,
                    'jpdc'=>$jpdc,
                    'ajc'=>$ajc,
                    'ppc'=>$sumppc,
                    'pec'=>$sumpec,
                    'ppdc'=>$ppdc,
                    'apc'=>$apc,
                    'jptot'=>$jptot,
                    'jetot'=>$jetot,
                    'jtpdc'=>$jtpdc,
                    'ajtot'=>$ajtot,
                    'pptot'=>$pptot,
                    'petot'=>$petot,
                    'ptpdc'=>$ptpdc,
                    'aptot'=>$aptot
                );

                

            }


        }

       
    }



echo json_encode($prog);

