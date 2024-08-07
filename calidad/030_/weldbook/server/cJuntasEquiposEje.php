<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$fecha = $_POST["fecha"];

$fecha = date("d/m/Y", strtotime($fecha));

$sql="SELECT especialidad  FROM datoswp GROUP BY especialidad ORDER BY especialidad";
$exito=mysqli_query($conexion, $sql);

   
    while( $obj = mysqli_fetch_object($exito)){

        $esp = $obj->especialidad;

        $sqle="SELECT equipo, fecha  FROM datoswp WHERE especialidad = '$esp' AND fecha = '$fecha' GROUP BY equipo ORDER BY equipo";   
        $exitoe=mysqli_query($conexion, $sqle);

        while($obje = mysqli_fetch_object($exitoe)){

            $equipo = $obje->equipo;

            $sqlp="SELECT especialidad, equipo, lugar, pulgadas, SUM(cantw1) AS juntasp, SUM(pulgdiam) as pulgadasp, COUNT(*) as cant FROM datoswp WHERE especialidad = '$esp' AND equipo = '$equipo' AND fecha = '$fecha' GROUP BY pulgadas ORDER BY pulgdiam";   
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


                 

                $sqlpe="SELECT especialidad, equipo, lugar, pulgadas, SUM(cantw1) AS juntasp, SUM(pulgdiam) as pulgadasp, COUNT(*) as cant  FROM datoswp WHERE especialidad = '$esp' AND equipo = '$equipo' AND pulgadas = '$pulgd' AND lugar='T' and fecha = '$fecha' GROUP BY pulgadas ORDER BY pulgdiam";   
                
                $exitope=mysqli_query($conexion, $sqlpe);

                while($objpe = mysqli_fetch_object($exitope)){
                    
                        $sumjet =  floatval($objpe->cant);
                        $sumpet =  floatval($objpe->pulgadasp);
                     

                }

                 

                $sqlpe="SELECT especialidad, equipo, lugar, pulgadas, SUM(cantw1) AS juntasp, SUM(pulgdiam) as pulgadasp, COUNT(*) as cant  FROM datoswp WHERE especialidad = '$esp' AND equipo = '$equipo' AND pulgadas = '$pulgd' AND lugar='C' and fecha = '$fecha' GROUP BY pulgadas ORDER BY pulgdiam";   
                
                $exitope=mysqli_query($conexion, $sqlpe);

                while($objpe = mysqli_fetch_object($exitope)){
                     
                     
                        $sumjec =  floatval($objpe->cant);
                        $sumpec =  floatval($objpe->pulgadasp);
                     

                }

  
                $jetot = $sumjet + $sumjec;
                $petot = $sumpet + $sumpec;
  

                $prog[] = array(
                    'especialidad'=>$objp->especialidad,
                    'equipo'=>$objp->equipo,
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



echo json_encode($prog);

