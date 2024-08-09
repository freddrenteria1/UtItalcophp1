<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

//consulta intercambiadores os38
$totalecp = 16;
$totalut = 10;

$cons = "SELECT * FROM os103";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantintercambiadores = $cant;

$totalinter = $totalinter * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;


$cons3 = "SELECT * FROM os103";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirma = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os103 WHERE tag = '$tag'";
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
        
        if($obj->limpz1 != ""){
            $limpz1 =  json_decode($obj->limpz1);
            if($limpz1[0]->nombreut != ""){
                $limpz1sup='OK';
                $sumfirma++;
            }else{
                $limpz1sup='PTE';
            }
        }else{
            $limpz1sup='PTE';
        }

        if($obj->limpz2 != ""){
            $limpz2 =  json_decode($obj->limpz2);
            if($limpz2[0]->nombreut != ""){
                $limpz2sup='OK';
                $sumfirma++;
            }else{
                $limpz2sup='PTE';
            }
        }else{
            $limpz2sup='PTE';
        }

        if($obj->limpz3 != ""){
            $limpz3 =  json_decode($obj->limpz3);
            if($limpz3[0]->nombreut != ""){
                $limpz3sup='OK';
                $sumfirma++;
            }else{
                $limpz3sup='PTE';
            }
        }else{
            $limpz3sup='PTE';
        }
    
            
        if($obj->eje_zona1 != ""){
            $eje_zona1 =  json_decode($obj->eje_zona1);
            if($eje_zona1[0]->nombreec != ""){
                $inspz1inspec='OK';
                $sumfirma++;
            }else{
                $inspz1inspec='PTE';
            }
        }else{
            $inspz1inspec='PTE';
        }

        if($obj->eje_zona2 != ""){
            $eje_zona2 =  json_decode($obj->eje_zona2);
            if($eje_zona2[0]->nombreec != ""){
                $inspz2inspec='OK';
                $sumfirma++;
            }else{
                $inspz2inspec='PTE';
            }
        }else{
            $inspz2inspec='PTE';
        }

        if($obj->eje_zona3 != ""){
            $eje_zona3 =  json_decode($obj->eje_zona3);
            if($eje_zona3[0]->nombreec != ""){
                $inspz3inspec='OK';
                $sumfirma++;
            }else{
                $inspz3inspec='PTE';
            }
        }else{
            $inspz3inspec='PTE';
        }
    
    
        if($obj->liberacion != ""){
            $liberacion =  json_decode($obj->liberacion);
             
            if($liberacion[0]->nombreutsup != ""){
                $libcompsup='OK';
                $sumfirma++;
            }else{
                $libcompsup='PTE';
            }
            if($liberacion[0]->nombreutqaqc != ""){
                $libcompqaqc='OK';
                $sumfirma++;
            }else{
                $libcompqaqc='PTE';
            }
            
            if($liberacion[0]->nombreec != ""){
                $libcompec='OK';
                $sumfirma++;
            }else{
                $libcompec='PTE';
            }

            if($liberacion[0]->nombreec2 != ""){
                $libqec='OK';
                $sumfirma++;
            }else{
                $libqec='PTE';
            }
            
        
        }else{
            $libcompsup='PTE';
            $libcompqaqc='PTE';
            $libcompec='PTE';
            $libqec='PTE';
        }

        
        if($obj->prueba_zona1 != ""){
            $prueba_zona1 =  json_decode($obj->prueba_zona1);
            if($prueba_zona1[0]->superpz1 != ""){
                $superpz1='OK';
            }else{
                $superpz1='PTE';
            }
            if($prueba_zona1[0]->nombreec != ""){
                $pruebaZ1gestor='OK';
                $sumfirma++;
            }else{
                $pruebaZ1gestor='PTE';
            }
        }else{
            $superpz1='PTE';
            $pruebaZ1gestor='PTE';
        }
        
        if($obj->prueba_zona2 != ""){
            $prueba_zona2 =  json_decode($obj->prueba_zona2);
            if($prueba_zona2[0]->superpz2 != ""){
                $superpz2='OK';
            }else{
                $superpz2='PTE';
            }
            if($prueba_zona2[0]->nombreec != ""){
                $pruebaZ2gestor='OK';
                $sumfirma++;
            }else{
                $pruebaZ2gestor='PTE';
            }
        }else{
            $superpz2='PTE';
            $pruebaZ2gestor='PTE';
        }

        if($obj->prueba_zona3 != ""){
            $prueba_zona3 =  json_decode($obj->prueba_zona3);
            if($prueba_zona3[0]->superpz3 != ""){
                $superpz3='OK';
            }else{
                $superpz3='PTE';
            }
            if($prueba_zona3[0]->nombreec != ""){
                $pruebaZ3gestor='OK';
                $sumfirma++;
            }else{
                $pruebaZ3gestor='PTE';
            }
        }else{
            $superpz3='PTE';
            $pruebaZ3gestor='PTE';
        }

        if($obj->prueba_zona4 != ""){
            $prueba_zona4 =  json_decode($obj->prueba_zona4);
            if($prueba_zona4[0]->superpz4 != ""){
                $superpz4='OK';
            }else{
                $superpz4='PTE';
            }
            if($prueba_zona4[0]->nombreec != ""){
                $pruebaZ4gestor='OK';
                $sumfirma++;
            }else{
                $pruebaZ4gestor='PTE';
            }
        }else{
            $superpz4='PTE';
            $pruebaZ4gestor='PTE';
        }

        if($obj->prueba_zona5 != ""){
            $prueba_zona5 =  json_decode($obj->prueba_zona5);
            if($prueba_zona5[0]->superpz5 != ""){
                $superpz5='OK';
            }else{
                $superpz5='PTE';
            }
            if($prueba_zona5[0]->nombreec != ""){
                $pruebaZ5gestor='OK';
                $sumfirma++;
            }else{
                $pruebaZ5gestor='PTE';
            }
        }else{
            $superpz5='PTE';
            $pruebaZ5gestor='PTE';
        }

        if($obj->prueba_zona6 != ""){
            $prueba_zona6 =  json_decode($obj->prueba_zona6);
            if($prueba_zona6[0]->superpz6 != ""){
                $superpz6='OK';
            }else{
                $superpz6='PTE';
            }
            if($prueba_zona6[0]->nombreec != ""){
                $pruebaZ6gestor='OK';
                $sumfirma++;
            }else{
                $pruebaZ6gestor='PTE';
            }
        }else{
            $superpz6='PTE';
            $pruebaZ6gestor='PTE';
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

    $tagshornos[] = array(
        'tag'=>$tag,
        'permisosup'=>$permisosup,
        'permisoope'=>$permisoope,
        'limpz1sup'=>$limpz1sup,
        'limpz2sup'=>$limpz2sup,
        'limpz3sup'=>$limpz3sup,
        'inspz1inspec'=>$inspz1inspec,
        'inspz2inspec'=>$inspz2inspec,
        'inspz3inspec'=>$inspz3inspec,
        'libcompsup'=>$libcompsup,
        'libcompqaqc'=>$libcompqaqc,
        'libcompec'=>$libcompec,
        'libqec'=>$libqec,
        'superpz1'=>$superpz1,
        'pruebaZ1gestor'=>$pruebaZ1gestor,
        'superpz2'=>$superpz2,
        'pruebaZ2gestor'=>$pruebaZ2gestor,
        'superpz3'=>$superpz3,
        'pruebaZ3gestor'=>$pruebaZ3gestor,
        'superpz4'=>$superpz4,
        'pruebaZ4gestor'=>$pruebaZ4gestor,
        'superpz5'=>$superpz5,
        'pruebaZ5gestor'=>$pruebaZ5gestor,
        'superpz6'=>$superpz6,
        'pruebaZ6gestor'=>$pruebaZ6gestor,
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
    'hornos'=>$tagshornos
);

echo json_encode($datos);