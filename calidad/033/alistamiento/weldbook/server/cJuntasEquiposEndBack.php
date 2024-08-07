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

                $plpprogt=0;
                $plpejet=0;
                $plpprogc=0;
                $plpejec=0;
                $plpprogtot=0;
                $plpejetot=0;

                $rxpreprogt=0;
                $rxpreejet=0;
                $rxpreprogc=0;
                $rxpreejec=0;
                $rxpreprogtot=0;
                $rxpreejetot=0;

                $utpreprogt=0;
                $utpreejet=0;
                $utpreprogc=0;
                $utpreejec=0;
                $utpreprogtot=0;
                $utpreejetot=0;

                $pwhtprogt=0;
                $pwhtejet=0;
                $pwhtprogc=0;
                $pwhtejec=0;
                $pwhtprogtot=0;
                $pwhtejetot=0;

                $durezaprogt=0;
                $durezaejet=0;
                $durezaprogc=0;
                $durezaejec=0;
                $durezaprogtot=0;
                $durezaejetot=0;

                $rxpostprogt=0;
                $rxpostejet=0;
                $rxpostprogc=0;
                $rxpostejec=0;
                $rxpostprogtot=0;
                $rxpostejetot=0;

                $utpostprogt=0;
                $utpostejet=0;
                $utpostprogc=0;
                $utpostejec=0;
                $utpostprogtot=0;
                $utpostejetot=0;

 
                $sqlpe="SELECT * FROM datoswp WHERE especialidad = '$esp' AND equipo = '$equipo' AND fecha != ''";   
                $exitope=mysqli_query($conexion, $sqlpe);

                while($objpe = mysqli_fetch_object($exitope)){


                        //PROGRAMADO
                        $cadena = $objpe->plpresultado;
                        $busq = "X";

                        $enc = strpos($cadena, $busq);

                        if($enc !== false){
                            $plpprogc++;
                        }

                        //EJECUTADO
                        $cadena = $objpe->plpresultado;
                        $busq = "OK";

                        $enc = strpos($cadena, $busq);

                        if($enc !== false){
                            $plpejec++;
                        }


                        ////////////

                        //PROGRAMADO
                        $cadena = $objpe->rxpreresultado;
                        $busq = "X";

                        $enc = strpos($cadena, $busq);

                        if($enc !== false){
                            $rxpreprogc++;
                        }

                        //EJECUTADO
                        $cadena = $objpe->rxpreresultado;
                        $busq = "OK";

                        $enc = strpos($cadena, $busq);

                        if($enc !== false){
                            $rxpreejec++;
                        }


                        ////////////

                        //PROGRAMADO
                        $cadena = $objpe->utpreresultado;
                        $busq = "X";

                        $enc = strpos($cadena, $busq);

                        if($enc !== false){
                            $utpreprogc++;
                        }

                        //EJECUTADO
                        $cadena = $objpe->utpreresultado;
                        $busq = "OK";

                        $enc = strpos($cadena, $busq);

                        if($enc !== false){
                            $utpreejec++;
                        }

                        ////////////

                        //PROGRAMADO
                        $cadena = $objpe->pwhtresultado;
                        $busq = "X";

                        $enc = strpos($cadena, $busq);

                        if($enc !== false){
                            $pwhtprogc++;
                        }

                        //EJECUTADO
                        $cadena = $objpe->pwhtresultado;
                        $busq = "OK";

                        $enc = strpos($cadena, $busq);

                        if($enc !== false){
                            $pwhtejec++;
                        }


                        ////////////

                        //PROGRAMADO
                        $cadena = $objpe->durezaresultado;
                        $busq = "X";

                        $enc = strpos($cadena, $busq);

                        if($enc !== false){
                            $durezaprogc++;
                        }

                        //EJECUTADO
                        $cadena = $objpe->durezaresultado;
                        $busq = "OK";

                        $enc = strpos($cadena, $busq);

                        if($enc !== false){
                            $durezaejec++;
                        }


                        ////////////

                        //PROGRAMADO
                        $cadena = $objpe->rxpostresultado;
                        $busq = "X";

                        $enc = strpos($cadena, $busq);

                        if($enc !== false){
                            $rxpostprogc++;
                        }

                        //EJECUTADO
                        $cadena = $objpe->rxpostresultado;
                        $busq = "OK";

                        $enc = strpos($cadena, $busq);

                        if($enc !== false){
                            $rxpostejec++;
                        }

                        ////////////

                        //PROGRAMADO
                        $cadena = $objpe->utpostresultado;
                        $busq = "X";

                        $enc = strpos($cadena, $busq);

                        if($enc !== false){
                            $utpostprogc++;
                        }

                        //EJECUTADO
                        $cadena = $objpe->utpostresultado;
                        $busq = "OK";

                        $enc = strpos($cadena, $busq);

                        if($enc !== false){
                            $utpostejec++;
                        }


                }

                $aplptot = $plpprogc+$plpejec;
                $arxpretot = $rxpreprogc + $rxpreejec;
                $autpretot = $utpreprogc + $utpreejec;
                $apwhttot = $pwhtprogc + $pwhtejec;
                $adurezatot = $durezaprogc + $durezaejec;
                $arxposttot = $rxpostprogc + $rxpostejec;
                $autposttot = $utpostprogc + $utpostejec;

                $prog[] = array(
                    'especialidad'=>$esp,
                    'equipo'=>$equipo,
                    
                    'plpprogtot'=>$plpprogc,
                    'plpejetot'=>$plpejec,
                    'aplptot'=>$aplptot,
                    
                    'rxpreprogtot'=>$rxpreprogc,
                    'rxpreejetot'=>$rxpreejec,
                    'arxpretot'=>$arxpretot,
                                        
                    'utpreprogtot'=>$utpreprogc,
                    'utpreejetot'=>$utpreejec,
                    'autpretot'=>$autpretot,
                    
                    'pwhtprogtot'=>$pwhtprogc,
                    'pwhtejetot'=>$pwhtejec,
                    'apwhttot'=>$apwhttot,
                    
                    'durezaprogtot'=>$durezaprogc,
                    'durezaejetot'=>$durezaejec,
                    'adurezatot'=>$adurezatot,
                    
                    'rxpostprogtot'=>$rxpostprogc,
                    'rxpostejetot'=>$rxpostejec,
                    'arxposttot'=>$arxposttot,
                    
                    'utpostprogtot'=>$utpostprogc,
                    'utpostejetot'=>$utpostejec,
                    'autposttot'=>$autposttot
                    
                );

            }
        }

        

echo json_encode($prog);