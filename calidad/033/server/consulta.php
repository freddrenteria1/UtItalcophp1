<?php
include("conectar.php"); 
$conexion=conectar();

$sql="SHOW COLUMNS FROM `os80`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os80 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os80 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

echo 'Total Firmas Ecopetrol: ' . $sumfirmaec . '<br>';
echo 'Total Firmas Italco: ' . $sumfirmaut . '<br>';

?>