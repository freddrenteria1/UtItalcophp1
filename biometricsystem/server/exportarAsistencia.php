<meta charset="utf-8" />
<?php 
session_start();//Esto debes poner siempre que un fichero vallas a utilizar las $_SESSION

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


include("conectar.php");
$conexion=conectar();

$fechab = $_GET["fecha"];
$ods = $_GET["ods"];


//Inicio de exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=personalDiario_$fecha.xls"); //Indica el nombre del archivo resultante
header("Pragma: no-cache");
header("Expires: 0");
echo '<table border="1">
          <thead>
            <th>CONTRATO</th>
            <th>CEDULA</th>
            <th>NOMBRES Y APELLIDOS</th>
            <th>CARGO</th>
            <th>LUGAR DE TRAB</th>
            <th>FECHA INICIO</th>
            <th>FECHA TRABAJO</th>
            <th>FECHA FIN</th>
            <th>A CARGO DE QUIEN</th>
            <th>SISTEMA PRECIO</th>
            <th>TIPO NOMINA</th>
            <th>DETALLES PAGO</th>
            <th>FRENTE DE TRABAJO</th>
            <th>SUPERVISOR</th>
            <th>JORNADA</th>
            <th>TURNO</th>
            <th>HORAS HOMBRE</th>
            <th>OBSERVACIONES</th>


          </thead>';

          $query = "SELECT * FROM trabajadores Where ods='$ods' and estado='Activo' order by frentetrab";
          $eje = mysqli_query($conexion, $query);

          
            while($row = mysqli_fetch_object($eje)){
                $doc = $row->cedula;
                $id = $row->id;
                $nombres = $row->nombres . ' ' . $row->apellidos;
                $cargo = $row->cargo;
                $turno = $row->turno;

                $fsalida = $row->fsalida;

                if($fsalida == '0000-00-00'){
                    $fsalida = '';
                }

                $sql = "SELECT * FROM marcaciones Where fecha='$fechab' And doc='$id'";
                $exito = mysqli_query($conexion, $sql);

                $enc = mysqli_num_rows($exito);

                if($enc != 0){
                    
                    $sql1 = "SELECT * FROM codturnos WHERE turno = '$turno'";
                    $eje1 = mysqli_query($conexion, $sql1);
                    $row1 = mysqli_fetch_object($eje1);
                
                    $horaingreso = $row1->entrada;
                    $horasalida = $row1->salida;
                    $hh = $row1->th;
    
                    $jornada = $horaingreso . ' A ' . $horasalida;

                }else{
                    $horaingreso = $row1->entrada;
                    $horasalida = $row1->salida;
                    $hh = '';
    
                    $jornada = '';
                }

               

                $sql2 = "SELECT * FROM novepersonal Where ods='$ods' And doc='$doc'";
                $exito2 = mysqli_query($conexion, $sql2);

                $enc2 = mysqli_num_rows($exito2);

                if($enc2 != 0){
                    $obj2 = mysqli_fetch_object($exito2);
                    $novedad = $obj2->novedad;
                }else{
                    $novedad = '';
                }

                
                echo '<tr>
                    <td>'.$row->contrato.'</td>
                    <td>'.$row->cedula.'</td>
                    <td>'.$nombres.'</td>
                    <td>'.$cargo.'</td>
                    <td>'.$row->lugartrab.'</td>
                    <td>'.$row->fingreso.'</td>
                    <td>'.$fechab.'</td>
                    <td>'.$fsalida.'</td>
                    <td>'.$row->acargo.'</td>
                    <td>'.$row->sistemaprecio.'</td>
                    <td>'.$row->tiponomina.'</td>
                    <td>'.$row->detpago.'</td>
                    <td>'.$row->frentetrab.'</td>
                    <td>'.$row->supervisor.'</td>
                    <td>'.$jornada.'</td>
                    <td>'.$turno.'</td>
                    <td>'.$hh.'</td>
                    <td>'.$novedad.'</td>
                </tr>
                ';

            }

           
          

 ?>

