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


//consulta hornos os2804
$totalhornoecp = 18;
$totalhornout = 27;

$cons = "SELECT * FROM os2804";
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

    if($obj->instalacion != ""){
        $limp_partes =  json_decode($obj->instalacion);
        if($limp_partes[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->ejecucion != ""){
        $insp_partes =  json_decode($obj->ejecucion);
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
     
    }

    if($obj->limpieza_cabezal != ""){
        $lib_partes =  json_decode($obj->limpieza_cabezal);
        
        if($lib_partes[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($lib_partes[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
        
        if($lib_partes[0]->nombreec != ""){
            $sumfirmaec++;
        }
     
    }

    if($obj->limp_cond_cabezal != ""){
        $lib_partes =  json_decode($obj->limp_cond_cabezal);
        
        if($lib_partes[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($lib_partes[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
        
        if($lib_partes[0]->nombreec != ""){
            $sumfirmaec++;
        }
     
    }

    if($obj->limp_tapones != ""){
        $lib_partes =  json_decode($obj->limp_tapones);
        
        if($lib_partes[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($lib_partes[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
        
        if($lib_partes[0]->nombreec != ""){
            $sumfirmaec++;
        }
     
    }

    if($obj->instalacion_tapones != ""){
        $lib_partes =  json_decode($obj->instalacion_tapones);
        
        if($lib_partes[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($lib_partes[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
        
        if($lib_partes[0]->nombreec != ""){
            $sumfirmaec++;
        }
     
    }

    if($obj->torque != ""){
        $torque =  json_decode($obj->torque);
        if($torque[0]->nombreut != ""){
            $sumfirmaut++;
        }
        if($torque[0]->nombreec != ""){
            $sumfirmaec++;
        }
    }

    if($obj->prueba_serpentin1 != ""){
        $prueba_serpentin1 =  json_decode($obj->prueba_serpentin1);
        if($prueba_serpentin1[0]->nombreut != ""){
            $sumfirmaut++;
        }
        if($prueba_serpentin1[0]->nombreec != ""){
            $sumfirmaec++;
        }
    }

    if($obj->prueba_serpentin2 != ""){
        $prueba_serpentin2 =  json_decode($obj->prueba_serpentin2);
        if($prueba_serpentin2[0]->nombreut != ""){
            $sumfirmaut++;
        }
        if($prueba_serpentin2[0]->nombreec != ""){
            $sumfirmaec++;
        }
    }

    if($obj->cierre_int != ""){
        $cierre_int =  json_decode($obj->cierre_int);
        if($cierre_int[0]->nombreut != ""){
            $sumfirmaut++;
        }
        if($cierre_int[0]->nombreec != ""){
            $sumfirmaec++;
        }
    }

    if($obj->cierre_tapas != ""){
        $cierre_tapas =  json_decode($obj->cierre_tapas);
        if($cierre_tapas[0]->nombreut != ""){
            $sumfirmaut++;
        }
        if($cierre_tapas[0]->nombreec != ""){
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

$tot2802ec=32;
$tot2802ut=31;
$tot2802 = $tot2802ec+$tot2802ut;

$tot2803ec=21;
$tot2803ut=22;
$tot2803 = $tot2803ec+$tot2803ut;





$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os2802";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot2802ut = $tot2802ut * $cant;
$tot2802ec = $tot2802ec * $cant;

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

    if($obj->limpieza_interior != ""){
        $limpieza_interior =  json_decode($obj->limpieza_interior);
    
        $cant = COUNT($limpieza_interior);
    
        for($i=0; $i<$cant;$i++){
            if($limpieza_interior[$i]->nombreut != ""){
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

    if($obj->ejecucion_interior != ""){
        $ejecucion_interior =  json_decode($obj->ejecucion_interior);
    
        $cant = COUNT($ejecucion_interior);
    
        for($i=0; $i<$cant;$i++){
            if($ejecucion_interior[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->liberacion_interior != ""){
        $liberacion_interior =  json_decode($obj->liberacion_interior);
    
        $cant = COUNT($liberacion_interior);
    
        for($i=0; $i<$cant;$i++){
            if($liberacion_interior[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->mantenimiento != ""){
        $mantenimiento =  json_decode($obj->mantenimiento);

        $cant = COUNT($mantenimiento);
    
        for($i=0; $i<$cant;$i++){

            if($mantenimiento[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($mantenimiento[$i]->nombreec != ""){
                $sumfirmaec++;
            }

        }
    }    


    if($obj->liberacion_partes != ""){
        $liberacion_partes =  json_decode($obj->liberacion_partes);
    
        $cant = COUNT($liberacion_partes);
    
        for($i=0; $i<$cant;$i++){
            if($liberacion_partes[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($liberacion_partes[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }
            
            if($liberacion_partes[$i]->nombreec != ""){
                $sumfirmaec++;
            }

             
        }
    
    }

    if($obj->liberacion_partes_cima != ""){
        $liberacion_partes_cima =  json_decode($obj->liberacion_partes_cima);
    
        $cant = COUNT($liberacion_partes_cima);
    
        for($i=0; $i<$cant;$i++){
            if($liberacion_partes_cima[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($liberacion_partes_cima[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }
            
            if($liberacion_partes_cima[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->liberacion_partes_platos != ""){
        $liberacion_partes_platos =  json_decode($obj->liberacion_partes_platos);
    
        $cant = COUNT($liberacion_partes_platos);
    
        for($i=0; $i<$cant;$i++){
            if($liberacion_partes_platos[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($liberacion_partes_platos[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }
            
            if($liberacion_partes_platos[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->prueba_pesa != ""){
        $prueba_pesa =  json_decode($obj->prueba_pesa);
    
        $cant = COUNT($prueba_pesa);
    
        for($i=0; $i<$cant;$i++){
            if($prueba_pesa[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($prueba_pesa[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }
            
            if($prueba_pesa[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->cambio_boquilla != ""){
        $cambio_boquilla =  json_decode($obj->cambio_boquilla);
    
        $cant = COUNT($cambio_boquilla);
    
        for($i=0; $i<$cant;$i++){
            if($cambio_boquilla[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($cambio_boquilla[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }
            
            if($cambio_boquilla[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }
 

    if($obj->cierre_manhol1 != ""){
        $cierre_manhol1 =  json_decode($obj->cierre_manhol1);
    
        $cant = COUNT($cierre_manhol1);
    
        for($i=0; $i<$cant;$i++){
            if($cierre_manhol1[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            
            if($cierre_manhol1[$i]->nombreec != ""){
                $sumfirmaec++;
            }

            if($cierre_manhol1[$i]->nombreec2 != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->cierre_manhol2 != ""){
        $cierre_manhol2 =  json_decode($obj->cierre_manhol2);
    
        $cant = COUNT($cierre_manhol2);
    
        for($i=0; $i<$cant;$i++){
            if($cierre_manhol2[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($cierre_manhol2[$i]->nombreec != ""){
                $sumfirmaec++;
            }

            if($cierre_manhol2[$i]->nombreec2 != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->cierre_manhol3 != ""){
        $cierre_manhol3 =  json_decode($obj->cierre_manhol3);
    
        $cant = COUNT($cierre_manhol3);
    
        for($i=0; $i<$cant;$i++){
            if($cierre_manhol3[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($cierre_manhol3[$i]->nombreec != ""){
                $sumfirmaec++;
            }

            if($cierre_manhol3[$i]->nombreec2 != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->cierre_manhol4 != ""){
        $cierre_manhol4 =  json_decode($obj->cierre_manhol4);
    
        $cant = COUNT($cierre_manhol4);
    
        for($i=0; $i<$cant;$i++){
            if($cierre_manhol4[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($cierre_manhol4[$i]->nombreec != ""){
                $sumfirmaec++;
            }

            if($cierre_manhol4[$i]->nombreec2 != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->cierre_manhol5 != ""){
        $cierre_manhol5 =  json_decode($obj->cierre_manhol5);
    
        $cant = COUNT($cierre_manhol5);
    
        for($i=0; $i<$cant;$i++){
            if($cierre_manhol5[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($cierre_manhol5[$i]->nombreec != ""){
                $sumfirmaec++;
            }

            if($cierre_manhol5[$i]->nombreec2 != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

  

    if($obj->torque != ""){
        $torque =  json_decode($obj->torque);

        $cant = COUNT($torque);
    
        for($i=0; $i<$cant;$i++){

            if($torque[$i]->nombreut != ""){
                $sumfirmaut++;
            }
            if($torque[$i]->nombreec != ""){
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



$cons = "SELECT * FROM os2803";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttorres += $cant;

$tot2803ut = $tot2803ut * $cant;
$tot2803ec = $tot2803ec * $cant;

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

    if($obj->limpieza_interior != ""){
        $limpieza_interior =  json_decode($obj->limpieza_interior);
    
        $cant = COUNT($limpieza_interior);
    
        for($i=0; $i<$cant;$i++){
            if($limpieza_interior[$i]->nombreut != ""){
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

    if($obj->ejecucion_interior != ""){
        $ejecucion_interior =  json_decode($obj->ejecucion_interior);
    
        $cant = COUNT($ejecucion_interior);
    
        for($i=0; $i<$cant;$i++){
            if($ejecucion_interior[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->liberacion_interior != ""){
        $liberacion_interior =  json_decode($obj->liberacion_interior);
    
        $cant = COUNT($liberacion_interior);
    
        for($i=0; $i<$cant;$i++){
            if($liberacion_interior[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->mantenimiento != ""){
        $mantenimiento =  json_decode($obj->mantenimiento);

        $cant = COUNT($mantenimiento);
    
        for($i=0; $i<$cant;$i++){

            if($mantenimiento[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($mantenimiento[$i]->nombreec != ""){
                $sumfirmaec++;
            }

        }
    }    


    if($obj->liberacion_partes != ""){
        $liberacion_partes =  json_decode($obj->liberacion_partes);
    
        $cant = COUNT($liberacion_partes);
    
        for($i=0; $i<$cant;$i++){
            if($liberacion_partes[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($liberacion_partes[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }
            
            if($liberacion_partes[$i]->nombreec != ""){
                $sumfirmaec++;
            }

             
        }
    
    }

    if($obj->prueba_pesa != ""){
        $prueba_pesa =  json_decode($obj->prueba_pesa);
    
        $cant = COUNT($prueba_pesa);
    
        for($i=0; $i<$cant;$i++){
            if($prueba_pesa[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($prueba_pesa[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }
            
            if($prueba_pesa[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }
 

    if($obj->cierre_manhol1 != ""){
        $cierre_manhol1 =  json_decode($obj->cierre_manhol1);
    
        $cant = COUNT($cierre_manhol1);
    
        for($i=0; $i<$cant;$i++){
            if($cierre_manhol1[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($cierre_manhol1[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }
            
            if($cierre_manhol1[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

    if($obj->cierre_manhol2 != ""){
        $cierre_manhol2 =  json_decode($obj->cierre_manhol2);
    
        $cant = COUNT($cierre_manhol2);
    
        for($i=0; $i<$cant;$i++){
            if($cierre_manhol2[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($cierre_manhol2[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }
            
            if($cierre_manhol2[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }
    
    }

  

    if($obj->torque != ""){
        $torque =  json_decode($obj->torque);

        $cant = COUNT($torque);
    
        for($i=0; $i<$cant;$i++){

            if($torque[$i]->nombreut != ""){
                $sumfirmaut++;
            }
            if($torque[$i]->nombreec != ""){
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

$totaltorresec = $tot2802ec+$tot2803ec;
$totaltorresut = $tot2802ut+$tot2803ut;


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
