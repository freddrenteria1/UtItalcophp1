<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");



	
	if (empty($_POST['placa']) || empty($_POST['tipo']) || empty($_POST['marca']) || empty($_POST['modelo']) || 
        empty($_POST['capacidad'])  || empty($_POST['ultmant']) || empty($_POST['kiloultmant'])  || 
        empty($_POST['proxmant']) || empty($_POST['soatexp'])  || empty($_POST['soatvence']) || 
        empty($_POST['tecnoexp'])  || empty($_POST['tecnovence']) ){ 
	 
		$msn = 'Todos los campos son obligatorios.';

	} else {

        $placa = $_POST["placa"];
        $tipo = $_POST["tipo"];
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $capacidad = $_POST["capacidad"];
        $ultmant = $_POST["ultmant"];
        $kiloultmant = $_POST["kiloultmant"];
        $proxmant = $_POST["proxmant"];
        $soatexp = $_POST["soatexp"];
        $soatvence = $_POST["soatvence"];
        $tecnoexp = $_POST["tecnoexp"];
        $tecnovence = $_POST["tecnovence"];

        $query = mysqli_query($conexion, "SELECT * FROM vehiculos WHERE placa = '$placa' ");
		$result = mysqli_num_rows($query);

		if ($result > 0) {
			$alert = '<p class="msg_error">El vehiculo ya se encuentra regitrado.</p>';
		} else {

			$query_insert = mysqli_query($conexion, "INSERT INTO vehiculos(placa,tipo,marca,modelo,capacidad,ultmant,kiloultmant,proxmant,soatexp,soatvence,tecnoexp,tecnovence)
			    VALUES('$placa','$tipo','$marca','$modelo','$capacidad','$ultmant','$kiloultmant','$proxmant',' $soatexp',' $soatvence','$tecnoexp',' $tecnovence')");
			if ($query_insert) {
				 
				$msn = 'Ok';
			} else {
				$msn = mysqli_error($conexion);
			}
		}
	}


$datos = array(
	'msn'=>$msn
);

echo json_encode($datos);
