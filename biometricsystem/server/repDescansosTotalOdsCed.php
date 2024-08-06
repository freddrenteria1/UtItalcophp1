<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

setlocale(LC_ALL,"es_ES");

$ods = $_POST["ods"];

$directos = 0;
$indirectos = 0;

$query1="SELECT * FROM cedulacopia";
$exito1=mysqli_query($conexion, $query1);

while ($row = mysqli_fetch_object($exito1)){

    $ced = $row->cedula;

    $query = "SELECT * FROM trabajadores Where cedula =  '$ced'";
    $ejeq = mysqli_query($conexion, $query);

    while($obj = mysqli_fetch_object($ejeq)){
        $idtrab = $obj->id;
        
        $cedtrab = $obj->cedula;
        $fechainicio = $obj->fingreso;
        $turno = $obj->turno;

        $datosTrab[] = array(
            'idtrab'=>$idtrab,
            'ced'=>$cedtrab,
            'nombres'=>$obj->nombres . ' ' . $obj->apellidos,
            'cargo'=>$obj->cargo,
            'frente'=>$obj->frentetrab,
            'fingreso'=>$obj->fingreso
        );

    }

}

// $fechainicial = $fecha;
// $fechafinal = date("Y-m-d",strtotime($fechabuscar."- 15 days"));


$cons = "SELECT * FROM marcaciones Where fecha  between '2023-07-24' AND '2023-07-30' AND tipo='Entrada'  order by fecha";
$eje = mysqli_query($conexion, $cons);

while($row = mysqli_fetch_object($eje)){
    $arrayMarcaciones[] = array(
        'fecha'=>$row->fecha,
        'doc'=>$row->doc
    );
}

$datos = array(
    'trab'=>$datosTrab,
    'marca'=>$arrayMarcaciones
);

echo json_encode($datos);