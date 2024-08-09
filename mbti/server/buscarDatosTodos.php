<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


//SE VERIFICA QUE EL ID NO ESTÉ REGISTRADO EN LAS ENTRADAS

$query = "SELECT * FROM pruebas ORDER BY fecha_e";
$eje = mysqli_query($conexion, $query);
$cont = mysqli_num_rows($eje);

$msn = 'Ok';



    while($obj = mysqli_fetch_object($eje)){

        $idreg = $obj->id;
        $link = 'https://utitalco.com/mbti/index.html?doc='.$obj->doc.'&id='.$idreg;
        
            $pruebas[] = array(
                'id'=>$obj->id,
                'fecha_a'=>$obj->fecha_a,
                'fecha_e'=>$obj->fecha_e,
                'nombre'=>$obj->nombre,
                'doc'=>$obj->doc,
                'edad'=>$obj->edad,
                'fecha_n'=>$obj->fecha_n,
                'cargo'=>$obj->cargo,
                'foto'=>$obj->foto,
                'parte1'=>$obj->parte1,
                'parte2'=>$obj->parte2,
                'parte3'=>$obj->parte3,
                'parte4'=>$obj->parte4,
                'resultados'=>$obj->resultados,
                'link'=>$link  
            );

    }

  
    

$query = "SELECT * FROM perfiles ";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){

        
    $pefiles[] = array(
        'id'=>$obj->id,
        'perfil'=>$obj->perfil,
        'info'=>$obj->info       
    );

}

$datos = array(
    'pruebas'=>$pruebas,
    'perfiles'=>$pefiles
);

echo json_encode($datos);