<meta charset="utf-8" />
<?php 
session_start();//Esto debes poner siempre que un fichero vallas a utilizar las $_SESSION

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


include("conectar.php");
$conexion=conectar();

$finicio = $_GET["finicio"];
$ffin = $_GET["ffin"];
$ods = $_GET["ods"];


//Inicio de exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=marcaciones_$fecha.xls"); //Indica el nombre del archivo resultante
header("Pragma: no-cache");
header("Expires: 0");
echo '<table border="1">
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
          </thead>';

          $query = "SELECT * FROM trabajadores Where ods='$ods' order by frente";
          $eje = mysqli_query($conexion, $query);

          
            while($row = mysqli_fetch_object($eje)){
                $doc = $row->cedula;
                $id = $row->id;
                $nombres = $row->nombres . ' ' . $row->apellidos;
                $cargo = $row->cargo;
                $turno = $row->turno;

                $sql = "SELECT * FROM marcaciones Where doc='$id' AND fecha between '$finicio' AND '$ffin'";
                $exito = mysqli_query($conexion, $sql);

                $enc = mysqli_num_rows($exito);

               

                    if($enc != 0){
                        
                        while($rowm = mysqli_fetch_object($exito)){
                        
                        $hora = $rowm->hora;
                        $fecha = $rowm->fecha;
                        
                        if($rowm->tipo == 'Entrada'){
                            $modo = "Inicio";
                        }
    
                        if($rowm->tipo == 'Salida'){
                            $modo = "Fin";
                        }  
                        
                        echo '<tr>
                            <td>'.$rowm->fecha.'</td>
                            <td>'.$rowm->hora.'</td>
                            <td>'.$rowm->terminal.'</td>
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
                }
                
            } 

 ?>

