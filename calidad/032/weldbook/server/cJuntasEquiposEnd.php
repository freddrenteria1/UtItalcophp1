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
            

            $sqlp="SELECT especialidad, equipo, lugar, pulgadas, SUM(cantw1) AS juntasp, SUM(pulgdiam) as pulgadasp, COUNT(*) as cant   FROM datoswp WHERE especialidad = '$esp' AND equipo = '$equipo' GROUP BY pulgadas ORDER BY pulgdiam";   
            $exitop=mysqli_query($conexion, $sqlp);



            while($objp = mysqli_fetch_object($exitop)){

                $pulgd = $objp->pulgadas;

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


                $sqlpe="SELECT * FROM datoswp WHERE especialidad = '$esp' AND equipo = '$equipo' AND pulgadas = '$pulgd'";   
                $exitope=mysqli_query($conexion, $sqlpe);

                while($objpe = mysqli_fetch_object($exitope)){

                    //TALLER
                    
                    if($objpe->lugar == 'T'){
                        if($objpe->plpresultado != 'NA'){
                            $plpprogt++;
                        }
                        if($objpe->plpresultado =='OK'){
                            $plpejet++;
                        }

                        if($objpe->rxpreresultado != 'NA'){
                            $rxpreprogt++;
                        }
                        if($objpe->rxpreresultado =='OK'){
                            $rxpreejet++;
                        }

                        if($objpe->utpreresultado != 'NA'){
                            $utpreprogt++;
                        }
                        if($objpe->utpreresultado =='OK'){
                            $utpreejet++;
                        }

                        if($objpe->pwhtresultado != 'NA'){
                            $pwhtprogt++;
                        }
                        if($objpe->pwhtresultado =='OK'){
                            $pwhtejet++;
                        }

                        if($objpe->durezaresultado != 'NA'){
                            $durezaprogt++;
                        }
                        if($objpe->durezaresultado =='OK'){
                            $durezaejet++;
                        }

                        if($objpe->rxpostresultado != 'NA'){
                            $rxpostprogt++;
                        }
                        if($objpe->rxpostresultado =='OK'){
                            $rxpostejet++;
                        }

                        if($objpe->utpostresultado != 'NA'){
                            $utpostprogt++;
                        }
                        if($objpe->utpostresultado =='OK'){
                            $utpostejet++;
                        }

                    }
                    
                    //CAMPO

                    if($objpe->lugar == 'C'){
                        if($objpe->plpresultado != 'NA'){
                            $plpprogc++;
                        }
                        if($objpe->plpresultado =='OK'){
                            $plpejec++;
                        }

                        if($objpe->rxpreresultado != 'NA'){
                            $rxpreprogc++;
                        }
                        if($objpe->rxpreresultado =='OK'){
                            $rxpreejec++;
                        }

                        if($objpe->utpreresultado != 'NA'){
                            $utpreprogc++;
                        }
                        if($objpe->utpreresultado =='OK'){
                            $utpreejec++;
                        }

                        if($objpe->pwhtresultado != 'NA'){
                            $pwhtprogc++;
                        }
                        if($objpe->pwhtresultado =='OK'){
                            $pwhtejec++;
                        }

                        if($objpe->durezaresultado != 'NA'){
                            $durezaprogc++;
                        }
                        if($objpe->durezaresultado =='OK'){
                            $durezaejec++;
                        }

                        if($objpe->rxpostresultado != 'NA'){
                            $rxpostprogc++;
                        }
                        if($objpe->rxpostresultado =='OK'){
                            $rxpostejec++;
                        }

                        if($objpe->utpostresultado != 'NA'){
                            $utpostprogc++;
                        }
                        if($objpe->utpostresultado =='OK'){
                            $utpostejec++;
                        }


                    }

                    

                }

                $plpprogtot += $plpprogt + $plpprogc;
                $plpejetot += $plpejet + $plpejec;

                if($plpprogt != 0){
                    $aplpt = round((($plpejet/$plpprogt)*100), 0);
                }else{
                    $aplpt = 0;
                }

                if($plpprogc != 0){
                    $aplpc = round((($plpejec/$plpprogc)*100), 0);
                }else{
                    $aplpc = 0;
                }

                if($plpprogtot != 0){
                    $aplptot = round((($plpejetot/$plpprogtot)*100), 0);
                }else{
                    $aplptot = 0;
                }

                $rxpreprogtot += $rxpreprogt + $rxpreprogc;
                $rxpreejetot += $rxpreejet + $rxpreejec;

                if($rxpreprogt != 0){
                    $arxpret = round((($rxpreejet/$rxpreprogt)*100), 0);
                }else{
                    $arxpret = 0;
                }

                if($rxpreprogc != 0){
                    $arxprec = round((($rxpreejec/$rxpreprogc)*100), 0);
                }else{
                    $arxprec = 0;
                }

                if($rxpreprogtot != 0){
                    $arxpretot = round((($rxpreejetot/$rxpreprogtot)*100), 0);
                }else{
                    $arxpretot = 0;
                }

                $utpreprogtot += $utpreprogt + $utpreprogc;
                $utpreejetot += $utpreejet + $utpreejec;

                if($utpreprogt != 0){
                    $autpret = round((($utpreejet/$utpreprogt)*100), 0);
                }else{
                    $autpret = 0;
                }

                if($utpreprogc != 0){
                    $autprec = round((($utpreejec/$utpreprogc)*100), 0);
                }else{
                    $autprec = 0;
                }

                if($utpreprogtot != 0){
                    $autpretot = round((($utpreejetot/$utpreprogtot)*100), 0);
                }else{
                    $autpretot = 0;
                }

                $pwhtprogtot += $pwhtprogt + $pwhtprogc;
                $pwhtejetot += $pwhtejet + $pwhtejec;

                if($pwhtprogt != 0){
                    $apwhtt = round((($pwhtejet/$pwhtprogt)*100), 0);
                }else{
                    $apwhtt = 0;
                }

                if($pwhtprogc != 0){
                    $apwhtc = round((($pwhtejec/$pwhtprogc)*100), 0);
                }else{
                    $apwhtc = 0;
                }

                if($pwhtprogtot != 0){
                    $apwhttot = round((($pwhtejetot/$pwhtprogtot)*100), 0);
                }else{
                    $apwhttot = 0;
                }

                $durezaprogtot += $durezaprogt + $durezaprogc;
                $durezaejetot += $durezaejet + $durezaejec;

                if($durezaprogt != 0){
                    $adurezat = round((($durezaejet/$durezaprogt)*100), 0);
                }else{
                    $adurezat = 0;
                }

                if($durezaprogc != 0){
                    $adurezac = round((($durezaejec/$durezaprogc)*100), 0);
                }else{
                    $adurezac = 0;
                }

                if($durezaprogtot != 0){
                    $adurezatot = round((($durezaejetot/$durezaprogtot)*100), 0);
                }else{
                    $adurezatot = 0;
                }

                $rxpostprogtot += $rxpostprogt + $rxpostprogc;
                $rxpostejetot += $rxpostejet + $rxpostejec;

                if($rxpostprogt != 0){
                    $arxpostt = round((($rxpostejet/$rxpostprogt)*100), 0);
                }else{
                    $arxpostt = 0;
                }

                if($rxpostprogc != 0){
                    $arxpostc = round((($rxpostejec/$rxpostprogc)*100), 0);
                }else{
                    $arxpostc = 0;
                }

                if($rxpostprogtot != 0){
                    $arxposttot = round((($rxpostejetot/$rxpostprogtot)*100), 0);
                }else{
                    $arxposttot = 0;
                }

                $utpostprogtot += $utpostprogt + $utpostprogc;
                $utpostejetot += $utpostejet + $utpostejec;

                if($utpostprogt != 0){
                    $autpostt = round((($utpostejet/$utpostprogt)*100), 0);
                }else{
                    $autpostt = 0;
                }

                if($utpostprogc != 0){
                    $autpostc = round((($utpostejec/$utpostprogc)*100), 0);
                }else{
                    $autpostc = 0;
                }

                if($utpostprogtot != 0){
                    $autposttot = round((($utpostejetot/$utpostprogtot)*100), 0);
                }else{
                    $autposttot = 0;
                }

                $prog[] = array(
                    'especialidad'=>$objp->especialidad,
                    'equipo'=>$objp->equipo,
                    'pulgadas'=>$objp->pulgadas,
                    'plpprogt'=>$plpprogt,
                    'plpejet'=>$plpejet,
                    'aplpt'=>$aplpt,
                    'plpprogc'=>$plpprogc,
                    'plpejec'=>$plpejec,
                    'aplpc'=>$aplpc,
                    'plpprogtot'=>$plpprogtot,
                    'plpejetot'=>$plpejetot,
                    'aplptot'=>$aplptot,
                    'rxpreprogt'=>$rxpreprogt,
                    'rxpreejet'=>$rxpreejet,
                    'arxpret'=>$arxpret,
                    'rxpreprogc'=>$rxpreprogc,
                    'rxpreejec'=>$rxpreejec,
                    'arxprec'=>$arxprec,
                    'rxpreprogtot'=>$rxpreprogtot,
                    'rxpreejetot'=>$rxpreejetot,
                    'arxpretot'=>$arxpretot,
                    'utpreprogt'=>$utpreprogt,
                    'utpreejet'=>$utpreejet,
                    'autpret'=>$autpret,
                    'utpreprogc'=>$utpreprogc,
                    'utpreejec'=>$utpreejec,
                    'autprec'=>$autprec,
                    'utpreprogtot'=>$utpreprogtot,
                    'utpreejetot'=>$utpreejetot,
                    'autpretot'=>$autpretot,
                    'pwhtprogt'=>$pwhtprogt,
                    'pwhtejet'=>$pwhtejet,
                    'apwhtt'=>$apwhtt,
                    'pwhtprogc'=>$pwhtprogc,
                    'pwhtejec'=>$pwhtejec,
                    'apwhtc'=>$apwhtc,
                    'pwhtprogtot'=>$pwhtprogtot,
                    'pwhtejetot'=>$pwhtejetot,
                    'apwhttot'=>$apwhttot,
                    'durezaprogt'=>$durezaprogt,
                    'durezaejet'=>$durezaejet,
                    'adurezat'=>$adurezat,
                    'durezaprogc'=>$durezaprogc,
                    'durezaejec'=>$durezaejec,
                    'adurezac'=>$adurezac,
                    'durezaprogtot'=>$durezaprogtot,
                    'durezaejetot'=>$durezaejetot,
                    'adurezatot'=>$adurezatot,
                    'rxpostprogt'=>$rxpostprogt,
                    'rxpostejet'=>$rxpostejet,
                    'arxpostt'=>$arxpostt,
                    'rxpostprogc'=>$rxpostprogc,
                    'rxpostejec'=>$rxpostejec,
                    'arxpostc'=>$arxpostc,
                    'rxpostprogtot'=>$rxpostprogtot,
                    'rxpostejetot'=>$rxpostejetot,
                    'arxposttot'=>$arxposttot,
                    'utpostprogt'=>$utpostprogt,
                    'utpostejet'=>$utpostejet,
                    'autpostt'=>$autpostt,
                    'utpostprogc'=>$utpostprogc,
                    'utpostejec'=>$utpostejec,
                    'autpostc'=>$autpostc,
                    'utpostprogtot'=>$utpostprogtot,
                    'utpostejetot'=>$utpostejetot,
                    'autposttot'=>$autposttot
                );

            }

        }
       
    }

echo json_encode($prog);