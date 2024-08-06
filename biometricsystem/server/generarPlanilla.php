<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fechadia=date("Y-m-d");

setlocale(LC_ALL,"es_ES");

$ods = $_POST["ods"];
$fecha = $_POST["fecha"];
$grupo = $_POST["grupo"];
$docsup = $_POST["docsup"];
$frentetrab = $_POST["frente"];
$turno = $_POST["turno"];
$clasefirma = $_POST["clasefirma"];

$query1="SELECT * FROM trabajadores WHERE frente='$grupo' AND frentetrab='$frentetrab' AND ods='$ods' AND cedula = '$docsup' AND turno='$turno' AND estado='Activo'";
$exito1=mysqli_query($conexion, $query1);

$encsup = mysqli_num_rows($exito1);

if($encsup != 0){

    $filas = mysqli_fetch_object($exito1);
    
    $turno = $filas->turno;
        $cedula = $filas->cedula;
        $id = $filas->id;
    
        $sql = "SELECT * FROM codturnos WHERE turno = '$turno'";
        $eje = mysqli_query($conexion, $sql);
        $row = mysqli_fetch_object($eje);
    
        $horaingreso = $row->entrada;
        $horasalida = $row->salida;
        $hh = $row->th;
    
        $filefirma = '../firmas/'  . $cedula . '.jpg';
    
        $filefirmapng = '../firmas/'  . $cedula . '.png';
        $filefirmajpg = '../firmas/'  . $cedula . '.jpg';
    
        if(file_exists($filefirmajpg)){
            $firma = '<img src="https://utitalco.com/biometricsystem/firmas/'  . $cedula . '.jpg" height="50px">';
        }
    
        if(file_exists($filefirmapng)){
            $firma = '<img src="https://utitalco.com/biometricsystem/firmas/'  . $cedula . '.png" height="50px">';
        }
    
        if (!file_exists($filefirmajpg) && !file_exists($filefirmapng)) {
            $firma = '<img src="https://utitalco.com/biometricsystem/firmas/firmab.jpg" height="50px">';
        }
    
        //verifica si realizo la marcación
        $sqlm = "SELECT * FROM marcaciones Where doc='$id' And fecha='$fecha' AND tipo = 'Entrada'";
        $ejem = mysqli_query($conexion, $sqlm);
    
        $cantm = mysqli_num_rows($ejem);

        if($clasefirma == 'firmado'){
            if($cantm == 0){
                // $horaingreso = '';
                // $horasalida = '';
                // $hh = 0;
                $firma = '<img src="https://utitalco.com/biometricsystem/firmas/firmab.jpg" height="50px">';
            }
        }
    
    
        //verifica si el trabajador tiene novedad
    
        $sqlnov = "SELECT * FROM novepersonal Where doc='$cedula'";
        $ejenov = mysqli_query($conexion, $sqlnov);
    
        $cantnov = mysqli_num_rows($ejenov);
    
        if($cantnov != 0){
            $rown = mysqli_fetch_object($ejenov);
            $firma = '<img src="https://utitalco.com/biometricsystem/firmas/firmab.jpg" height="50px">';

            if($rown->novedad == 'Tele-Trabajo' || $rown->novedad == 'Capacitación'){
                $observacion = $rown->novedad;
                $firma = '<img src="https://utitalco.com/biometricsystem/firmas/firmab.jpg" height="50px">';
            }else{
               
                $observacion = $rown->novedad;
                $horaingreso = '';
                $horasalida = '';
                $hh = 0;
                $firma = '<img src="https://utitalco.com/biometricsystem/firmas/firmab.jpg" height="50px">';
            }
        }else{
            $observacion = '';
        }

        
    
        $datosPersonal[] = array(
            'contrato' => $filas->contrato,
            'cedula' => $filas->cedula,
            'nombres'=>$filas->nombres . ' ' . $filas->apellidos,
            'cargo'=>$filas->cargo,
            'grupo'=>$filas->frente,
            'frentetrab'=>$filas->frentetrab,
            'turno'=>$filas->turno,
            'horaingreso'=>$horaingreso,
            'horasalida'=>$horasalida,
            'horastrab'=>$hh,
            'firma'=>$firma,
            'observacion'=>$observacion,
            'tiponomina'=>$filas->tiponomina,
            'sistemaprecio'=>$filas->sistemaprecio,
            'acargo'=>$filas->acargo,
            'detpago'=>$filas->detpago,
            'supervisor'=>''
        );


}    

 
$query="SELECT * FROM trabajadores WHERE frente='$grupo'  AND frentetrab='$frentetrab' AND ods='$ods' AND turno='$turno' AND estado='Activo' AND cedula != '$docsup' order by cargo";
$exito=mysqli_query($conexion, $query);

