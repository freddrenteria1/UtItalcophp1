<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

//consulta ciclones 2213 y 2233
$totalciclonecp = 18;
$totalciclonut = 23;
$totalciclon = $totalciclonecp + $totalciclonut;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os2213";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantciclores = $cant;

$sql="SHOW COLUMNS FROM `os2213`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os2213 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os2213 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$cons = "SELECT * FROM os2233";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantciclores += $cant;

$sql="SHOW COLUMNS FROM `os2233`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os2233 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os2233 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totalciclonecpeje = $sumfirmaec;
$totalciclonuteje = $sumfirmaut;


//consulta HORNO 2232
$totalhornoecp = 7;
$totalhornout = 9;
$totalhorno = $totalhornoecp + $totalhornout;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os2232";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canthornos = $cant;

$sql="SHOW COLUMNS FROM `os2232`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os2232 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os2232 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totalhornoecpeje = $sumfirmaec;
$totalhornouteje = $sumfirmaut;


//consulta INTERCAMBIADOR 2208 2209
$totalinterecp = 16;
$totalinterut = 20;
$totalinter = $totalinterecp + $totalinterut;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os2208";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantintercambiadores = $cant;

$sql="SHOW COLUMNS FROM `os2208`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os2208 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os2208 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$cons = "SELECT * FROM os2209";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantintercambiadores += $cant;

$sql="SHOW COLUMNS FROM `os2209`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os2209 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os2209 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totalinterecpeje = $sumfirmaec;
$totalinteruteje = $sumfirmaut;


//consulta REACTOR 2212
$totalreactorecp = 98;
$totalreactorut = 149;
$totalreactor = $totalreactorecp + $totalreactorut;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os2212";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantreactores = $cant;

$sql="SHOW COLUMNS FROM `os2212`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os2212 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os2212 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totalreactorecpeje = $sumfirmaec;
$totalreactoruteje = $sumfirmaut;


//consulta REGENERADOR 2211
$totalregeneradorecp = 98;
$totalregeneradorut = 149;
$totalregenerador = $totalregeneradorecp + $totalregeneradorut;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os2211";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantregeneradores = $cant;

$sql="SHOW COLUMNS FROM `os2211`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os2211 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os2211 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totalregeneradorecpeje = $sumfirmaec;
$totalregeneradoruteje = $sumfirmaut;


//consulta TORRE 2234
$totaltorreecp = 13;
$totaltorreut = 24;
$totaltorre = $totaltorreecp + $totaltorreut;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os2234";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres = $cant;

$sql="SHOW COLUMNS FROM `os2234`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os2234 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os2234 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}


$totaltorreecpeje =  $sumfirmaec;
$totaltorreuteje = $sumfirmaut;


//consulta VALVULAS 2241
$totalvalvulaecp = 51;
$totalvalvulaut = 95;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os2241";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantvalvulas = $cant;

$cons = "SELECT * FROM os2241";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$totalvalvulaecp = $totalvalvulaecp * $cant;
$totalvalvulaut = $totalvalvulaut * $cant;

$sql="SHOW COLUMNS FROM `os2241`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os2241 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os2241 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totalvalvulaecpeje = $sumfirmaec;
$totalvalvulauteje = $sumfirmaut;


//consulta LÍNEA DE TRANSFERENCIA 2242
$totallineaecp = 17;
$totallineaut = 26;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os2242";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantlinea = $cant;

$cons = "SELECT * FROM os2242";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$totallineaecp = $totallineaecp * $cant;
$totallineaut = $totallineaut * $cant;

$sql="SHOW COLUMNS FROM `os2242`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os2242 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os2242 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totalineecpeje = $sumfirmaec;
$totallineauteje = $sumfirmaut;


$ciclones = array(
    'firmasecp'=>$totalciclonecp,
    'firmasut'=> $totalciclonut,
    'firmasecpeje'=>$totalciclonecpeje,
    'firmasuteje'=>$totalciclonuteje,
    'totalfirmas'=>$totalciclonecp+$totalciclonut,
    'totalfirmaseje'=>$totalciclonecpeje + $totalciclonuteje,
    'cantciclores'=>$cantciclores
);

$hornos = array(
    'firmasecp'=>$totalhornoecp,
    'firmasut'=> $totalhornout,
    'firmasecpeje'=>$totalhornoecpeje,
    'firmasuteje'=>$totalhornouteje,
    'totalfirmas'=>$totalhornoecp+$totalhornout,
    'totalfirmaseje'=>$totalhornoecpeje + $totalhornouteje,
    'canthornos'=>$canthornos
);

