<meta charset="utf-8" />
<?php
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM registro";
$exito=mysqli_query($conexion, $sql);

$cantusuarios = mysqli_num_rows($exito);

$html = '';

$html .= '<table border="1">
          <thead>
            <th>Fecha Registro</th>
            <th>Tipo Doc</th>
            <th>Documento</th>
            <th>Dpto Documento</th>
            <th>Munic. Documento</th>
            <th>Nombres</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>F. Nacimiento</th>
            <th>Nacionalidad</th>
            <th>Depto Nacimiento</th>
            <th>Munic. Nacimiento</th>
            <th>Domicilio</th>
            <th>Estado civil</th>
            <th>Genero</th>
            <th>Grupo Sanguíneo</th>
            <th>Número de hijos</th>
            <th>Cabeza de Familia</th>
            <th>Población Vulnerable</th>
            <th>Cargo Aspira</th>
            <th>Postulado</th>
          </thead><tbody>';

while($obj = mysqli_fetch_object($exito)){

    $doc = $obj->doc;

    $sql2="SELECT * FROM infobasica Where doc = '$doc'";
    $exito2=mysqli_query($conexion, $sql2);
    $enc2 = mysqli_num_rows($exito2);
    
    $row = mysqli_fetch_object($exito2);


    $datosp = json_decode($row->datospersonales);
    

    $html .=  '<tr>
            <td>'.$obj->fechareg.'</td>
            <td>'.$obj->tipodoc.'</td>
            <td>'.$obj->doc.'</td>
            <td>' . $datosp->depdoc . '</td>
            <td>' . $datosp->mundoc . '</td>
            <td>' . $obj->nombres . '</td>
            <td>' . $obj->email . '</td>
            <td>' . $obj->tel . '</td>
            <td>' . $obj->nacimiento . '</td>
            <td>' . $datosp->nacionalidad . '</td>
            <td>' . $datosp->depnac . '</td>
            <td>' . $datosp->municipionac . '</td>
            <td>' . $row->domicilio . '</td>
            <td>' . $datosp->estcivil . '</td>
            <td>' . $datosp->sexo . '</td>
            <td>' . $datosp->gruposangre . '</td>
            <td>' . $datosp->numhijos . '</td>
            <td>' . $datosp->cabfam . '</td>
            <td>' . $datosp->pobvul . '</td>
            <td>' . $datosp->cargoasp . '</td>
            <td>' . $datosp->postulado . '</td>             
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
