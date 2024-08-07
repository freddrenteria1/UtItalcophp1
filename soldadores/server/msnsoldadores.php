<?php 
	header('Access-Control-Allow-Origin: *');
	
	include("conectar.php");
      $conexion=conectar();
      
    

	$sel="SELECT * FROM soldadores";
	$busq=mysqli_query($conexion, $sel);
	$cont=mysqli_num_rows($busq);

    $datos=array();
    
	if ($cont!=0){

        while ($obj = mysqli_fetch_object($busq)){
        
            $cel = $obj->celular;
           

            $celenviar = '57' . $cel; 

            $mensaje ="UT Italco lo invita a presentar prueba de calificación para soldadores. Regístrese aquí https://utitalco.com/soldadores/";

            $texto = $mensaje;

            $auth_basic = base64_encode("jairocruzprogramador@gmail.com:@Aa3142141645");
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.labsmobile.com/json/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => '{"message":"'.$texto.'", "tpoa":"Sender","recipient":[{"msisdn":"'.$celenviar.'"}]}',
                CURLOPT_HTTPHEADER => array(
                "Authorization: Basic ".$auth_basic,
                "Cache-Control: no-cache",
                "Content-Type: application/json"
                ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
        }

        
        
               
	}
	echo 'hecho';
?>