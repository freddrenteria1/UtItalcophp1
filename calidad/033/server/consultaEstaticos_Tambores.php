<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

//consulta tambores
$totalecp = 9;
$totalut = 10;

$cons = "SELECT * FROM os80";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantintercambiadores = $cant;

$totalinter = $totalinter * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os80";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

// $totalecp = $totalecp * $cant;
// $totalut = $totalut * $cant;

$cons3 = "SELECT * FROM os80";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirma = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os80 WHERE tag = '$tag'";
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
        
        if($obj->limpieza != ""){
            $limpieza =  json_decode($obj->limpieza);
            if($limpieza[0]->nombreut != ""){
                $limpsup='OK';
                $sumfirma++;
            }else{
                $limpsup='PTE';
            }
        }else{
            $limpsup='PTE';
        }
       
            
        if($obj->ejecucion != ""){
            $ejecucion =  json_decode($obj->ejecucion);
            if($ejecucion[0]->nombreec != ""){
                $inspec='OK';
                $sumfirma++;
            }else{
                $inspec='PTE';
            }
        }else{
            $inspec='PTE';
        }
   
    
        if($obj->liberacion_int != ""){
            $liberacion_int =  json_decode($obj->liberacion_int);
             
            if($liberacion_int[0]->nombreutsup != ""){
                $libintsup='OK';
                $sumfirma++;
            }else{
                $libintsup='PTE';
            }
            if($liberacion_int[0]->nombreutqaqc != ""){
                $libintqaqc='OK';
                $sumfirma++;
            }else{
                $libintqaqc='PTE';
            }
            
            if($liberacion_int[0]->nombreec != ""){
                $libintec='OK';
                $sumfirma++;
            }else{
                $libintec='PTE';
            }

            if($liberacion_int[0]->nombreec2 != ""){
                $libintecing='OK';
                $sumfirma++;
            }else{
                $libintecing='PTE';
            }
            
        
        }else{
            $libintsup='PTE';
            $libintqaqc='PTE';
            $libintec='PTE';
            $libintecing='PTE';
        }

        if($obj->liberacion_casco != ""){
            $liberacion_casco =  json_decode($obj->liberacion_casco);
             
            if($liberacion_casco[0]->nombreutsup != ""){
                $libcascosup='OK';
                $sumfirma++;
            }else{
                $libcascosup='PTE';
            }
            if($liberacion_casco[0]->nombreutqaqc != ""){
                $libcascoqaqc='OK';
                $sumfirma++;
            }else{
                $libcascoqaqc='PTE';
            }
            
            if($liberacion_casco[0]->nombreec != ""){
                $libcascoec='OK';
                $sumfirma++;
            }else{
                $libcascoec='PTE';
            }

        
        }else{
            $libcascosup='PTE';
            $libcascoqaqc='PTE';
            $libcascoec='PTE';
             
        }

        

        if($obj->cierre != ""){
            $cierre =  json_decode($obj->cierre);
            if($cierre[0]->nombreut != ""){
                $cierresup = 'OK';
                $sumfirma++;
            }else{
                $cierresup = 'PTE';
            }
            if($cierre[0]->nombreec != ""){
                $cierreopec='OK';
                $sumfirma++;
            }else{
                $cierreopec='PTE';
            }
        }else{
            $cierresup = 'PTE';
            $cierreopec='PTE';
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

    $tagstambores[] = array(
        'tag'=>$tag,
        'permisosup'=>$permisosup,
        'permisoope'=>$permisoope,
        'limpsup'=>$limpsup,
        'inspec'=>$inspec,
        'libintsup'=>$libintsup,
        'libintqaqc'=>$libintqaqc,
        'libintec'=>$libintec,
        'libintecing'=>$libintecing,
        'libcascosup'=>$libcascosup,
        'libcascoqaqc'=>$libcascoqaqc,
        'libcascoec'=>$libcascoec,
        'cierresup'=>$cierresup,
        'cierreopec'=>$cierreopec,
        'termsup'=>$termsup,
        'termgestor'=>$termgestor,
        'pintseup'=>$pintseup,
        'pintgestor'=>$pintgestor,
        'entsup'=>$entsup,
        'entope'=>$entope,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirma,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirma)
    );

}

$datos = array(
    'tambores'=>$tagstambores
);

echo json_encode($datos);