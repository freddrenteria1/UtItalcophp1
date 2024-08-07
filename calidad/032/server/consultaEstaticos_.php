<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

//consulta intercambiadores os38
$totalinterecp = 10;
$totalinterut = 10;

$totalinterecp1 = 10;
$totalinterut1 = 10;

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

$cons3 = "SELECT * FROM os38";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os38`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
   
        $campo = $row->Field;
    
        $cons1 = "SELECT * FROM os38 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

          
        $sumfirmaut += $enc1;
    
        $cons2 = "SELECT * FROM os38 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);
    
        $sumfirmaec += $enc2;

    }

    $tagsinter[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalinterut1,
        'totalfirmasecpplan'=>$totalinterecp1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalinterut1 + $totalinterecp1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalinterut1 + $totalinterecp1)-($sumfirmaut+$sumfirmaec)
    );

}

//INICIO TORRES

$tot24ec=43;
$tot24ut=48;
$tot24ec1=43;
$tot24ut1=48;

$tot24 = $tot24ec+$tot24ut;

$tot25ec=23;
$tot25ut=33;
$tot25ec1=23;
$tot25ut1=33;
$tot25 = $tot25ec+$tot25ut;

$tot23ec=27;
$tot23ut=30;
$tot23ec1=27;
$tot23ut1=30;
$tot23= $tot23ec+$tot23ut;

$tot26ec=29;
$tot26ut=32;
$tot26ec1=29;
$tot26ut1=32;
$tot26 = $tot26ec+$tot26ut;

$tot27ec1=23;
$tot27ut1=26;
$tot27 = $tot27ec+$tot27ut;

$tot28ec1=26;
$tot28ut1=27;
$tot28 = $tot28ec+$tot28ut;

$tot29ec=7;
$tot29ut=8;
$tot29ec1=7;
$tot29ut1=8;
$tot29 = $tot29ec+$tot29ut;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons3 = "SELECT * FROM os2224";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
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

        $cons1 = "SELECT * FROM os2224 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os2224 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagstorres[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$tot24ut1,
        'totalfirmasecpplan'=>$tot24ec1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$tot24ut1 + $tot24ec1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($tot24ut1 + $tot24ec1)-($sumfirmaut+$sumfirmaec)
    );


}

$cons = "SELECT * FROM os2225";
    $ejec = mysqli_query($conexion, $cons);
    $cant = mysqli_num_rows($ejec);

    $canttorres += $cant;

    $tot25ut = $tot25ut * $cant;
    $tot25ec = $tot25ec * $cant;

$cons3 = "SELECT * FROM os2225";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os2225`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os2225 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'". " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os2225 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'". " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagstorres[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$tot25ut1,
        'totalfirmasecpplan'=>$tot25ec1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$tot25ut1 + $tot25ec1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($tot25ut1 + $tot25ec1)-($sumfirmaut+$sumfirmaec)
    );
}

$cons = "SELECT * FROM os2223";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot23ut = $tot23ut * $cant;
$tot23ec = $tot23ec * $cant;

$cons3 = "SELECT * FROM os2223";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os2223`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os2223 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os2223 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagstorres[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$tot23ut1,
        'totalfirmasecpplan'=>$tot23ec1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$tot23ut1 + $tot23ec1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($tot23ut1 + $tot23ec1)-($sumfirmaut+$sumfirmaec)
    );
}

$cons = "SELECT * FROM os2226";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot26ut = $tot26ut * $cant;
$tot26ec = $tot26ec * $cant;

$cons3 = "SELECT * FROM os2226";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os2226`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os2226 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os2226 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagstorres[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$tot26ut1,
        'totalfirmasecpplan'=>$tot26ec1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$tot26ut1 + $tot26ec1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($tot26ut1 + $tot26ec1)-($sumfirmaut+$sumfirmaec)
    );
}

$cons = "SELECT * FROM os2227";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot27ut = $tot27ut * $cant;
$tot27ec = $tot27ec * $cant;

