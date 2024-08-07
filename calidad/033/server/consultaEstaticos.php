<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

//consulta intercambiadores os38
$totalinterecp = 10;
$totalinterut = 10;

$cons = "SELECT * FROM os38";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantintercambiadores = $cant;

$totalinter = $totalinter * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os38";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$totalinterecp = $totalinterecp * $cant;
$totalinterut = $totalinterut * $cant;

$sql="SHOW COLUMNS FROM `os38`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os38 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os38 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

//SUMAS DE INTERCAMBIADORES
$totalintereceje = $sumfirmaec;
$totalinteruteje = $sumfirmaut;

//INICIO TORRES

$tot24ec=43;
$tot24ut=48;
$tot24 = $tot24ec+$tot24ut;

$tot25ec=23;
$tot25ut=33;
$tot25 = $tot25ec+$tot25ut;

$tot23ec=27;
$tot23ut=30;
$tot23= $tot23ec+$tot23ut;

$tot26ec=29;
$tot26ut=32;
$tot26 = $tot26ec+$tot26ut;

$tot27ec=23;
$tot27ut=26;
$tot27 = $tot27ec+$tot27ut;

$tot28ec=26;
$tot28ut=27;
$tot28 = $tot28ec+$tot28ut;

$tot29ec=7;
$tot29ut=8;
$tot29 = $tot29ec+$tot29ut;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os2224";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot24ut = $tot24ut * $cant;
$tot24ec = $tot24ec * $cant;

$sql="SHOW COLUMNS FROM `os2224`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os2224 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os2224 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$cons = "SELECT * FROM os2225";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot25ut = $tot25ut * $cant;
$tot25ec = $tot25ec * $cant;

$sql="SHOW COLUMNS FROM `os2225`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os2225 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os2225 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$cons = "SELECT * FROM os2223";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot23ut = $tot23ut * $cant;
$tot23ec = $tot23ec * $cant;

$sql="SHOW COLUMNS FROM `os2223`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os2223 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os2223 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$cons = "SELECT * FROM os2226";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot26ut = $tot26ut * $cant;
$tot26ec = $tot26ec * $cant;

$sql="SHOW COLUMNS FROM `os2226`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os2226 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os2226 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$cons = "SELECT * FROM os2227";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot27ut = $tot27ut * $cant;
$tot27ec = $tot27ec * $cant;

$sql="SHOW COLUMNS FROM `os2227`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os2227 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os2227 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$cons = "SELECT * FROM os2228";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot28ut = $tot28ut * $cant;
$tot28ec = $tot28ec * $cant;

$sql="SHOW COLUMNS FROM `os2228`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os2228 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os2228 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$cons = "SELECT * FROM os2229";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot29ut = $tot29ut * $cant;
$tot29ec = $tot29ec * $cant;

$sql="SHOW COLUMNS FROM `os2229`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os2229 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os2229 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}


//SUMA TORRES
$totaltorreseceje = $sumfirmaec;
$totaltorresuteje = $sumfirmaut;

$totaltorresec = $tot23ec+$tot24ec+$tot25ec+$tot26ec+$tot27ec+$tot28ec+$tot29ec;
$totaltorresut = $tot23ut+$tot24ut+$tot25ut+$tot26ut+$tot27ut+$tot28ut+$tot29ut;


//consulta HORNO 2230
$totalhornoecp = 13;
$totalhornout = 13;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os2230";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canthornos = $cant;

$sql="SHOW COLUMNS FROM `os2230`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os2230 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os2230 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totalhornoecpeje = $sumfirmaec;
$totalhornouteje = $sumfirmaut;


//consulta TAMBORES
$totaltamborec = 9;
$totaltamborut = 10;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os80";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttambores = $cant;

$totaltamborec = $totaltamborec * $cant;
$totaltamborut = $totaltamborut * $cant;

$sql="SHOW COLUMNS FROM `os80`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os80 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os80 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totaltamboreceje = $sumfirmaec;
$totaltamboruteje = $sumfirmaut;


//consulta LG os21
$totallgec = 2;
$totallgut = 3;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os21";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantlgs = $cant;

$totallgec = $totallgec * $cant;
$totallgut = $totallgut * $cant;

$sql="SHOW COLUMNS FROM `os21`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os21 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os21 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totallgeceje = $sumfirmaec;
$totallguteje = $sumfirmaut;

//consulta valvulas os02
$totalvalec = 5;
$totalvalut = 5;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os02";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantvalvulas = $cant;

$totalvalec = $totalvalec * $cant;
$totalvalut = $totalvalut * $cant;

