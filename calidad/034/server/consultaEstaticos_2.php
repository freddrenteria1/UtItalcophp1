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

$cons3 = "SELECT * FROM os38";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os38 WHERE tag = '$tag'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->permiso != ""){
            $permiso =  json_decode($obj->permiso);
            if($permiso[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($permiso[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
        
        if($obj->limp_partes != ""){
            $limp_partes =  json_decode($obj->limp_partes);
            if($limp_partes[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->limp_haz_tubos != ""){
            $limp_haz_tubos =  json_decode($obj->limp_haz_tubos);
            if($limp_haz_tubos[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->insp_partes != ""){
            $insp_partes =  json_decode($obj->insp_partes);
            if($insp_partes[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->insp_haz_tubos != ""){
            $insp_haz_tubos =  json_decode($obj->insp_haz_tubos);
            if($insp_haz_tubos[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->lib_partes != ""){
            $lib_partes =  json_decode($obj->lib_partes);
        
            $cant = COUNT($lib_partes);
        
            for($i=0; $i<$cant;$i++){
                if($lib_partes[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($lib_partes[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($lib_partes[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    
        if($obj->lib_haz_tubos != ""){
            $lib_haz_tubos =  json_decode($obj->lib_haz_tubos);
        
            $cant = COUNT($lib_haz_tubos);
        
            for($i=0; $i<$cant;$i++){
                if($lib_haz_tubos[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($lib_haz_tubos[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($lib_haz_tubos[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    
        if($obj->prueba != ""){
            $prueba =  json_decode($obj->prueba);
            if($prueba[0]->nombreectubo != ""){
                $sumfirmaec++;
            }
            if($prueba[0]->nombreeccasco != ""){
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

$tot24ec=25;
$tot24ut=28;
$tot24ec1=25;
$tot24ut1=28;
 
$tot24 = $tot24ec+$tot24ut;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons3 = "SELECT * FROM os2901";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2901";
    $ejec = mysqli_query($conexion, $cons);
    $cant = mysqli_num_rows($ejec);

    $canttorres += $cant;

    $tot24ut = $tot24ut * $cant;
    $tot24ec = $tot24ec * $cant;

    $cons = "SELECT * FROM os2901 WHERE tag = '$tag'";
    $ejec = mysqli_query($conexion, $cons);
    $cant = mysqli_num_rows($ejec);

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
        
        if($obj->limpieza_exterior != ""){
            $limpieza_exterior =  json_decode($obj->limpieza_exterior);
            if($limpieza_exterior[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->limpieza_zona1 != ""){
            $limpieza_zona1 =  json_decode($obj->limpieza_zona1);
            if($limpieza_zona1[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->limpieza_zona2 != ""){
            $limpieza_zona2 =  json_decode($obj->limpieza_zona2);
            if($limpieza_zona2[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->limpieza_zona3 != ""){
            $limpieza_zona3 =  json_decode($obj->limpieza_zona3);
            if($limpieza_zona3[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
      
    
        if($obj->ejecucion_exterior != ""){
            $ejecucion_exterior =  json_decode($obj->ejecucion_exterior);
            if($ejecucion_exterior[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->ejecucion_zona1 != ""){
            $ejecucion_zona1 =  json_decode($obj->ejecucion_zona1);
            if($ejecucion_zona1[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->ejecucion_zona2 != ""){
            $ejecucion_zona2 =  json_decode($obj->ejecucion_zona2);
            if($ejecucion_zona2[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->ejecucion_zona3 != ""){
            $ejecucion_zona3 =  json_decode($obj->ejecucion_zona3);
            if($ejecucion_zona3[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        
    
        if($obj->liberacion_zona1_int != ""){
            $liberacion_zona1_int =  json_decode($obj->liberacion_zona1_int);
        
            $cant = COUNT($liberacion_zona1_int);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion_zona1_int[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion_zona1_int[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion_zona1_int[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
    
                if($liberacion_zona1_int[$i]->nombreec2 != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    
        if($obj->liberacion_zona1_ext != ""){
            $liberacion_zona1_ext =  json_decode($obj->liberacion_zona1_ext);
        
            $cant = COUNT($liberacion_zona1_ext);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion_zona1_ext[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion_zona1_ext[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion_zona1_ext[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
               
            }
        
        }
    
        if($obj->liberacion_zona2_int != ""){
            $liberacion_zona2_int =  json_decode($obj->liberacion_zona2_int);
        
            $cant = COUNT($liberacion_zona2_int);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion_zona2_int[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion_zona2_int[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion_zona2_int[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
    
                if($liberacion_zona2_int[$i]->nombreec2 != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    
        if($obj->liberacion_zona2_ext != ""){
            $liberacion_zona2_ext =  json_decode($obj->liberacion_zona2_ext);
        
            $cant = COUNT($liberacion_zona2_ext);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion_zona2_ext[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion_zona2_ext[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion_zona2_ext[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
               
            }
        
        }
    
        if($obj->liberacion_zona3_int != ""){
            $liberacion_zona3_int =  json_decode($obj->liberacion_zona3_int);
        
            $cant = COUNT($liberacion_zona3_int);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion_zona3_int[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion_zona3_int[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion_zona3_int[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
    
                if($liberacion_zona3_int[$i]->nombreec2 != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    
        if($obj->liberacion_zona3_ext != ""){
            $liberacion_zona3_ext =  json_decode($obj->liberacion_zona3_ext);
        
            $cant = COUNT($liberacion_zona3_ext);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion_zona3_ext[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion_zona3_ext[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion_zona3_ext[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
               
            }
        
        }
      
    
    
        if($obj->prueba_goteo != ""){
            $prueba_goteo =  json_decode($obj->prueba_goteo);
    
            $cant = COUNT($prueba_goteo);
        
            for($i=0; $i<$cant;$i++){
    
                if($prueba_goteo[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
                if($prueba_goteo[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
    
            }
        }    
    
    
        if($obj->armado != ""){
            $armado =  json_decode($obj->armado);
    
            $cant = COUNT($armado);
        
            for($i=0; $i<$cant;$i++){
    
                if($armado[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
                if($armado[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
    
            }
        }    
    
        if($obj->prueba_distri != ""){
            $prueba_distri =  json_decode($obj->prueba_distri);
    
            $cant = COUNT($prueba_distri);
        
            for($i=0; $i<$cant;$i++){
    
                if($prueba_distri[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
                if($prueba_distri[$i]->nombreec != ""){
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

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os21 WHERE tag = '$tag'";
    $ejec = mysqli_query($conexion, $cons);

    while($obj = mysqli_fetch_object($ejec)){

        if($obj->desmontaje != ""){
            $desmontaje =  json_decode($obj->desmontaje);
            if($desmontaje[0]->nombreut != ""){
                $sumfirmaut++;
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
    
        if($obj->prueba != ""){
            $prueba =  json_decode($obj->prueba);
    
            $cant = COUNT($prueba);
        
            for($i=0; $i<$cant;$i++){
    
                if($prueba[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
                if($prueba[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
    
            }
        }    
     
      
    
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

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os02 WHERE tag = '$tag'";
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
    
        if($obj->mantenimiento != ""){
            $mantenimiento =  json_decode($obj->mantenimiento);
            if($mantenimiento[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($mantenimiento[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->retiro != ""){
            $retiro =  json_decode($obj->retiro);
            if($retiro[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($retiro[0]->nombreec != ""){
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

//consulta valvulas os07
$totalvalec3 = 5;
$totalvalut3 = 6;
$totalvalec2 = 5;
$totalvalut2 = 6;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os07";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantvalvulas += $cant;

$totalvalec += $totalvalec3 * $cant;
$totalvalut += $totalvalut3 * $cant;

$cons3 = "SELECT * FROM os07";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os07 WHERE tag = '$tag'";
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
    
        if($obj->mantenimiento != ""){
            $mantenimiento =  json_decode($obj->mantenimiento);
            if($mantenimiento[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($mantenimiento[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->retiro != ""){
            $retiro =  json_decode($obj->retiro);
            if($retiro[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($retiro[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
        
       
    
        if($obj->terminacion != ""){
            $terminacion =  json_decode($obj->terminacion);
            if($terminacion[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($terminacion[0]->nombreutq != ""){
                $sumfirmaut++;
            }
            if($terminacion[0]->nombreec != ""){
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

  
    $tagsvalvulas[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalvalec2,
        'totalfirmasecpplan'=>$totalvalut2,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalvalec2 + $totalvalut2,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalvalec2 + $totalvalut2)-($sumfirmaut+$sumfirmaec)
    );

}



$datos = array(
    'intercambiadores'=>$tagsinter,
    'torres'=>$tagstorres,
    'lgs'=>$tagslgs,
    'valvulas'=>$tagsvalvulas
);

echo json_encode($datos);
