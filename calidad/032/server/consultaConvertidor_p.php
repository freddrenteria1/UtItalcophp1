<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

//consulta ciclones 2213 y 2233
$totalciclonecp = 18;
$totalciclonut = 23;
$totalciclonecp1 = 18;
$totalciclonut1= 23;
$totalciclon = $totalciclonecp + $totalciclonut;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os2213";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantciclores = $cant;

$cons3 = "SELECT * FROM os2213";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os2213`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os2213 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os2213 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagsciclones[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalciclonut1,
        'totalfirmasecpplan'=>$totalciclonecp1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalciclonut1 + $totalciclonecp1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalciclonut1 + $totalciclonecp1)-($sumfirmaut+$sumfirmaec)
    );

}

$cons = "SELECT * FROM os2233";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantciclores += $cant;

$cons3 = "SELECT * FROM os2233";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os2233`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os2233 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'". " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os2233 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'". " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagsciclones[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalciclonut1,
        'totalfirmasecpplan'=>$totalciclonecp1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalciclonut1 + $totalciclonecp1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalciclonut1 + $totalciclonecp1)-($sumfirmaut+$sumfirmaec)
    );
}

$totalciclonecpeje = $sumfirmaec;
$totalciclonuteje = $sumfirmaut;

//consulta HORNO 2232
$totalhornoecp = 7;
$totalhornout = 9;
$totalhornoecp1 = 7;
$totalhornout1 = 9;

$totalhorno = $totalhornoecp + $totalhornout;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os2232";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canthornos = $cant;

$cons3 = "SELECT * FROM os2232";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os2232`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os2232 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'". " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os2232 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'". " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagshornos[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalhornout1,
        'totalfirmasecpplan'=>$totalhornoecp1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalhornout1 + $totalhornoecp1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalhornout1 + $totalhornoecp1)-($sumfirmaut+$sumfirmaec)
    );

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

$cons3 = "SELECT * FROM os2208";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os2208`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os2208 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'". " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os2208 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'". " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagsintercambiadores[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalinterut,
        'totalfirmasecpplan'=>$totalinterecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalinterut + $totalinterecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalinterut + $totalinterecp)-($sumfirmaut+$sumfirmaec)
    );

}

$cons = "SELECT * FROM os2209";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantintercambiadores += $cant;

$cons3 = "SELECT * FROM os2209";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os2209`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os2209 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'". " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os2209 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'". " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagsintercambiadores[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalinterut,
        'totalfirmasecpplan'=>$totalinterecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalinterut + $totalinterecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalinterut + $totalinterecp)-($sumfirmaut+$sumfirmaec)
    );

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

$cons3 = "SELECT * FROM os2212";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os2212`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os2212 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os2212 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagsreactor[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalreactorut,
        'totalfirmasecpplan'=>$totalreactorecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalreactorut + $totalreactorecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalreactorut + $totalreactorecp)-($sumfirmaut+$sumfirmaec)
    );
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

$cons3 = "SELECT * FROM os2211";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os2211`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os2211 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os2211 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagsregenerador[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalregeneradorut,
        'totalfirmasecpplan'=>$totalregeneradorecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalregeneradorut + $totalregeneradorecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalregeneradorut + $totalregeneradorecp)-($sumfirmaut+$sumfirmaec)
    );

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

$cons3 = "SELECT * FROM os2234";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os2234`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os2234 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'". " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os2234 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'". " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagstorres[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totaltorreut,
        'totalfirmasecpplan'=>$totaltorreecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totaltorreut + $totaltorreecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totaltorreut + $totaltorreecp)-($sumfirmaut+$sumfirmaec)
    );

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

$totalvalvulaecp1 = 51;
$totalvalvulaut1 = 95;

$cons3 = "SELECT * FROM os2241";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os2241`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os2241 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'". " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os2241 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'". " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }
    $tagsvalvulas[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalvalvulaut1,
        'totalfirmasecpplan'=>$totalvalvulaecp1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalvalvulaut1 + $totalvalvulaecp1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalvalvulaut1 + $totalvalvulaecp1)-($sumfirmaut+$sumfirmaec)
    );

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

$cons3 = "SELECT * FROM os2242";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os2242`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os2242 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'". " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os2242 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'". " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }
    $tagslinea[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totallineaut,
        'totalfirmasecpplan'=>$totallineaecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totallineaut + $totallineaecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totallineaut + $totallineaecp)-($sumfirmaut+$sumfirmaec)
    );
}

$datos = array(
    'ciclones'=>$tagsciclones,
    'hornos'=>$tagshornos,
    'intercambiadores'=>$tagsintercambiadores,
    'reactor'=>$tagsreactor,
    'regenerador'=>$tagsregenerador,
    'torre'=>$tagstorres,
    'valvulas'=>$tagsvalvulas,
    'linea'=>$tagslinea
);

echo json_encode($datos);
