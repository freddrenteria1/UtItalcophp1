<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");
    
    $query = "SELECT * FROM entradaherramientas WHERE remision = ''";
    $exito = mysqli_query($conexion, $query);

    while($obj = mysqli_fetch_object($exito)){

        $ubicacion = $obj->ubicacion;

        $datos[] = array(
            'id'=>$obj->id,
            'ods'=>$obj->ods,
            'ubicacion'=>$obj->ubicacion,
            'items'=>$obj->items,
            'observaciones'=>$obj->observaciones
        );

        $ods = $obj->ods;
        $nument = $obj->id;
        $items = $obj->items;
        $observaciones = $obj->observaciones;

        //guardar registro de salida virtual
        $cons = "INSERT INTO ordensalidaherrinv VALUES('',$nument,'$fecha','Herramientas','$ods','$ubicacion','$items','$observaciones')";
        $ejec = mysqli_query($conexion, $cons);

        $lastid = mysqli_insert_id($conexion);

        // //se actualiza la entrada de herramienta 
        $remi = 'A'.$lastid;
        $sql2 = "UPDATE entradaherramientas SET remision = '$remi' WHERE id=$nument";
        $eje2 = mysqli_query($conexion, $sql2);

        $items = json_decode($items);
        $canti = count($items);

        for($i = 0; $i<$canti; $i++){

            $cod = $items[$i]->cod;
            $cant = $items[$i]->cant;
            $artitem = $items[$i]->item;

            //busca el item
            $query = "SELECT * FROM items Where codigo = '$cod'";
            $eje = mysqli_query($conexion, $query);
            $fila = mysqli_fetch_object($eje);

            $tipo = $fila->tipo;
            $codtipo = $fila->codtipo;
            $clase = $fila->clase;
            $codclase = $fila->codclase;
            $articulo = $fila->articulo;
            $unidad = $fila->unidad;

            //BUSCAR SI EXISTE HERRAMIENTA EN EL INV ALMA REF Y SUMA LA CANTIDAD

            $buscar = "SELECT * FROM invplantaalm Where codigo = '$cod' And ods='$ods' And almacen = 'Herramientas' And ubicacion = '$ubicacion'";
            $ejeb = mysqli_query($conexion, $buscar);

            $cantb = mysqli_num_rows($ejeb);

            if($cantb > 0){
                $filab = mysqli_fetch_object($ejeb);
                $cantb = $filab->cant;
                $ncant = $cantb + $cant;

                $query2 = "UPDATE invplantaalm SET cant = $ncant Where codigo = '$cod' And ods='$ods' And almacen = 'Herramientas' And ubicacion = '$ubicacion'";
                $realizar = mysqli_query($conexion, $query2);
            }else{
                $query2 = "INSERT INTO invplantaalm VALUES('','$fecha', $lastid, '$cod', '$artitem', $cant, '$ods', 'Herramientas', '$ubicacion')";
                $realizar = mysqli_query($conexion, $query2);
                if(!$realizar){
                    $msn = mysqli_error($conexion);
                }
            }

            //VERIFICA SI EL ITEM EXISTE EN EL INVENTARIO DE ALMACEN PRINCIPAL DE LO CONTRARIO LO AGREGA CON SALDO 0
            $buscar2 = "SELECT * FROM inventario Where codigo = '$cod' AND ubicacion = 'AP'";
            $ejeb2 = mysqli_query($conexion, $buscar2);

            $cantb2 = mysqli_num_rows($ejeb2);

            if($cantb2 == 0){
                $query2 = "INSERT INTO inventario VALUES('','$tipo', '$codtipo', '$clase', '$codclase', '$articulo', '$cod', '$unidad', 0, 'AP', 'Existente')";
                $realizar = mysqli_query($conexion, $query2);
                if(!$realizar){
                    $msn = mysqli_error($conexion);
                }
            }
        }
    }


echo json_encode($datos);