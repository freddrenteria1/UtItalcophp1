<?php 
header('Content-type: application/json');
	header('Access-Control-Allow-Origin: *');
	
	include("conectar.php");
      $conexion=conectar();

      date_default_timezone_set("America/Bogota");
$fechaAct=date("Y-m-d");
      
     
    
	$sel="SELECT * FROM testcovidpcr order by nombres";
	$busq=mysqli_query($conexion, $sel);
	$cont=mysqli_num_rows($busq);

    $datos=array();
    
	if ($cont!=0){

        while($obj = mysqli_fetch_object($busq)){

        $doc = $obj->doc;

        $query = "SELECT * FROM personalitalco Where doc ='$doc'";
        $eje = mysqli_query($conexion, $query);

        $fila = mysqli_fetch_object($eje);

        $ods = $fila->ods;
        $fechanac = $fila->nacimiento;
        $edad = $fechaAct - $fechanac;
        $cargo = $fila->cargo;
        $tipo = $fila->tipopersonal;

        $datos[] = array(
            'nombres'=>$obj->nombres,
            'doc'=>$obj->doc,
            'cargo'=>$cargo,
            'ods'=>$ods,
            'tipo'=>$tipo,
            'edad'=>$edad,
            'covidpos'=>$obj->covidpos,
            'fechacovid'=>$obj->fechacovid,
            'vaccovid'=>$obj->vaccovid,
            'dosisvac'=>$obj->dosisvac,
            'fechapcr'=>$obj->fechapcr,
            'fotocarnet'=>$obj->fotocarnet
        );

        }
               
	}



	
    echo json_encode($datos);