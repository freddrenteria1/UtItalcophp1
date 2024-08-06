<meta charset="utf-8" />
<?php 
session_start();//Esto debes poner siempre que un fichero vallas a utilizar las $_SESSION

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$FECHA_ACTUAL=$fecha;

$ods = $_GET["ods"];

include("conectar.php");
$conexion=conectar();


//Inicio de exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=exceBiometrico$FECHA_ACTUAL.xls"); //Indica el nombre del archivo resultante
header("Pragma: no-cache");
header("Expires: 0");
echo '<table border="1">
          <thead>
            <th>ID de Usuario</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Departmento</th>
          </thead>';

 $cons="SELECT * FROM trabajadores WHERE ods='$ods'";
$ejecutar=mysqli_query($conexion, $cons);
          $sumtotal=0;
          while ($fila = mysqli_fetch_array($ejecutar)){ 
            $idtrab=$fila["id"];
            $nombre=$fila["nombres"];
            $apellidos=$fila["apellidos"];
            $dep=$ods;

            echo '<tr>
                <td>'.$idtrab.'</td>
                <td>'.$nombre.'</td>
                <td>'.$apellidos.'</td>
                <td>'.$dep.'</td>
            </tr>
            ';
          } 

 ?>

