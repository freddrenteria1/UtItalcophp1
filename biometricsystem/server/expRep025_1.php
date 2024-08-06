<meta charset="utf-8" />
<?php 
session_start();//Esto debes poner siempre que un fichero vallas a utilizar las $_SESSION

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


include("conectar.php");
$conexion=conectar();

$finicio = $_GET["finicio"];
$ffin = $_GET["ffin"];

// //Inicio de exportación en Excel
// header('Content-type: application/vnd.ms-excel');
// header("Content-Disposition: attachment; filename=marcaciones_$fecha.xls"); //Indica el nombre del archivo resultante
// header("Pragma: no-cache");
// header("Expires: 0");
echo '<table border="1">
          <thead>
            <th>CONTRATO</th>
            <th>DOCUMENTO</th>
            <th>NOMBRES</th>
            <th>CARGO</th>
            <th>TIPO NOMINA</th>
            <th>SIST  PRECIO</th>
            <th>A CARGO</th>
            <th>DET PAGO</th>
            <th>FECHA</th>
            <th>TURNO</th>
            <th>HHT</th>
            <th>HORA ENTRADA</th>
            <th>HORA SALIDA</th>
            <th>FRENTE</th>
            <th>GRUPO</th>
            <th>SUPERVISOR</th>
            <th>NOVEDAD</th>
            <th>ODS</th>
          </thead>';

          $query = "SELECT  rep025.contrato, rep025.doc, rep025.nombres, rep025.cargo, rep025.tiponomina, rep025.sistemaprecio, rep025.acargo, rep025.detallepago, rep025.fecha, rep025.turno, rep025.hht, rep025.frente, rep025.grupo, rep025.supervisor, rep025.novedad, rep025.ods, trabajadores.id, trabajadores.cedula FROM rep025  LEFT JOIN trabajadores ON rep025.doc = trabajadores.cedula   WHERE rep025.fecha between '$finicio' AND '$ffin'   ";
          $eje = mysqli_query($conexion, $query);

          
            while($row = mysqli_fetch_object($eje)){

               
                $doc = $row->doc;
                $fecha = $row->fecha;

                // echo 'Doc ' . $doc;
                // echo '<br>';

                // $query1="SELECT * FROM trabajadores WHERE cedula =  '$doc'";
                // $exito1=mysqli_query($conexion, $query1);

                // $filas = mysqli_fetch_object($exito1);

                $id = $row->id;

                // echo 'Id ' . $id;
                // echo '<br>';
               
                $sql = "SELECT hora FROM marcaciones Where doc='$id' AND fecha = '$fecha' AND tipo ='Entrada' ";
                $exito = mysqli_query($conexion, $sql);

                $encm = mysqli_num_rows($exito);
               

                if($encm != 0){
                    $rowm   = mysqli_fetch_object($exito);
                    $horae = $rowm->hora;
                }

                $sql = "SELECT hora FROM marcaciones Where doc='$id' AND fecha = '$fecha' AND tipo ='Salida' ";
                $exito = mysqli_query($conexion, $sql);

                $encm = mysqli_num_rows($exito);

                if($encm != 0){
                    $rowm   = mysqli_fetch_object($exito);
                    $horas = $rowm->hora;
                }
 
                        
                        echo '<tr>
                            <td>'.$row->contrato.'</td>
                            <td>'.$row->doc.'</td>
                            <td>'.$row->nombres.'</td>
                            <td>'.$row->cargo.'</td>
                            <td>'.$row->tiponomina.'</td>
                            <td>'.$row->sistemaprecio.'</td>
                            <td>'.$row->acargo.'</td>
                            <td>'.$row->detallepago.'</td>
                            <td>'.$row->fecha.'</td>
                            <td>'.$row->turno.'</td>
                            <td>'.$row->hht.'</td>
                            <td>'.$horae.'</td>
                            <td>'.$horas.'</td>
                            <td>'.$row->frente.'</td>
                            <td>'.$row->grupo.'</td>
                            <td>'.$row->supervisor.'</td>
                            <td>'.$row->novedad.'</td>
                            <td>'.$row->ods.'</td>
                            
                        </tr>
                        ';
    
                    
                }
                
            

 ?>

