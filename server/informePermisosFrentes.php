<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$fecha = $_POST["fecha"];


    $query="SELECT * FROM permisostrab WHERE ods = '$ods' AND fecha='$fecha' GROUP BY frente";
    $eje=mysqli_query($conexion, $query);

    while ($obj = mysqli_fetch_object($eje)){

        $turno = $obj->frente;

        $turnos[] = array(
            'turno'=>$turno
        );

        $pfrio = 0;
        $pcaliente = 0;
        $pelectrico = 0;
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
        $prevalidados = 0;
        $pnuevos = 0;
        $pcerrados = 0;

        
        $sql="SELECT * FROM permisostrab WHERE ods = '$ods' AND fecha='$fecha' and frente = '$turno'";
        $exito=mysqli_query($conexion, $sql);
        

        while ($row = mysqli_fetch_object($exito)){

             
                $prevalidados++;
                $pfrio += $row->pfrio;
                $pcaliente += $row->pcaliente;
                $pelectrico += $row->pelectrico;
            
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
             

            $pnuevos += $row->pnuevos;
            $pcerrados += $row->pcerrados;
            
        }  


        $total = $pfrio+$pcaliente+$pelectrico;
        $totalmatriz = $ramh+$ramm+$ramvh;
        $totalca = $ca1 + $ca2 + $ca3 + $ca5 + $ca6 + $ca7 + $sas + $saes;
        $totalpr = $pra + $prc + $prg;

        $datos[] = array(
            'pfrio'=>$pfrio,
            'pcaliente'=>$pcaliente,
            'pelectrico'=>$pelectrico,
            'totalp'=>$total,
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

        $row = mysqli_fetch_object($eje);

        $observaciones = $row->observaciones;
        $personal = $row->personal;

        $consolidado = array(
            
            'tabla'=>$tabla,
            'datos'=>$datos,
            'observaciones'=>$observaciones,
            'personal'=>$personal,
            'turnos'=>$turnos
        );

echo json_encode($consolidado);