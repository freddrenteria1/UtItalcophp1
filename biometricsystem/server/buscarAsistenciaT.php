<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$fechab = $_POST["fecha"];
$turno = $_POST["turno"];

//$frente=$_POST["frente"];

if($turno == 'Todos'){
    $query = "SELECT * FROM trabajadores Where estado='Activo'";
    $eje = mysqli_query($conexion, $query);
}else{
    $query = "SELECT * FROM trabajadores Where estado='Activo' and turno='$turno'";
    $eje = mysqli_query($conexion, $query);
}



while($row = mysqli_fetch_object($eje)){
    $doc = $row->cedula;
    $id = $row->id;
    $nombres = $row->nombres . ' ' . $row->apellidos;
    $cargo = $row->cargo;
    $ods = $row->ods;

    $sql = "SELECT * FROM marcaciones Where fecha='$fechab' And doc='$id' And tipo = 'Entrada'";
    $exito = mysqli_query($conexion, $sql);

    $enc = mysqli_num_rows($exito);

    if($enc != 0){
        $obj = mysqli_fetch_object($exito);
        $hora = $obj->hora;
        $tipo = $obj->tipo;
    }else{
        $hora = '';
        $tipo = 'SIN MARCACIÓN';
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

    $datos[] = array(
        'id'=>$row->id,
        'contrato'=>$row->contrato,
        'cedula'=>$row->cedula,
        'nombres'=>$nombres,
        'tiponomina'=>$row->tiponomina,
        'cargo'=>$cargo,
        'ods'=>$ods,
        'fecha'=>$fechab,
        'hora'=>$hora,
        'tipo'=>$tipo,
        'grupo'=>$row->frente,
        'frentetrab'=>$row->frentetrab,
        'supervisor'=>$row->supervisor,
        'novedad'=>$novedad
    );

}

echo json_encode($datos);