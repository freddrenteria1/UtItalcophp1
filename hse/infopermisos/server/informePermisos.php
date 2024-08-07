<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$fecha = $_POST["fecha"];

// $ods = $_GET["ods"];
// $fecha = $_GET["fecha"];


    $query="SELECT * FROM permisostrab WHERE ods = '$ods' AND fecha='$fecha' GROUP BY turno";
    $eje=mysqli_query($conexion, $query);

    while ($obj = mysqli_fetch_object($eje)){

        $turno = $obj->turno;

        $turnos[] = array(
            'turno'=>$turno
        );

        $pfrio = 0;
        $pcaliente = 0;
        $pelectrico = 0;

        $raml = 0;
        $ramm = 0;
        $ramh = 0;
        $ramvh = 0;

        $ca1 = 0;
        $ca2 = 0;
        $ca3 = 0;
        $ca5 = 0;
        $ca6 = 0;
        $ca7 = 0;
        $sas = 0;
        $saes = 0;

        $pra = 0;
        $prc = 0;   
        $prg = 0;

        $ca1n = 0;
        $ca2n = 0;
        $ca3n = 0;
        $ca5n = 0;
        $ca6n = 0;
        $ca7n = 0;
        $sasn = 0;
        $saesn = 0;
        
        $pran = 0;
        $prcn = 0;   
        $prgn = 0;

        $prevalidados = 0;
        $pnuevos = 0;
        $pcerrados = 0;

        
        $sql="SELECT * FROM permisostrab WHERE ods = '$ods' AND fecha='$fecha' and turno = '$turno'";
        $exito=mysqli_query($conexion, $sql);
        

        while ($row = mysqli_fetch_object($exito)){

            
                $prevalidados++;
                $pfrio += $row->pfrio;
                $pcaliente += $row->pcaliente;
                $pelectrico += $row->pelectrico;
           
                $raml += $row->raml;
                $ramm += $row->ramm;
                $ramh += $row->ramh;
                $ramvh += $row->ramvh;

               

                    $ca1 += $row->ca1;
                    $ca2 += $row->ca2;
                    $ca3 += $row->ca3;
                    $ca5 += $row->ca5;
                    $ca6 += $row->ca6;
                    $ca7 += $row->ca7;
                    $sas += $row->sas;
                    $saes += $row->saes;

                    $pra += $row->pra;
                    $prc += $row->prc;    
                    $prg += $row->prg;

                

                if($row->pnuevos == 1 && $row->pcerrados == 0){

                    $ca1n += $row->ca1;
                    $ca2n += $row->ca2;
                    $ca3n += $row->ca3;
                    $ca5n += $row->ca5;
                    $ca6n += $row->ca6;
                    $ca7n += $row->ca7;
                    $sasn += $row->sas;
                    $saesn += $row->saes;

                    $pran += $row->pra;
                    $prcn += $row->prc;    
                    $prgn += $row->prg;

                }

                
            if($row->pnuevos == 1 && $row->pcerrados == 0){
                $pnuevos += $row->pnuevos;
            }

            $pcerrados += $row->pcerrados;
            
        }  


        $total = $pfrio+$pcaliente+$pelectrico;
        $totalmatriz = $raml + $ramh+$ramm+$ramvh;
        $totalca = $ca1 + $ca2 + $ca3 + $ca5 + $ca6 + $ca7 + $sas + $saes;
        $totalpr = $pra + $prc + $prg;

        $totalcan = $ca1n + $ca2n + $ca3n + $ca5n + $ca6n + $ca7n + $sasn + $saesn;
        $totalprn = $pran + $prcn + $prgn;

        $datos[] = array(
            'pfrio'=>$pfrio,
            'pcaliente'=>$pcaliente,
            'pelectrico'=>$pelectrico,
            'totalp'=>$total,
            'raml'=>$raml,
            'ramm'=>$ramm,
            'ramh'=>$ramh,
            'ramvh'=>$ramvh,
            'totalmatriz'=>$totalmatriz,
            'ca1'=>$ca1,
            'ca2'=>$ca2,
            'ca3'=>$ca3,
            'ca5'=>$ca5,
            'ca6'=>$ca6,
            'ca7'=>$ca7,
            'sas'=>$sas,
            'saes'=>$saes,
            'totalca'=>$totalca,
            'pra'=>$pra,
            'prc'=>$prc,
            'prg'=>$prg,
            'totalpr'=>$totalpr,
            'ca1n'=>$ca1n,
            'ca2n'=>$ca2n,
            'ca3n'=>$ca3n,
            'ca5n'=>$ca5n,
            'ca6n'=>$ca6n,
            'ca7n'=>$ca7n,
            'sasn'=>$sasn,
            'saesn'=>$saesn,
            'totalcan'=>$totalcan,
            'pran'=>$pran,
            'prcn'=>$prcn,
            'prgn'=>$prgn,
            'totalprn'=>$totalprn,
            'prevalidados'=>$prevalidados,
            'pnuevos'=>$pnuevos,
            'pcerrados'=>$pcerrados
        );


    }


        //guardar la tabla
        
            $sql="SELECT * FROM permisostrab WHERE ods = '$ods' AND fecha='$fecha'";
            $exito=mysqli_query($conexion, $sql);
        

        while ($row = mysqli_fetch_object($exito)){


            $tabla[] = array(
                'id' => $row->id,
                'num'=>$row->num,
                'empresa'=>$row->empresa,
                'pfrio'=>$row->pfrio,
                'pcaliente'=>$row->pcaliente,
                'pelectrico'=>$row->pelectrico,
                'actividad'=>$row->actividad,
                'especialidad'=>$row->especialidad,
                'supervisor'=>$row->supervisor,
                'area'=>$row->area,
                'equipo'=>$row->equipo,
                'planta'=>$row->planta,
                'turno'=>$row->turno,
                'raml'=>$row->raml,
                'ramm'=>$row->ramm,
                'ramh'=>$row->ramh,
                'ramvh'=>$row->ramvh,
                'ca1'=>$row->ca1,
                'ca2'=>$row->ca2,
                'ca3'=>$row->ca3,
                'ca5'=>$row->ca5,
                'ca6'=>$row->ca6,
                'ca7'=>$row->ca7,
                'sas'=>$row->sas,
                'saes'=>$row->saes,
                'pra'=>$row->pra,
                'prc'=>$row->prc,
                'prg'=>$row->prg,
                'cvias'=>$row->cvias,
                'pizaje'=>$row->pizaje,
                'agua'=>$row->agua,
                'prevalidados'=>$row->prevalidados,
                'pnuevos'=>$row->pnuevos,
                'pcerrados'=>$row->pcerrados,
                'numpcerrado'=>$row->numpcerrado,
                'personas'=>$row->personas,
                'observaciones'=>$row->observaciones
            );
            
        }  

        

        $query="SELECT * FROM observacionespermisos WHERE ods = '$ods' AND fecha='$fecha'";
        $eje=mysqli_query($conexion, $query);

        $observaciones = '';
        $personal = 0;

        while($row = mysqli_fetch_object($eje)){
            $observaciones .=  ' - ' . $row->observaciones;
            $personal += $row->personal;
        }

        $consolidado = array(
            
            'tabla'=>$tabla,
            'datos'=>$datos,
            'observaciones'=>$observaciones,
            'personal'=>$personal,
            'turnos'=>$turnos
        );

echo json_encode($consolidado);