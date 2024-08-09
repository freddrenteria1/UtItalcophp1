<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
// $fecha=date("Y-m-d H:i:s");
$fecha=date("Y-m-d");

$user = $_POST["user"];

$arrayAnexoB = $_POST["arrayAnexoB"];

// Ruta donde se guardar?n las im?genes
$directorio = 'archivos/';

// Recibo los datos de la imagen
$nombre1 = $_FILES['filea1']['name'];
$tipo1 = $_FILES['filea1']['type'];
$tamano1 = $_FILES['filea1']['size'];

if(isset($_FILES['filea1'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['filea1']['tmp_name'],$directorio.$nombre1);
    $archivo1=$nombre1;
}else{
    $archivo1 = '';
}

// Recibo los datos de la imagen
$nombre2 = $_FILES['filea2']['name'];
$tipo2 = $_FILES['filea2']['type'];
$tamano2 = $_FILES['filea2']['size'];

if(isset($_FILES['filea2'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['filea2']['tmp_name'],$directorio.$nombre2);
    $archivo2=$nombre2;
}else{
    $archivo2 = '';
}

// Recibo los datos de la imagen
$nombre3 = $_FILES['filea3']['name'];
$tipo3 = $_FILES['filea3']['type'];
$tamano3 = $_FILES['filea3']['size'];

if(isset($_FILES['filea3'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['filea3']['tmp_name'],$directorio.$nombre3);
    $archivo3=$nombre3;
}else{
    $archivo3 = '';
}

// Recibo los datos de la imagen
$nombre4 = $_FILES['filea4']['name'];
$tipo4 = $_FILES['filea4']['type'];
$tamano4 = $_FILES['filea4']['size'];

if(isset($_FILES['filea4'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['filea4']['tmp_name'],$directorio.$nombre4);
    $archivo4=$nombre4;
}else{
    $archivo4 = '';
}

// Recibo los datos de la imagen
$nombre5 = $_FILES['filea5']['name'];
$tipo5 = $_FILES['filea5']['type'];
$tamano5 = $_FILES['filea5']['size'];

if(isset($_FILES['filea5'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['filea5']['tmp_name'],$directorio.$nombre5);
    $archivo5=$nombre5;
}else{
    $archivo5 = '';
}

// Recibo los datos de la imagen
$nombre6 = $_FILES['filea6']['name'];
$tipo6 = $_FILES['filea6']['type'];
$tamano6 = $_FILES['filea6']['size'];

if(isset($_FILES['filea6'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['filea6']['tmp_name'],$directorio.$nombre6);
    $archivo6=$nombre6;
}else{
    $archivo6 = '';
}

// Recibo los datos de la imagen
$nombre7 = $_FILES['filea7']['name'];
$tipo7 = $_FILES['filea7']['type'];
$tamano7 = $_FILES['filea7']['size'];

if(isset($_FILES['filea7'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['filea7']['tmp_name'],$directorio.$nombre7);
    $archivo7=$nombre7;
}else{
    $archivo7 = '';
}

// Recibo los datos de la imagen
$nombre8 = $_FILES['filea8']['name'];
$tipo8 = $_FILES['filea8']['type'];
$tamano8 = $_FILES['filea8']['size'];

if(isset($_FILES['filea8'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['filea8']['tmp_name'],$directorio.$nombre8);
    $archivo8=$nombre8;
}else{
    $archivo8 = '';
}

//GUARDA LA ENTRADA
$msn = 'Ok';

//verifica si el user ya existe y actualiza los campos

$consulta = "SELECT * FROM anexob WHERE user = '$user'";
$ejec = mysqli_query($conexion, $consulta);

$enc = mysqli_num_rows($ejec);

$arrayAnexoB = json_decode($arrayAnexoB);


if($enc == 0){
    $a1=$arrayAnexoB[0]->A1;
    $oba1=$arrayAnexoB[0]->obs;

    $sql = "INSERT INTO anexob VALUES('', 'A1', '$a1','$oba1', '$archivo1','$user')";
    $guardar = mysqli_query($conexion, $sql);

    $a1=$arrayAnexoB[1]->A2;
    $oba1=$arrayAnexoB[1]->obs;

    $sql = "INSERT INTO anexob VALUES('', 'A2', '$a1','$oba1', '$archivo2','$user')";
    $guardar = mysqli_query($conexion, $sql);

    $a1=$arrayAnexoB[2]->A3;
    $oba1=$arrayAnexoB[2]->obs;

    $sql = "INSERT INTO anexob VALUES('', 'A3', '$a1','$oba1', '$archivo3','$user')";
    $guardar = mysqli_query($conexion, $sql);

    $a1=$arrayAnexoB[3]->A4;
    $oba1=$arrayAnexoB[3]->obs;

    $sql = "INSERT INTO anexob VALUES('', 'A4', '$a1','$oba1', '$archivo4','$user')";
    $guardar = mysqli_query($conexion, $sql);

    $a1=$arrayAnexoB[4]->A5;
    $oba1=$arrayAnexoB[4]->obs;

    $sql = "INSERT INTO anexob VALUES('', 'A5', '$a1','$oba1', '$archivo5','$user')";
    $guardar = mysqli_query($conexion, $sql);

    $a1=$arrayAnexoB[5]->A6;
    $oba1=$arrayAnexoB[5]->obs;

    $sql = "INSERT INTO anexob VALUES('', 'A6', '$a1','$oba1', '$archivo6','$user')";
    $guardar = mysqli_query($conexion, $sql);

    $a1=$arrayAnexoB[6]->A7;
    $oba1=$arrayAnexoB[6]->obs;

    $sql = "INSERT INTO anexob VALUES('', 'A7', '$a1','$oba1', '$archivo7','$user')";
    $guardar = mysqli_query($conexion, $sql);

    $a1=$arrayAnexoB[7]->A8;
    $oba1=$arrayAnexoB[7]->obs;

    $sql = "INSERT INTO anexob VALUES('', 'A8', '$a1','$oba1', '$archivo8','$user')";
    $guardar = mysqli_query($conexion, $sql);

    
}else{
    $a1=$arrayAnexoB[0]->A1;
    $oba1=$arrayAnexoB[0]->obs;

    if($archivo1 != ""){
        $sql = "UPDATE anexob SET estado = '$a1', archivo='$archivo1', observacion='$oba1' WHERE user='$user' AND item='A1'";
        $guardar = mysqli_query($conexion, $sql);
    }else{
        $sql = "UPDATE anexob SET estado = '$a1', observacion='$oba1' WHERE user='$user' AND item='A1'";
        $guardar = mysqli_query($conexion, $sql);
    }

    $a1=$arrayAnexoB[1]->A2;
    $oba1=$arrayAnexoB[1]->obs;

    if($archivo2 != ""){
        $sql = "UPDATE anexob SET estado = '$a1', observacion='$oba1', archivo='$archivo2' WHERE user='$user' AND item='A2'";
        $guardar = mysqli_query($conexion, $sql);
    }else{
        $sql = "UPDATE anexob SET estado = '$a1', observacion='$oba1' WHERE user='$user' AND item='A2'";
        $guardar = mysqli_query($conexion, $sql);
    }

    $a1=$arrayAnexoB[2]->A3;
    $oba1=$arrayAnexoB[2]->obs;

    if($archivo3 != ""){
        $sql = "UPDATE anexob SET estado = '$a1', observacion='$oba1', archivo='$archivo3' WHERE user='$user' AND item='A3'";
        $guardar = mysqli_query($conexion, $sql);
    }else{
        $sql = "UPDATE anexob SET estado = '$a1', observacion='$oba1' WHERE user='$user' AND item='A3'";
        $guardar = mysqli_query($conexion, $sql);
    }

    $a1=$arrayAnexoB[3]->A4;
    $oba1=$arrayAnexoB[3]->obs;

    if($archivo4 != ""){
        $sql = "UPDATE anexob SET estado = '$a1', observacion='$oba1', archivo='$archivo4' WHERE user='$user' AND item='A4'";
        $guardar = mysqli_query($conexion, $sql);
    }else{
        $sql = "UPDATE anexob SET estado = '$a1', observacion='$oba1' WHERE user='$user' AND item='A4'";
        $guardar = mysqli_query($conexion, $sql);
    }

    $a1=$arrayAnexoB[4]->A5;
    $oba1=$arrayAnexoB[4]->obs;

    if($archivo5 != ""){
        $sql = "UPDATE anexob SET estado = '$a1', observacion='$oba1', archivo='$archivo5' WHERE user='$user' AND item='A5'";
        $guardar = mysqli_query($conexion, $sql);
    }else{
        $sql = "UPDATE anexob SET estado = '$a1', observacion='$oba1' WHERE user='$user' AND item='A5'";
        $guardar = mysqli_query($conexion, $sql);
    }

    $a1=$arrayAnexoB[5]->A6;
    $oba1=$arrayAnexoB[5]->obs;

    if($archivo6 != ""){
        $sql = "UPDATE anexob SET estado = '$a1', observacion='$oba1', archivo='$archivo6' WHERE user='$user' AND item='A6'";
        $guardar = mysqli_query($conexion, $sql);
    }else{
        $sql = "UPDATE anexob SET estado = '$a1', observacion='$oba1' WHERE user='$user' AND item='A6'";
        $guardar = mysqli_query($conexion, $sql);
    }

    $a1=$arrayAnexoB[6]->A7;
    $oba1=$arrayAnexoB[6]->obs;

    if($archivo7 != ""){
        $sql = "UPDATE anexob SET estado = '$a1', observacion='$oba1', archivo='$archivo7' WHERE user='$user' AND item='A7'";
        $guardar = mysqli_query($conexion, $sql);
    }else{
        $sql = "UPDATE anexob SET estado = '$a1', observacion='$oba1' WHERE user='$user' AND item='A7'";
        $guardar = mysqli_query($conexion, $sql);
    }

    $a1=$arrayAnexoB[7]->A8;
    $oba1=$arrayAnexoB[7]->obs;

    if($archivo8 != ""){
        $sql = "UPDATE anexob SET estado = '$a1', observacion='$oba1', archivo='$archivo8' WHERE user='$user' AND item='A8'";
        $guardar = mysqli_query($conexion, $sql);
    }else{
        $sql = "UPDATE anexob SET estado = '$a1', observacion='$oba1' WHERE user='$user' AND item='A8'";
        $guardar = mysqli_query($conexion, $sql);
    }

}

$datos = array(
    'msn'=>$msn,
    'datos'=>$arrayAnexoB
);

echo json_encode($datos);