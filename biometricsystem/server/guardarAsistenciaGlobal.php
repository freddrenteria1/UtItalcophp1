<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$fechab = $_POST["fecha"];
// $ods = $_GET["ods"];

$msn = 'Ok';

    $borrar ="DELETE FROM asistenciasglobal Where fecha='$fechab'";
    $ejeb = mysqli_query($conexion, $borrar);


    $query = "SELECT * FROM trabajadores Where estado='Activo' order by frente";
    $eje = mysqli_query($conexion, $query);

    while($row = mysqli_fetch_object($eje)){
        $doc = $row->cedula;
        $id = $row->id;
        $nombres = $row->nombres . ' ' . $row->apellidos;
        $cargo = $row->cargo;
        $turno = $row->turno;

        $ods = $row->ods;

        $sqlt = "SELECT * FROM codturnos WHERE turno = '$turno'";
        $ejet = mysqli_query($conexion, $sqlt);
        $rowt = mysqli_fetch_object($ejet);

        
        $sql = "SELECT * FROM marcaciones Where fecha='$fechab' And doc='$id' And tipo='Entrada'";
        $exito = mysqli_query($conexion, $sql);

        $enc = mysqli_num_rows($exito);

        if($enc != 0){
            $obj = mysqli_fetch_object($exito);
            $hora = $obj->hora;
            $tipo = $obj->tipo;

            $horaingreso = $rowt->entrada;
            $horasalida = $rowt->salida;

            $turnolab = $turno . ' - ' . $horaingreso . ' - ' . $horasalida;
            $hh = $rowt->th;

        }else{
            $hora = '';
            $tipo = 'SIN MARCACIÓN';

            $turnolab = '';
            $hh = 0;
        }

        $sql2 = "SELECT * FROM novepersonal Where ods='$ods' And doc='$doc'";
        $exito2 = mysqli_query($conexion, $sql2);

        $enc2 = mysqli_num_rows($exito2);

        if($enc2 != 0){
            $obj2 = mysqli_fetch_object($exito2);
            $novedad = $obj2->novedad;
        }else{
            $novedad = '';
        }

        
        $sqlg = "INSERT INTO asistenciasglobal VALUES('','$row->contrato','$row->cedula','$nombres','$cargo','$row->lugartrab','$row->tiponomina','$row->sistemaprecio','$row->acargo','$row->detpago', '$fechab','$turnolab', $hh,'$row->frentetrab','','$row->supervisor','$novedad','$ods')";
        $ejeg = mysqli_query($conexion, $sqlg);

        if(!$ejeg){
            $msn = mysqli_error($conexion);
        }

    }


$datos = array(
    'msn' => $msn,
    'sql'=>$sqlg
);

echo json_encode($datos);