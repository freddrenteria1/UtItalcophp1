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


//consulta hornos os103
$totalhornoecp = 16;
$totalhornout = 10;

$cons = "SELECT * FROM os103";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canthornos = $cant;

$totalhornoecp = $totalhornoecp * $cant;
$totalhornout = $totalhornout * $cant;

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
    
    if($obj->limp_zona1 != ""){
        $limp_partes =  json_decode($obj->limp_zona1);
        if($limp_partes[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->limp_zona2 != ""){
        $limp_partes =  json_decode($obj->limp_zona2);
        if($limp_partes[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->limp_zona3 != ""){
        $limp_partes =  json_decode($obj->limp_zona3);
        if($limp_partes[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->eje_zona1 != ""){
        $insp_partes =  json_decode($obj->eje_zona1);
        if($insp_partes[0]->nombreec != ""){
            $sumfirmaec++;
        }
    }

    if($obj->eje_zona2 != ""){
        $insp_partes =  json_decode($obj->eje_zona2);
        if($insp_partes[0]->nombreec != ""){
            $sumfirmaec++;
        }
    }

    if($obj->eje_zona3 != ""){
        $insp_partes =  json_decode($obj->eje_zona3);
        if($insp_partes[0]->nombreec != ""){
            $sumfirmaec++;
        }
    }

     if($obj->liberacion != ""){
        $lib_partes =  json_decode($obj->liberacion);
        
        if($lib_partes[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($lib_partes[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
        
        if($lib_partes[0]->nombreec != ""){
            $sumfirmaec++;
        }

        if($lib_partes[0]->nombreec2 != ""){
            $sumfirmaec++;
        }
         
    
    }
    

    if($obj->prueba_zona1 != ""){
        $prueba =  json_decode($obj->prueba_zona1);
        if($prueba[0]->nombreec != ""){
            $sumfirmaec++;
        }
         
    }   
    
    if($obj->prueba_zona2 != ""){
        $prueba =  json_decode($obj->prueba_zona2);
        if($prueba[0]->nombreec != ""){
            $sumfirmaec++;
        }
         
    }   

    if($obj->prueba_zona3 != ""){
        $prueba =  json_decode($obj->prueba_zona3);
        if($prueba[0]->nombreec != ""){
            $sumfirmaec++;
        }
         
    }   

    if($obj->prueba_zona4 != ""){
        $prueba =  json_decode($obj->prueba_zona4);
        if($prueba[0]->nombreec != ""){
            $sumfirmaec++;
        }
         
    }   

    if($obj->prueba_zona5 != ""){
        $prueba =  json_decode($obj->prueba_zona5);
        if($prueba[0]->nombreec != ""){
            $sumfirmaec++;
        }
         
    }   

    if($obj->prueba_zona6 != ""){
        $prueba =  json_decode($obj->prueba_zona6);
        if($prueba[0]->nombreec != ""){
            $sumfirmaec++;
        }
         
    }   

    if($obj->cierre != ""){
        $cierre =  json_decode($obj->cierre);
        if($cierre[0]->nombreut != ""){
            $sumfirmaut++;
        }
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

//SUMAS DE HORNOS
$totalhornoecpeje = $sumfirmaec;
$totalhornouteje = $sumfirmaut;


//INICIO TORRES

$tot3001ec=36;
$tot3001ut=40;
$tot3001 = $tot3001ec+$tot3001ut;

$tot3002ec=14;
$tot3002ut=15;
$tot3002 = $tot3002ec+$tot3002ut;

$tot3003ec=38;
$tot3003ut=43;
$tot3003= $tot3003ec+$tot3003ut;



$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os3001";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot3001ut = $tot3001ut * $cant;
$tot3001ec = $tot3001ec * $cant;

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
    
        $cant = COUNT($limpieza_exterior);
    
        for($i=0; $i<$cant;$i++){
            if($limpieza_exterior[$i]->nombreut != ""){
                $sumfirmaut++;
            }
           
        }
    
    }

    if($obj->limpieza_zona1 != ""){
        $limpieza_zona1 =  json_decode($obj->limpieza_zona1);
    
        $cant = COUNT($limpieza_zona1);
    
        for($i=0; $i<$cant;$i++){
            if($limpieza_zona1[$i]->nombreut != ""){
                $sumfirmaut++;
            }
           
        }
    
    }

    if($obj->limpieza_zona2 != ""){
        $limpieza_zona2 =  json_decode($obj->limpieza_zona2);
    
        $cant = COUNT($limpieza_zona2);
    
        for($i=0; $i<$cant;$i++){
            if($limpieza_zona2[$i]->nombreut != ""){
                $sumfirmaut++;
            }
           
        }
    
    }

    if($obj->limpieza_zona3 != ""){
        $limpieza_zona3 =  json_decode($obj->limpieza_zona3);
    
        $cant = COUNT($limpieza_zona3);
    
        for($i=0; $i<$cant;$i++){
            if($limpieza_zona3[$i]->nombreut != ""){
                $sumfirmaut++;
            }
           
        }
    
    }

    if($obj->limpieza_zona4 != ""){
        $limpieza_zona4 =  json_decode($obj->limpieza_zona4);
    
        $cant = COUNT($limpieza_zona4);
    
        for($i=0; $i<$cant;$i++){
            if($limpieza_zona4[$i]->nombreut != ""){
                $sumfirmaut++;
            }
           
        }
    
    }
 

    if($obj->ejecucion_exterior != ""){
        $ejecucion_exterior =  json_decode($obj->ejecucion_exterior);
    
        $cant = COUNT($ejecucion_exterior);
    
        for($i=0; $i<$cant;$i++){
            if($ejecucion_exterior[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->ejecucion_zona1 != ""){
        $ejecucion_zona1 =  json_decode($obj->ejecucion_zona1);
    
        $cant = COUNT($ejecucion_zona1);
    
        for($i=0; $i<$cant;$i++){
            if($ejecucion_zona1[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->ejecucion_zona2 != ""){
        $ejecucion_zona2 =  json_decode($obj->ejecucion_zona2);
    
        $cant = COUNT($ejecucion_zona2);
    
        for($i=0; $i<$cant;$i++){
            if($ejecucion_zona2[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->ejecucion_zona3 != ""){
        $ejecucion_zona3 =  json_decode($obj->ejecucion_zona3);
    
        $cant = COUNT($ejecucion_zona3);
    
        for($i=0; $i<$cant;$i++){
            if($ejecucion_zona3[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->ejecucion_zona4 != ""){
        $ejecucion_zona4 =  json_decode($obj->ejecucion_zona4);
    
        $cant = COUNT($ejecucion_zona4);
    
        for($i=0; $i<$cant;$i++){
            if($ejecucion_zona4[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
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



$cons = "SELECT * FROM os3002";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot3002ut = $tot3002ut * $cant;
$tot3002ec = $tot3002ec * $cant;

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
    
        $cant = COUNT($limpieza_exterior);
    
        for($i=0; $i<$cant;$i++){
            if($limpieza_exterior[$i]->nombreut != ""){
                $sumfirmaut++;
            }
           
        }
    
    }

    if($obj->limpieza_zona1 != ""){
        $limpieza_zona1 =  json_decode($obj->limpieza_zona1);
    
        $cant = COUNT($limpieza_zona1);
    
        for($i=0; $i<$cant;$i++){
            if($limpieza_zona1[$i]->nombreut != ""){
                $sumfirmaut++;
            }
           
        }
    
    }

    if($obj->limpieza_zona2 != ""){
        $limpieza_zona2 =  json_decode($obj->limpieza_zona2);
    
        $cant = COUNT($limpieza_zona2);
    
        for($i=0; $i<$cant;$i++){
            if($limpieza_zona2[$i]->nombreut != ""){
                $sumfirmaut++;
            }
           
        }
    
    }

    

    

    if($obj->ejecucion_exterior != ""){
        $ejecucion_exterior =  json_decode($obj->ejecucion_exterior);
    
        $cant = COUNT($ejecucion_exterior);
    
        for($i=0; $i<$cant;$i++){
            if($ejecucion_exterior[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->ejecucion_zona1 != ""){
        $ejecucion_zona1 =  json_decode($obj->ejecucion_zona1);
    
        $cant = COUNT($ejecucion_zona1);
    
        for($i=0; $i<$cant;$i++){
            if($ejecucion_zona1[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->ejecucion_zona2 != ""){
        $ejecucion_zona2 =  json_decode($obj->ejecucion_zona2);
    
        $cant = COUNT($ejecucion_zona2);
    
        for($i=0; $i<$cant;$i++){
            if($ejecucion_zona2[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
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




$cons = "SELECT * FROM os3003";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot3003ut = $tot3003ut * $cant;
$tot3003ec = $tot3003ec * $cant;



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
    
        $cant = COUNT($limpieza_exterior);
    
        for($i=0; $i<$cant;$i++){
            if($limpieza_exterior[$i]->nombreut != ""){
                $sumfirmaut++;
            }
           
        }
    
    }

    if($obj->limpieza_zona1 != ""){
        $limpieza_zona1 =  json_decode($obj->limpieza_zona1);
    
        $cant = COUNT($limpieza_zona1);
    
        for($i=0; $i<$cant;$i++){
            if($limpieza_zona1[$i]->nombreut != ""){
                $sumfirmaut++;
            }
           
        }
    
    }

    if($obj->limpieza_zona2 != ""){
        $limpieza_zona2 =  json_decode($obj->limpieza_zona2);
    
        $cant = COUNT($limpieza_zona2);
    
        for($i=0; $i<$cant;$i++){
            if($limpieza_zona2[$i]->nombreut != ""){
                $sumfirmaut++;
            }
           
        }
    
    }

    if($obj->limpieza_zona3 != ""){
        $limpieza_zona3 =  json_decode($obj->limpieza_zona3);
    
        $cant = COUNT($limpieza_zona3);
    
        for($i=0; $i<$cant;$i++){
            if($limpieza_zona3[$i]->nombreut != ""){
                $sumfirmaut++;
            }
           
        }
    
    }

    if($obj->limpieza_zona4 != ""){
        $limpieza_zona4 =  json_decode($obj->limpieza_zona4);
    
        $cant = COUNT($limpieza_zona4);
    
        for($i=0; $i<$cant;$i++){
            if($limpieza_zona4[$i]->nombreut != ""){
                $sumfirmaut++;
            }
           
        }
    
    }

    if($obj->limpieza_zona5 != ""){
        $limpieza_zona5 =  json_decode($obj->limpieza_zona5);
    
        $cant = COUNT($limpieza_zona5);
    
        for($i=0; $i<$cant;$i++){
            if($limpieza_zona5[$i]->nombreut != ""){
                $sumfirmaut++;
            }
           
        }
    
    }
 

    if($obj->ejecucion_exterior != ""){
        $ejecucion_exterior =  json_decode($obj->ejecucion_exterior);
    
        $cant = COUNT($ejecucion_exterior);
    
        for($i=0; $i<$cant;$i++){
            if($ejecucion_exterior[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->ejecucion_zona1 != ""){
        $ejecucion_zona1 =  json_decode($obj->ejecucion_zona1);
    
        $cant = COUNT($ejecucion_zona1);
    
        for($i=0; $i<$cant;$i++){
            if($ejecucion_zona1[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->ejecucion_zona2 != ""){
        $ejecucion_zona2 =  json_decode($obj->ejecucion_zona2);
    
        $cant = COUNT($ejecucion_zona2);
    
        for($i=0; $i<$cant;$i++){
            if($ejecucion_zona2[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->ejecucion_zona3 != ""){
        $ejecucion_zona3 =  json_decode($obj->ejecucion_zona3);
    
        $cant = COUNT($ejecucion_zona3);
    
        for($i=0; $i<$cant;$i++){
            if($ejecucion_zona3[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->ejecucion_zona4 != ""){
        $ejecucion_zona4 =  json_decode($obj->ejecucion_zona4);
    
        $cant = COUNT($ejecucion_zona4);
    
        for($i=0; $i<$cant;$i++){
            if($ejecucion_zona4[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->ejecucion_zona5 != ""){
        $ejecucion_zona5 =  json_decode($obj->ejecucion_zona5);
    
        $cant = COUNT($ejecucion_zona5);
    
        for($i=0; $i<$cant;$i++){
            if($ejecucion_zona5[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
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

$totaltorresec = $tot3003ec+$tot3001ec+$tot3002ec;
$totaltorresut = $tot3003ut+$tot3001ut+$tot3002ut;


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
$totaleyeec = 6;
$totaleyeut = 7;

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
        if($liberacion[0]->nombreut != ""){
            $sumfirmaut++;
        }

        if($liberacion[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }

        if($liberacion[0]->nombreec != ""){
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

$totalequipos = $cantintercambiadores + $canttorres + $canthornos + $cantlgs + $cantvalvulas  + $canteyectores;
$totalitalcoplan = $totalinterut + $totaltorresut + $totalhornout + $totaltamborut + $totallgut + $totalvalut + $totaleyeut;
$totalecoplan = $totalinterecp + $totaltorresec + $totalhornoecp + $totaltamborec + $totallgec + $totalvalec + $totaleyeec;
$totalitalcoeje = $totalinteruteje + $totaltorresuteje + $totalhornouteje + $totaltamboruteje + $totallguteje + $totalvaluteje + $totaleyeuteje;
$totalecoeje = $totaleyeeceje + $totalvaleceje + $totallgeceje + $totaltamboreceje + $totalhornoecpeje + $totaltorreseceje + $totalintereceje;

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
