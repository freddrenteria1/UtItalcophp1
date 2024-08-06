<?php 
	header('Access-Control-Allow-Origin: *');
	 
       
            

            $cel = '573154245920'; 

            $mensaje = 'Mensaje UT Italco ';

            $texto = $mensaje;

            $auth_basic = base64_encode("programador@tcrapp.online:e95NHj6WTLWDTzWscCMYnJ98Pl3qdjAh");
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.labsmobile.com/json/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => '{"message":"'.$texto.'", "tpoa":"Sender","recipient":[{"msisdn":"'.$cel.'"}]}',
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