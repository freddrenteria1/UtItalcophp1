<?php 
	header('Access-Control-Allow-Origin: *');
	
	include("conectar.php");
      $conexion=conectar();
      
    
        
            $cel = '3202876690';
           

            $celenviar = '57' . $cel; 

            $mensaje ="UT Italco ha reprogramado su calificación de soldadura para el lunes 08:00 AM";

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
            
        
               
	
	echo 'hecho';
?>