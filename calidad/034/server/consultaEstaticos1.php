<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

//consulta tambor de vapor os3319
$totaltamborvaporecp = 22;
$totaltamborvaporut = 31;

$cons = "SELECT * FROM os3319";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttamborvapor = $cant;

$totaltamborvaporecp = $totaltamborvaporecp;
$totaltamborvaporut = $totaltamborvaporut;


$sumfirmaut = 0;
$sumfirmaec = 0;

while($obj = mysqli_fetch_object($ejec)){

    if($obj->instalacion != ""){
        $instalacion =  json_decode($obj->instalacion);

        if($instalacion[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($instalacion[0]->nombreecp != ""){
            $sumfirmaec++;
        }
         
    }

    if($obj->apertura != ""){
        $apertura =  json_decode($obj->apertura);

        if($apertura[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($apertura[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
         
    }
    
     
    if($obj->limpieza != ""){

        $limpieza =  json_decode($obj->limpieza);

        $cant = COUNT($limpieza);
    
        for($i=0; $i<$cant;$i++){
            if($limpieza[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
             
           
        }

    }

    if($obj->inspeccion != ""){

        $inspeccion =  json_decode($obj->inspeccion);

        $cant = COUNT($inspeccion);
    
        for($i=0; $i<$cant;$i++){
             

            if($inspeccion[$i]->nombreecp != ""){
                $sumfirmaec++;
            }
             
           
        }

    }


    if($obj->mantenimiento != ""){
        $mantenimiento =  json_decode($obj->mantenimiento);

        if($mantenimiento[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($mantenimiento[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }

        if($mantenimiento[0]->nombreecpg != ""){
            $sumfirmaec++;
        }
         
    }

    if($obj->limpieza != ""){

        $limpieza =  json_decode($obj->limpieza);

        $cant = COUNT($limpieza);
    
        for($i=0; $i<$cant;$i++){

            if($limpieza[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }

            if($limpieza[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }

            if($limpieza[$i]->nombreutecp != ""){
                $sumfirmaec++;
            }
             
           
        }

    }

    if($obj->internos != ""){
        $internos =  json_decode($obj->internos);

        if($internos[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($internos[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }

        if($internos[0]->nombreecp != ""){
            $sumfirmaec++;
        }

        if($internos[0]->nombreecp2 != ""){
            $sumfirmaec++;
        }
         
    }

    if($obj->cierrem1 != ""){
        $cierrem1 =  json_decode($obj->cierrem1);

        if($cierrem1[0]->nombreutsup != ""){
            $sumfirmaut++;
        }

        if($cierrem1[0]->nombreecp != ""){
            $sumfirmaec++;
        }
         
    }

    if($obj->cierrem2 != ""){
        $cierrem2 =  json_decode($obj->cierrem2);

        if($cierrem2[0]->nombreutsup != ""){
            $sumfirmaut++;
        }

        if($cierrem2[0]->nombreecp != ""){
            $sumfirmaec++;
        }
         
    }

    if($obj->ajustes != ""){
        $ajustes =  json_decode($obj->ajustes);

        if($ajustes[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($ajustes[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }

        if($ajustes[0]->nombreecpg != ""){
            $sumfirmaec++;
        }

         
    }

    if($obj->terminacion != ""){
        $terminacion =  json_decode($obj->terminacion);

        if($terminacion[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($terminacion[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }

        if($terminacion[0]->nombreecpg != ""){
            $sumfirmaec++;
        }
         
    }


    if($obj->aplicacion != ""){
        $aplicacion =  json_decode($obj->aplicacion);

        if($aplicacion[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($aplicacion[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }

        if($aplicacion[0]->nombreecpg != ""){
            $sumfirmaec++;
        }
       
        
        if($obj->aplicacion != ""){
            $aplicacion =  json_decode($obj->aplicacion);
    
            if($aplicacion[0]->nombreutsup != ""){
                $sumfirmaut++;
            }
             
    
            if($aplicacion[0]->nombreecp != ""){
                $sumfirmaec++;
            }
             
        }
    }


   

}

//SUMAS DE TAMBOR VAPOR
$totaltamborvaporeceje = $sumfirmaec;
$totaltamborvaporuteje = $sumfirmaut;


//consulta tambor de lodos os3320
$totaltamborlodosecp = 18;
$totaltamborlodosut = 27;

$cons = "SELECT * FROM os3320";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canttamborlodos = $cant;

$totaltamborlodosecp = $totaltamborlodosecp;
$totaltamborlodosut = $totaltamborlodosut;


$sumfirmaut = 0;
$sumfirmaec = 0;

while($obj = mysqli_fetch_object($ejec)){

    if($obj->instalacion != ""){
        $instalacion =  json_decode($obj->instalacion);

        if($instalacion[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($instalacion[0]->nombreecp != ""){
            $sumfirmaec++;
        }
         
    }

    if($obj->apertura != ""){
        $apertura =  json_decode($obj->apertura);

        if($apertura[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($apertura[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
         
    }
    
     
    if($obj->limpieza != ""){

        $limpieza =  json_decode($obj->limpieza);

        $cant = COUNT($limpieza);
    
        for($i=0; $i<$cant;$i++){
            if($limpieza[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
             
           
        }

    }

    if($obj->inspeccion != ""){

        $inspeccion =  json_decode($obj->inspeccion);

        $cant = COUNT($inspeccion);
    
        for($i=0; $i<$cant;$i++){
             

            if($inspeccion[$i]->nombreecp != ""){
                $sumfirmaec++;
            }
             
           
        }

    }


    // if($obj->mantenimiento != ""){
    //     $mantenimiento =  json_decode($obj->mantenimiento);

    //     if($mantenimiento[0]->nombreutsup != ""){
    //         $sumfirmaut++;
    //     }
    //     if($mantenimiento[0]->nombreutqaqc != ""){
    //         $sumfirmaut++;
    //     }

    //     if($mantenimiento[0]->nombreecpg != ""){
    //         $sumfirmaec++;
    //     }
         
    // }

    if($obj->limpieza != ""){

        $limpieza =  json_decode($obj->limpieza);

        $cant = COUNT($limpieza);
    
        for($i=0; $i<$cant;$i++){

            if($limpieza[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }

            if($limpieza[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }

            if($limpieza[$i]->nombreutecp != ""){
                $sumfirmaec++;
            }
             
           
        }

    }

    // if($obj->internos != ""){
    //     $internos =  json_decode($obj->internos);

    //     if($internos[0]->nombreutsup != ""){
    //         $sumfirmaut++;
    //     }
    //     if($internos[0]->nombreutqaqc != ""){
    //         $sumfirmaut++;
    //     }

    //     if($internos[0]->nombreecp != ""){
    //         $sumfirmaec++;
    //     }

    //     if($internos[0]->nombreecp2 != ""){
    //         $sumfirmaec++;
    //     }
         
    // }

    if($obj->cierrem1 != ""){
        $cierrem1 =  json_decode($obj->cierrem1);

        if($cierrem1[0]->nombreutsup != ""){
            $sumfirmaut++;
        }

        if($cierrem1[0]->nombreecp != ""){
            $sumfirmaec++;
        }
         
    }

    if($obj->cierrem2 != ""){
        $cierrem2 =  json_decode($obj->cierrem2);

        if($cierrem2[0]->nombreutsup != ""){
            $sumfirmaut++;
        }

        if($cierrem2[0]->nombreecp != ""){
            $sumfirmaec++;
        }
         
    }

    if($obj->ajustes != ""){
        $ajustes =  json_decode($obj->ajustes);

        if($ajustes[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($ajustes[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }

        if($ajustes[0]->nombreecpg != ""){
            $sumfirmaec++;
        }

         
    }

    if($obj->terminacion != ""){
        $terminacion =  json_decode($obj->terminacion);

        if($terminacion[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($terminacion[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }

        if($terminacion[0]->nombreecpg != ""){
            $sumfirmaec++;
        }
         
    }


    if($obj->aplicacion != ""){
        $aplicacion =  json_decode($obj->aplicacion);

        if($aplicacion[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($aplicacion[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }

        if($aplicacion[0]->nombreecpg != ""){
            $sumfirmaec++;
        }
       
        
        if($obj->aplicacion != ""){
            $aplicacion =  json_decode($obj->aplicacion);
    
            if($aplicacion[0]->nombreutsup != ""){
                $sumfirmaut++;
            }
             
    
            if($aplicacion[0]->nombreecp != ""){
                $sumfirmaec++;
            }
             
        }
    }


   

}

//SUMAS DE TAMBOR lodos
$totaltamborlodoseceje = $sumfirmaec;
$totaltamborlodosuteje = $sumfirmaut;

//consulta chimenea os3329
$totalinterecp = 10;
$totalinterut = 25;

$cons = "SELECT * FROM os3329";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantintercambiadores = $cant;

$totalinterecp = $totalinterecp;
$totalinterut = $totalinterut;


$sumfirmaut = 0;
$sumfirmaec = 0;

while($obj = mysqli_fetch_object($ejec)){

    if($obj->alistamiento != ""){
        $alistamiento =  json_decode($obj->alistamiento);

        if($alistamiento[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($alistamiento[0]->fechautqaqc != ""){
            $sumfirmaut++;
        }
         
    }
    
    if($obj->limpieza != ""){
        $limpieza =  json_decode($obj->limpieza);

        if($limpieza[0]->nombreutsup != ""){
            $sumfirmaut++;
        }

        if($limpieza[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }

        if($limpieza[0]->nombreutsup2 != ""){
            $sumfirmaut++;
        }

        if($limpieza[0]->nombreutqaqc2 != ""){
            $sumfirmaut++;
        }

    }

     
    if($obj->componentes != ""){

        $componentes =  json_decode($obj->componentes);

        $cant = COUNT($componentes);
    
        for($i=0; $i<$cant;$i++){
            if($componentes[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($componentes[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }

            if($componentes[$i]->nombreutec != ""){
                $sumfirmaec++;
            }
           
        }

    }

   

}

//SUMAS DE CHIMENEA
$totalintereceje = $sumfirmaec;
$totalinteruteje = $sumfirmaut;


//consulta paredes laterales 3321
$totalhornoecp = 21;
$totalhornout = 44;

$cons = "SELECT * FROM os3321";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$canthornos = $cant;

$totalhornoecp = $totalhornoecp * $cant;
$totalhornout = $totalhornout * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

while($obj = mysqli_fetch_object($ejec)){

    if($obj->alistamiento != ""){
        $alistamiento =  json_decode($obj->alistamiento);
        if($alistamiento[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($alistamiento[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
    }
    
    if($obj->componentes != ""){

        $componentes =  json_decode($obj->componentes);

        $cant = COUNT($componentes);
    
        for($i=0; $i<$cant;$i++){
            if($componentes[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($componentes[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }

            if($componentes[$i]->nombreutec != ""){
                $sumfirmaec++;
            }
           
        }

    }

    

}

//SUMAS DE PAREDES LATERALES
$totalhornoecpeje = $sumfirmaec;
$totalhornouteje = $sumfirmaut;

//PARED PISO 3322
$totalparedpisoecp = 8;
$totalparedpisout = 20;

$cons = "SELECT * FROM os3322";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantparedpiso = $cant;

$totalparedpisoecp = $totalparedpisoecp * $cant;
$totalparedpisout = $totalparedpisout * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

while($obj = mysqli_fetch_object($ejec)){

    if($obj->alistamiento != ""){
        $alistamiento =  json_decode($obj->alistamiento);
        if($alistamiento[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($alistamiento[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
    }

    if($obj->liberacion != ""){
        $liberacion =  json_decode($obj->liberacion);
        if($liberacion[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($liberacion[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
    }
    
    if($obj->componentes != ""){

        $componentes =  json_decode($obj->componentes);

        $cant = COUNT($componentes);
    
        for($i=0; $i<$cant;$i++){
            if($componentes[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($componentes[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }

            if($componentes[$i]->nombreutec != ""){
                $sumfirmaec++;
            }
           
        }


        

    }

    

}

//SUMAS DE PARED PISO
$totalparedpisoecpeje = $sumfirmaec;
$totalparedpisouteje = $sumfirmaut;


//PARED PANTALLA 3323
$totalparedpantallaecp = 5;
$totalparedpantallaut = 14;

$cons = "SELECT * FROM os3323";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantparedpantalla = $cant;

$totalparedpantallaecp = $totalparedpantallaecp * $cant;
$totalparedpantallaut = $totalparedpantallaut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

while($obj = mysqli_fetch_object($ejec)){

    if($obj->alistamiento != ""){
        $alistamiento =  json_decode($obj->alistamiento);
        if($alistamiento[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($alistamiento[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
    }

    if($obj->liberacion != ""){
        $liberacion =  json_decode($obj->liberacion);
        if($liberacion[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($liberacion[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
    }
    
    if($obj->componentes != ""){

        $componentes =  json_decode($obj->componentes);

        $cant = COUNT($componentes);
    
        for($i=0; $i<$cant;$i++){
            if($componentes[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($componentes[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }

            if($componentes[$i]->nombreutec != ""){
                $sumfirmaec++;
            }
           
        }


    }
   

}

//SUMAS DE PARED PANTALLA
$totalparedpantallaecpeje = $sumfirmaec;
$totalparedpantallauteje = $sumfirmaut;


//PARED TECHO 3324
$totalparedtechoecp = 7;
$totalparedtechout = 18;

$cons = "SELECT * FROM os3324";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantparedptecho = $cant;

$totalparedtechoecp = $totalparedtechoecp * $cant;
$totalparedtechout = $totalparedtechout * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

while($obj = mysqli_fetch_object($ejec)){

    if($obj->alistamiento != ""){
        $alistamiento =  json_decode($obj->alistamiento);
        if($alistamiento[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($alistamiento[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
    }

    if($obj->liberacion != ""){
        $liberacion =  json_decode($obj->liberacion);
        if($liberacion[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($liberacion[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
    }
    
    if($obj->componentes != ""){

        $componentes =  json_decode($obj->componentes);

        $cant = COUNT($componentes);
    
        for($i=0; $i<$cant;$i++){
            if($componentes[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($componentes[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }

            if($componentes[$i]->nombreutec != ""){
                $sumfirmaec++;
            }
           
        }


    }

    

}

//SUMAS DE PARED TECHO
$totalparedtechoecpeje = $sumfirmaec;
$totalparedtechouteje = $sumfirmaut;


//PARED QUEMADORES 3325
$totalparedquemaecp = 6;
$totalparedquemaut = 16;

$cons = "SELECT * FROM os3325";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantparedquema = $cant;

$totalparedquemaecp = $totalparedquemaecp * $cant;
$totalparedquemaut = $totalparedquemaut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

while($obj = mysqli_fetch_object($ejec)){

    if($obj->alistamiento != ""){
        $alistamiento =  json_decode($obj->alistamiento);
        if($alistamiento[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($alistamiento[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
    }

    if($obj->liberacion != ""){
        $liberacion =  json_decode($obj->liberacion);
        if($liberacion[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($liberacion[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
    }
    
    if($obj->componentes != ""){

        $componentes =  json_decode($obj->componentes);

        $cant = COUNT($componentes);
    
        for($i=0; $i<$cant;$i++){
            if($componentes[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($componentes[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }

            if($componentes[$i]->nombreutec != ""){
                $sumfirmaec++;
            }
           
        }

    }    

}

//SUMAS DE PARED QUEMADORES
$totalparedquemaecpeje = $sumfirmaec;
$totalparedquemauteje = $sumfirmaut;



// SOBRECALENTADOR 3326
$totalsobrecalecp = 12;
$totalsobrecalut = 28;

$cons = "SELECT * FROM os3326";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantsobrecal = $cant;

$totalsobrecalecp = $totalsobrecalecp * $cant;
$totalsobrecalut = $totalsobrecalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

while($obj = mysqli_fetch_object($ejec)){

    if($obj->alistamiento != ""){
        $alistamiento =  json_decode($obj->alistamiento);
        if($alistamiento[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($alistamiento[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
    }
    
    if($obj->componentes != ""){

        $componentes =  json_decode($obj->componentes);

        $cant = COUNT($componentes);
    
        for($i=0; $i<$cant;$i++){
            if($componentes[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($componentes[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }

            if($componentes[$i]->nombreutec != ""){
                $sumfirmaec++;
            }
           
        }

    }

    

}

//SUMAS DE  SOBRECALENTADOR
$totalsobrecalecpeje = $sumfirmaec;
$totalsobrecaluteje = $sumfirmaut;


//TUBERIA RISER 3327
$totalriserecp = 6;
$totalriserut = 16;

$cons = "SELECT * FROM os3327";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantriser = $cant;

$totalriserecp = $totalriserecp * $cant;
$totalriserut = $totalriserut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

while($obj = mysqli_fetch_object($ejec)){

    if($obj->alistamiento != ""){
        $alistamiento =  json_decode($obj->alistamiento);
        if($alistamiento[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($alistamiento[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
    }

    if($obj->liberacion != ""){
        $liberacion =  json_decode($obj->liberacion);
        if($liberacion[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($liberacion[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
    }
    
    if($obj->componentes != ""){

        $componentes =  json_decode($obj->componentes);

        $cant = COUNT($componentes);
    
        for($i=0; $i<$cant;$i++){
            if($componentes[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($componentes[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }

            if($componentes[$i]->nombreutec != ""){
                $sumfirmaec++;
            }
           
        }

    }

}

//SUMAS DE TUBERIA RISER
$totalriserecpeje = $sumfirmaec;
$totalriseruteje = $sumfirmaut;



//CALENTADOR AIRE 3328
$totalcalaireecp = 10;
$totalcalaireut = 22;

$cons = "SELECT * FROM os3328";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantcalaire = $cant;

$totalcalaireecp = $totalcalaireecp * $cant;
$totalcalaireut = $totalcalaireut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

while($obj = mysqli_fetch_object($ejec)){

    if($obj->alistamiento != ""){
        $alistamiento =  json_decode($obj->alistamiento);
        if($alistamiento[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($alistamiento[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
    }

    if($obj->liberacion != ""){
        $liberacion =  json_decode($obj->liberacion);
        if($liberacion[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($liberacion[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
    }
    
    if($obj->componentes != ""){

        $componentes =  json_decode($obj->componentes);

        $cant = COUNT($componentes);
    
        for($i=0; $i<$cant;$i++){
            if($componentes[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($componentes[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }

            if($componentes[$i]->nombreutec != ""){
                $sumfirmaec++;
            }
           
        }


        

    }

    

}

//SUMAS DE CALENTADOR AIRE
$totalcalaireecpeje = $sumfirmaec;
$totalcalaireuteje = $sumfirmaut;



//MIRILLAS 11
$totalmirillasecp = 5;
$totalmirillasut = 6;

$cons = "SELECT * FROM os11";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantmirillas = $cant;

$totalmirillasecp = $totalmirillasecp * $cant;
$totalmirillasut = $totalmirillasut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

while($obj = mysqli_fetch_object($ejec)){

    if($obj->desconexion != ""){
        $desconexion =  json_decode($obj->desconexion);
        if($desconexion[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($desconexion[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }

        if($desconexion[0]->nombreecp != ""){
            $sumfirmaec++;
        }
        
    }

    if($obj->mantenimiento != ""){
        $mantenimiento =  json_decode($obj->mantenimiento);

        if($mantenimiento[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($mantenimiento[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }

        if($mantenimiento[0]->nombreecp != ""){
            $sumfirmaec++;
        }

        if($mantenimiento[0]->nombreecpi != ""){
            $sumfirmaec++;
        }
        
    }

    if($obj->instalacion != ""){
        $instalacion =  json_decode($obj->instalacion);

        if($instalacion[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($instalacion[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }

        if($instalacion[0]->nombreecp != ""){
            $sumfirmaec++;
        }
 
        
    }

    if($obj->entrega != ""){
        $entrega =  json_decode($obj->entrega);

        if($entrega[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
         

        if($entrega[0]->nombreecp != ""){
            $sumfirmaec++;
        }
 
        
    }

     

}

//SUMAS DE MIRILLAS
$totalmirillasecpeje = $sumfirmaec;
$totalmirillasuteje = $sumfirmaut;


//QUEMADOR  06
$totalquemadorecp = 5;
$totalquemadorut = 7;

$cons = "SELECT * FROM os06";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantquemador = $cant;

$totalquemadorecp = $totalquemadorecp * $cant;
$totalquemadorut = $totalquemadorut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

while($obj = mysqli_fetch_object($ejec)){

    if($obj->desconexion != ""){
        $desconexion =  json_decode($obj->desconexion);
        if($desconexion[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
         

        if($desconexion[0]->nombreecp != ""){
            $sumfirmaec++;
        }
        
    }

    if($obj->mantenimiento != ""){
        $mantenimiento =  json_decode($obj->mantenimiento);

        if($mantenimiento[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($mantenimiento[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }

        if($mantenimiento[0]->nombreecp != ""){
            $sumfirmaec++;
        }

        
        
    }

    if($obj->instalacion != ""){
        $instalacion =  json_decode($obj->instalacion);

        if($instalacion[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($instalacion[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }

        if($instalacion[0]->nombreecp != ""){
            $sumfirmaec++;
        }

        if($instalacion[0]->nombreecpi != ""){
            $sumfirmaec++;
        }
 
        
    }

    if($obj->entrega != ""){
        $entrega =  json_decode($obj->entrega);

        if($entrega[0]->nombreutsup != ""){
            $sumfirmaut++;
        }

        if($entrega[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
         

        if($entrega[0]->nombreecp != ""){
            $sumfirmaec++;
        }
 
        
    }

     

}

//SUMAS DE QUEMADOR
$totalquemadorecpeje = $sumfirmaec;
$totalquemadoruteje = $sumfirmaut;



//VÁLVULAS  07
$totalvalvulasecp = 5;
$totalvalvulasut = 6;

$cons = "SELECT * FROM os07";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantvalvulas = $cant;

$totalvalvulasecp = $totalvalvulasecp * $cant;
$totalvalvulasut = $totalvalvulasut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

while($obj = mysqli_fetch_object($ejec)){

    if($obj->permiso != ""){
        $permiso =  json_decode($obj->permiso);
        if($permiso[0]->nombrepermut != ""){
            $sumfirmaut++;
        }

        if($permiso[0]->nombrepermec != ""){
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

        if($terminacion[0]->nombreutq != ""){
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

//SUMAS DE VÁLVULAS
$totalvalvulasecpeje = $sumfirmaec;
$totalvalvulasuteje = $sumfirmaut;


//VÁLVULAS SEGURIDAD 02
$totalvalsegecp = 5;
$totalvalsegut = 5;

$cons = "SELECT * FROM os02";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantvalseg = $cant;

$totalvalsegecp = $totalvalsegecp * $cant;
$totalvalsegut = $totalvalsegut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

while($obj = mysqli_fetch_object($ejec)){

    if($obj->permiso != ""){
        $permiso =  json_decode($obj->permiso);
        if($permiso[0]->nombrepermut != ""){
            $sumfirmaut++;
        }

        if($permiso[0]->nombrepermec != ""){
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

//SUMAS DE VÁLVULAS SEGURIDAD
$totalvalsegecpeje = $sumfirmaec;
$totalvalseguteje = $sumfirmaut;


//BANCO PRINCIPAL
$totalbancoprincipalecp = 9;
$totalbancoprincipalut = 22;

$cons = "SELECT * FROM os3316";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantbancoprincipal = $cant;

$totalbancoprincipalecp = $totalbancoprincipalecp * $cant;
$totalbancoprincipalut = $totalbancoprincipalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

while($obj = mysqli_fetch_object($ejec)){

    if($obj->alistamiento != ""){
        $alistamiento =  json_decode($obj->alistamiento);
        if($alistamiento[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($alistamiento[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
    }

    if($obj->libItems != ""){
        $liberacion =  json_decode($obj->libItems);
        if($liberacion[0]->nombreutsup != ""){
            $sumfirmaut++;
        }
        if($liberacion[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
    }
    
    if($obj->libComp != ""){

        $componentes =  json_decode($obj->libComp);

        $cant = COUNT($componentes);
    
        for($i=0; $i<$cant;$i++){
            if($componentes[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($componentes[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }

            if($componentes[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }

    }

    

}

//SUMAS BANCO PRINCIPAL
$totalbancoprincipalecpeje = $sumfirmaec;
$totalbancoprincipaluteje = $sumfirmaut;


//DESMANTELAMIENTO
$totaldesmantecp = 50;
$totaldesmantut = 65;

$cons = "SELECT * FROM os3317";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantdesmant = $cant;

$totaldesmantecp = $totaldesmantecp * $cant;
$totaldesmantut = $totaldesmantut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

while($obj = mysqli_fetch_object($ejec)){

    if($obj->sas != ""){
        $alistamiento =  json_decode($obj->sas);
        if($alistamiento[0]->nombreutsup != ""){
            $sumfirmaec++;
        }
        if($alistamiento[0]->nombreutqaqc != ""){
            $sumfirmaut++;
        }
    }

    if($obj->apertura != ""){

        $apertura =  json_decode($obj->apertura);

        $cant = COUNT($apertura);
    
        for($i=0; $i<$cant;$i++){

            if($apertura[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }

        }
        
    }

    if($obj->limpieza != ""){

        $limpieza =  json_decode($obj->limpieza);

        $cant = COUNT($limpieza);
    
        for($i=0; $i<$cant;$i++){

            if($limpieza[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }

        }
        
    }
    
    if($obj->retiro != ""){

        $componentes =  json_decode($obj->retiro);

        $cant = COUNT($componentes);
    
        for($i=0; $i<$cant;$i++){
            if($componentes[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }
            if($componentes[$i]->nombreutqaqc != ""){
                $sumfirmaut++;
            }

            if($componentes[$i]->nombreec != ""){
                $sumfirmaec++;
            }

            if($componentes[$i]->nombreecg != ""){
                $sumfirmaec++;
            }
           
        }

    }

    if($obj->entrega != ""){

        $entrega =  json_decode($obj->entrega);

        $cant = COUNT($entrega);
    
        for($i=0; $i<$cant;$i++){
            if($entrega[$i]->nombreutsup != ""){
                $sumfirmaut++;
            }

            if($entrega[$i]->nombreec != ""){
                $sumfirmaec++;
            }
           
        }

    }

    

}

//SUMAS DEMANTELAMIENTO
$totaldesmantecpeje = $sumfirmaec;
$totaldesmantuteje = $sumfirmaut;


//DESMANTELAMIENTO
$desmant = array(
    'totaldesmantecp'=>$totaldesmantecp,
    'totaldesmantut'=> $totaldesmantut,
    'totaldesmanteceje'=>$totaldesmantecpeje,
    'totaldesmantuteje'=>$totaldesmantuteje,
    'totalfirmas'=>$totaldesmantecp+$totaldesmantut,
    'totalfirmaseje'=>$totaldesmantecpeje + $totaldesmantuteje,
    'cantdesmant'=>$cantdesmant
);

//BANCO
$banco = array(
    'totalbancoecp'=>$totalbancoprincipalecp,
    'totalbancout'=> $totalbancoprincipalut,
    'totalbancoeceje'=>$totalbancoprincipalecpeje,
    'totalbancouteje'=>$totalbancoprincipaluteje,
    'totalfirmas'=>$totalbancoprincipalecp+$totalbancoprincipalut,
    'totalfirmaseje'=>$totalbancoprincipalecpeje + $totalbancoprincipaluteje,
    'cantbancoprincipal'=>$cantbancoprincipal
);

//CHIMENEA
$intercambiadores = array(
    'totalinterecp'=>$totalinterecp,
    'totalinterut'=> $totalinterut,
    'totalintereceje'=>$totalintereceje,
    'totalinteruteje'=>$totalinteruteje,
    'totalfirmas'=>$totalinterecp+$totalinterut,
    'totalfirmaseje'=>$totalintereceje + $totalinteruteje,
    'cantintercambiadores'=>$cantintercambiadores
);

//PAREDES LATERALS
$hornos = array(
    'totalhornoecp'=>$totalhornoecp,
    'totalhornout'=> $totalhornout,
    'totalhornoecpeje'=>$totalhornoecpeje,
    'totalhornouteje'=>$totalhornouteje,
    'totalfirmas'=>$totalhornoecp+$totalhornout,
    'totalfirmaseje'=>$totalhornoecpeje + $totalhornouteje,
    'canthornos'=>$canthornos
);

//PARED PISO
$paredpiso = array(
    'totalparedpisoecp'=>$totalparedpisoecp,
    'totalparedpisout'=> $totalparedpisout,
    'totalparedpisoecpeje'=>$totalparedpisoecpeje,
    'totalparedpisouteje'=>$totalparedpisouteje,
    'totalfirmas'=>$totalparedpisoecp+$totalparedpisout,
    'totalfirmaseje'=>$totalparedpisoecpeje + $totalparedpisouteje,
    'cantparedpiso'=>$cantparedpiso
);

//PARED PANTALLA
$paredpantalla = array(
    'totalparedpantallaecp'=>$totalparedpantallaecp,
    'totalparedpantallaut'=> $totalparedpantallaut,
    'totalparedpantallaecpeje'=>$totalparedpantallaecpeje,
    'totalparedpantallauteje'=>$totalparedpantallauteje,
    'totalfirmas'=>$totalparedpantallaecp+$totalparedpantallaut,
    'totalfirmaseje'=>$totalparedpantallaecpeje + $totalparedpantallauteje,
    'cantparedpantalla'=>$cantparedpantalla
);

//PARED TECHO
$paredtecho = array(
    'totalparedtechoecp'=>$totalparedtechoecp,
    'totalparedtechout'=> $totalparedtechout,
    'totalparedtechoecpeje'=>$totalparedtechoecpeje,
    'totalparedtechouteje'=>$totalparedtechouteje,
    'totalfirmas'=>$totalparedtechoecp+$totalparedtechout,
    'totalfirmaseje'=>$totalparedtechoecpeje + $totalparedtechouteje,
    'cantparedptecho'=>$cantparedptecho
);

//PARED QUEMADORES
$paredquemadores = array(
    'totalparedquemaecp'=>$totalparedquemaecp,
    'totalparedquemaut'=> $totalparedquemaut,
    'totalparedquemaecpeje'=>$totalparedquemaecpeje,
    'totalparedquemauteje'=>$totalparedquemauteje,
    'totalfirmas'=>$totalparedquemaecp+$totalparedquemaut,
    'totalfirmaseje'=>$totalparedquemaecpeje + $totalparedquemauteje,
    'cantparedquema'=>$cantparedquema
);

//TAMBOR VAPOR
$tamborvapor = array(
    'totalecp'=>$totaltamborvaporecp,
    'totalut'=> $totaltamborvaporut,
    'totalecpeje'=>$totaltamborvaporeceje,
    'totaluteje'=>$totaltamborvaporuteje,
    'totalfirmas'=>$totaltamborvaporecp+$totaltamborvaporut,
    'totalfirmaseje'=>$totaltamborvaporeceje + $totaltamborvaporuteje,
    'cant'=>$canttamborvapor
);

//TAMBOR LODOS
$tamborlodos = array(
    'totalecp'=>$totaltamborlodosecp,
    'totalut'=> $totaltamborlodosut,
    'totalecpeje'=>$totaltamborlodoseceje,
    'totaluteje'=>$totaltamborlodosuteje,
    'totalfirmas'=>$totaltamborlodosecp+$totaltamborlodosut,
    'totalfirmaseje'=>$totaltamborlodoseceje + $totaltamborlodosuteje,
    'cant'=>$canttamborlodos
);

//SOBRECALENTADOR
$sobrecalentador = array(
    'totalsobrecalecp'=>$totalsobrecalecp,
    'totalsobrecalut'=> $totalsobrecalut,
    'totalsobrecalecpeje'=>$totalsobrecalecpeje,
    'totalsobrecaluteje'=>$totalsobrecaluteje,
    'totalfirmas'=>$totalsobrecalecp+$totalsobrecalut,
    'totalfirmaseje'=>$totalsobrecalecpeje + $totalsobrecaluteje,
    'cantsobrecal'=>$cantsobrecal
);


//RISER
$riser = array(
    'totalriserecp'=>$totalriserecp,
    'totalriserut'=> $totalriserut,
    'totalriserecpeje'=>$totalriserecpeje,
    'totalriseruteje'=>$totalriseruteje,
    'totalfirmas'=>$totalriserecp+$totalriserut,
    'totalfirmaseje'=>$totalriserecpeje + $totalriseruteje,
    'cantriser'=>$cantriser
);


//CALENTADOR AIRE
$calaire = array(
    'totalcalaireecp'=>$totalcalaireecp,
    'totalcalaireut'=> $totalcalaireut,
    'totalcalaireecpeje'=>$totalcalaireecpeje,
    'totalcalaireuteje'=>$totalcalaireuteje,
    'totalfirmas'=>$totalcalaireecp+$totalcalaireut,
    'totalfirmaseje'=>$totalcalaireecpeje + $totalcalaireuteje,
    'cantcalaire'=>$cantcalaire
);


//MIRILLAS
$mirillas = array(
    'totalmirillasecp'=>$totalmirillasecp,
    'totalmirillasut'=> $totalmirillasut,
    'totalmirillasecpeje'=>$totalmirillasecpeje,
    'totalmirillasuteje'=>$totalmirillasuteje,
    'totalfirmas'=>$totalmirillasecp+$totalmirillasut,
    'totalfirmaseje'=>$totalmirillasecpeje + $totalmirillasuteje,
    'cantmirillas'=>$cantmirillas
);


//QUEMADOR
$quemador = array(
    'totalquemadorecp'=>$totalquemadorecp,
    'totalquemadorut'=> $totalquemadorut,
    'totalquemadorecpeje'=>$totalquemadorecpeje,
    'totalquemadoruteje'=>$totalquemadoruteje,
    'totalfirmas'=>$totalquemadorecp+$totalquemadorut,
    'totalfirmaseje'=>$totalquemadorecpeje + $totalquemadoruteje,
    'cantquemador'=>$cantquemador
);

//VÁLVULAS
$valvulas = array(
    'totalvalvulasecp'=>$totalvalvulasecp,
    'totalvalvulasut'=> $totalvalvulasut,
    'totalvalvulasecpeje'=>$totalvalvulasecpeje,
    'totalvalvulasuteje'=>$totalvalvulasuteje,
    'totalfirmas'=>$totalvalvulasecp+$totalvalvulasut,
    'totalfirmaseje'=>$totalvalvulasecpeje + $totalvalvulasuteje,
    'cantvalvulas'=>$cantvalvulas
);


//VÁLVULAS SEGURIDAD
$valseg = array(
    'totalvalsegecp'=>$totalvalsegecp,
    'totalvalsegut'=> $totalvalsegut,
    'totalvalsegecpeje'=>$totalvalsegecpeje,
    'totalvalseguteje'=>$totalvalseguteje,
    'totalfirmas'=>$totalvalsegecp+$totalvalsegut,
    'totalfirmaseje'=>$totalvalsegecpeje + $totalvalseguteje,
    'cantvalseg'=>$cantvalseg
);



$totalequipos = $canttamborvapor + $canttamborlodos  + $cantdesmant +$cantbancoprincipal + $cantintercambiadores + $canthornos + $cantparedpiso + $cantparedpantalla  + $cantparedptecho + $cantparedquema + $cantsobrecal + $cantriser + $cantcalaire + $cantmirillas + $cantquemador + $cantvalvulas + $cantvalseg;

$totalitalcoplan = $totaltamborvaporut + $totaltamborlodosut + $totaldesmantut + $totalbancoprincipalut + $totalinterut + $totalhornout + $totalparedpisout + $totalparedpantallaut + $totalparedtechout + $totalparedquemaut + $totalsobrecalut + $totalriserut + $totalcalaireut + $totalmirillasut + $totalquemadorut + $totalvalvulasut + $totalvalsegut;

$totalecoplan = $totaltamborvaporecp + $totaltamborlodosecp + $totaldesmantecp + $totalbancoprincipalecp + $totalinterecp + $totalhornoecp + $totalparedpisoecp + $totalparedpantallaecp + $totalparedtechoecp + $totalparedquemaecp + $totalsobrecalecp + $totalriserecp + $totalcalaireecp + $totalmirillasecp + $totalquemadorecp + $totalvalvulasecp + $totalvalsegecp;

$totalitalcoeje = $totaltamborvaporuteje + $totaltamborlodosuteje + $totaldesmantuteje + $totalbancoprincipaluteje + $totalinteruteje + $totalhornouteje + $totalparedpisouteje + $totalparedpantallauteje + $totalparedtechouteje + $totalparedquemauteje + $totalsobrecaluteje + $totalriseruteje + $totalcalaireuteje + $totalmirillasuteje + $totalquemadoruteje + $totalvalvulasuteje + $totalvalseguteje;

$totalecoeje = $totaltamborvaporeceje + $totaltamborlodoseceje + $totaldesmantecpeje + $totalbancoprincipalecpeje + $totalinterecpeje + $totalhornoecpeje + $totalparedpisoecpeje + $totalparedpantallaecpeje + $totalparedtechoecpeje + $totalparedquemaecpeje + $totalsobrecalecpeje + $totalriserecpeje + $totalcalaireecpeje + $totalmirillasecpeje + $totalquemadorecpeje + $totalvalvulasecpeje + $totalvalsegecpeje;

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
    'hornos'=>$hornos,
    'paredpiso'=>$paredpiso,
    'paredpantalla'=>$paredpantalla,
    'paredtecho'=>$paredtecho,
    'paredquemadores'=>$paredquemadores,
    'sobrecalentador'=>$sobrecalentador,
    'riser'=>$riser,
    'calaire'=>$calaire,
    'mirillas'=>$mirillas,
    'quemador'=>$quemador,
    'valvulas'=>$valvulas,
    'valseg'=>$valseg,
    'banco'=>$banco,
    'desmant'=>$desmant,
    'tamborvapor'=>$tamborvapor,
    'tamborlodos'=>$tamborlodos,
    'consolidado'=>$consolidado
);

echo json_encode($datos);
