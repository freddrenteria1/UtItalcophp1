<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

$fecha = $_GET["fecha"];

// $fecha = '2022-11-06';

//VALOR DE CANTIDAD DE RCA FIRMADOS CON PERMISO
$campo = 'permiso';

$cons = "SELECT * FROM os38  WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'"; 
$ejec = mysqli_query($conexion, $cons);
$catpermfirmut = mysqli_num_rows($ejec);

$cons = "SELECT * FROM os38  WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'"; 
$ejec = mysqli_query($conexion, $cons);
$catpermfirmec = mysqli_num_rows($ejec);

$catpermfirm = $catpermfirmut + $catpermfirmec;

//VALOR DE CANTIDAD DE RCA EJECUTADOS CON PERMISOS
$query = "SELECT * FROM hitosinter WHERE fecha = '$fecha' AND hito LIKE '%INSTALACION DE SAS%'";
$eje = mysqli_query($conexion, $query);
$cant = mysqli_num_rows($eje);

if($cant != 0){
    $obj = mysqli_fetch_object($eje);
    $cantpermeje = $obj->eje;
    $cantpermeje = $cantpermeje * 2;
}

//VALOR DE CANTIDAD DE RCA FIRMADOS CON LIMP PARTES
$campo = 'limp_partes';

$cons = "SELECT * FROM os38  WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
$ejec = mysqli_query($conexion, $cons);
$cantlimpartesfirm = mysqli_num_rows($ejec);

//VALOR DE CANTIDAD DE RCA EJECUTADOS CON LIMP PARTES
$query = "SELECT * FROM hitosinter WHERE fecha = '$fecha' AND hito LIKE '%LIMPIEZA DE PARTES%'";
$eje = mysqli_query($conexion, $query);
$cant = mysqli_num_rows($eje);

if($cant != 0){
    $obj = mysqli_fetch_object($eje);
    $cantlimparteseje = $obj->eje;
}

//VALOR DE CANTIDAD DE RCA FIRMADOS CON LIMP CASCO
$campo = 'limp_haz_tubos';

$cons = "SELECT * FROM os38  WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
$ejec = mysqli_query($conexion, $cons);
$cantlimphazfirm = mysqli_num_rows($ejec);

//VALOR DE CANTIDAD DE RCA EJECUTADOS CON LIMP CASCO
$query = "SELECT * FROM hitosinter WHERE fecha = '$fecha' AND hito LIKE '%LIMPIEZA DE HAZ%'";
$eje = mysqli_query($conexion, $query);
$cant = mysqli_num_rows($eje);

if($cant != 0){
    $obj = mysqli_fetch_object($eje);
    $cantlimphazeje = $obj->eje;
}

//VALOR DE CANTIDAD DE RCA FIRMADOS CON INSP PARTES
$campo = 'insp_partes';

$cons = "SELECT * FROM os38  WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
$ejec = mysqli_query($conexion, $cons);
$cantinspartesfirm = mysqli_num_rows($ejec);

//VALOR DE CANTIDAD DE RCA EJECUTADOS CON INSP PARTES
$query = "SELECT * FROM hitosinter WHERE fecha = '$fecha' AND hito LIKE '%INSPECCION DE PARTES%'";
$eje = mysqli_query($conexion, $query);
$cant = mysqli_num_rows($eje);

if($cant != 0){
    $obj = mysqli_fetch_object($eje);
    $cantinsparteseje = $obj->eje;
}

//VALOR DE CANTIDAD DE RCA FIRMADOS CON INSP HAZ
$campo = 'insp_haz_tubos';

$cons = "SELECT * FROM os38  WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
$ejec = mysqli_query($conexion, $cons);
$cantinsphazfirm = mysqli_num_rows($ejec);

//VALOR DE CANTIDAD DE RCA EJECUTADOS CON INSP HAZ
$query = "SELECT * FROM hitosinter WHERE fecha = '$fecha' AND hito LIKE '%INSPECCION DE HAZ%'";
$eje = mysqli_query($conexion, $query);
$cant = mysqli_num_rows($eje);

if($cant != 0){
    $obj = mysqli_fetch_object($eje);
    $cantinsphazeje = $obj->eje;
}

