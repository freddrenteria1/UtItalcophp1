<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$fechab = $_POST["fecha"];
$ods = $_POST["ods"];

// $fechab = $_GET["fecha"];
// $ods = $_GET["ods"];

$msn = 'Ok';

    $borrar ="DELETE FROM asistencias Where fecha='$fechab' AND ods='$ods'";
    $ejeb = mysqli_query($conexion, $borrar);


    $query = "SELECT * FROM trabajadores Where ods='$ods' AND estado='Activo' order by frente";
    $eje = mysqli_query($conexion, $query);

    while($row = mysqli_fetch_object($eje)){
        $doc = $row->cedula;
        $id = $row->id;
        $nombres = $row->nombres . ' ' . $row->apellidos;
        $cargo = $row->cargo;
        $turno = $row->turno;

        $sqlt = "SELECT * FROM codturnos WHERE turno = '$turno'";
        $ejet = mysqli_query($conexion, $sqlt);
        $rowt = mysqli_fetch_object($ejet);

        
        $sql = "SELECT * FROM marcaciones Where fecha='$fechab' And doc='$id' And tipo='Entrada'";
        $exito = mysqli_query($conexion, $sql);

        $enc = mysqli_num_rows($exito);

        if($enc != 0){
            $obj = mysqli_fetch_object($exito);
            $hora = $obj->hora;
            $tipo = $obj->tipo;

            $horaingreso = $rowt->entrada;
            $horasalida = $rowt->salida;

            $turnolab = $turno . ' - ' . $horaingreso . ' - ' . $horasalida;
            $hh = $rowt->th;

        }else{
            $hora = '';
            $tipo = 'SIN MARCACIÓN';

            $turnolab = '';
            $hh = 0;
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

        if($hh != 0){
            if($row->sistemaprecio == 'PXQ'){
                if($row->tiponomina == 'Directo'){
                    $directospxq++;
                    $hhdirpxq += $hh;
                }else{
                    $indirectospxq++;
                    $hhindirpxq += $hh;
                }
            }else{
                if($row->tiponomina == 'Directo'){
                    $directosg++;
                    $hhdirg += $hh;
                }else{
                    $indirectosg++;
                    $hhindirg += $hh;
                }
            }
        }

        $sqlg = "INSERT INTO asistencias VALUES('','$row->contrato','$row->cedula','$nombres','$cargo','$row->tiponomina','$row->sistemaprecio','$fechab','$turnolab', $hh,'$row->frentetrab','$row->frente','$row->supervisor','$novedad','$ods')";
        $ejeg = mysqli_query($conexion, $sqlg);

        if(!$ejeg){
            $msn = mysqli_error($conexion);
        }

    }


    // $borrar = "DELETE FROM personaldiario Where fecha='$fecha' and ods='$ods'";
    // $ejeb = mysqli_query($conexion, $borrar);

    // $tppxq = $directospxq + $indirectospxq;
    // $thhpxq = $hhdirpxq + $hhindirpxq;

    // $tpg = $directosg + $indirectosg;
    // $thhg = $hhdirg + $hhindirg;

    // $thdir = $hhdirpxq + $hhdirg;
    // $thindir = $hhindirpxq + $hhindirg;
    // $thht = $thdir + $thindir;

    // $sqlp = "INSERT INTO personaldiario VALUES('','$fecha','$ods','PXQ', '7:00 AM A 5:00 PM', $directospxq, $indirectospxq, $tppxq, $hhdirpxq, $hhindirpxq, $thhpxq)";
    // $ejep = mysqli_query($conexion, $sqlp);

    // $sqlg = "INSERT INTO personaldiario VALUES('','$fecha','$ods','GLOBAL', '7:00 AM A 5:00 PM', $directosg, $indirectosg, $tpg, $hhdirg, $hhindirg, $thhg)";
    // $ejeg = mysqli_query($conexion, $sqlg);

    // $borrarh = "DELETE FROM horasacumuladas Where fecha='$fecha' and ods='$ods'";
    // $ejebh = mysqli_query($conexion, $borrarh);

    // $sqlh = "INSERT INTO horasacumuladas VALUES('', $thdir, $thindir, $thht, '$fecha', '$ods')";
    // $ejebhh = mysqli_query($conexion, $sqlh);


$datos = array(
    'msn' => $msn
);

echo json_encode($datos);