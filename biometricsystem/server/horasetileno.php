<?php

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
//$fecha=date("Y-m-d");

$query = "SELECT * FROM pdtetileno Where tag != '' GROUP BY tag ORDER BY id ";
$eje = mysqli_query($conexion, $query);

echo '<table border="1">';

while($row = mysqli_fetch_object($eje)){
    $tag = $row->tag;
    
    $sql = "SELECT * FROM pdtetileno WHERE tag='$tag' AND resp='ECOPETROL' limit 1";
    $exito = mysqli_query($conexion, $sql);
    $obj = mysqli_fetch_object($exito);

    $inicioplan = $obj->inicioplan;
    $inicioreal = $obj->inicio;
    $idb = $obj->id;

    echo '<tr style="background-color: #AED6F1;"><td>'.$tag.' </td><td>Inicio Plan: '.$inicioplan.' | Inicio Real: '.$inicioreal.'</td><td colspan="2">Causa: '.$obj->causa.' </td> </tr>';
    echo '<tr style="background-color: #F7DC6F;"><td>TAG</td><td>ACTIVIDAD</td><td>INICIO PLAN</td><td>HORAS DESFASE</td></tr>';
    // echo '------------------------------------------- <br>';
    // echo 'TAG: ' . $tag . '<br>';
    // echo 'Inicio Planeado: ' . $inicioplan . '<br>';
    // echo 'Inicio Real: ' . $inicioreal . '<br>';
    // echo '------------------------------------------- <br>';
 
    $sumatotalhoras = 0;

    $buscar = "SELECT * FROM pdtetileno WHERE tag='$tag' AND inicioplan BETWEEN '$inicioplan' AND '$inicioreal' AND id>$idb";
    $ejeb = mysqli_query($conexion, $buscar);

    while($file = mysqli_fetch_object($ejeb)){

        $iniciplanact = $file->inicioplan;
        $iniciorealact = $file->inicio;

        $cantdias = 0;

        $firstDate  = new DateTime($iniciplanact);
        $secondDate = new DateTime($inicioreal);
        $intvl = $firstDate->diff($secondDate);

        $cantdias = $intvl->d;
        $canthoras = $intvl->format('%H');

        $totalhoras = ($cantdias * 24)+$canthoras;

        echo '<tr><td>'.$tag.'</td><td>' . $file->actividad . ' </td><td> ' . $iniciplanact  .  '</td><td> ' . $totalhoras  .  '</td></tr>';

        // echo 'Actividad: ' . $file->actividad . ' | Cant horas: ' . $totalhoras  .  '<br>';

        $sumatotalhoras += $totalhoras;

    }

    echo '<tr style="background-color: #F7DC6F;"><td></td><td>TOTAL DESFASE: '.$sumatotalhoras.' </td><td></td><td></td></tr>';
    

    // echo '------------------------------------------- <br>';
    // echo 'Total horas retrazo del Tag ' . $tag . ' = ' . $sumatotalhoras;
    // echo '<br>';
   
}

echo '</table>';