//VALOR DE CANTIDAD DE RCA FIRMADOS CON LIBERACION PARTES
$campo = 'lib_partes';

$cons = "SELECT * FROM os38  WHERE " . $campo . " LIKE '%\"firmautsup\":\"data:image/png;%'" ; 
$ejec = mysqli_query($conexion, $cons);
$cantlibpartesfirmsup = mysqli_num_rows($ejec);

$cons = "SELECT * FROM os38  WHERE " .  $campo . " LIKE '%\"firmautqaqc\":\"data:image/png;%'"; 
$ejec = mysqli_query($conexion, $cons);
$cantlibpartesfirmq = mysqli_num_rows($ejec);


$cons = "SELECT * FROM os38  WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'"; 
$ejec = mysqli_query($conexion, $cons);
$cantlibpartesfirmec = mysqli_num_rows($ejec);

$cantlibpartesfirm = $cantlibpartesfirmsup + $cantlibpartesfirmq + $cantlibpartesfirmec;


//VALOR DE CANTIDAD DE RCA EJECUTADOS CON LIBERACION PARTES
$query = "SELECT * FROM hitosinter WHERE fecha = '$fecha' AND hito LIKE '%INSTALACION DE HAZ%'";
$eje = mysqli_query($conexion, $query);
$cant = mysqli_num_rows($eje);

if($cant != 0){
    $obj = mysqli_fetch_object($eje);
    $canlibparteseje = $obj->eje;
    $canlibparteseje = $canlibparteseje * 3;
}

//VALOR DE CANTIDAD DE RCA FIRMADOS CON LIBERACION HAZ
$campo = 'lib_haz_tubos';

$cons = "SELECT * FROM os38  WHERE " . $campo . " LIKE '%\"firmautsup\":\"data:image/png;%'" ; 
$ejec = mysqli_query($conexion, $cons);
$cantlibhazfirmsup = mysqli_num_rows($ejec);

$cons = "SELECT * FROM os38  WHERE " .  $campo . " LIKE '%\"firmautqaqc\":\"data:image/png;%'"; 
$ejec = mysqli_query($conexion, $cons);
$cantlibhazfirmq = mysqli_num_rows($ejec);

$cons = "SELECT * FROM os38  WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'"; 
$ejec = mysqli_query($conexion, $cons);
$cantlibhazfirmec = mysqli_num_rows($ejec);

$cantlibhazfirm = $cantlibhazfirmsup + $cantlibhazfirmq + $cantlibhazfirmec;

//VALOR DE CANTIDAD DE RCA EJECUTADOS CON LIBERACION HAZ
$query = "SELECT * FROM hitosinter WHERE fecha = '$fecha' AND hito LIKE '%INSTALACION DE HAZ%'";
$eje = mysqli_query($conexion, $query);
$cant = mysqli_num_rows($eje);

if($cant != 0){
    $obj = mysqli_fetch_object($eje);
    $canlibhazeje = $obj->eje;
    $canlibhazeje = $canlibhazeje * 3;
}

//VALOR DE CANTIDAD DE RCA FIRMADOS CON PRUEBA TUBO
$campo = 'prueba';

$cons = "SELECT * FROM os38  WHERE " . $campo . " LIKE '%\"firmaecptubo\":\"data:image/png;%'"; 
$ejec = mysqli_query($conexion, $cons);
$cantpruebatubofirm = mysqli_num_rows($ejec);

//VALOR DE CANTIDAD DE RCA EJECUTADOS CON PRUEBA TUBO
$query = "SELECT * FROM hitosinter WHERE fecha = '$fecha' AND hito LIKE '%PRUEBA HIDROSTATICA POR TUBOS%'";
$eje = mysqli_query($conexion, $query);
$cant = mysqli_num_rows($eje);

if($cant != 0){
    $obj = mysqli_fetch_object($eje);
    $cantpruebatuboeje = $obj->eje;
}

//VALOR DE CANTIDAD DE RCA FIRMADOS CON PRUEBA HAZ
$campo = 'prueba';

$cons = "SELECT * FROM os38  WHERE " . $campo . " LIKE '%\"firmaecpcasco\":\"data:image/png;%'"; 
$ejec = mysqli_query($conexion, $cons);
$cantpcascofirm = mysqli_num_rows($ejec);