$intercambiadores = array(
    'firmasecp'=>$totalinterecp,
    'firmasut'=> $totalinterut,
    'firmasecpeje'=>$totalinterecpeje,
    'firmasuteje'=>$totalinteruteje,
    'totalfirmas'=>$totalinterecp+$totalinterut,
    'totalfirmaseje'=>$totalinterecpeje + $totalinteruteje,
    'cantintercambiadores'=>$cantintercambiadores
);

$reactor = array(
    'firmasecp'=>$totalreactorecp,
    'firmasut'=> $totalreactorut,
    'firmasecpeje'=>$totalreactorecpeje,
    'firmasuteje'=>$totalreactoruteje,
    'totalfirmas'=>$totalreactorecp+$totalreactorut,
    'totalfirmaseje'=>$totalreactorecpeje + $totalreactoruteje,
    'cantreactores'=>$cantreactores
);

$regenerador = array(
    'firmasecp'=>$totalregeneradorecp,
    'firmasut'=> $totalregeneradorut,
    'firmasecpeje'=>$totalregeneradorecpeje,
    'firmasuteje'=>$totalregeneradoruteje,
    'totalfirmas'=>$totalregeneradorecp+$totalregeneradorut,
    'totalfirmaseje'=>$totalregeneradorecpeje + $totalregeneradoruteje,
    'cantregeneradores'=>$cantregeneradores
);

$torre = array(
    'firmasecp'=>$totaltorreecp,
    'firmasut'=> $totaltorreut,
    'firmasecpeje'=>$totaltorreecpeje,
    'firmasuteje'=>$totaltorreuteje,
    'totalfirmas'=>$totaltorreecp+$totaltorreut,
    'totalfirmaseje'=>$totaltorreecpeje + $totaltorreuteje,
    'canttorres'=>$canttorres
);

$valvulas = array(
    'firmasecp'=>$totalvalvulaecp,
    'firmasut'=> $totalvalvulaut,
    'firmasecpeje'=>$totalvalvulaecpeje,
    'firmasuteje'=>$totalvalvulauteje,
    'totalfirmas'=>$totalvalvulaecp+$totalvalvulaut,
    'totalfirmaseje'=>$totalvalvulaecpeje + $totalvalvulauteje,
    'cantvalvulas'=>$cantvalvulas
);

$linea = array(
    'firmasecp'=>$totallineaecp,
    'firmasut'=> $totallineaut,
    'firmasecpeje'=>$totalineecpeje,
    'firmasuteje'=>$totallineauteje,
    'totalfirmas'=>$totallineaecp+$totallineaut,
    'totalfirmaseje'=>$totalineecpeje + $totallineauteje,
    'cantlinea'=>$cantlinea
);


$totalequipos = $cantciclores + $canthornos + $cantintercambiadores + $cantreactores + $cantregeneradores  + $canttorres + $cantvalvulas + $cantlinea;
$totalitalcoplan = $totalciclonut + $totalhornout + $totalinterut + $totalreactorut + $totalregeneradorut  + $totaltorreut + $totalvalvulaut + $totallineaut;
$totalecoplan = $totalciclonecp + $totalhornoecp + $totalinterecp + $totalreactorecp + $totalregeneradorecp + $totaltorreecp + $totalvalvulaecp + $totallineaecp;
$totalitalcoeje = $totalciclonuteje + $totalhornouteje + $totalinteruteje + $totalreactoruteje + $totalregeneradoruteje + $totaltorreuteje + $totalvalvulauteje + $totallineauteje;
$totalecoeje = $totalciclonecpeje + $totalhornoecpeje + $totalinterecpeje + $totalreactorecpeje + $totalregeneradorecpeje + $totaltorreecpeje + $totalvalvulaecpeje + $totalineecpeje;

$totalfirmasplan = $totalitalcoplan + $totalecoplan;
$totalfirmaseje = $totalitalcoeje + $totalecoeje;
$firmasfaltantes = $totalfirmasplan - $totalfirmaseje;

$consolidado = array(
    'totalequipos'=>$totalequipos,
    'totalitalcoplan'=>$totalitalcoplan,
    'totalecoplan'=>$totalecoplan,
    'totalitalcoeje'=>$totalitalcoeje,
    'totalecoeje'=>$totalecoeje,
    'totalfirmasplan'=>$totalfirmasplan,
    'totalfirmaseje'=>$totalfirmaseje,
    'firmasfaltantes'=>$firmasfaltantes
);



$datos = array(
    'ciclones'=>$ciclones,
    'hornos'=>$hornos,
    'intercambiadores'=>$intercambiadores,
    'reactor'=>$reactor,
    'regenerador'=>$regenerador,
    'torre'=>$torre,
    'valvulas'=>$valvulas,
    'linea'=>$linea,
    'consolidado'=>$consolidado
);

echo json_encode($datos);
