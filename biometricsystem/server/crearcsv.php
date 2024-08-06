<?php
// Decir a PHP que vamos generar un archivo que debe descargarse
header("content-type:application/csv;charset=UTF-8");
header("Content-Disposition:attachment;filename=datos_ventas.csv");

$ventas = array( array('Enero',132.00),
                array('Febrero',346.00),
                array('Marzo',256.00)
              );

$fh = fopen('php://output','w');

foreach ($ventas as $venta) {
    if (fputcsv($fh, $venta, ",") === false) {
        die("Error al escribir en CSV");
    }
}
fclose($fh);

 ?>