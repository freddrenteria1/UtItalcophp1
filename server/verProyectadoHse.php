<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");

$ods = $_POST["ods"];
$fecha = $_POST["fecha"];

$fecha = date("Y-m-d",strtotime($fecha."+ 1 days")); 

// $ods = $_GET["ods"];
// $fecha = $_GET["fecha"];


$bsql = "SELECT *,  COUNT(*) AS tot FROM personalrhp Where fecha = '$fecha' AND ods = '$ods' AND supervisor != 'GTG' AND supervisor != 'MRDI' AND supervisor != 'METALPREST' AND hh != 0 GROUP BY turno, tipo";
$ejeb = mysqli_query($conexion, $bsql);

$dir = 0;
$indir = 0;
$tdir=0;
$tindir=0;
$tot = 0;
$sumtotal=0;

$sql = "DELETE FROM proyectado WHERE ods='$ods' and fecha = '$fecha'";
$exito = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($ejeb)){

    $fecha = $obj->fecha;
    $tipo = $obj->tipo;
    $turno = $obj->turno;
    $jornada = $obj->jornada;
    $tot = $obj->tot;
    
    $query = "INSERT INTO proyectado VALUES('', '$fecha', '$tipo', '$turno', '$jornada' , $tot, '$ods')";
    $exito = mysqli_query($conexion, $query);

}

$cons = "SELECT * FROM proyectado WHERE fecha='$fecha' and ods='$ods' GROUP BY turno";
$ejec1 =  mysqli_query($conexion, $cons);

while($row = mysqli_fetch_object($ejec1)){

    $turno = $row->turno;
    $jornada = $row->jornada;

    $buscar = "SELECT * FROM proyectado WHERE fecha='$fecha' AND turno = '$turno' AND tipo = 'DIRECTO' AND ods='$ods' ";
    $ejebus =  mysqli_query($conexion, $buscar);

    if(mysqli_num_rows($ejebus) != 0){
        $fila = mysqli_fetch_object($ejebus);
        $totdir = intval($fila->tot);
    }else{
        $totdir = 0;
    }


    $buscar = "SELECT * FROM proyectado WHERE fecha='$fecha' AND turno = '$turno' AND tipo = 'INDIRECTO' AND ods='$ods'";
    $ejebus =  mysqli_query($conexion, $buscar);

    if(mysqli_num_rows($ejebus) != 0){
        $fila = mysqli_fetch_object($ejebus);
        $totindir =intval($fila->tot);
    }else{
        $totindir = 0;
    }
 

    $total = $totdir + $totindir;

    $sumtotaldir += $totdir;
    $sumtotalindir += $totindir;

   

    $proy[] = array(
        'turno'=>$turno,
        'jornada'=>$jornada,
        'directo'=>$totdir,
        'indirecto'=>$totindir,
        'tot'=>$total
    );
    


}

$sumatotal = $sumtotaldir + $sumtotalindir;


$bsql = "SELECT *,  COUNT(*) AS totdir FROM personalrhp Where fecha = '$fecha' ANd ods = '$ods' AND supervisor = 'GTG' AND hh != 0 AND tipo = 'DIRECTO'";
$ejeb = mysqli_query($conexion, $bsql);

if( mysqli_num_rows($ejeb)!= 0 ){
    $obj = mysqli_fetch_object($ejeb);
    $gtgdir = intval($obj->totdir);
}else{
    $gtgdir = 0;
}

$bsql = "SELECT *,  COUNT(*) AS totdir FROM personalrhp Where fecha = '$fecha' ANd ods = '$ods' AND supervisor = 'GTG' AND hh != 0 AND tipo = 'INDIRECTO'";
$ejeb = mysqli_query($conexion, $bsql);

if( mysqli_num_rows($ejeb)!= 0 ){
    $obj = mysqli_fetch_object($ejeb);
    $gtgindir = intval($obj->totdir);
}else{
    $gtgindir = 0;
}

$subcon[] = array(
    'subc'=>'GTG',
    'dir'=>$gtgdir,
    'indir'=>$gtgindir,
    'tot'=>$gtgdir+$gtgindir
);



$bsql = "SELECT *,  COUNT(*) AS totdir FROM personalrhp Where fecha = '$fecha' ANd ods = '$ods' AND supervisor = 'MRDI' AND hh != 0 AND tipo = 'DIRECTO'";
$ejeb = mysqli_query($conexion, $bsql);

