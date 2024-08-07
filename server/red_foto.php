<?php

include("conectar.php"); 
$conexion=conectar();

$query = "SELECT * FROM galeria WHERE ods='017' AND fecha = '2021-06-25'";
$exito = mysqli_query($conexion, $query);

echo 'Cargando......';
echo '<br><br>';

$cant = 0;

while ($row = mysqli_fetch_object($exito)){

    // Creamos la variable que contiene la imagen
    // Uso de la librería imagick
    $im = new imagick($row->foto);

    $imageprops = $im->getImageGeometry();

    // reconocimiento de la altura y ancho de la imagen
    $width = $imageprops['width'];
    $height = $imageprops['height'];

    // Nueva altura y ancho
    if($width > $height){
        $newHeight = 320;
        $newWidth = (320 / $height) * $width;
    }else{
        $newWidth = 320;
        $newHeight = (320 / $width) * $height;
    }
        $im->resizeImage($newWidth,$newHeight, imagick::FILTER_LANCZOS, 0.9, true);
        $im->cropImage (320,320,0,0);
        // Escribimos la nueva imagen redimensionada
        $im->writeImage($row->foto);
        // Impresion en el navegador de la imagen

        $foto = $row->foto;
        echo '<img src="'.$foto.'">';

}
?>