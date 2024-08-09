<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


//se buscan los productos existentes
$sql="SELECT * FROM users order by name";
$exito=mysqli_query($conexion, $sql);
$totprod=mysqli_num_rows($exito);

while ($row = mysqli_fetch_object($exito)){
    
    $datos[] = array(
        'id' => $row->id,
        'fecha_r' => $row->fecha_r,
        'user' => $row->user,
        'clave' => $row->clave,
        'name' => $row->name,
        'cargo' => $row->cargo,
        'nivel' => $row->nivel,
        'email' => $row->email,
        'estado' => $row->estado
    );

}  
echo json_encode($datos);
?>