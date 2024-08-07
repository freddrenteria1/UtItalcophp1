<?php
 header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

$sql = "SELECT * FROM os2213";
$eje = mysqli_query($conexion, $sql);
$canteqc += mysqli_num_rows($eje);

$planut += 15;
$planec += 11;

while($obj = mysqli_fetch_object($eje)){

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
    
        $cant = COUNT($liberacion);
    
        for($i=0; $i<$cant;$i++){
            if($liberacion[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($liberacion[$i]->nombreutq != ""){
                $sumfirmaut++;
            }
            
            if($liberacion[$i]->nombreec != ""){
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

$sql = "SELECT * FROM os2233";
$eje = mysqli_query($conexion, $sql);
$canteqc += mysqli_num_rows($eje);

$planut += 8;
$planec += 7;

while($obj = mysqli_fetch_object($eje)){

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
    
        $cant = COUNT($liberacion);
    
        for($i=0; $i<$cant;$i++){
            if($liberacion[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($liberacion[$i]->nombreutq != ""){
                $sumfirmaut++;
            }
            
            if($liberacion[$i]->nombreec != ""){
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


//plan
$planciclonesut = $planut;
$planciclonesec = $planec;
//ejecutado
$totalciclonesut = $sumfirmaut;
$totalciclonesec = $sumfirmaec;
$cantequiposciclones = $canteqc;

$totalconvut += $totalciclonesut;
$totalconvec += $totalciclonesec;

$sumfirmaut = 0;
$sumfirmaec = 0;
$planut = 0;
$planec = 0;
$canteqc = 0;

// echo 'Cantidad de equipos ' . $cantequiposciclones;
// echo '<br>';
// echo 'Cantidad de plan ut ' . $planciclonesut;
// echo '<br>';
// echo 'Cantidad de eje tu ' . $totalciclonesut;
// echo '<br>';
// echo 'Cantidad de plan ec ' . $planciclonesec;
// echo '<br>';
// echo 'Cantidad de eje ec ' . $totalciclonesec;
// echo '<br>';


//HORNOS

$sql = "SELECT * FROM os2232";
$eje = mysqli_query($conexion, $sql);
$canteqc += mysqli_num_rows($eje);

$planut += 8;
$planec += 7;

while($obj = mysqli_fetch_object($eje)){

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
    
        $cant = COUNT($liberacion);
    
        for($i=0; $i<$cant;$i++){
            if($liberacion[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($liberacion[$i]->nombreutq != ""){
                $sumfirmaut++;
            }
            
            if($liberacion[$i]->nombreec != ""){
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

//plan
$planhornout = $planut;
$planhornoec = $planec;
//ejecutado
$totalhornout = $sumfirmaut;
$totalhornoec = $sumfirmaec;
$cantequiposhornos = $canteqc;

$sumfirmaut = 0;
$sumfirmaec = 0;
$planut = 0;
$planec = 0;
$$canteqc = 0;

// echo 'Hornos';
// echo '<br>';
// echo 'Cantidad de equipos ' . $cantequiposhornos;
// echo '<br>';
// echo 'Cantidad de plan ut ' . $planhornout;
// echo '<br>';
// echo 'Cantidad de eje tu ' . $totalhornout;
// echo '<br>';
// echo 'Cantidad de plan ec ' . $planhornoec;
// echo '<br>';
// echo 'Cantidad de eje ec ' . $totalhornoec;
// echo '<br>';

//INTERCAMBIADORES

$sql = "SELECT * FROM os2209";
$eje = mysqli_query($conexion, $sql);
$canteqc = mysqli_num_rows($eje);


while($obj = mysqli_fetch_object($eje)){

    $planut += 9;
    $planec += 8;

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
    
        $cant = COUNT($liberacion);
    
        for($i=0; $i<$cant;$i++){
            if($liberacion[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($liberacion[$i]->nombreutq != ""){
                $sumfirmaut++;
            }
            
            if($liberacion[$i]->nombreec != ""){
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

//plan
$planinterut = $planut;
$planinterec = $planec;
//ejecutado
$totalinterut = $sumfirmaut;
$totalinterec = $sumfirmaec;
$cantequiposinter = $canteqc;

$sumfirmaut = 0;
$sumfirmaec = 0;
$planut = 0;
$planec = 0;
$$canteqc = 0;

// echo 'Intercambiadores';
// echo '<br>';
// echo 'Cantidad de equipos ' . $cantequiposinter;
// echo '<br>';
// echo 'Cantidad de plan ut ' . $planinterut;
// echo '<br>';
// echo 'Cantidad de eje tu ' . $totalinterut;
// echo '<br>';
// echo 'Cantidad de plan ec ' . $planinterec;
// echo '<br>';
// echo 'Cantidad de eje ec ' . $totalinterec;
// echo '<br>';

//reactor

$sql = "SELECT * FROM os2212";
$eje = mysqli_query($conexion, $sql);
$canteqc = mysqli_num_rows($eje);


while($obj = mysqli_fetch_object($eje)){

    $planut += 149;
    $planec += 98;

    if($obj->permiso != ""){
        $permiso =  json_decode($obj->permiso);
        if($permiso[0]->nombreut != ""){
            $sumfirmaut++;
        }
        if($permiso[0]->nombreec != ""){
            $sumfirmaec++;
        }
    }
    
    if($obj->manhole1 != ""){
        $manhole1 =  json_decode($obj->manhole1);
        if($manhole1[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->manhole2 != ""){
        $manhole2 =  json_decode($obj->manhole2);
        if($manhole2[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->manhole3 != ""){
        $manhole3 =  json_decode($obj->manhole3);
        if($manhole3[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->manhole4 != ""){
        $manhole4 =  json_decode($obj->manhole4);
        if($manhole4[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->manhole5 != ""){
        $manhole5 =  json_decode($obj->manhole5);
        if($manhole5[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->manhole6 != ""){
        $manhole6 =  json_decode($obj->manhole6);
        if($manhole6[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->manhole7 != ""){
        $manhole7 =  json_decode($obj->manhole7);
        if($manhole7[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->faccomp1 != ""){
        $faccomp1 =  json_decode($obj->faccomp1);
        if($faccomp1[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->faccomp2 != ""){
        $faccomp2 =  json_decode($obj->faccomp2);
        if($faccomp2[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->faccomp3 != ""){
        $faccomp3 =  json_decode($obj->faccomp3);
        if($faccomp3[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->faccomp4 != ""){
        $faccomp4 =  json_decode($obj->faccomp4);
        if($faccomp4[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }
    if($obj->faccomp5 != ""){
        $faccomp5 =  json_decode($obj->faccomp5);
        if($faccomp5[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->faccomp6 != ""){
        $faccomp6 =  json_decode($obj->faccomp6);
        if($faccomp6[0]->nombreut != ""){
            $sumfirmaut++;
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
    
    if($obj->liberacion != ""){
        $liberacion =  json_decode($obj->liberacion);
    
        $cant = COUNT($liberacion);
    
        for($i=0; $i<$cant;$i++){
            if($liberacion[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($liberacion[$i]->nombreutq != ""){
                $sumfirmaut++;
            }
            
            if($liberacion[$i]->nombreec != ""){
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

    if($obj->aislamiento != ""){
        $aislamiento =  json_decode($obj->aislamiento);
        if($aislamiento[0]->nombreut != ""){
            $sumfirmaut++;
        }
        if($aislamiento[0]->nombreec != ""){
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

//plan
$planreactorut = $planut;
$planreactorec = $planec;
//ejecutado
$totalreactorut = $sumfirmaut;
$totalreactorec = $sumfirmaec;
$cantequiposreactor = $canteqc;

$sumfirmaut = 0;
$sumfirmaec = 0;
$planut = 0;
$planec = 0;
$$canteqc = 0;

// echo 'Reactor';
// echo '<br>';
// echo 'Cantidad de equipos ' . $cantequiposreactor;
// echo '<br>';
// echo 'Cantidad de plan ut ' . $planreactorut;
// echo '<br>';
// echo 'Cantidad de eje tu ' . $totalreactorut;
// echo '<br>';
// echo 'Cantidad de plan ec ' . $planreactorec;
// echo '<br>';
// echo 'Cantidad de eje ec ' . $totalreactorec;
// echo '<br>';

//REGENERADOR

$sql = "SELECT * FROM os2211";
$eje = mysqli_query($conexion, $sql);
$canteqc = mysqli_num_rows($eje);


while($obj = mysqli_fetch_object($eje)){

    $planut += 86;
    $planec += 56;

    if($obj->permiso != ""){
        $permiso =  json_decode($obj->permiso);
        if($permiso[0]->nombreut != ""){
            $sumfirmaut++;
        }
        if($permiso[0]->nombreec != ""){
            $sumfirmaec++;
        }
    }
    
    if($obj->manhole1 != ""){
        $manhole1 =  json_decode($obj->manhole1);
        if($manhole1[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->manhole2 != ""){
        $manhole2 =  json_decode($obj->manhole2);
        if($manhole2[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->manhole3 != ""){
        $manhole3 =  json_decode($obj->manhole3);
        if($manhole3[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->manhole4 != ""){
        $manhole4 =  json_decode($obj->manhole4);
        if($manhole4[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

   
    if($obj->faccomp1 != ""){
        $faccomp1 =  json_decode($obj->faccomp1);
        if($faccomp1[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->faccomp2 != ""){
        $faccomp2 =  json_decode($obj->faccomp2);
        if($faccomp2[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->faccomp3 != ""){
        $faccomp3 =  json_decode($obj->faccomp3);
        if($faccomp3[0]->nombreut != ""){
            $sumfirmaut++;
        }
    }

    if($obj->faccomp4 != ""){
        $faccomp4 =  json_decode($obj->faccomp4);
        if($faccomp4[0]->nombreut != ""){
            $sumfirmaut++;
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
    
    if($obj->liberacion != ""){
        $liberacion =  json_decode($obj->liberacion);
    
        $cant = COUNT($liberacion);
    
        for($i=0; $i<$cant;$i++){
            if($liberacion[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($liberacion[$i]->nombreutq != ""){
                $sumfirmaut++;
            }
            
            if($liberacion[$i]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
    }

    if($obj->cierre != ""){
        $cierre =  json_decode($obj->cierre);
       
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

//plan
$planregeut = $planut;
$planregeec = $planec;
//ejecutado
$totalregeut = $sumfirmaut;
$totalregeec = $sumfirmaec;
$cantequiposregenerador = $canteqc;

$sumfirmaut = 0;
$sumfirmaec = 0;
$planut = 0;
$planec = 0;
$$canteqc = 0;

// echo 'Regenerador';
// echo '<br>';
// echo 'Cantidad de equipos ' . $cantequiposregenerador;
// echo '<br>';
// echo 'Cantidad de plan ut ' . $planregeut;
// echo '<br>';
// echo 'Cantidad de eje tu ' . $totalregeut;
// echo '<br>';
// echo 'Cantidad de plan ec ' . $planregeec;
// echo '<br>';
// echo 'Cantidad de eje ec ' . $totalregeec;
// echo '<br>';

//TORRE

$sql = "SELECT * FROM os2234";
$eje = mysqli_query($conexion, $sql);
$canteqc = mysqli_num_rows($eje);


while($obj = mysqli_fetch_object($eje)){

    $planut += 22;
    $planec += 13;

    if($obj->permiso != ""){
        $permiso =  json_decode($obj->permiso);
        if($permiso[0]->nombreut != ""){
            $sumfirmaut++;
        }
        if($permiso[0]->nombreec != ""){
            $sumfirmaec++;
        }
    }

    if($obj->facilidades != ""){
        $facilidades =  json_decode($obj->facilidades);
    
        $cant = COUNT($facilidades);
    
        for($i=0; $i<$cant;$i++){
            
            if($facilidades[$i]->nombreut != ""){
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
    
    if($obj->liberacion != ""){
        $liberacion =  json_decode($obj->liberacion);
    
        $cant = COUNT($liberacion);
    
        for($i=0; $i<$cant;$i++){
            if($liberacion[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($liberacion[$i]->nombreutq != ""){
                $sumfirmaut++;
            }
            
            if($liberacion[$i]->nombreec != ""){
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

//plan
$plantorreut = $planut;
$plantorreec = $planec;
//ejecutado
$totaltorreut = $sumfirmaut;
$totaltoreeec = $sumfirmaec;
$cantequipostorres = $canteqc;

$sumfirmaut = 0;
$sumfirmaec = 0;
$planut = 0;
$planec = 0;
$$canteqc = 0;

// echo 'Torre';
// echo '<br>';
// echo 'Cantidad de equipos ' . $cantequipostorres;
// echo '<br>';
// echo 'Cantidad de plan ut ' . $plantorreut;
// echo '<br>';
// echo 'Cantidad de eje tu ' . $totaltorreut;
// echo '<br>';
// echo 'Cantidad de plan ec ' . $plantorreec;
// echo '<br>';
// echo 'Cantidad de eje ec ' . $totaltoreeec;
// echo '<br>';


//VALVULAS

$sql = "SELECT * FROM os2241";
$eje = mysqli_query($conexion, $sql);
$canteqc = mysqli_num_rows($eje);


while($obj = mysqli_fetch_object($eje)){

    $planut += 98;
    $planec += 51;

    if($obj->permiso != ""){
        $permiso =  json_decode($obj->permiso);
        if($permiso[0]->nombreut != ""){
            $sumfirmaut++;
        }
        if($permiso[0]->nombreec != ""){
            $sumfirmaec++;
        }
    }

    if($obj->limpieza_actuador != ""){
        $limpieza_actuador =  json_decode($obj->limpieza_actuador);
    
        $cant = COUNT($limpieza_actuador);
    
        for($i=0; $i<$cant;$i++){
            
            if($limpieza_actuador[$i]->nombreut != ""){
                $sumfirmaut++;
            }
            // if($limpieza_actuador[$i]->nombreec != ""){
            //     $sumfirmaec++;
            // }
        }
    
    }

    if($obj->limpieza_tuberia != ""){
        $limpieza_tuberia =  json_decode($obj->limpieza_tuberia);
    
        $cant = COUNT($limpieza_tuberia);
    
        for($i=0; $i<$cant;$i++){
            
            if($limpieza_tuberia[$i]->nombreut != ""){
                $sumfirmaut++;
            }
           
        }
    }

    if($obj->limpieza_bonete != ""){
        $limpieza_bonete =  json_decode($obj->limpieza_bonete);
    
        $cant = COUNT($limpieza_bonete);
    
        for($i=0; $i<$cant;$i++){
            
            if($limpieza_bonete[$i]->nombreut != ""){
                $sumfirmaut++;
            }
            
        }
    
    }

    if($obj->limpieza_componentes != ""){
        $limpieza_componentes =  json_decode($obj->limpieza_componentes);
    
        $cant = COUNT($limpieza_componentes);
    
        for($i=0; $i<$cant;$i++){
            
            if($limpieza_componentes[$i]->nombreut != ""){
                $sumfirmaut++;
            }
            
        }
    
    }

    if($obj->limpieza_int_valvula != ""){
        $limpieza_int_valvula =  json_decode($obj->limpieza_int_valvula);
    
        $cant = COUNT($limpieza_int_valvula);
    
        for($i=0; $i<$cant;$i++){
            
            if($limpieza_int_valvula[$i]->nombreut != ""){
                $sumfirmaut++;
            }
            
        }
    
    }

    if($obj->limpieza_cuerpo_valvula != ""){
        $limpieza_cuerpo_valvula =  json_decode($obj->limpieza_cuerpo_valvula);
    
        $cant = COUNT($limpieza_cuerpo_valvula);
    
        for($i=0; $i<$cant;$i++){
            
            if($limpieza_cuerpo_valvula[$i]->nombreut != ""){
                $sumfirmaut++;
            }
            
        }
    
    }

    if($obj->inspdimencional != ""){
        $inspdimencional =  json_decode($obj->inspdimencional);
    
        $cant = COUNT($inspdimencional);
    
        for($i=0; $i<$cant;$i++){
            
            if($inspdimencional[$i]->nombreut != ""){
                $sumfirmaut++;
            }
            
        }
    
    }

    if($obj->inspdimencional != ""){
        $inspdimencional =  json_decode($obj->inspdimencional);
    
        $cant = COUNT($inspdimencional);
    
        for($i=0; $i<$cant;$i++){
            
            if($inspdimencional[$i]->nombreut != ""){
                $sumfirmaut++;
            }
            
        }
    
    }

    if($obj->inspgeneral != ""){
        $inspgeneral =  json_decode($obj->inspgeneral);
    
        $cant = COUNT($inspgeneral);
    
        for($i=0; $i<$cant;$i++){
            
            if($inspgeneral[$i]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }
    
    }
   
}

//plan
$planvalut = $planut;
$planvalec = $planec;
//ejecutado
$totalvalut = $sumfirmaut;
$totalvalec = $sumfirmaec;
$cantequiposvalvulas = $canteqc;

$sumfirmaut = 0;
$sumfirmaec = 0;
$planut = 0;
$planec = 0;
$$canteqc = 0;

// echo 'Válvulas';
// echo '<br>';
// echo 'Cantidad de equipos ' . $cantequiposvalvulas;
// echo '<br>';
// echo 'Cantidad de plan ut ' . $planvalut;
// echo '<br>';
// echo 'Cantidad de eje tu ' . $totalvalut;
// echo '<br>';
// echo 'Cantidad de plan ec ' . $planvalec;
// echo '<br>';
// echo 'Cantidad de eje ec ' . $totalvalec;
// echo '<br>';

//LINEA DE TRANSFERENCIA

$sql = "SELECT * FROM os2242";
$eje = mysqli_query($conexion, $sql);
$canteqc = mysqli_num_rows($eje);


while($obj = mysqli_fetch_object($eje)){

    $planut += 26;
    $planec +=18;

    if($obj->permiso != ""){
        $permiso =  json_decode($obj->permiso);
        if($permiso[0]->nombreut != ""){
            $sumfirmaut++;
        }
        if($permiso[0]->nombreec != ""){
            $sumfirmaec++;
        }
    }
    
    if($obj->facilidades != ""){
        $facilidades =  json_decode($obj->facilidades);

        $cant = COUNT($facilidades);
    
        for($i=0; $i<$cant;$i++){
            if($facilidades[$i]->nombreut != ""){
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
  
    
    if($obj->liberacion != ""){
        $liberacion =  json_decode($obj->liberacion);
    
        $cant = COUNT($liberacion);
    
        for($i=0; $i<$cant;$i++){
            if($liberacion[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($liberacion[$i]->nombreutq != ""){
                $sumfirmaut++;
            }
            
            if($liberacion[$i]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
    }

    if($obj->cierre != ""){
        $cierre =  json_decode($obj->cierre);
    
        $cant = COUNT($cierre);
    
        for($i=0; $i<$cant;$i++){
            if($liberacion[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($liberacion[$i]->nombreutq != ""){
                $sumfirmaut++;
            }
            
            if($liberacion[$i]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
    }

    if($obj->ajustes != ""){
        $ajustes =  json_decode($obj->ajustes);
        if($ajustes[0]->nombreut != ""){
            $sumfirmaut++;
        }
        if($ajustes[0]->nombreec != ""){
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

//plan
$planlineaut = $planut;
$planlineaec = $planec;
//ejecutado
$totallineaut = $sumfirmaut;
$totallineaec = $sumfirmaec;
$cantequiposlinea = $canteqc;

$sumfirmaut = 0;
$sumfirmaec = 0;
$planut = 0;
$planec = 0;
$$canteqc = 0;

// echo 'Línea de Transferencia';
// echo '<br>';
// echo 'Cantidad de equipos ' . $cantequiposlinea;
// echo '<br>';
// echo 'Cantidad de plan ut ' . $planlineaut;
// echo '<br>';
// echo 'Cantidad de eje tu ' . $totallineaut;
// echo '<br>';
// echo 'Cantidad de plan ec ' . $planlineaec;
// echo '<br>';
// echo 'Cantidad de eje ec ' . $totallineaec;
// echo '<br>';


$ciclones = array(
    'cantequipos'=>$cantequiposciclones,
    'cantrca'=>$cantequiposciclones,
    'planut'=>$planciclonesut,
    'ejeut'=>$totalciclonesut,
    'planec'=>$planciclonesec,
    'ejeec'=>$totalciclonesec,
    'totfirm'=>$planciclonesut+$planciclonesec,
    'totfirmeje'=>$totalciclonesut+$totalciclonesec
);

$hornos = array(
    'cantequipos'=>$cantequiposhornos,
    'cantrca'=>$cantequiposhornos,
    'planut'=>$planhornout,
    'ejeut'=>$totalhornout,
    'planec'=>$planhornoec,
    'ejeec'=>$totalhornoec,
    'totfirm'=>$planhornout+$planhornoec,
    'totfirmeje'=>$totalhornout+$totalhornoec
);

$inter = array(
    'cantequipos'=>$cantequiposinter,
    'cantrca'=>$cantequiposinter,
    'planut'=>$planinterut,
    'ejeut'=>$totalinterut,
    'planec'=>$planinterec,
    'ejeec'=>$totalinterec,
    'totfirm'=>$planinterut+$planinterec,
    'totfirmeje'=>$totalinterut+$totalinterec
);

$reactor = array(
    'cantequipos'=>$cantequiposreactor,
    'cantrca'=>$cantequiposreactor,
    'planut'=>$planreactorut,
    'ejeut'=>$totalreactorut,
    'planec'=>$planreactorec,
    'ejeec'=>$totalreactorec,
    'totfirm'=>$planreactorut+$planreactorec,
    'totfirmeje'=>$totalreactorut+$totalreactorec
);

$regenerador = array(
    'cantequipos'=>$cantequiposregenerador,
    'cantrca'=>$cantequiposregenerador,
    'planut'=>$planregeut,
    'ejeut'=>$totalregeut,
    'planec'=>$planregeec,
    'ejeec'=>$totalregeec,
    'totfirm'=>$planregeut+$planregeec,
    'totfirmeje'=>$totalregeut+$totalregeec
);

$torres = array(
    'cantequipos'=>$cantequipostorres,
    'cantrca'=>$cantequipostorres,
    'planut'=>$plantorreut,
    'ejeut'=>$totaltorreut,
    'planec'=>$plantorreec,
    'ejeec'=>$totaltoreeec,
    'totfirm'=>$plantorreut+$plantorreec,
    'totfirmeje'=>$totaltorreut+$totaltoreeec
);

$valvulas = array(
    'cantequipos'=>$cantequiposvalvulas,
    'cantrca'=>$cantequiposvalvulas,
    'planut'=>$planvalut,
    'ejeut'=>$totalvalut,
    'planec'=>$planvalec,
    'ejeec'=>$totalvalec,
    'totfirm'=>$planvalut+$planvalec,
    'totfirmeje'=>$totalvalut+$totalvalec
);

$linea = array(
    'cantequipos'=>$cantequiposlinea,
    'cantrca'=>$cantequiposlinea,
    'planut'=>$planlineaut,
    'ejeut'=>$totallineaut,
    'planec'=>$planlineaec,
    'ejeec'=>$totallineaec,
    'totfirm'=>$planlineaut+$planlineaec,
    'totfirmeje'=>$totallineaut+$totallineaec
);

$consolidado = array(
    'cantequipos'=>$cantequiposciclones+$cantequiposhornos+$cantequiposreactor+$cantequiposregenerador+$cantequipostorres+$cantequiposvalvulas+$cantequiposlinea,
    'cantrca'=>$cantequiposlinea+$cantequiposhornos+$cantequiposreactor+$cantequiposregenerador+$cantequipostorres+$cantequiposvalvulas+$cantequiposlinea,
    'planut'=>$planciclonesut+$planhornout+$planreactorut+$planregeut+$plantorreut+$planvalut+$planlineaut,
    'ejeut'=>$totalciclonesut+$totalhornout+$totalreactorut+$totalregeut+$totaltorreut+$totalvalut+$totallineaut,
    'planec'=>$planciclonesec+$planhornoec+$planreactorec+$planregeec+$planregeec+$plantorreec+$planvalec+$planlineaec,
    'ejeec'=>$totalciclonesec+$totalhornoec+$totalinterec+$totalreactorec+$totalregeec+$totaltoreeec+$totalvalec+$totallineaec,
    'totfirm'=>$planciclonesut+$planciclonesec+$planhornout+$planhornoec+$planreactorut+$planreactorec+$planregeut+$planregeec+$plantorreut+$plantorreec+$planvalut+$planvalec+$planlineaut+$planlineaec,
    'totfirmeje'=>$totalciclonesut+$totalciclonesec+$totalhornout+$totalhornoec+$totalreactorut+$totalreactorec+$totalregeut+$totalregeec+$totaltorreut+$totaltoreeec+$totalvalut+$totalvalec+$totallineaut+$totallineaec
);

$datos = array(
    'ciclones'=>$ciclones,
    'hornos'=>$hornos,
    'inter'=>$inter,
    'reactor'=>$reactor,
    'regenerador'=>$regenerador,
    'torres'=>$torres,
    'valvulas'=>$valvulas,
    'linea'=>$linea,
    'consolidado'=>$consolidado
);


 echo json_encode($datos);
