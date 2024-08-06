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
            <th>Documento</th>
            <th>Clase</th>
            <th>Modo</th>
            <th>Tipo</th>
            <th>Serial de tarjeta No</th>
            <th>Resultado</th>
            <th>Propiedad</th>
            <th>Dispositivo externo</th>
            <th>Coordinar</th>
          </thead><tbody>';

            $sql = "SELECT marcaciones.doc, marcaciones.fecha, marcaciones.hora, marcaciones.tipo, marcaciones.terminal, trabajadores.id, trabajadores.cedula, trabajadores.nombres, trabajadores.apellidos FROM marcaciones INNER JOIN trabajadores ON marcaciones.doc = trabajadores.id Where fecha between '$finicio' AND '$ffin'";
            $exito = mysqli_query($conexion, $sql);
          
            while($row = mysqli_fetch_object($exito)){

                $idbio = $row->doc;
 

                    
                    $obj = mysqli_fetch_object($eje);

                    $doc = $row->cedula;
                    $id = $row->id;
                    $nombres = $row->nombres . ' ' . $row->apellidos;
                    
                    $hora = $row->hora;
                    $fecha = $row->fecha;
                    
                    if($row->tipo == 'Entrada'){
                        $modo = "Inicio";
                    }

                    if($row->tipo == 'Salida'){
                        $modo = "Fin";
                    }  
                    
                    $html .=  '<tr>
                        <td>'.$fecha.'</td>
                        <td>'.$hora.'</td>
                        <td>'.$row->terminal.'</td>
                        <td>'.$id.'</td>
                        <td>'.$nombres.'</td>
                        <td>'.$doc.'</td>
                        <td>Usuario</td>
                        <td>'.$modo.'</td>
                        <td>1: N</td>
                        <td></td>
                        <td>Éxito</td>
                        <td>1100</td>
                        <td></td>
                        <td>0 / 0</td>
                    </tr>
                    ';

                
            } 

            $html .=  '</tbody></table>';
            
//Inicio de exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=marcaciones_$fecha.xlsx"); //Indica el nombre del archivo resultante
header("Pragma: no-cache");
header("Expires: 0");

echo $html;


 ?>