if( mysqli_num_rows($ejeb)!= 0 ){
    $obj = mysqli_fetch_object($ejeb);
    $gtgdir = intval($obj->totdir);
}else{
    $gtgdir = 0;
}

$bsql = "SELECT *,  COUNT(*) AS totdir FROM personalrhp Where fecha = '$fecha' ANd ods = '$ods' AND supervisor = 'MRDI' AND hh != 0 AND tipo = 'INDIRECTO'";
$ejeb = mysqli_query($conexion, $bsql);

if( mysqli_num_rows($ejeb)!= 0 ){
    $obj = mysqli_fetch_object($ejeb);
    $gtgindir = intval($obj->totdir);
}else{
    $gtgindir = 0;
}

$subcon[] = array(
    'subc'=>'MRDI',
    'dir'=>$gtgdir,
    'indir'=>$gtgindir,
    'tot'=>$gtgdir+$gtgindir
);

$bsql = "SELECT *,  COUNT(*) AS totdir FROM personalrhp Where fecha = '$fecha' ANd ods = '$ods' AND supervisor = 'METALPREST' AND hh != 0 AND tipo = 'DIRECTO'";
$ejeb = mysqli_query($conexion, $bsql);

if( mysqli_num_rows($ejeb)!= 0 ){
    $obj = mysqli_fetch_object($ejeb);
    $gtgdir = intval($obj->totdir);
}else{
    $gtgdir = 0;
}

$bsql = "SELECT *,  COUNT(*) AS totdir FROM personalrhp Where fecha = '$fecha' ANd ods = '$ods' AND supervisor = 'METALPREST' AND hh != 0 AND tipo = 'INDIRECTO'";
$ejeb = mysqli_query($conexion, $bsql);

if( mysqli_num_rows($ejeb)!= 0 ){
    $obj = mysqli_fetch_object($ejeb);
    $gtgindir = intval($obj->totdir);
}else{
    $gtgindir = 0;
}

$subcon[] = array(
    'subc'=>'METALPREST',
    'dir'=>$gtgdir,
    'indir'=>$gtgindir,
    'tot'=>$gtgdir+$gtgindir
);

$bsql = "SELECT *,  COUNT(*) AS totdir FROM personalrhp Where fecha = '$fecha' ANd ods = '$ods' AND turno = 'D'";
$ejeb = mysqli_query($conexion, $bsql);

if( mysqli_num_rows($ejeb)!= 0 ){
    $obj = mysqli_fetch_object($ejeb);
    $totdesc = intval($obj->totdir);
}else{
    $totdesc = 0;
}

$bsql = "SELECT *,  COUNT(*) AS totdir FROM personalrhp Where fecha = '$fecha' ANd ods = '$ods' AND turno = 'PNR'";
$ejeb = mysqli_query($conexion, $bsql);

if( mysqli_num_rows($ejeb)!= 0 ){
    $obj = mysqli_fetch_object($ejeb);
    $totperm = intval($obj->totdir);
}else{
    $totperm = 0;
}

$bsql = "SELECT *,  COUNT(*) AS totdir FROM personalrhp Where fecha = '$fecha' ANd ods = '$ods' AND turno = 'INC'";
$ejeb = mysqli_query($conexion, $bsql);

if( mysqli_num_rows($ejeb)!= 0 ){
    $obj = mysqli_fetch_object($ejeb);
    $totinc = intval($obj->totdir);
}else{
    $totinc = 0;
}

$bsql = "SELECT *,  COUNT(*) AS totdir FROM personalrhp Where fecha = '$fecha' ANd ods = '$ods' AND turno = 'RET'";
$ejeb = mysqli_query($conexion, $bsql);

if( mysqli_num_rows($ejeb)!= 0 ){
    $obj = mysqli_fetch_object($ejeb);
    $totret = intval($obj->totdir);
}else{
    $totret = 0;
}

$datos = array(
    'proy'=>$proy,
    'subcon'=>$subcon,
    'sumdir'=>$sumtotaldir,
    'sumindir'=>$sumtotalindir,
    'tot'=>$sumatotal,
    'totdesc'=>$totdesc,
    'totperm'=>$totperm,
    'totinc'=>$totinc,
    'totret'=>$totret
);

 
echo json_encode($datos);