$sql="SHOW COLUMNS FROM `os02`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os02 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os02 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totalvaleceje = $sumfirmaec;
$totalvaluteje = $sumfirmaut;



//consulta eyectores  os102
$totaleyeec = 5;
$totaleyeut = 4;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os102";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canteyectores = $cant;

$totaleyeec = $totaleyeec * $cant;
$totaleyeut = $totaleyeut * $cant;

$sql="SHOW COLUMNS FROM `os102`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os102 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os102 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totaleyeeceje = $sumfirmaec;
$totaleyeuteje = $sumfirmaut;



$intercambiadores = array(
    'totalinterecp'=>$totalinterecp,
    'totalinterut'=> $totalinterut,
    'totalintereceje'=>$totalintereceje,
    'totalinteruteje'=>$totalinteruteje,
    'totalfirmas'=>$totalinterecp+$totalinterut,
    'totalfirmaseje'=>$totalintereceje + $totalinteruteje,
    'cantintercambiadores'=>$cantintercambiadores
);

$torres = array(
    'totaltorresec'=>$totaltorresec,
    'totaltorresut'=> $totaltorresut,
    'totaltorreseceje'=>$totaltorreseceje,
    'totaltorresuteje'=>$totaltorresuteje,
    'totalfirmas'=>$totaltorresec+$totaltorresut,
    'totalfirmaseje'=>$totaltorreseceje + $totaltorresuteje,
    'canttorres'=>$canttorres
);

$hornos = array(
    'totalhornoecp'=>$totalhornoecp,
    'totalhornout'=> $totalhornout,
    'totalhornoecpeje'=>$totalhornoecpeje,
    'totalhornouteje'=>$totalhornouteje,
    'totalfirmas'=>$totalhornoecp+$totalhornout,
    'totalfirmaseje'=>$totalhornoecpeje + $totalhornouteje,
    'canthornos'=>$canthornos
);

$tambores = array(
    'totaltamborec'=>$totaltamborec,
    'totaltamborut'=> $totaltamborut,
    'totaltamboreceje'=>$totaltamboreceje,
    'totaltamboruteje'=>$totaltamboruteje,
    'totalfirmas'=>$totaltamborec+$totaltamborut,
    'totalfirmaseje'=>$totaltamboreceje + $totaltamboruteje,
    'canttambores'=>$canttambores
);

$lgs = array(
    'totallgec'=>$totallgec,
    'totallgut'=> $totallgut,
    'totallgeceje'=>$totallgeceje,
    'totallguteje'=>$totallguteje,
    'totalfirmas'=>$totallgec+$totallgut,
    'totalfirmaseje'=>$totallgeceje + $totallguteje,
    'cantlgs'=>$cantlgs
);

$valvulas = array(
    'totalvalec'=>$totalvalec,
    'totalvalut'=> $totalvalut,
    'totalvaleceje'=>$totalvaleceje,
    'totalvaluteje'=>$totalvaluteje,
    'totalfirmas'=>$totalvalec+$totalvalut,
    'totalfirmaseje'=>$totalvaleceje + $totalvaluteje,
    'cantvalvulas'=>$cantvalvulas
);

$eyectores = array(
    'totaleyeec'=>$totaleyeec,
    'totaleyeut'=> $totaleyeut,
    'totaleyeeceje'=>$totaleyeeceje,
    'totaleyeuteje'=>$totaleyeuteje,
    'totalfirmas'=>$totaleyeec+$totaleyeut,
    'totalfirmaseje'=>$totaleyeeceje + $totaleyeuteje,
    'canteyectores'=>$canteyectores 
);

$totalequipos = $cantintercambiadores + $canttorres + $canthornos + $cantlgs + $cantvalvulas  + $canteyectores ;
$totalitalcoplan = $totalinterut + $totaltorresut + $totaltamborut + $totallgut + $totalvalut + $totaleyeut;
$totalecoplan = $totalinterecp + $totaltorresec + $totaltamborec + $totallgec + $totalvalec + $totaleyeec;
$totalitalcoeje = $totalinteruteje + $totaltorresuteje + $totaltamboruteje + $totalvaluteje + $totaleyeuteje;
$totalecoeje = $totaleyeeceje + $totalvaleceje + $totallgeceje + $totaltamboreceje + $totaltorreseceje + $totalintereceje;

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
    'intercambiadores'=>$intercambiadores,
    'torres'=>$torres,
    'hornos'=>$hornos,
    'tambores'=>$tambores,
    'lgs'=>$lgs,
    'valvulas'=>$valvulas,
    'eyectores'=>$eyectores,
    'consolidado'=>$consolidado
);

echo json_encode($datos);
