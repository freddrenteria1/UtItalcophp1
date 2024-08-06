<?php

$horaentrada = '07:00:00';

$fechaUno=new DateTime($horaentrada);
$fechaDos=new DateTime('08:45');

$dateInterval = $fechaUno->diff($fechaDos);
//echo $dateInterval->format('Total: %H horas %i minutos %s segundos').PHP_EOL;
echo $dateInterval->format('%H');
$horas = $dateInterval->format('%H');
echo '<br>';
echo $dateInterval->format('%i');
$minutos = $dateInterval->format('%i');
echo '<br>';
echo 'Variable horas '.intval($horas);
echo '<br>';
echo 'Variable minutos '.intval($minutos);
echo '<br>';

$canth = intval($horas);
$cantm = intval($minutos);

echo 'Cant horas: ' . $canth;
echo '<br>';

if($canth <= 1){
    echo 'Marcó entrada: ';
}else{
    echo 'Marcó salida';
}