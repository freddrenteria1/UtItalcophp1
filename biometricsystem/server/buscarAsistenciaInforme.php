<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$fechab = $_POST["fecha"];

//$frente=$_POST["frente"];

    $query = "SELECT * FROM trabajadores Where estado='Activo'";
    $eje = mysqli_query($conexion, $query);




while($row = mysqli_fetch_object($eje)){
    $doc = $row->cedula;
    $id = $row->id;
    $nombres = $row->nombres . ' ' . $row->apellidos;
    $cargo = $row->cargo;
    $ods = $row->ods;
    $lugar = $row->lugartrab;
    $empresa = $row->empresa;

    if($empresa=="UT"){
        $totalUT++;
    }
    if($empresa=='TS'){
        $totalTS++;
    }

    $totalTrab++;

    $sql = "SELECT * FROM marcaciones Where fecha='$fechab' And doc='$id' And tipo = 'Entrada'";
    $exito = mysqli_query($conexion, $sql);

    $enc = mysqli_num_rows($exito);

    if($enc != 0){
        $obj = mysqli_fetch_object($exito);
        $hora = $obj->hora;
        $tipo = $obj->tipo;

        if($lugar == 'GRB'){
            $totalGRB++;
        }
        if($lugar == 'Taller de Prefabricado' || $lugar == 'Taller Fecub'){
            $totalTaller++;
        }
        if($lugar == 'Oficina'){
            $totalOficina++;
        }
    
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
   
   
}

$cons = "SELECT novedad, COUNT(*) AS tot From novepersonal group by novedad";
$ejec = mysqli_query($conexion, $cons);

while($rowc = mysqli_fetch_object($ejec)){
    $nove[] = array(
        'novedad'=>$rowc->novedad,
        'tot'=>$rowc->tot
    );
}

$totalMarca = $totalOficina + $totalTaller + $totalGRB;

$datos = array(
    'totalTrab'=>$totalTrab,
    'totalUT'=>$totalUT,
    'totalTS'=>$totalTS,
    'totalGRB'=>$totalGRB,
    'totalTaller'=>$totalTaller,
    'totalOficina'=>$totalOficina,
    'totalMarca'=>$totalMarca,
    'novedades'=>$nove  
);


echo json_encode($datos);