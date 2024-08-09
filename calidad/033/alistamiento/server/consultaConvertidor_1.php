<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

//consulta ciclones 2213 y 2233
$totalciclonecp = 7;
$totalciclonut = 8;
$totalciclonecp1 =11;
$totalciclonut1= 15;
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

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2213 WHERE tag = '$tag'";
    $ejec = mysqli_query($conexion, $cons);

    while($obj = mysqli_fetch_object($ejec)){

        if($obj->permiso != ""){
            $permiso =  json_decode($obj->permiso);
            if($permiso[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($permiso[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
        
        if($obj->limpieza != ""){
            $limpieza =  json_decode($obj->limpieza);
            if($limpieza[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
        
        if($obj->ejecucion != ""){
            $ejecucion =  json_decode($obj->ejecucion);
            if($ejecucion[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
        
        if($obj->liberacion != ""){
            $liberacion =  json_decode($obj->liberacion);
        
            $cant = COUNT($liberacion);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion[$i]->nombreutq != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    
        if($obj->cierre != ""){
            $cierre =  json_decode($obj->cierre);
        
            $cant = COUNT($cierre);
        
            for($i=0; $i<$cant;$i++){
                if($cierre[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
                
                if($cierre[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    
        if($obj->terminacion != ""){
            $terminacion =  json_decode($obj->terminacion);
            if($terminacion[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($terminacion[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->pintura != ""){
            $pintura =  json_decode($obj->pintura);
            if($pintura[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($pintura[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->entrega != ""){
            $entrega =  json_decode($obj->entrega);
            if($entrega[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($entrega[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
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

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2233 WHERE tag='$tag'";
    $eje = mysqli_query($conexion, $cons);

    while($obj = mysqli_fetch_object($eje)){

        if($obj->permiso != ""){
            $permiso =  json_decode($obj->permiso);
            if($permiso[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($permiso[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
        
        if($obj->limpieza != ""){
            $limpieza =  json_decode($obj->limpieza);
            if($limpieza[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
        
        if($obj->ejecucion != ""){
            $ejecucion =  json_decode($obj->ejecucion);
            if($ejecucion[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
        
        if($obj->liberacion != ""){
            $liberacion =  json_decode($obj->liberacion);
        
            $cant = COUNT($liberacion);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    
        if($obj->cierre != ""){
            $cierre =  json_decode($obj->cierre);
        
            $cant = COUNT($cierre);
        
            for($i=0; $i<$cant;$i++){
                if($cierre[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
                
                if($cierre[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    
        if($obj->terminacion != ""){
            $terminacion =  json_decode($obj->terminacion);
            if($terminacion[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($terminacion[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->pintura != ""){
            $pintura =  json_decode($obj->pintura);
            if($pintura[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($pintura[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->entrega != ""){
            $entrega =  json_decode($obj->entrega);
            if($entrega[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($entrega[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
        
    }

    $tagsciclones[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalciclonut,
        'totalfirmasecpplan'=>$totalciclonecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalciclonut + $totalciclonecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalciclonut1 + $totalciclonecp1)-($sumfirmaut+$sumfirmaec)
    );
}

$totalciclonecpeje = $sumfirmaec;
$totalciclonuteje = $sumfirmaut;

//consulta HORNO 2232
$totalhornoecp = 7;
$totalhornout = 8;
$totalhornoecp1 = 7;
$totalhornout1 = 8;

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

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2232 WHERE tag = '$tag'";
    $ejec = mysqli_query($conexion, $cons);

    while($obj = mysqli_fetch_object($ejec)){

        if($obj->permiso != ""){
            $permiso =  json_decode($obj->permiso);
            if($permiso[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($permiso[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
        
        if($obj->limpieza != ""){
            $limpieza =  json_decode($obj->limpieza);
            if($limpieza[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
        
        if($obj->ejecucion != ""){
            $ejecucion =  json_decode($obj->ejecucion);
            if($ejecucion[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
        
        if($obj->liberacion != ""){
            $liberacion =  json_decode($obj->liberacion);
        
            $cant = COUNT($liberacion);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    
        if($obj->cierre != ""){
            $cierre =  json_decode($obj->cierre);
        
            $cant = COUNT($cierre);
        
            for($i=0; $i<$cant;$i++){
                if($cierre[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
                
                if($cierre[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    
        if($obj->terminacion != ""){
            $terminacion =  json_decode($obj->terminacion);
            if($terminacion[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($terminacion[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->pintura != ""){
            $pintura =  json_decode($obj->pintura);
            if($pintura[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($pintura[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->entrega != ""){
            $entrega =  json_decode($obj->entrega);
            if($entrega[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($entrega[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
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
// $totalinterecp = 16;
// $totalinterut = 20;
// $totalinter = $totalinterecp + $totalinterut;

// $sumfirmaut = 0;
// $sumfirmaec = 0;

// $cons = "SELECT * FROM os2208";
// $ejec = mysqli_query($conexion, $cons);
// $cant = mysqli_num_rows($ejec);

// $cantintercambiadores = $cant;

// $cons3 = "SELECT * FROM os2208";
// $ejec3 = mysqli_query($conexion, $cons3);
// $enc3 = mysqli_num_rows($ejec3);

// while($obj = mysqli_fetch_object($ejec3)){

//     $tag = $obj->tag;
//     $sumfirmaut = 0;
//     $sumfirmaec = 0;

//     $sql="SHOW COLUMNS FROM `os2208`";
//     $exito=mysqli_query($conexion, $sql);

//     while($row = mysqli_fetch_object($exito)){
    
//         $campo = $row->Field;

//         $cons1 = "SELECT * FROM os2208 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'". " AND tag = '$tag'" ;
//         $ejec1 = mysqli_query($conexion, $cons1);
//         $enc1 = mysqli_num_rows($ejec1);

//         $sumfirmaut += $enc1;

//         $cons2 = "SELECT * FROM os2208 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'". " AND tag = '$tag'" ;
//         $ejec2 = mysqli_query($conexion, $cons2);
//         $enc2 = mysqli_num_rows($ejec2);

//         $sumfirmaec += $enc2;
//     }

//     $tagsintercambiadores[] = array(
//         'tag'=>$tag,
//         'totalfirmasutplan'=>$totalinterut,
//         'totalfirmasecpplan'=>$totalinterecp,
//         'totalfimasuteje'=>$sumfirmaut,
//         'totalfirmaseceje'=> $sumfirmaec,
//         'totalfirmasplan'=>$totalinterut + $totalinterecp,
//         'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
//         'firmasfaltantes'=>($totalinterut + $totalinterecp)-($sumfirmaut+$sumfirmaec)
//     );

// }

// $cons = "SELECT * FROM os2209";
// $ejec = mysqli_query($conexion, $cons);
// $cant = mysqli_num_rows($ejec);

// $cantintercambiadores += $cant;

// $cons3 = "SELECT * FROM os2209";
// $ejec3 = mysqli_query($conexion, $cons3);
// $enc3 = mysqli_num_rows($ejec3);

// while($obj = mysqli_fetch_object($ejec3)){

//     $tag = $obj->tag;
//     $sumfirmaut = 0;
//     $sumfirmaec = 0;

//     $sql="SHOW COLUMNS FROM `os2209`";
//     $exito=mysqli_query($conexion, $sql);

//     while($row = mysqli_fetch_object($exito)){
    
//         $campo = $row->Field;

//         $cons1 = "SELECT * FROM os2209 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'". " AND tag = '$tag'" ;
//         $ejec1 = mysqli_query($conexion, $cons1);
//         $enc1 = mysqli_num_rows($ejec1);

//         $sumfirmaut += $enc1;

//         $cons2 = "SELECT * FROM os2209 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'". " AND tag = '$tag'" ;
//         $ejec2 = mysqli_query($conexion, $cons2);
//         $enc2 = mysqli_num_rows($ejec2);

//         $sumfirmaec += $enc2;
//     }

//     $tagsintercambiadores[] = array(
//         'tag'=>$tag,
//         'totalfirmasutplan'=>$totalinterut,
//         'totalfirmasecpplan'=>$totalinterecp,
//         'totalfimasuteje'=>$sumfirmaut,
//         'totalfirmaseceje'=> $sumfirmaec,
//         'totalfirmasplan'=>$totalinterut + $totalinterecp,
//         'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
//         'firmasfaltantes'=>($totalinterut + $totalinterecp)-($sumfirmaut+$sumfirmaec)
//     );

// }

// $totalinterecpeje = $sumfirmaec;
// $totalinteruteje = $sumfirmaut;


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

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2212 WHERE tag = '$tag'";
    $ejec = mysqli_query($conexion, $cons);

    while($obj = mysqli_fetch_object($ejec)){

        $planut += 149;
        $planec += 98;
    
        if($obj->permiso != ""){
            $permiso =  json_decode($obj->permiso);
            if($permiso[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($permiso[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
        
        if($obj->manhole1 != ""){
            $manhole1 =  json_decode($obj->manhole1);
            if($manhole1[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->manhole2 != ""){
            $manhole2 =  json_decode($obj->manhole2);
            if($manhole2[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->manhole3 != ""){
            $manhole3 =  json_decode($obj->manhole3);
            if($manhole3[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->manhole4 != ""){
            $manhole4 =  json_decode($obj->manhole4);
            if($manhole4[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->manhole5 != ""){
            $manhole5 =  json_decode($obj->manhole5);
            if($manhole5[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->manhole6 != ""){
            $manhole6 =  json_decode($obj->manhole6);
            if($manhole6[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->manhole7 != ""){
            $manhole7 =  json_decode($obj->manhole7);
            if($manhole7[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->faccomp1 != ""){
            $faccomp1 =  json_decode($obj->faccomp1);
            if($faccomp1[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->faccomp2 != ""){
            $faccomp2 =  json_decode($obj->faccomp2);
            if($faccomp2[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->faccomp3 != ""){
            $faccomp3 =  json_decode($obj->faccomp3);
            if($faccomp3[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->faccomp4 != ""){
            $faccomp4 =  json_decode($obj->faccomp4);
            if($faccomp4[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
        if($obj->faccomp5 != ""){
            $faccomp5 =  json_decode($obj->faccomp5);
            if($faccomp5[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->faccomp6 != ""){
            $faccomp6 =  json_decode($obj->faccomp6);
            if($faccomp6[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
        
        if($obj->ejecucion != ""){
            $ejecucion =  json_decode($obj->ejecucion);
        
            $cant = COUNT($ejecucion);
        
            for($i=0; $i<$cant;$i++){
                
                if($ejecucion[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
            }
        
        }
        
        if($obj->liberacion != ""){
            $liberacion =  json_decode($obj->liberacion);
        
            $cant = COUNT($liberacion);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion[$i]->nombreutq != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    
      
        if($obj->terminacion != ""){
            $terminacion =  json_decode($obj->terminacion);
            if($terminacion[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($terminacion[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->aislamiento != ""){
            $aislamiento =  json_decode($obj->aislamiento);
            if($aislamiento[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($aislamiento[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->entrega != ""){
            $entrega =  json_decode($obj->entrega);
            if($entrega[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($entrega[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
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
$totalregeneradorecp = 56;
$totalregeneradorut = 86;
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

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2211 WHERE tag = '$tag'";
    $ejec = mysqli_query($conexion, $cons);

    while($obj = mysqli_fetch_object($ejec)){

        $planut += 86;
        $planec += 56;
    
        if($obj->permiso != ""){
            $permiso =  json_decode($obj->permiso);
            if($permiso[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($permiso[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
        
        if($obj->manhole1 != ""){
            $manhole1 =  json_decode($obj->manhole1);
            if($manhole1[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->manhole2 != ""){
            $manhole2 =  json_decode($obj->manhole2);
            if($manhole2[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->manhole3 != ""){
            $manhole3 =  json_decode($obj->manhole3);
            if($manhole3[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->manhole4 != ""){
            $manhole4 =  json_decode($obj->manhole4);
            if($manhole4[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
       
        if($obj->faccomp1 != ""){
            $faccomp1 =  json_decode($obj->faccomp1);
            if($faccomp1[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->faccomp2 != ""){
            $faccomp2 =  json_decode($obj->faccomp2);
            if($faccomp2[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->faccomp3 != ""){
            $faccomp3 =  json_decode($obj->faccomp3);
            if($faccomp3[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->faccomp4 != ""){
            $faccomp4 =  json_decode($obj->faccomp4);
            if($faccomp4[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
       
        
        if($obj->ejecucion != ""){
            $ejecucion =  json_decode($obj->ejecucion);
        
            $cant = COUNT($ejecucion);
        
            for($i=0; $i<$cant;$i++){
                
                if($ejecucion[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
            }
        
        }
        
        if($obj->liberacion != ""){
            $liberacion =  json_decode($obj->liberacion);
        
            $cant = COUNT($liberacion);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion[$i]->nombreutq != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    
        if($obj->cierre != ""){
            $cierre =  json_decode($obj->cierre);
           
            if($cierre[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
    
      
        if($obj->terminacion != ""){
            $terminacion =  json_decode($obj->terminacion);
            if($terminacion[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($terminacion[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->pintura != ""){
            $pintura =  json_decode($obj->pintura);
            if($pintura[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($pintura[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->entrega != ""){
            $entrega =  json_decode($obj->entrega);
            if($entrega[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($entrega[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
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

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2234 WHERE tag = '$tag'";
    $ejec = mysqli_query($conexion, $cons);

    while($obj = mysqli_fetch_object($ejec)){

        $planut += 22;
        $planec += 13;
    
        if($obj->permiso != ""){
            $permiso =  json_decode($obj->permiso);
            if($permiso[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($permiso[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->facilidades != ""){
            $facilidades =  json_decode($obj->facilidades);
        
            $cant = COUNT($facilidades);
        
            for($i=0; $i<$cant;$i++){
                
                if($facilidades[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
            }
        
        }
           
        
        if($obj->ejecucion != ""){
            $ejecucion =  json_decode($obj->ejecucion);
        
            $cant = COUNT($ejecucion);
        
            for($i=0; $i<$cant;$i++){
                
                if($ejecucion[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
            }
        
        }
        
        if($obj->liberacion != ""){
            $liberacion =  json_decode($obj->liberacion);
        
            $cant = COUNT($liberacion);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion[$i]->nombreutq != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    
       
      
        if($obj->terminacion != ""){
            $terminacion =  json_decode($obj->terminacion);
            if($terminacion[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($terminacion[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->pintura != ""){
            $pintura =  json_decode($obj->pintura);
            if($pintura[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($pintura[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->entrega != ""){
            $entrega =  json_decode($obj->entrega);
            if($entrega[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($entrega[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
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
$totalvalvulaut = 100;

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
$totalvalvulaut1 = 100;

$cons3 = "SELECT * FROM os2241";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2241 WHERE tag = '$tag'";
    $ejec = mysqli_query($conexion, $cons);

    while($obj = mysqli_fetch_object($ejec)){

        $planut += 98;
        $planec += 51;
    
        if($obj->permiso != ""){
            $permiso =  json_decode($obj->permiso);
            if($permiso[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($permiso[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->limpieza_actuador != ""){
            $limpieza_actuador =  json_decode($obj->limpieza_actuador);
        
            $cant = COUNT($limpieza_actuador);
        
            for($i=0; $i<$cant;$i++){
                
                if($limpieza_actuador[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
                // if($limpieza_actuador[$i]->nombreec != ""){
                //     $sumfirmaec++;
                // }
            }
        
        }
    
        if($obj->limpieza_tuberia != ""){
            $limpieza_tuberia =  json_decode($obj->limpieza_tuberia);
        
            $cant = COUNT($limpieza_tuberia);
        
            for($i=0; $i<$cant;$i++){
                
                if($limpieza_tuberia[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
               
            }
        }
    
        if($obj->limpieza_bonete != ""){
            $limpieza_bonete =  json_decode($obj->limpieza_bonete);
        
            $cant = COUNT($limpieza_bonete);
        
            for($i=0; $i<$cant;$i++){
                
                if($limpieza_bonete[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
                
            }
        
        }
    
        if($obj->limpieza_componentes != ""){
            $limpieza_componentes =  json_decode($obj->limpieza_componentes);
        
            $cant = COUNT($limpieza_componentes);
        
            for($i=0; $i<$cant;$i++){
                
                if($limpieza_componentes[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
                
            }
        
        }
    
        if($obj->limpieza_int_valvula != ""){
            $limpieza_int_valvula =  json_decode($obj->limpieza_int_valvula);
        
            $cant = COUNT($limpieza_int_valvula);
        
            for($i=0; $i<$cant;$i++){
                
                if($limpieza_int_valvula[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
                
            }
        
        }
    
        if($obj->limpieza_cuerpo_valvula != ""){
            $limpieza_cuerpo_valvula =  json_decode($obj->limpieza_cuerpo_valvula);
        
            $cant = COUNT($limpieza_cuerpo_valvula);
        
            for($i=0; $i<$cant;$i++){
                
                if($limpieza_cuerpo_valvula[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
                
            }
        
        }
    
        if($obj->inspdimencional != ""){
            $inspdimencional =  json_decode($obj->inspdimencional);
        
            $cant = COUNT($inspdimencional);
        
            for($i=0; $i<$cant;$i++){
                
                if($inspdimencional[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
                
            }
        
        }
    
        if($obj->inspdimencional != ""){
            $inspdimencional =  json_decode($obj->inspdimencional);
        
            $cant = COUNT($inspdimencional);
        
            for($i=0; $i<$cant;$i++){
                
                if($inspdimencional[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
                
            }
        
        }
    
        if($obj->inspgeneral != ""){
            $inspgeneral =  json_decode($obj->inspgeneral);
        
            $cant = COUNT($inspgeneral);
        
            for($i=0; $i<$cant;$i++){
                
                if($inspgeneral[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
                
            }
        
        }
       
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
$totallineaecp = 18;
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

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2242 WHERE tag = '$tag'";
    $ejec = mysqli_query($conexion, $cons);

    while($obj = mysqli_fetch_object($ejec)){

        $planut += 26;
        $planec +=18;
    
        if($obj->permiso != ""){
            $permiso =  json_decode($obj->permiso);
            if($permiso[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($permiso[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
        
        if($obj->facilidades != ""){
            $facilidades =  json_decode($obj->facilidades);
    
            $cant = COUNT($facilidades);
        
            for($i=0; $i<$cant;$i++){
                if($facilidades[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
                
            }
            
        }
    
        if($obj->ejecucion != ""){
            $ejecucion =  json_decode($obj->ejecucion);
    
            $cant = COUNT($ejecucion);
        
            for($i=0; $i<$cant;$i++){
                if($ejecucion[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
                
            }
            
        }
      
        
        if($obj->liberacion != ""){
            $liberacion =  json_decode($obj->liberacion);
        
            $cant = COUNT($liberacion);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion[$i]->nombreutq != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    
        if($obj->cierre != ""){
            $cierre =  json_decode($obj->cierre);
        
            $cant = COUNT($cierre);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion[$i]->nombreutq != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    
        if($obj->ajustes != ""){
            $ajustes =  json_decode($obj->ajustes);
            if($ajustes[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($ajustes[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->terminacion != ""){
            $terminacion =  json_decode($obj->terminacion);
            if($terminacion[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($terminacion[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->pintura != ""){
            $pintura =  json_decode($obj->pintura);
            if($pintura[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($pintura[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->entrega != ""){
            $entrega =  json_decode($obj->entrega);
            if($entrega[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($entrega[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
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
    'reactor'=>$tagsreactor,
    'regenerador'=>$tagsregenerador,
    'torre'=>$tagstorres,
    'valvulas'=>$tagsvalvulas,
    'linea'=>$tagslinea
);

echo json_encode($datos);
