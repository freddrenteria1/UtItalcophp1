<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

setlocale(LC_ALL,"es_ES");

$ods = $_POST["ods"];
$fecha = $_POST["fecha"];
$grupo = $_POST["grupo"];
$turno = $_POST["turno"];
 

        //SE EN LISTA EL RESTO DEL PERSONAL
        $query="SELECT * FROM personalotra WHERE  frente='$grupo' AND turno = '$turno'";
        $exito=mysqli_query($conexion, $query);

        //$cant = mysqli_num_rows($exito);

        // if($cant == 0){
        //     $query="SELECT * FROM personalodsproy WHERE grupo='$grupo' and ods = '$ods'";
        //     $exito=mysqli_query($conexion, $query);
        // }

        

        while ($obj = mysqli_fetch_object($exito)){

            //se busca el horario del turno y se verifica la marcación si fue realiza
            $turno = $obj->turno;
            $hh = $obj->hh;
            $cedula = $obj->cedula;

            $sql = "SELECT * FROM codturnos WHERE turno = '$turno'";
            $eje = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_object($eje);

            $horaingreso = $obj->entrada;
            $horasalida = $obj->salida;

          
                 

                $filefirma = '../recursoshumanos/firmas/'  . $cedula . '.jpg';

                $filefirmapng = '../recursoshumanos/firmas/'  . $cedula . '.png';
                $filefirmajpg = '../recursoshumanos/firmas/'  . $cedula . '.jpg';

                if(file_exists($filefirmajpg)){

                    $firma = '<img src="http://italco.tk/recursoshumanos/firmas/'  . $cedula . '.jpg" height="60px">';

                }

                if(file_exists($filefirmapng)){

                    $firma = '<img src="http://italco.tk/recursoshumanos/firmas/'  . $cedula . '.png" height="60px">';
                }
                 

                if (!file_exists($filefirmajpg) && !file_exists($filefirmapng)) {
                    $firma = '<img src="http://italco.tk/recursoshumanos/firmas/firmab.jpg" height="60px">';
                }

            // }else{

            //     $firma = '<img src="http://italco.tk/recursoshumanos/firmas/firmab.jpg" height="60px">';
            // }


            if($obj->observacion == 'AISLAMIENTO' OR $obj->observacion == 'DESCANSO'){
                $observacion = $obj->observacion;
                $horaingreso = '';
                $horasalida = '';
                $hh = 0;
                $firma = '<img src="http://italco.tk/recursoshumanos/firmas/firmab.jpg" height="60px">';
            }else{
                $observacion = '';
            }

            if($obj->cedula !== $cedsuper){
                $datosPersonal[] = array(
                    'contrato' => $obj->contrato,
                    'cedula' => $obj->cedula,
                    'nombres'=>$obj->nombre,
                    'cargo'=>$obj->cargo,
                    'grupo'=>$grupo,
                    'turno'=>$obj->turno,
                    'horaingreso'=>$horaingreso,
                    'horasalida'=>$horasalida,
                    'horastrab'=>$hh,
                    'firma'=>$firma,
                    'observacion'=>$obj->observacion
                );
            }
        }


    
        


 
echo json_encode($datosPersonal);