$cons3 = "SELECT * FROM os2227";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os2227`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os2227 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os2227 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagstorres[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$tot27ut1,
        'totalfirmasecpplan'=>$tot27ec1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$tot27ut1 + $tot27ec1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($tot27ut1 + $tot27ec1)-($sumfirmaut+$sumfirmaec)
    );

}

$cons = "SELECT * FROM os2228";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot28ut = $tot28ut * $cant;
$tot28ec = $tot28ec * $cant;

$cons3 = "SELECT * FROM os2228";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os2228`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os2228 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os2228 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagstorres[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$tot28ut1,
        'totalfirmasecpplan'=>$tot28ec1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$tot28ut1 + $tot28ec1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($tot28ut1 + $tot28ec1)-($sumfirmaut+$sumfirmaec)
    );

}

$cons = "SELECT * FROM os2229";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot29ut = $tot29ut * $cant;
$tot29ec = $tot29ec * $cant;

$cons3 = "SELECT * FROM os2229";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os2229`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os2229 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os2229 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagstorres[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$tot29ut1,
        'totalfirmasecpplan'=>$tot29ec1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$tot29ut1 + $tot29ec1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($tot29ut1 + $tot29ec1)-($sumfirmaut+$sumfirmaec)
    );

}


//consulta TAMBORES
$totaltamborec = 9;
$totaltamborut = 10;
$totaltamborec1= 9;
$totaltamborut1 = 10;

$cons = "SELECT * FROM os80";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);
$canttambores = $cant;

$totaltamborec = $totaltamborec * $cant;
$totaltamborut = $totaltamborut * $cant;


$cons3 = "SELECT * FROM os80";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os80`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os80 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os80 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagstambores[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totaltamborec1,
        'totalfirmasecpplan'=>$totaltamborut1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totaltamborec1 + $totaltamborut1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totaltamborec1 + $totaltamborut1)-($sumfirmaut+$sumfirmaec)
    );

}


//consulta LG os21
$totallgec = 2;
$totallgut = 3;
$totallgec1 = 2;
$totallgut1 = 3;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os21";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantlgs = $cant;

$totallgec = $totallgec * $cant;
$totallgut = $totallgut * $cant;

$cons3 = "SELECT * FROM os21";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os21`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os21 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os21 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagslgs[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totallgec1,
        'totalfirmasecpplan'=>$totallgut1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totallgec1 + $totallgut1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totallgec1 + $totallgut1)-($sumfirmaut+$sumfirmaec)
    );

}

//consulta valvulas os02
$totalvalec = 5;
$totalvalut = 5;
$totalvalec1 = 5;
$totalvalut1 = 5;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os02";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantvalvulas = $cant;

$totalvalec = $totalvalec * $cant;
$totalvalut = $totalvalut * $cant;

$cons3 = "SELECT * FROM os02";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os02`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os02 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os02 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagsvalvulas[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalvalec1,
        'totalfirmasecpplan'=>$totalvalut1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalvalec1 + $totalvalut1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalvalec1 + $totalvalut1)-($sumfirmaut+$sumfirmaec)
    );

}


//consulta eyectores  os102
$totaleyeec = 5;
$totaleyeut = 4;
$totaleyeec1 = 5;
$totaleyeut1 = 4;


$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os102";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canteyectores = $cant;

$totaleyeec = $totaleyeec * $cant;
$totaleyeut = $totaleyeut * $cant;

$cons3 = "SELECT * FROM os102";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os102`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os102 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os102 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

    $tagseyectores[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totaleyeec1,
        'totalfirmasecpplan'=>$totaleyeut1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totaleyeec1 + $totaleyeut1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totaleyeec1 + $totaleyeut1)-($sumfirmaut+$sumfirmaec)
    );


}

$totaleyeeceje = $sumfirmaec;
$totaleyeuteje = $sumfirmaut;


$datos = array(
    'intercambiadores'=>$tagsinter,
    'torres'=>$tagstorres,
    'tambores'=>$tagstambores,
    'lgs'=>$tagslgs,
    'valvulas'=>$tagsvalvulas,
    'eyectores'=>$tagseyectores
);

echo json_encode($datos);