while ($obj = mysqli_fetch_object($exito)){

    //se busca el horario del turno y se verifica la marcación si fue realiza
    $turno = $obj->turno;
    $cedula = $obj->cedula;
    $id = $obj->id;

    $sql = "SELECT * FROM codturnos WHERE turno = '$turno'";
    $eje = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_object($eje);

    $horaingreso = $row->entrada;
    $horasalida = $row->salida;
    $hh = $row->th;

    $horaingreso2 = $row->entrada;
    $horasalida2 = $row->salida;
    $hh2 = $row->th;


    $filefirma = '../firmas/'  . $cedula . '.jpg';

    $filefirmapng = '../firmas/'  . $cedula . '.png';
    $filefirmajpg = '../firmas/'  . $cedula . '.jpg';

    if(file_exists($filefirmajpg)){
        $firma = '<img src="https://utitalco.com/biometricsystem/firmas/'  . $cedula . '.jpg" height="50px">';
        $firma2 = $firma;
    }

    if(file_exists($filefirmapng)){
        $firma = '<img src="https://utitalco.com/biometricsystem/firmas/'  . $cedula . '.png" height="50px">';
        $firma2 = $firma;
    }

    if (!file_exists($filefirmajpg) && !file_exists($filefirmapng)) {
        $firma = '<img src="https://utitalco.com/biometricsystem/firmas/firmab.jpg" height="50px">';
        $firma2 = $firma;
    }

    //verifica si realizo la marcación
    $sqlm = "SELECT * FROM marcaciones Where doc='$id' And fecha='$fecha' AND tipo = 'Entrada'";
    $ejem = mysqli_query($conexion, $sqlm);

    $cantm = mysqli_num_rows($ejem);

    if($clasefirma == 'firmado'){
        if($cantm == 0){
            $horaingreso = '';
            $horasalida = '';
            $hh = 0;
            $firma = '<img src="https://utitalco.com/biometricsystem/firmas/firmab.jpg" height="50px">';
        }
    }

    //verifica si el trabajador tiene novedad

    $sqlnov = "SELECT * FROM novepersonal Where doc='$cedula'";
    $ejenov = mysqli_query($conexion, $sqlnov);

    $cantnov = mysqli_num_rows($ejenov);

    if($cantnov != 0){
        $rown = mysqli_fetch_object($ejenov);
        

        if($rown->novedad == 'Tele-Trabajo' || $rown->novedad == 'Capacitación'){
            $observacion = $rown->novedad;
            $firma = '<img src="https://utitalco.com/biometricsystem/firmas/firmab.jpg" height="50px">';
            // $firma = $firma2;
            $horaingreso = $horaingreso2;
            $horasalida = $horasalida2;
            $hh = $hh2;
        }else{
           
            $observacion = $rown->novedad;
            $horaingreso = '';
            $horasalida = '';
            $hh = 0;
            $firma = '<img src="https://utitalco.com/biometricsystem/firmas/firmab.jpg" height="50px">';
        }
        if($rown->novedad == 'Capacitación'){
            $hh = 8;
        }
    }else{
        $observacion = '';
    }

    $datosPersonal[] = array(
        'contrato' => $obj->contrato,
        'cedula' => $obj->cedula,
        'nombres'=>$obj->nombres . ' ' . $obj->apellidos,
        'cargo'=>$obj->cargo,
        'grupo'=>$obj->frente,
        'frentetrab'=>$obj->frentetrab,
        'turno'=>$obj->turno,
        'horaingreso'=>$horaingreso,
        'horasalida'=>$horasalida,
        'horastrab'=>$hh,
        'firma'=>$firma,
        'observacion'=>$observacion,
        'tiponomina'=>$obj->tiponomina,
        'sistemaprecio'=>$obj->sistemaprecio,
        'acargo'=>$obj->acargo,
        'detpago'=>$obj->detpago,
        'supervisor'=>$obj->supervisor
    );
     
}

$cantreg = count($datosPersonal);

$date1 = new DateTime($fecha);
$date2 = new DateTime($fechadia);

$diff = $date1->diff($date2);

$difdias = $diff->days;

    if($difdias <= 2){
        $borrar = "DELETE FROM histoplanillas WHERE fecha = '$fecha' AND ods='$ods' AND frente='$frentetrab' AND grupo = '$grupo' AND turno='$turno'";
        $ejeb = mysqli_query($conexion, $borrar);
        
        for($i=0; $i<$cantreg; $i++){
           $contrato = $datosPersonal[$i]["contrato"];
           $cedula = $datosPersonal[$i]["cedula"];
           $nombres = $datosPersonal[$i]["nombres"];
           $cargo = $datosPersonal[$i]["cargo"];
           $tiponomina = $datosPersonal[$i]["tiponomina"];
           $sistemaprecio = $datosPersonal[$i]["sistemaprecio"];
           $detpago = $datosPersonal[$i]["detpago"];
           $acargo = $datosPersonal[$i]["acargo"];
           $horastrab = $datosPersonal[$i]["horastrab"];
           $supervisor = $datosPersonal[$i]["supervisor"];
           $observacion = $datosPersonal[$i]["observacion"];
        
           $guardar = "INSERT INTO histoplanillas VALUES('','$contrato','$cedula','$nombres','$cargo','$tiponomina','$sistemaprecio','$acargo','$detpago','$fecha','$turno',$horastrab,'$frentetrab','$grupo','$supervisor','$observacion','$ods')";
           $exitog = mysqli_query($conexion, $guardar);
           
        }
    }


 
echo json_encode($datosPersonal);