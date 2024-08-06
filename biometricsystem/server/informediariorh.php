<meta charset="utf-8" />
<?php 
session_start();//Esto debes poner siempre que un fichero vallas a utilizar las $_SESSION

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


include("conectar.php");
$conexion=conectar();

$fecha = $_GET["fecha"];


//Inicio de exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=rep_diario_turnos_unificado_$fecha.xls"); //Indica el nombre del archivo resultante
header("Pragma: no-cache");
header("Expires: 0");
echo '<table border="1">
          <thead>
            <tr>
                <td colspan="14">
                    <h4><center><b>REPORTE DIARIO - CONTROL DE TURNOS UNIFICADO - FECHA: '.$fecha.' </b></center></h4>
                </td>
            </tr>
            <th>No.</th>
            <th>Contrato</th>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Empresa</th>
            <th>Presente</th>
            <th>Vacaciones/Incapacidad</th>
            <th>Cargo</th>
            <th>ODS</th>
            <th>Frente de trabajo</th>
            <th>Turno</th>
            <th>Origen Pago</th>
            <th>Jornada</th>
            <th>HH</th>
            <th>Concepto</th>
          </thead>';

            $query = "SELECT * FROM trabajadores Where estado = 'Activo' and fingreso <= '$fecha'";
            $eje = mysqli_query($conexion, $query);

            $item = 1;
            
            while($row = mysqli_fetch_object($eje)){

                $id = $row->id;
                $doc = $row->cedula;

                $sql = "SELECT * FROM marcaciones Where doc = '$id' AND fecha = '$fecha' AND tipo = 'Entrada'";
                $exito = mysqli_query($conexion, $sql);

                $enc = mysqli_num_rows($exito);


                if($enc != 0){

                    $presente = 'X';
                    $concepto = 'PRESENTE';

                }else{
                    $presente = ' ';

                    $sql2 = "SELECT * FROM novepersonal Where doc = '$doc'";
                    $exito2 = mysqli_query($conexion, $sql2);
    
                    $enc2 = mysqli_num_rows($exito2);

                    if($enc2 != 0){
                        $obj = mysqli_fetch_object($exito2);
                        $concepto = $obj->novedad;
                    }else{
                        $concepto = '';
                    }

                }

                    
                    $doc = $row->cedula;
                    $id = $row->id;
                    $nombres = $row->nombres . ' ' . $row->apellidos;
                    $cargo = $row->cargo;
                    $turno = $row->turno;

                    $buscar = "SELECT * FROM codturnos WHERE turno='$turno'";
                    $ejeb = mysqli_query($conexion, $buscar);
                    $fila = mysqli_fetch_object($ejeb);

                    $jornada = $fila->entrada . ' - ' . $fila->salida;
                    
                    
                    echo '<tr>
                        <td>'.$item.'</td>
                        <td>'.$row->contrato.'</td>
                        <td>'.$doc.'</td>
                        <td>'.$nombres.'</td>
                        <td>'.$row->empresa.'</td>
                        <td>'.$presente.'</td>
                        <td></td>
                        <td>'.$row->cargo.'</td>
                        <td>'.$row->ods.'</td>
                        <td>'.$row->frente.'</td>
                        <td>'.$row->turno.'</td>
                        <td>'.$row->acargo.'</td>
                        
                        <td>'.$jornada.'</td>
                        <td> '.$fila->th.' </td>
                        <td> '.$concepto.' </td>
                    </tr>
                    ';

                
                $item++;
                
            } 

 ?>

