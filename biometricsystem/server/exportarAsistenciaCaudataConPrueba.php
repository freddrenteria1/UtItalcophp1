<meta charset="utf-8" />
<?php 
session_start();//Esto debes poner siempre que un fichero vallas a utilizar las $_SESSION

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


include("conectar.php");
$conexion=conectar();

$finicio = $_GET["finicio"];
$ffin = $_GET["ffin"];

$html = '';


$html .= '<table border="1">
          <thead>
            <th>Fecha</th>
            <th>Hora</th>
            <th>ID de Terminal</th>
            <th>ID de usuario</th>
            <th>Nombre</th>
            <th>Modo</th>

          </thead><tbody>';

            $sql = "SELECT * FROM marcaciones Where fecha between '$finicio' AND '$ffin'";
            $exito = mysqli_query($conexion, $sql);
          
            while($row = mysqli_fetch_object($exito)){

                $idbio = $row->doc;
                    
                    $hora = $row->hora;
                    $fecha = $row->fecha;
                    $nombres=$row->nombre;
                    
                    if($row->tipo == 'Entrada'){
                        $modo = "Inicio";
                    }

                    if($row->tipo == 'Salida'){
                        $modo = "Fin";
                    }  
                    
                    $html .= '<tr>
                        <td>'.$fecha.'</td>
                        <td>'.$hora.'</td>
                        <td>'.$row->terminal.'</td>
                        <td>'.$idbio.'</td>
                        <td>'.$nombres.'</td>
                        <td>'.$modo.'</td>
                    </tr>
                    ';

                
                
                
            } 

            $html .=  '</tbody></table>';

            //Inicio de exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=marcaciones_$fecha.xls"); //Indica el nombre del archivo resultante
header("Pragma: no-cache");
header("Expires: 0");
    
    echo $html;

 ?>

