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

    if( $tag == 'E-2765' ||  $tag == 'E-2768' ||  $tag == 'E-2778'  || $tag == 'E-2783'  ){
        $totalinterecp1 = 9;
    }else{
        $totalinterecp1 = 10;
    }

    if( $tag == 'E-2717' || $tag == 'E-2791'  || $tag == 'E-2792'){
        $totalinterecp1 = 8;
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
$tot25ut=26;
$tot25ec1=23;
$tot25ut1=26;
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

$tot28ec1=25;
$tot28ut1=28;
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

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2224";
    $ejec = mysqli_query($conexion, $cons);
    $cant = mysqli_num_rows($ejec);

    $canttorres += $cant;

    $tot24ut = $tot24ut * $cant;
    $tot24ec = $tot24ec * $cant;

    $cons = "SELECT * FROM os2224 WHERE tag = '$tag'";
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
    
        if($obj->limpieza_zona4 != ""){
            $limpieza_zona4 =  json_decode($obj->limpieza_zona4);
            if($limpieza_zona4[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
        if($obj->limpieza_zona5 != ""){
            $limpieza_zona5 =  json_decode($obj->limpieza_zona5);
            if($limpieza_zona5[0]->nombreut != ""){
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
    
        if($obj->ejecucion_zona4 != ""){
            $ejecucion_zona4 =  json_decode($obj->ejecucion_zona4);
            if($ejecucion_zona4[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
        if($obj->ejecucion_zona5 != ""){
            $ejecucion_zona5 =  json_decode($obj->ejecucion_zona5);
            if($ejecucion_zona5[0]->nombreec != ""){
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
    
        if($obj->liberacion_zona4_int != ""){
            $liberacion_zona4_int =  json_decode($obj->liberacion_zona4_int);
        
            $cant = COUNT($liberacion_zona4_int);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion_zona4_int[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion_zona4_int[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion_zona4_int[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
    
                if($liberacion_zona4_int[$i]->nombreec2 != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    
        if($obj->liberacion_zona4_ext != ""){
            $liberacion_zona4_ext =  json_decode($obj->liberacion_zona4_ext);
        
            $cant = COUNT($liberacion_zona4_ext);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion_zona4_ext[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion_zona4_ext[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion_zona4_ext[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
               
            }
        
        }
    
        if($obj->liberacion_zona5_int != ""){
            $liberacion_zona5_int =  json_decode($obj->liberacion_zona5_int);
        
            $cant = COUNT($liberacion_zona5_int);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion_zona5_int[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion_zona5_int[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion_zona5_int[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
    
                if($liberacion_zona5_int[$i]->nombreec2 != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    
        if($obj->liberacion_zona5_ext != ""){
            $liberacion_zona5_ext =  json_decode($obj->liberacion_zona5_ext);
        
            $cant = COUNT($liberacion_zona5_ext);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion_zona5_ext[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion_zona5_ext[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion_zona5_ext[$i]->nombreec != ""){
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

$cons = "SELECT * FROM os2225";
    $ejec = mysqli_query($conexion, $cons);
    $cant = mysqli_num_rows($ejec);

    $canttorres += $cant;

    $tot25ut = $tot25ut * $cant;
    $tot25ec = $tot25ec * $cant;

$cons3 = "SELECT * FROM os2225";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2225 WHERE tag = '$tag'";
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

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2223 WHERE tag = '$tag'";
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

    if($tag == 'T-2751'){
        $tot23ut1 = $tot23ut1 - 1;
        $tot23ec1 = $tot23ec1 - 1;
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

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2226 WHERE tag = '$tag'";
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

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2227 WHERE tag = '$tag'";
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

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2228 WHERE tag = '$tag'";
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

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2229 WHERE tag = '$tag'";
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
    
           
        if($obj->ejecucion_exterior != ""){
            $ejecucion_exterior =  json_decode($obj->ejecucion_exterior);
            if($ejecucion_exterior[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
       
        if($obj->liberacion_ext != ""){
            $liberacion_ext =  json_decode($obj->liberacion_ext);
        
            $cant = COUNT($liberacion_ext);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion_ext[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion_ext[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion_ext[$i]->nombreec != ""){
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

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os80 WHERE tag = '$tag'";
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
    
       
        if($obj->liberacion_int != ""){
            $liberacion_int =  json_decode($obj->liberacion_int);
        
            $cant = COUNT($liberacion_int);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion_int[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion_int[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion_int[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
    
                if($liberacion_int[$i]->firmaec2 != ""){
                    $sumfirmaec++;
                }
              
            }
        
        }

        if($obj->liberacion_casco != ""){
            $liberacion_casco =  json_decode($obj->liberacion_casco);
        
            $cant = COUNT($liberacion_casco);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion_casco[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion_casco[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion_casco[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
              
            }
        
        }
    
    
        if($obj->cierre != ""){
            $cierre =  json_decode($obj->cierre);
    
            $cant = COUNT($cierre);
        
            for($i=0; $i<$cant;$i++){
    
                if($cierre[$i]->firmaut != ""){
                    $sumfirmaut++;
                }
                if($cierre[$i]->firmaec != ""){
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

    if($tag == 'D-2710'){
        $totaltamborec1 = $totaltamborec1;
        $totaltamborut1 = $totaltamborut1 - 3;
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

    if($tag == 'V1E2717'){
        $totalvalec1 = $totalvalec1 - 2;
        $totalvalut1 = $totalvalut1 - 3;
    }else{
        $totalvalec1 = 5;
        $totalvalut1 = 5;
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
$totaleyeec = 3;
$totaleyeut = 2;
$totaleyeec1 = 3;
$totaleyeut1 = 2;


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

    $cons = "SELECT * FROM os102 WHERE tag = '$tag'";
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
        
             if($obj->ejecucion != ""){
            $ejecucion =  json_decode($obj->ejecucion);
            if($ejecucion[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
      
    
        // if($obj->terminacion != ""){
        //     $terminacion =  json_decode($obj->terminacion);
        //     if($terminacion[0]->nombreut != ""){
        //         $sumfirmaut++;
        //     }
        //     if($terminacion[0]->nombreec != ""){
        //         $sumfirmaec++;
        //     }
        // }
    
        // if($obj->pintura != ""){
        //     $pintura =  json_decode($obj->pintura);
        //     if($pintura[0]->nombreut != ""){
        //         $sumfirmaut++;
        //     }
        //     if($pintura[0]->nombreec != ""){
        //         $sumfirmaec++;
        //     }
        // }
    
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

    $tagseyectores[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totaleyeut1,
        'totalfirmasecpplan'=>$totaleyeec1,
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
