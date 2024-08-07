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
    $sumfirma = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os38 WHERE tag = '$tag'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->permiso != ""){
            $permiso =  json_decode($obj->permiso);
            if($permiso[0]->nombreut != ""){
                $permisosup='OK';
                $sumfirma++;
            }else{
                $permisosup='PTE';
            }
            if($permiso[0]->nombreec != ""){
                $permisoope='OK';
                $sumfirma++;
            }else{
                $permisoope='PTE';
            }
        }else{
            $permisosup='PTE';
            $permisoope='PTE';
        }
        
        if($obj->limp_partes != ""){
            $limp_partes =  json_decode($obj->limp_partes);
            if($limp_partes[0]->nombreut != ""){
                $limppartessup='OK';
                $sumfirma++;
            }else{
                $limppartessup='PTE';
            }
        }else{
            $limppartessup='PTE';
        }
    
        if($obj->limp_haz_tubos != ""){
            $limp_haz_tubos =  json_decode($obj->limp_haz_tubos);
            if($limp_haz_tubos[0]->nombreut != ""){
                $limphazsup='OK';
                $sumfirma++;
            }else{
                $limphazsup='PTE';
            }
        }else{
            $limphazsup='PTE';
        }
    
        if($obj->insp_partes != ""){
            $insp_partes =  json_decode($obj->insp_partes);
            if($insp_partes[0]->nombreec != ""){
                $insppartesec='OK';
                $sumfirma++;
            }else{
                $insppartesec='PTE';
            }
        }else{
            $insppartesec='PTE';
        }
    
        if($obj->insp_haz_tubos != ""){
            $insp_haz_tubos =  json_decode($obj->insp_haz_tubos);
            if($insp_haz_tubos[0]->nombreec != ""){
                $insphazec='OK';
                $sumfirma++;
            }else{
                $insphazec='PTE';
            }
        }else{
            $insphazec='PTE';
        }
    
        if($obj->lib_partes != ""){
            $lib_partes =  json_decode($obj->lib_partes);
        
            $cant = COUNT($lib_partes);
        
            for($i=0; $i<$cant;$i++){
                if($lib_partes[$i]->nombreutsup != ""){
                    $libcompsup='OK';
                    $sumfirma++;
                }else{
                    $libcompsup='PTE';
                }
                if($lib_partes[$i]->nombreutqaqc != ""){
                    $libcompqaqc='OK';
                    $sumfirma++;
                }else{
                    $libcompqaqc='PTE';
                }
                
                if($lib_partes[$i]->nombreec != ""){
                    $libcompec='OK';
                    $sumfirma++;
                }else{
                    $libcompec='PTE';
                }
            }
        
        }else{
            $libcompsup='PTE';
            $libcompqaqc='PTE';
            $libcompec='PTE';
        }
    
        if($obj->lib_haz_tubos != ""){
            $lib_haz_tubos =  json_decode($obj->lib_haz_tubos);
        
            $cant = COUNT($lib_haz_tubos);
        
            for($i=0; $i<$cant;$i++){
                if($lib_haz_tubos[$i]->nombreutsup != ""){
                    $libhazsup='OK';
                    $sumfirma++;
                }else{
                    $libhazsup='PTE';
                }
                if($lib_haz_tubos[$i]->nombreutqaqc != ""){
                    $libhazqaqc='OK';
                    $sumfirma++;
                }else{
                    $libhazqaqc='PTE';
                }
                
                if($lib_haz_tubos[$i]->nombreec != ""){
                    $libhazec='OK';
                    $sumfirma++;
                }else{
                    $libhazec='PTE';
                }
            }
        
        }else{
            $libhazsup='PTE';
            $libhazqaqc='PTE';
            $libhazec='PTE';
        }
    
        if($obj->prueba != ""){
            $prueba =  json_decode($obj->prueba);
            if($prueba[0]->nombreectubo != ""){
                $pruebatuboec='OK';
                $sumfirma++;
            }else{
                $pruebatuboec='PTE';
            }

            if($prueba[0]->nombreutsuptubo != ""){
                $pruebatubout='OK';
            }else{
                $pruebatubout='PTE';
            }

            if($prueba[0]->nombreeccasco != ""){
                $pruebacascoec='OK';
                $sumfirma++;
            }else{
                $pruebacascoec='PTE';
            }

            if($prueba[0]->nombreutsupcasco != ""){
                $pruebacascout='OK';
            }else{
                $pruebacascout='PTE';
            }
            
        }else{
            $pruebatuboec='PTE';
            $pruebatubout='PTE';
            $pruebacascoec='PTE';
            $pruebacascout='PTE';
        }   
    
        if($obj->terminacion != ""){
            $terminacion =  json_decode($obj->terminacion);
            if($terminacion[0]->nombreut != ""){
                $termsup = 'OK';
                $sumfirma++;
            }else{
                $termsup = 'PTE';
            }
            if($terminacion[0]->nombreec != ""){
                $termgestor='OK';
                $sumfirma++;
            }else{
                $termgestor='PTE';
            }
        }else{
            $termsup = 'PTE';
            $termgestor='PTE';
        }
    
        if($obj->pintura != ""){
            $pintura =  json_decode($obj->pintura);
            if($pintura[0]->nombreut != ""){
                $pintseup='OK';
                $sumfirma++;
            }else{
                $pintseup='PTE';
            }
            if($pintura[0]->nombreec != ""){
                $pintgestor='OK';
                $sumfirma++;
            }else{
                $pintgestor='PTE';
            }
        }else{
            $pintseup='PTE';
            $pintgestor='PTE';
        }
    
        if($obj->entrega != ""){
            $entrega =  json_decode($obj->entrega);
            if($entrega[0]->nombreut != ""){
                $entsup='OK';
                $sumfirma++;
            }else{
                $entsup='PTE';
            }
            if($entrega[0]->nombreec != ""){
                $entope='OK';
                $sumfirma++;
            }else{
                $entope='PTE';
            }
        }else{
            $entsup='PTE';
            $entope='PTE';
        }
    
    }

    $tagsinter[] = array(
        'tag'=>$tag,
        'permisosup'=>$permisosup,
        'permisoope'=>$permisoope,
        'limppartessup'=>$limppartessup,
        'limphazsup'=>$limphazsup,
        'insppartesec'=>$insppartesec,
        'insphazec'=>$insphazec,
        'libcompsup'=>$libcompsup,
        'libcompqaqc'=>$libcompqaqc,
        'libcompec'=>$libcompec,
        'libhazsup'=>$libhazsup,
        'libhazqaqc'=>$libhazqaqc,
        'libhazec'=>$libhazec,
        'pruebatuboec'=>$pruebatuboec,
        'pruebatubout'=>$pruebatubout,
        'pruebacascoec'=>$pruebacascoec,
        'pruebacascout'=>$pruebacascout,
        'termsup'=>$termsup,
        'termgestor'=>$termgestor,
        'pintseup'=>$pintseup,
        'pintgestor'=>$pintgestor,
        'entsup'=>$entsup,
        'entope'=>$entope,
        'totalfirmasutplan'=>$totalinterut1,
        'totalfirmasecpplan'=>$totalinterecp1,
        'totalfirmasplan'=>$totalinterut1 + $totalinterecp1,
        'totalfirmaseje'=>$sumfirma,
        'firmasfaltantes'=>($totalinterut1 + $totalinterecp1)-($sumfirma)
    );

}

$datos = array(
    'intercambiadores'=>$tagsinter
);

echo json_encode($datos);