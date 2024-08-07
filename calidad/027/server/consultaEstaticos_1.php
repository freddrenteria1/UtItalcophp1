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
            if($prueba[0]->nombreeccasco != ""){
                $sumfirmaec++;
            }
            if($prueba[0]->nombreectubo != ""){
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

 
$tot24ec1=31;
$tot24ut1=39;

$tot24 = $tot24ec1+$tot24ut1;

 
$tot25ec1=27;
$tot25ut1=37;
$tot25 = $tot25ec1+$tot25ut1;



$sumfirmaut = 0;
$sumfirmaec = 0;

$cons3 = "SELECT * FROM os2702";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2702";
    $ejec = mysqli_query($conexion, $cons);
    $cant = mysqli_num_rows($ejec);

    $canttorres += $cant;

    $tot24ut = $tot24ut * $cant;
    $tot24ec = $tot24ec * $cant;

    $cons = "SELECT * FROM os2702 WHERE tag = '$tag'";
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
        
    
        if($obj->limpieza != ""){
            $limpieza =  json_decode($obj->limpieza);
        
            $cant = COUNT($limpieza);
        
            for($i=0; $i<$cant;$i++){
                if($limpieza[$i]->nombreut != ""){
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
    
        if($obj->libext != ""){
            $libext =  json_decode($obj->libext);
        
            $cant = COUNT($libext);
        
            for($i=0; $i<$cant;$i++){
                if($libext[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
               
            }
        
        }
    
        if($obj->libext != ""){
            $libext =  json_decode($obj->libext);
        
            $cant = COUNT($libext);
        
            for($i=0; $i<$cant;$i++){
                if($libext[$i]->nombreutq != ""){
                    $sumfirmaut++;
                }
               
            }
        
        }
    
        if($obj->libext != ""){
            $libext =  json_decode($obj->libext);
        
            $cant = COUNT($libext);
        
            for($i=0; $i<$cant;$i++){
                if($libext[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
               
            }
        
        }
    
        if($obj->libzonas != ""){
            $libzonas =  json_decode($obj->libzonas);
        
            $cant = COUNT($libzonas);
        
            for($i=0; $i<$cant;$i++){
                if($libzonas[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
               
            }
        
        }
    
        if($obj->libzonas != ""){
            $libzonas =  json_decode($obj->libzonas);
        
            $cant = COUNT($libzonas);
        
            for($i=0; $i<$cant;$i++){
                if($libzonas[$i]->nombreutq != ""){
                    $sumfirmaut++;
                }
               
            }
        
        }
    
        if($obj->libzonas != ""){
            $libzonas =  json_decode($obj->libzonas);
        
            $cant = COUNT($libzonas);
        
            for($i=0; $i<$cant;$i++){
                if($libzonas[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
               
            }
        
        }
    
        if($obj->libzonas != ""){
            $libzonas =  json_decode($obj->libzonas);
        
            $cant = COUNT($libzonas);
        
            for($i=0; $i<$cant;$i++){
                if($libzonas[$i]->nombreec2 != ""){
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
               
            }
        }
        
    
        if($obj->cierre != ""){
            $cierre =  json_decode($obj->cierre);
        
            $cant = COUNT($cierre);
        
            for($i=0; $i<$cant;$i++){
                if($cierre[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
                
            }
        
        }
    
        if($obj->terminacion != ""){
            $terminacion =  json_decode($obj->terminacion);
        
            $cant = COUNT($terminacion);
        
            for($i=0; $i<$cant;$i++){
                if($terminacion[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
               
            }
        }
        
    
        if($obj->terminacion != ""){
            $terminacion =  json_decode($obj->terminacion);
        
            $cant = COUNT($terminacion);
        
            for($i=0; $i<$cant;$i++){
                if($terminacion[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
                
            }
        
        }
    
        if($obj->pintura != ""){
            $pintura =  json_decode($obj->pintura);
        
            $cant = COUNT($pintura);
        
            for($i=0; $i<$cant;$i++){
                if($pintura[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
               
            }
        }
        
    
        if($obj->pintura != ""){
            $pintura =  json_decode($obj->pintura);
        
            $cant = COUNT($pintura);
        
            for($i=0; $i<$cant;$i++){
                if($pintura[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
                
            }
        
        }
    
        if($obj->entrega != ""){
            $entrega =  json_decode($obj->entrega);
        
            $cant = COUNT($entrega);
        
            for($i=0; $i<$cant;$i++){
                if($entrega[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
               
            }
        }
        
    
        if($obj->entrega != ""){
            $entrega =  json_decode($obj->entrega);
        
            $cant = COUNT($entrega);
        
            for($i=0; $i<$cant;$i++){
                if($entrega[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
                
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

$cons = "SELECT * FROM os2703";
    $ejec = mysqli_query($conexion, $cons);
    $cant = mysqli_num_rows($ejec);

    $canttorres += $cant;

    $tot25ut = $tot25ut * $cant;
    $tot25ec = $tot25ec * $cant;

$cons3 = "SELECT * FROM os2703";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons = "SELECT * FROM os2703 WHERE tag = '$tag'";
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
        
    
        if($obj->limpieza != ""){
            $limpieza =  json_decode($obj->limpieza);
        
            $cant = COUNT($limpieza);
        
            for($i=0; $i<$cant;$i++){
                if($limpieza[$i]->nombreut != ""){
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
    
        if($obj->libext != ""){
            $libext =  json_decode($obj->libext);
        
            $cant = COUNT($libext);
        
            for($i=0; $i<$cant;$i++){
                if($libext[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
               
            }
        
        }
    
        if($obj->libext != ""){
            $libext =  json_decode($obj->libext);
        
            $cant = COUNT($libext);
        
            for($i=0; $i<$cant;$i++){
                if($libext[$i]->nombreutq != ""){
                    $sumfirmaut++;
                }
               
            }
        
        }
    
        if($obj->libext != ""){
            $libext =  json_decode($obj->libext);
        
            $cant = COUNT($libext);
        
            for($i=0; $i<$cant;$i++){
                if($libext[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
               
            }
        
        }
    
        if($obj->libzonas != ""){
            $libzonas =  json_decode($obj->libzonas);
        
            $cant = COUNT($libzonas);
        
            for($i=0; $i<$cant;$i++){
                if($libzonas[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
               
            }
        
        }
    
        if($obj->libzonas != ""){
            $libzonas =  json_decode($obj->libzonas);
        
            $cant = COUNT($libzonas);
        
            for($i=0; $i<$cant;$i++){
                if($libzonas[$i]->nombreutq != ""){
                    $sumfirmaut++;
                }
               
            }
        
        }
    
        if($obj->libzonas != ""){
            $libzonas =  json_decode($obj->libzonas);
        
            $cant = COUNT($libzonas);
        
            for($i=0; $i<$cant;$i++){
                if($libzonas[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
               
            }
        
        }
    
        if($obj->libzonas != ""){
            $libzonas =  json_decode($obj->libzonas);
        
            $cant = COUNT($libzonas);
        
            for($i=0; $i<$cant;$i++){
                if($libzonas[$i]->nombreec2 != ""){
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
               
            }
        }
        
    
        if($obj->cierre != ""){
            $cierre =  json_decode($obj->cierre);
        
            $cant = COUNT($cierre);
        
            for($i=0; $i<$cant;$i++){
                if($cierre[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
                
            }
        
        }
    
        if($obj->terminacion != ""){
            $terminacion =  json_decode($obj->terminacion);
        
            $cant = COUNT($terminacion);
        
            for($i=0; $i<$cant;$i++){
                if($terminacion[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
               
            }
        }
        
    
        if($obj->terminacion != ""){
            $terminacion =  json_decode($obj->terminacion);
        
            $cant = COUNT($terminacion);
        
            for($i=0; $i<$cant;$i++){
                if($terminacion[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
                
            }
        
        }
    
        if($obj->pintura != ""){
            $pintura =  json_decode($obj->pintura);
        
            $cant = COUNT($pintura);
        
            for($i=0; $i<$cant;$i++){
                if($pintura[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
               
            }
        }
        
    
        if($obj->pintura != ""){
            $pintura =  json_decode($obj->pintura);
        
            $cant = COUNT($pintura);
        
            for($i=0; $i<$cant;$i++){
                if($pintura[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
                
            }
        
        }
    
        if($obj->entrega != ""){
            $entrega =  json_decode($obj->entrega);
        
            $cant = COUNT($entrega);
        
            for($i=0; $i<$cant;$i++){
                if($entrega[$i]->nombreut != ""){
                    $sumfirmaut++;
                }
               
            }
        }
        
    
        if($obj->entrega != ""){
            $entrega =  json_decode($obj->entrega);
        
            $cant = COUNT($entrega);
        
            for($i=0; $i<$cant;$i++){
                if($entrega[$i]->nombreec != ""){
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
               
            }
        }
        
    
        if($obj->prueba != ""){
            $prueba =  json_decode($obj->prueba);
        
            $cant = COUNT($prueba);
        
            for($i=0; $i<$cant;$i++){
                if($prueba[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
                
            }
        
        }
    
    
        
    
    }

    $sumfirmaec--;


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
    
                if($liberacion_casco[$i]->nombreec2 != ""){
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
