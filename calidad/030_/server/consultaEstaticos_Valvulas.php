<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

//consulta valvulas
$totalecp = 5;
$totalut = 5;

$cons = "SELECT * FROM os02";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantintercambiadores = $cant;

$totalinter = $totalinter * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os02";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

// $totalecp = $totalecp * $cant;
// $totalut = $totalut * $cant;

$cons3 = "SELECT * FROM os02";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirma = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os02 WHERE tag = '$tag'";
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
         
     
        if($obj->mantenimiento != ""){
            $mantenimiento =  json_decode($obj->mantenimiento);
            if($mantenimiento[0]->nombreut != ""){
                $mtosup = 'OK';
                $sumfirma++;
            }else{
                $mtosup = 'PTE';
            }
            if($mantenimiento[0]->nombreec != ""){
                $mtoec='OK';
                $sumfirma++;
            }else{
                $mtoec='PTE';
            }
        }else{
            $mtosup = 'PTE';
            $mtoec='PTE';
        }

        if($obj->retiro != ""){
            $retiro =  json_decode($obj->retiro);
            if($retiro[0]->nombreut != ""){
                $retirosup = 'OK';
                $sumfirma++;
            }else{
                $retirosup = 'PTE';
            }
            if($retiro[0]->nombreec != ""){
                $retiroec='OK';
                $sumfirma++;
            }else{
                $retiroec='PTE';
            }
        }else{
            $retirosup = 'PTE';
            $retiroec='PTE';
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

    $tagsvalvulas[] = array(
        'tag'=>$tag,
        'permisosup'=>$permisosup,
        'permisoope'=>$permisoope,
        'mtosup'=>$mtosup,
        'mtoec'=>$mtoec,
        'retirosup'=>$retirosup,
        'retiroec'=>$retiroec,
        'termsup'=>$termsup,
        'termgestor'=>$termgestor,
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
    'valvulas'=>$tagsvalvulas
);

echo json_encode($datos);