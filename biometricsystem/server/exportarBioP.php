<meta charset="utf-8" />
<?php 
session_start();//Esto debes poner siempre que un fichero vallas a utilizar las $_SESSION

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$FECHA_ACTUAL=$fecha;

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

          $sql = "SELECT * FROM programados Where bio='NO'";
          $eje = mysqli_query($conexion, $sql);

          $sumtotal=0;

          while ($obj = mysqli_fetch_object($eje)){ 
            

            $id = $obj->id;
            $doc = $obj->doc;

            $cons="SELECT * FROM trabajadores WHERE cedula='$doc'";
            $ejecutar=mysqli_query($conexion, $cons);

            $fila = mysqli_fetch_array($ejecutar);

            $idtrab=$fila["id"];
            $nombre=$fila["nombres"];
            $apellidos=$fila["apellidos"];
            $dep='21';

            $actp = "UPDATE programados SET bio='SI' Where id=$id";
            $ejep = mysqli_query($conexion, $actp);

            echo '<tr>
                <td>'.$idtrab.'</td>
                <td>'.$nombre.'</td>
                <td>'.$apellidos.'</td>
                <td>'.$dep.'</td>
            </tr>
            ';
          } 

 ?>

