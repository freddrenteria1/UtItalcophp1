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

$tot2802ec=32;
$tot2802ut=31;
$tot2802 = $tot2802ec+$tot2802ut;

$tot2803ec=21;
$tot2803ut=22;
$tot2803 = $tot2803ec+$tot2803ut;


$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os2802";
$ejec3 = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec3);

$canttorres += $cant;

$tot2802ut = $tot2802ut * $cant;
$tot2802ec = $tot2802ec * $cant;

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;

    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2802 WHERE tag = '$tag'";
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
    
        if($obj->sello_tapa != ""){
            $sello_tapa =  json_decode($obj->sello_tapa);
        
            $cant = COUNT($sello_tapa);
        
            for($i=0; $i<$cant;$i++){
                if($sello_tapa[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($sello_tapa[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($sello_tapa[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
               
            }
        
        }
    
    
        if($obj->ver_malla != ""){
            $ver_malla =  json_decode($obj->ver_malla);
        
            $cant = COUNT($ver_malla);
        
            for($i=0; $i<$cant;$i++){
                if($ver_malla[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($ver_malla[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($ver_malla[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
    
                if($ver_malla[$i]->nombreec2 != ""){
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

    $tagstorres[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$tot2802ut,
        'totalfirmasecpplan'=>$tot2802ec,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$tot2802ut + $tot2802ec,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($tot2802ut + $tot2802ec)-($sumfirmaut+$sumfirmaec)
    );


}

$cons = "SELECT * FROM os2803";
$ejec3 = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec3);

$canttorres += $cant;

$tot2803ut = $tot2803ut * $cant;
$tot2803ec = $tot2803ec * $cant;

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2803 WHERE tag = '$tag'";
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

    $tagstorres[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$tot2803ut,
        'totalfirmasecpplan'=>$tot2803ec,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$tot2803ut + $tot2803ec,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($tot2803ut + $tot2803ec)-($sumfirmaut+$sumfirmaec)
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

//consulta HORNOS
$totalhornoecp = 18;
$totalhornout = 27;

$cons = "SELECT * FROM os2804";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);
$canttambores = $cant;

$totalhornoecp = $totalhornoecp * $cant;
$totalhornout = $totalhornout * $cant;

$cons3 = "SELECT * FROM os2804";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2804 WHERE tag = '$tag'";
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

    $tagshornos[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalhornout,
        'totalfirmasecpplan'=>$totalhornoecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalhornout + $totalhornoecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalhornout + $totalhornoecp)-($sumfirmaut+$sumfirmaec)
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
    'hornos'=>$tagshornos,
    'lgs'=>$tagslgs,
    'valvulas'=>$tagsvalvulas,
    'eyectores'=>$tagseyectores
);

echo json_encode($datos);
