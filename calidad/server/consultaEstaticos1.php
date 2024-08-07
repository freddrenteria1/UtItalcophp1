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

$totalinterecp = $totalinterecp * $cant;
$totalinterut = $totalinterut * $cant;

$totalinterecp = $totalinterecp - 10;

$sumfirmaut = 0;
$sumfirmaec = 0;

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

//SUMAS DE INTERCAMBIADORES
$totalintereceje = $sumfirmaec;
$totalinteruteje = $sumfirmaut;


//INICIO TORRES

$tot24ec=43;
$tot24ut=48;
$tot24 = $tot24ec+$tot24ut;

$tot25ec=23;
$tot25ut=26;
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

$tot28ec=25;
$tot28ut=28;
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



$cons = "SELECT * FROM os2225";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot25ut = $tot25ut * $cant;
$tot25ec = $tot25ec * $cant;

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




$cons = "SELECT * FROM os2223";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot23ut = $tot23ut * $cant;
$tot23ec = $tot23ec * $cant;


//MENOS 1 y 1 Firma de la T-2751
$tot23ut = $tot23ut - 1;
$tot23ec = $tot23ec - 1;


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


$cons = "SELECT * FROM os2226";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot26ut = $tot26ut * $cant;
$tot26ec = $tot26ec * $cant;


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



$cons = "SELECT * FROM os2227";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot27ut = $tot27ut * $cant;
$tot27ec = $tot27ec * $cant;

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


$cons = "SELECT * FROM os2228";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot28ut = $tot28ut * $cant;
$tot28ec = $tot28ec * $cant;

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

$cons = "SELECT * FROM os2229";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot29ut = $tot29ut * $cant;
$tot29ec = $tot29ec * $cant;

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

//SUMA TORRES
$totaltorreseceje = $sumfirmaec;
$totaltorresuteje = $sumfirmaut;

$totaltorresec = $tot23ec+$tot24ec+$tot25ec+$tot26ec+$tot27ec+$tot28ec+$tot29ec;
$totaltorresut = $tot23ut+$tot24ut+$tot25ut+$tot26ut+$tot27ut+$tot28ut+$tot29ut;


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

$totaltamborec = $totaltamborec - 2;
$totaltamborut = $totaltamborut - 1;

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

            if($liberacion_int[$i]->nombreec2 != ""){
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

            if($cierre[$i]->fechaut != ""){
                $sumfirmaut++;
            }
            if($cierre[$i]->fechaec != ""){
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

$totalvalec = $totalvalec - 2;
$totalvalut = $totalvalut  - 3;

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

$totalvaleceje = $sumfirmaec;
$totalvaluteje = $sumfirmaut;



//consulta eyectores  os102
$totaleyeec = 3;
$totaleyeut = 2;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os102";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canteyectores = $cant;

$totaleyeec = $totaleyeec * $cant;
$totaleyeut = $totaleyeut * $cant;

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
$totalitalcoeje = $totalinteruteje + $totaltorresuteje + $totaltamboruteje + $totallguteje + $totalvaluteje + $totaleyeuteje;
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