//VALOR DE CANTIDAD DE RCA EJECUTADOS CON PRUEBA HAZ
$query = "SELECT * FROM hitosinter WHERE fecha = '$fecha' AND hito LIKE '%PRUEBA HIDROSTATICA POR CASCO%'";
$eje = mysqli_query($conexion, $query);
$cant = mysqli_num_rows($eje);

if($cant != 0){
    $obj = mysqli_fetch_object($eje);
    $cantpcascoeje = $obj->eje;
}

//VALOR DE CANTIDAD DE RCA FIRMADOS CON TERMINACION
$campo = 'terminacion';

$cons = "SELECT * FROM os38  WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'"  .  ' AND  ' . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'"; 
$ejec = mysqli_query($conexion, $cons);
$canttermfirm = mysqli_num_rows($ejec);

//VALOR DE CANTIDAD DE RCA EJECUTADOS CON TERMINACION
$query = "SELECT * FROM hitosinter WHERE fecha = '$fecha' AND hito LIKE '%RETIRO DE SAS%'";
$eje = mysqli_query($conexion, $query);
$cant = mysqli_num_rows($eje);

if($cant != 0){
    $obj = mysqli_fetch_object($eje);
    $canttermeje = $obj->eje;
}

//VALOR DE CANTIDAD DE RCA FIRMADOS CON PINTURA
$campo = 'pintura';

$cons = "SELECT * FROM os38  WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'"  .  ' AND  ' . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'"; 
$ejec = mysqli_query($conexion, $cons);
$cantpintfirm = mysqli_num_rows($ejec);

//VALOR DE CANTIDAD DE RCA EJECUTADOS CON PINTURA
$query = "SELECT * FROM hitosinter WHERE fecha = '$fecha' AND hito LIKE '%RETIRO DE SAS%'";
$eje = mysqli_query($conexion, $query);
$cant = mysqli_num_rows($eje);

if($cant != 0){
    $obj = mysqli_fetch_object($eje);
    $cantpinteje = $obj->eje;
}

//VALOR DE CANTIDAD DE RCA FIRMADOS CON ENTREGA
$campo = 'entrega';

$cons = "SELECT * FROM os38  WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'"  .  ' AND  ' . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'"; 
$ejec = mysqli_query($conexion, $cons);
$cantentfirm = mysqli_num_rows($ejec);

//VALOR DE CANTIDAD DE RCA EJECUTADOS CON ENTREGA
$query = "SELECT * FROM hitosinter WHERE fecha = '$fecha' AND hito LIKE '%RETIRO DE SAS%'";
$eje = mysqli_query($conexion, $query);
$cant = mysqli_num_rows($eje);

if($cant != 0){
    $obj = mysqli_fetch_object($eje);
    $cantenteje = $obj->eje;
}

$datos = array(
    'permisoeje'=>$cantpermeje,
    'permisofirm'=>$catpermfirm,
    'limparteseje'=>$cantlimparteseje,
    'limpartesfirm'=>$cantlimpartesfirm,
    'limphazeje'=>$cantlimphazeje,
    'limphazfirm'=>$cantlimphazfirm,
    'insparteseje'=>$cantinsparteseje,
    'inspartesfirm'=>$cantinspartesfirm,
    'insphazeje'=>$cantinsphazeje,
    'insphazfirm'=>$cantinsphazfirm,
    'libparteseje'=>$canlibparteseje,
    'libpartesfirm'=>$cantlibpartesfirm,
    'libhazeje'=>$canlibhazeje,
    'libhazfirm'=>$cantlibhazfirm,
    'ptuboeje'=>$cantpruebatuboeje,
    'ptubofirm'=>$cantpruebatubofirm,
    'pcascoeje'=>$cantpcascoeje,
    'pcascofirm'=>$cantpcascofirm,
    'termeje'=>$canttermeje,
    'termfirm'=>$canttermfirm,
    'pinteje'=>$cantpinteje,
    'pintfirm'=>$cantpintfirm,
    'enteje'=>$cantenteje,
    'entfirm'=>$cantentfirm
);

$info = json_encode($datos);

echo $info;

// $sql = "INSERT INTO hitosinterfirm VALUES('' , '$fecha', '$info')";
// $ejeg = mysqli_query($conexion, $sql);
