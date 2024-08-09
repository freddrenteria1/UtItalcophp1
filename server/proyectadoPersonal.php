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


        //SE EN LISTA EL RESTO DEL PERSONAL
        $query="SELECT * FROM personalodsproy WHERE  grupo='$grupo' and ods = '$ods' and fecha = '$fecha'";
        $exito=mysqli_query($conexion, $query);

        //$cant = mysqli_num_rows($exito);

        // if($cant == 0){
        //     $query="SELECT * FROM personalodsproy WHERE grupo='$grupo' and ods = '$ods'";
        //     $exito=mysqli_query($conexion, $query);
        // }

        

        while ($obj = mysqli_fetch_object($exito)){

            //se busca el horario del turno y se verifica la marcación si fue realiza
            $turno = $obj->turno;
            $hh = $obj->horas;
            $cedula = $obj->cedula;

            $sql = "SELECT * FROM codturnos WHERE turno = '$turno'";
            $eje = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_object($eje);

            $horaingreso = date( "g:i a", strtotime( $row->entrada ) );
            $horasalida = date( "g:i a", strtotime( $row->salida ) );

            //se verifica la marcación
            // $sql = "SELECT * FROM biometrico WHERE cedula = '$cedula' AND fecha='$fecha' AND modo = 'Inicio'";
            // $eje = mysqli_query($conexion, $sql);
            // $cant = mysqli_num_rows($eje);

            // if($cant != 0){
                 

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


            if($obj->estado != 'PRESENTE'){
                $observacion = $obj->estado;
                $horaingreso = '';
                $horasalida = '';
                $hh = 0;
            }else{
                $observacion = '';
            }

            if($obj->cedula !== $cedsuper){
                $datosPersonal[] = array(
                    'contrato' => $obj->contrato,
                    'cedula' => $obj->cedula,
                    'nombres'=>$obj->nombres,
                    'empresa'=>$obj->empresa,
                    'tipodirecto'=>$obj->tipodirecto,
                    'ods'=>$obj->ods,
                    'cargo'=>$obj->cargo,
                    'grupo'=>$grupo,
                    'lugartrab'=>$obj->lugartrab,
                    'especialidad'=>$obj->especialidad,
                    'turno'=>$obj->turno,
                    'origenpago'=>$obj->origenpago,
                    'horaingreso'=>$horaingreso,
                    'horasalida'=>$horasalida,
                    'horastrab'=>$hh,
                    'firma'=>$firma,
                    'observacion'=>$observacion,
                    'frentes'=>$datos
                );
            }
        }

        

        
   
$cantpers = count($datosPersonal);

// $query = "DELETE FROM repdiarioproy WHERE fecha='$fecha'";
// $exito = mysqli_query($conexion, $query);

for($i=0; $i<$cantpers; $i++){
    
    $contrato = $datosPersonal[$i]["contrato"];
    $cedula = $datosPersonal[$i]["cedula"];
    $nombres = $datosPersonal[$i]["nombres"];
    $empresa = $datosPersonal[$i]["empresa"];
    $tipodirecto = $datosPersonal[$i]["tipodirecto"];
    $cargo = $datosPersonal[$i]["cargo"];
    $ods = $datosPersonal[$i]["ods"];
    $lugartrab = $datosPersonal[$i]["lugartrab"];
    $frente = $datosPersonal[$i]["frente"];
    $especialidad = $datosPersonal[$i]["especialidad"];
    $turno = $datosPersonal[$i]["turno"];
    $origenpago = $datosPersonal[$i]["origenpago"];
    $horaingreso = $datosPersonal[$i]["horaingreso"];
    $horasalida = $datosPersonal[$i]["horasalida"];
    $hh = $datosPersonal[$i]["horastrab"];
    $concepto = $datosPersonal[$i]["estado"];

   
    
    // $sql="INSERT INTO repdiarioproy VALUES('', '$contrato', '$cedula', '$nombres', '$empresa', '$tipodirecto', '$cargo', '$ods', '$lugartrab', '$frente', '$especialidad', '$turno', '$origenpago', '$horaingreso', '$horasalida', $hh, '$concepto', '$fecha')";
    // $eje = mysqli_query($conexion, $sql);

}
 
echo json_encode($datosPersonal);