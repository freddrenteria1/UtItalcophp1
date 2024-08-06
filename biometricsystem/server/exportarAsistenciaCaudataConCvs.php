<?php 
session_start();//Esto debes poner siempre que un fichero vallas a utilizar las $_SESSION

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


include("conectar.php");
$conexion=conectar();

$finicio = $_GET["finicio"];
$ffin = $_GET["ffin"];
$turno = $_GET["turno"];
$deli = $_GET["deli"];

$odsM = $_GET["odsM"];
$biom = $_GET["biom"];


if($deli == ','){
    $delimiter = ",";
}

if($deli == ';'){
    $delimiter = ";";
}

if($turno == ''){

    
    $filename = "marcaciones_" . $finicio . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('Fecha', 'Hora', 'ID de Terminal', 'ID de usuario', 'Nombre', 'Documento', 'Clase', 'Modo', 'Tipo', 'Serial de tarjeta No', 'Resultado', 'Propiedad', 'Dispositivo externo', 'Coordinar');
    fputcsv($f, $fields, $delimiter);


        if($odsM == 'Todas'){

            if($biom == 'Todos'){
                
                $sql = "SELECT * FROM marcaciones Where fecha between '$finicio' AND '$ffin' ";
                $exito = mysqli_query($conexion, $sql);

            }else{

                $sql = "SELECT * FROM marcaciones Where fecha between '$finicio' AND '$ffin' AND terminal = '$biom'";
                $exito = mysqli_query($conexion, $sql);

            }


        }else{

            if($biom == 'Todos'){

                $sql = "SELECT * FROM marcaciones Where fecha between '$finicio' AND '$ffin' AND ods ='$odsM'";
                $exito = mysqli_query($conexion, $sql);

            }else{

                $sql = "SELECT * FROM marcaciones Where fecha between '$finicio' AND '$ffin' AND ods ='$odsM' AND terminal = '$biom'";
                $exito = mysqli_query($conexion, $sql);

            }
        }


            
          
            while($row = mysqli_fetch_object($exito)){

                $idbio = $row->doc;


                $query = "SELECT * FROM trabajadores Where id=$idbio";
                $eje = mysqli_query($conexion, $query);

                $enc = mysqli_num_rows($eje);


                if($enc != 0){
                    
                    $obj = mysqli_fetch_object($eje);

                    $doc = $obj->cedula;
                    $id = $obj->id;
                    $nombres = $obj->nombres . ' ' . $obj->apellidos;
                    $cargo = $obj->cargo;
                    $turno = $obj->turno;
                    
                    $hora = $row->hora;
                    $fecha = $row->fecha;
                    
                    if($row->tipo == 'Entrada'){
                        $modo = "Inicio";
                    }

                    if($row->tipo == 'Salida'){
                        $modo = "Fin";
                    }  

                    $lineData = array($fecha, $hora, $row->terminal, $id, $nombres, $doc, 'Usuario', $modo, '1: N', '', 'Éxito', '1100', '', '0 / 0');
                    fputcsv($f, $lineData, $delimiter);
                    
                    

                
                }
                
            } 

           //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);

    exit;

}else{

   
    $filename = "marcaciones_" . $finicio . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('Fecha', 'Hora', 'ID de Terminal', 'ID de usuario', 'Nombre', 'Documento', 'Clase', 'Modo', 'Tipo', 'Serial de tarjeta No', 'Resultado', 'Propiedad', 'Dispositivo externo', 'Coordinar');
    fputcsv($f, $fields, $delimiter);

        if($odsM == 'Todas'){

            if($biom == 'Todos'){

                $sql = "SELECT * FROM marcaciones Where turno='$turno' AND fecha between '$finicio' AND '$ffin'  ";
                $exito = mysqli_query($conexion, $sql);

            }else{

                $sql = "SELECT * FROM marcaciones Where turno='$turno' AND fecha between '$finicio' AND '$ffin' AND terminal = '$biom'";
                $exito = mysqli_query($conexion, $sql);

            }



        }else{

            if($biom == 'Todos'){

                $sql = "SELECT * FROM marcaciones Where turno='$turno' AND fecha between '$finicio' AND '$ffin'  AND ods = '$odsM'";
                $exito = mysqli_query($conexion, $sql);

            }else{

                $sql = "SELECT * FROM marcaciones Where turno='$turno' AND fecha between '$finicio' AND '$ffin'  AND ods = '$odsM' AND terminal = '$biom'";
                $exito = mysqli_query($conexion, $sql);

            }


        }
          
            while($row = mysqli_fetch_object($exito)){

                $idbio = $row->doc;


                $query = "SELECT * FROM trabajadores Where id=$idbio";
                $eje = mysqli_query($conexion, $query);

                $enc = mysqli_num_rows($eje);


                if($enc != 0){
                    
                    $obj = mysqli_fetch_object($eje);

                    $doc = $obj->cedula;
                    $id = $obj->id;
                    $nombres = $obj->nombres . ' ' . $obj->apellidos;
                    $cargo = $obj->cargo;
                    $turno = $obj->turno;
                    
                    $hora = $row->hora;
                    $fecha = $row->fecha;
                    
                    if($row->tipo == 'Entrada'){
                        $modo = "Inicio";
                    }

                    if($row->tipo == 'Salida'){
                        $modo = "Fin";
                    }  

                    $lineData = array($fecha, $hora, $row->terminal, $id, $nombres, $doc, 'Usuario', $modo, '1: N', '', 'Éxito', '1100', '', '0 / 0');
                    fputcsv($f, $lineData, $delimiter);
                    
                    

                
                }
                
            } 

           //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);

    exit;

}





 ?>

