<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
// $fecha=date("Y-m-d H:i:s");
$fecha=date("Y-m-d");

$user = $_POST["user"];
$actividad = $_POST["actividad"];
$tipopersona = $_POST["tipopersona"];
$regimen = $_POST["regimen"];
$actprincipal = $_POST["actprincipal"];
$grancontri = $_POST["grancontri"];
$resgrancontri = $_POST["resgrancontri"];
$fecharesgrancontri = $_POST["fecharesgrancontri"];
$autorete = $_POST["autorete"];
$resautorete = $_POST["resautorete"];
$fecharesautorete = $_POST["fecharesautorete"];
$excentorete = $_POST["excentorete"];
$resexcentorete = $_POST["resexcentorete"];
$fecharesexcentorete = $_POST["fecharesexcentorete"];
$excentoica = $_POST["excentoica"];
$telnombcont = $_POST["telnombcont"];
$resexcentoica = $_POST["resexcentoica"];
$fecharesexcentoica = $_POST["fecharesexcentoica"];
$ciiu = $_POST["ciiu"];
$fechaciiu = $_POST["fechaciiu"];
$tarifaica = $_POST["tarifaica"];
$ciudadtarifaica = $_POST["ciudadtarifaica"];

//GUARDA LA ENTRADA
$msn = 'Ok';

//verifica si el user ya existe y actualiza los campos

$consulta = "SELECT * FROM infotributaria WHERE user = '$user'";
$ejec = mysqli_query($conexion, $consulta);

$enc = mysqli_num_rows($ejec);

if($enc == 0){
    $sql = "INSERT INTO infotributaria VALUES('','$user','$actividad','$tipopersona','$regimen','$actprincipal','$grancontri','$resgrancontri','$fecharesgrancontri','$autorete','$resautorete','$fecharesautorete','$excentorete','$resexcentorete','$fecharesexcentorete','$excentoica','$resexcentoica','$fecharesexcentoica','$ciiu','$fechaciiu','$tarifaica','$ciudadtarifaica')";
    $guardar = mysqli_query($conexion, $sql);

    if(!$guardar){
        $msn = mysqli_error($conexion);
    }
}else{
    $sql = "UPDATE infotributaria SET tipoact='$actividad', tipopersona='$tipopersona', regimen='$regimen', actprincipal='$actprincipal', grancontri='$grancontri', resgran='$resgrancontri', fecharesgran='$fecharesgrancontri', autoretenedor='$autorete', resauto='$resautorete', fecharesauto='$fecharesautorete', excentorete='$excentorete', resexcentorete='$resexcentorete', fecharesexcentorete='$fecharesexcentorete', excentoica='$excentoica', resexcentoica='$resexcentoica', fecharesexcentoica='$fecharesexcentoica', ciiu='$ciiu', fechaciiu='$fechaciiu', tarifaica='$tarifaica', ciudadica='$ciudadtarifaica' WHERE user='$user'";
    $guardar = mysqli_query($conexion, $sql);

    if(!$guardar){
        $msn = mysqli_error($conexion);
    }
}

$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);