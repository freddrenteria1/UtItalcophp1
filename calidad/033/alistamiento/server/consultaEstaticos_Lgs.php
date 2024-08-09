<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

//consulta lGS
$totalecp = 2;
$totalut = 3;

$cons = "SELECT * FROM os21";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantintercambiadores = $cant;

$totalinter = $totalinter * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;


$cons3 = "SELECT * FROM os21";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirma = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os21 WHERE tag = '$tag'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->desmontaje != ""){
            $desmontaje =  json_decode($obj->desmontaje);
            if($desmontaje[0]->nombreut != ""){
                $permisosup='OK';
                $sumfirma++;
            }else{
                $permisosup='PTE';
            }
            
        }else{
            $permisosup='PTE';
        }
    
        if($obj->liberacion != ""){
            $liberacion =  json_decode($obj->liberacion);
             
            if($liberacion[0]->nombreutsup != ""){
                $libintsup='OK';
                $sumfirma++;
            }else{
                $libintsup='PTE';
            }
            if($liberacion[0]->nombreutqaqc != ""){
                $libintqaqc='OK';
                $sumfirma++;
            }else{
                $libintqaqc='PTE';
            }
            
            if($liberacion[0]->nombreec != ""){
                $libintec='OK';
                $sumfirma++;
            }else{
                $libintec='PTE';
            }

            
        
        }else{
            $libintsup='PTE';
            $libintqaqc='PTE';
            $libintec='PTE';
        }


        if($obj->prueba != ""){
            $prueba =  json_decode($obj->prueba);
            if($prueba[0]->nombreut != ""){
                $pruebasup = 'OK';
            }else{
                $pruebasup = 'PTE';
            }
            if($prueba[0]->nombreec != ""){
                $pruebagestor='OK';
                $sumfirma++;
            }else{
                $pruebagestor='PTE';
            }
        }else{
            $pruebasup = 'PTE';
            $pruebagestor='PTE';
        }
 
    
    }

    $tagslgs[] = array(
        'tag'=>$tag,
        'permisosup'=>$permisosup,
        'libintsup'=>$libintsup,
        'libintqaqc'=>$libintqaqc,
        'libintec'=>$libintec,
        'pruebasup'=>$pruebasup,
        'pruebagestor'=>$pruebagestor,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirma,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirma)
    );

}

$datos = array(
    'lgs'=>$tagslgs
);

echo json_encode($datos);