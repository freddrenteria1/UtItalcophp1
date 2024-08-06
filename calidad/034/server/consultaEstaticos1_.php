<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

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

            if($componentes[$i]->nombreecp != ""){
                $sumfirmaec++;
            }
           
        }

    }

   

}

//SUMAS DE CHIMENEA
$totalintereceje = $sumfirmaec;
$totalinteruteje = $sumfirmaut;


//consulta paredes laterales 3321
$totalhornoecp = 22;
$totalhornout = 42;

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
$totalparedpantallaecp = 6;
$totalparedpantallaut = 16;

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
$totalparedptechoecp = 7;
$totalparedptechout = 18;

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



$totalequipos = $cantintercambiadores + $canthornos + $cantparedpiso + $cantparedpantalla  + $cantparedptecho + $cantparedquema + $cantsobrecal + $cantriser + $cantcalaire + $cantmirillas + $cantquemador + $cantvalvulas + $cantvalseg;

$totalitalcoplan = $totalinterut + $totalhornout + $totalparedpisout + $totalparedpantallaut + $totalparedtechout + $totalparedquemaut + $totalsobrecalut + $totalriserut + $totalcalaireut + $totalmirillasut + $totalquemadorut + $totalvalvulasut + $totalvalsegut;

$totalecoplan = $totalinterecp + $totalhornoecp + $totalparedpisoecp + $totalparedpantallaecp + $totalparedtechoecp + $totalparedquemaecp + $totalsobrecalecp + $totalriserecp + $totalcalaireecp + $totalmirillasecp + $totalquemadorecp + $totalvalvulasecp + $totalvalsegecp;

$totalitalcoeje = $totalinteruteje + $totalhornouteje + $totalparedpisouteje + $totalparedpantallauteje + $totalparedtechouteje + $totalparedquemauteje + $totalsobrecaluteje + $totalriseruteje + $totalcalaireuteje + $totalmirillasuteje + $totalquemadoruteje + $totalvalvulasuteje + $totalvalseguteje;

$totalecoeje = $totalinterecpeje + $totalhornoecpeje + $totalparedpisoecpeje + $totalparedpantallaecpeje + $totalparedtechoecpeje + $totalparedquemaecpeje + $totalsobrecalecpeje + $totalriserecpeje + $totalcalaireecpeje + $totalmirillasecpeje + $totalquemadorecpeje + $totalvalvulasecpeje + $totalvalsegecpeje;

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
    'consolidado'=>$consolidado
);

echo json_encode($datos);
