<?php
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=archivo.xls");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false);

    $id = $_GET["id"];

    include("conectar.php"); 
    $conexion=conectar();

    date_default_timezone_set("America/Bogota");
    $fecha=date("Y-m-d H:i:s");

    $sql = "SELECT * FROM ordensalidaherr Where id=$id";
    $exito = mysqli_query($conexion, $sql);

    $obj = mysqli_fetch_object($exito);

    $items = json_decode($obj->items);
    $cant = count($items);


?>
<html>

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title></title>
    <meta name="generator" content="LibreOffice 7.2.5.2 (Linux)" />
    <meta name="author" content="DELL" />
    <meta name="created" content="2022-02-08T16:33:42" />
    <meta name="changed" content="2022-05-13T13:36:15" />
    <meta name="AppVersion" content="16.0300" />
    <meta name="DocSecurity" content="0" />
    <meta name="HyperlinksChanged" content="false" />
    <meta name="LinksUpToDate" content="false" />
    <meta name="ScaleCrop" content="false" />
    <meta name="ShareDoc" content="false" />

    <style type="text/css">
        body,
        div,
        table,
        thead,
        tbody,
        tfoot,
        tr,
        th,
        td,
        p {
            font-family: "Calibri";
            font-size: x-small
        }
        
        a.comment-indicator:hover+comment {
            background: #ffd;
            position: absolute;
            display: block;
            border: 1px solid black;
            padding: 0.5em;
        }
        
        a.comment-indicator {
            background: red;
            display: inline-block;
            border: 1px solid black;
            width: 0.5em;
            height: 0.5em;
        }
        
        comment {
            display: none;
        }
    </style>

</head>

<body>
    <table cellspacing="0" border="0">
        <colgroup width="78"></colgroup>
        <colgroup width="120"></colgroup>
        <colgroup span="5" width="78"></colgroup>
        <colgroup width="94"></colgroup>
        <colgroup span="5" width="78"></colgroup>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 rowspan=5 height="100" align="center" valign=bottom>
                <font face="Verdana" color="#000000">
                    <img src="img/ecopetrol.png" width="250px" alt="">
                </font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 align="center" valign=middle><b><font face="Verdana" color="#000000">Autorización de ingreso y salida de elementos</font></b></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 rowspan=2 align="center" valign=middle><b><font face="Verdana" color="#000000">Gestión del Entorno<br>Gerencia de Segurdiad Física</font></b></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 rowspan=2 align="center" valign=middle><b><font face="Verdana" color="#000000">Código<br>GDE-F-076</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 rowspan=2 align="center" valign=middle><b><font face="Verdana" color="#000000">Elaborado<br>17/07/2018</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 rowspan=2 align="center" valign=middle><b><font face="Verdana" color="#000000">Versión<br> 1</font></b></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=13 height="20" align="center" valign=bottom>
                <font face="Verdana" size=1 color="#000000">Cualquier información sobre este formato consultar el documento: GDE-P-009, procedimiento para actualizaicón y validación de firma autorizada.</font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=13 height="32" align="center" valign=middle bgcolor="#B5DC10"><b><font face="Verdana" color="#000000">DATOS PARA EL INGRESO DE ELEMENTOS</font></b></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="20" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Consecutivo No.:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="" sdnum="1033;">
                <font face="Verdana" color="#000000">2113</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">¿Se requiere vehículo?</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#FFFFFF">
                <font face="Verdana" color="#000000">SI</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Fecha de ingreso:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1033;0;D/M/YYYY">
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Hora de ingreso:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1033;0;HH:MM">
                <font face="Verdana" color="#000000"><br></font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 height="20" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Nombre de quien ingresa elementos:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Documento:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Empresa:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000">ITALCO</font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 height="20" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Nombre del conductor:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Documento:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Empresa:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000">ITALCO</font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 height="20" align="center" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Vehículo</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Procedencia de los elementos:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" valign=bottom bgcolor="#FFFFFF">
                <font face="Verdana" color="#000000">PATIO DE ITALCO</font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="20" align="center" valign=middle bgcolor="#FFFFFF">
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF">
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#FFFFFF">
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Destino de los elementos:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" valign=bottom>
                <font color="#000000">ORDEN DE SERVICIO 021 DIA A DIA </font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=13 height="32" align="center" valign=middle bgcolor="#B5DC10"><b><font face="Verdana" color="#000000">DATOS PARA EL RETIRO DE ELEMENTOS</font></b></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="20" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Consecutivo No.:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">¿Se requiere vehículo?</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#FFFFFF">
                <font face="Verdana"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Fecha de retiro:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1033;0;DD/MM/YYYY">
                <font face="Verdana"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Hora de retiro:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF">
                <font face="Verdana" color="#BFBFBF">HH:MM</font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 height="20" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Nombre de quien retira elementos:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Documento:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Empresa:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 height="22" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Nombre del conductor:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Documento:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Empresa:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 height="20" align="center" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Vehículo</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Procedencia de los elementos:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" valign=bottom bgcolor="#FFFFFF">
                <font face="Verdana" color="#000000"><br></font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="20" align="center" valign=middle bgcolor="#FFFFFF">
                <font face="Verdana"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF">
                <font face="Verdana"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#FFFFFF">
                <font face="Verdana"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Destino de los elementos:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" valign=bottom>
                <font color="#000000"><br></font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=13 height="32" align="center" valign=middle bgcolor="#B5DC10"><b><font face="Verdana" color="#000000">DETALLE DE LOS ELEMENTOS</font></b></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="43" align="center" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">ÍTEM</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">CANTIDAD<br>(en números y letras)</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">UNIDAD DE MEDIDA</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">No. SERIAL</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">DESCRIPCIÓN DEL MATERIAL</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">PROPIEDAD DE</font>
            </td>
        </tr>
        <!-- INICIO DE ITEMS -->
        <tbody id="tablaDatos">
            <?php for($i=0; $i<$cant; $i++): ?>
            <tr>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="20" align="center" valign=middle sdval="1" sdnum="1033;"><b><font face="Verdana" color="#000000"><?= $i+1 ?></font></b></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><b><?= $items[$i]->cant ?></b></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>
                    <font face="Verdana" color="#000000"><?= $items[$i]->unidad ?></font>
                </td>
                <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle sdnum="1033;0;@">
                    <font face="Verdana" color="#000000"><br></font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="left" valign=middle>
                    <font size=3><?= $items[$i]->item ?></font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle>
                    <font face="Verdana" color="#000000">UT ITALCO</font>
                </td>
            </tr>
            <?php endfor ?>
        </tbody>
        <!-- FIN DE ITEMS -->

        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="20" align="center" valign=middle><b><font face="Verdana" color="#000000"><br></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><b><br></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle sdnum="1033;0;@">
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" valign=middle>
                <font size=3><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=13 height="72" align="left" valign=top><b><font face="Verdana" color="#000000">OBSERVACIONES:</font></b></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=13 height="32" align="center" valign=middle bgcolor="#B5DC10"><b><font face="Verdana" color="#000000">VALIDACIÓN DE LAS AUTORIZACIONES PARA EL INGRESO DE LOS ELEMENTOS</font></b></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 height="32" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Nombre de quien ingresa elementos:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Documento:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Firma:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 height="32" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Nombre de quien autoriza el ingreso:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Registro:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Firma:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 height="32" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Nombre del vigilante al ingreso:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Documento:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Firma:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=13 height="32" align="center" valign=middle bgcolor="#B5DC10"><b><font face="Verdana" color="#000000">VALIDACIÓN DE LAS AUTORIZACIONES PARA EL RETIRO DE LOS ELEMENTOS</font></b></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 height="32" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Nombre de quien retira elementos:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Documento:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Firma:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 height="32" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Nombre de quien autoriza el retiro:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Registro:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Firma:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 height="32" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Nombre del vigilante al retiro:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Documento:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#D8D8D8">
                <font face="Verdana" color="#000000">Firma:</font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>
                <font face="Verdana" color="#000000"><br></font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=13 height="46" align="center" valign=middle bgcolor="#B5DC10"><b><font face="Verdana" color="#000000">Favor enviar autorización antes de las 15:00 horas al correo de seguridad física del área<br>No se acepta con tachones o enmendaduras</font></b></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=13 height="60" align="left" valign=top>
                <font face="Verdana" size=1 color="#000000">En Ecopetrol está prohibido el ingreso de: explosivos, armas de fuego y sus municiones, dispositivos para aturdir, armas blancas, bebidas alcohólicas, drogas ilegales y demás elementos o sustancias que puedan poner en riesgo la seguridad
                    de las personas y las instalaciones.<br>El ingreso de equipos de amplificación como: megáfonos, vuvuzelas, parlantes, equipos de sonido, bafles, etc., únicamente está autorizado a los grupos de emergencia o a los aprobados por el responsable
                    de la instalación.</font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=13 height="32" align="left" valign=middle bgcolor="#FFFFFF">
                <font face="Verdana" size=1 color="#000000">Todos los derechos reservados para Ecopetrol S.A. Este formato no puede ser editado sin un consentimiento escrito o de acuerdo con las leyes que regulan los derechos de autor y con base en la regulación vigente.</font>
            </td>
        </tr>
    </table>
    <!-- ************************************************************************** -->

    <script>
        function Unidades(num) {

            switch (num) {
                case 1:
                    return " UN";
                case 2:
                    return " DOS";
                case 3:
                    return " TRES";
                case 4:
                    return " CUATRO";
                case 5:
                    return " CINCO";
                case 6:
                    return " SEIS";
                case 7:
                    return " SIETE";
                case 8:
                    return " OCHO";
                case 9:
                    return " NUEVE";
            }

            return "";
        } //Unidades()

        function Decenas(num) {

            decena = Math.floor(num / 10);
            unidad = num - (decena * 10);

            switch (decena) {
                case 1:
                    switch (unidad) {
                        case 0:
                            return " DIEZ";
                        case 1:
                            return " ONCE";
                        case 2:
                            return " DOCE";
                        case 3:
                            return " TRECE";
                        case 4:
                            return " CATORCE";
                        case 5:
                            return " QUINCE";
                        default:
                            return " DIECI" + Unidades(unidad);
                    }
                case 2:
                    switch (unidad) {
                        case 0:
                            return " VEINTE";
                        default:
                            return " VEINTI" + Unidades(unidad);
                    }
                case 3:
                    return DecenasY(" TREINTA", unidad);
                case 4:
                    return DecenasY(" CUARENTA", unidad);
                case 5:
                    return DecenasY(" CINCUENTA", unidad);
                case 6:
                    return DecenasY(" SESENTA", unidad);
                case 7:
                    return DecenasY(" SETENTA", unidad);
                case 8:
                    return DecenasY(" OCHENTA", unidad);
                case 9:
                    return DecenasY(" NOVENTA", unidad);
                case 0:
                    return Unidades(unidad);
            }
        } //Unidades()

        function DecenasY(strSin, numUnidades) {
            if (numUnidades > 0)
                return strSin + " Y" + Unidades(numUnidades)

            return strSin;
        } //DecenasY()

        function Centenas(num) {
            centenas = Math.floor(num / 100);
            decenas = num - (centenas * 100);

            switch (centenas) {
                case 1:
                    if (decenas > 0)
                        return " CIENTO" + Decenas(decenas);
                    return " CIEN";
                case 2:
                    return " DOSCIENTOS" + Decenas(decenas);
                case 3:
                    return " TRESCIENTOS" + Decenas(decenas);
                case 4:
                    return " CUATROCIENTOS" + Decenas(decenas);
                case 5:
                    return " QUINIENTOS" + Decenas(decenas);
                case 6:
                    return " SEISCIENTOS" + Decenas(decenas);
                case 7:
                    return " SETECIENTOS" + Decenas(decenas);
                case 8:
                    return " OCHOCIENTOS" + Decenas(decenas);
                case 9:
                    return " NOVECIENTOS" + Decenas(decenas);
            }

            return Decenas(decenas);
        } //Centenas()

        function Seccion(num, divisor, strSingular, strPlural) {
            cientos = Math.floor(num / divisor)
            resto = num - (cientos * divisor)

            letras = "";

            if (cientos > 0)
                if (cientos > 1)
                    letras = Centenas(cientos) + "" + strPlural;
                else
                    letras = strSingular;

            if (resto > 0)
                letras += "";

            return letras;
        } //Seccion()

        function Miles(num) {
            divisor = 1000;
            cientos = Math.floor(num / divisor)
            resto = num - (cientos * divisor)

            strMiles = Seccion(num, divisor, " UN MIL", " MIL");
            strCentenas = Centenas(resto);

            if (strMiles == "")
                return strCentenas;

            return strMiles + "" + strCentenas;
        } //Miles()

        function Millones(num) {
            divisor = 1000000;
            cientos = Math.floor(num / divisor)
            resto = num - (cientos * divisor)

            strMillones = Seccion(num, divisor, " UN MILLON DE", " MILLONES DE");
            strMiles = Miles(resto);

            if (strMillones == "")
                return strMiles;

            return strMillones + "" + strMiles;
        } //Millones()

        function NumeroALetras(num) {
            var data = {
                numero: num,
                enteros: Math.floor(num),
                centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
                letrasCentavos: "",
                letrasMonedaPlural: '', //"PESOS", 'Dólares', 'Bolívares', 'etcs'
                letrasMonedaSingular: '', //"PESO", 'Dólar', 'Bolivar', 'etc'

                letrasMonedaCentavoPlural: "",
                letrasMonedaCentavoSingular: ""
            };

            if (data.centavos > 0) {
                data.letrasCentavos = " CON" + (function() {
                    if (data.centavos == 1)
                        return Millones(data.centavos) + "" + data.letrasMonedaCentavoSingular;
                    else
                        return Millones(data.centavos) + "" + data.letrasMonedaCentavoPlural;
                })();
            };

            if (data.enteros == 0)
                return " CERO" + data.letrasMonedaPlural + "" + data.letrasCentavos;
            if (data.enteros == 1)
                return Millones(data.enteros) + "" + data.letrasMonedaSingular + "" + data.letrasCentavos;
            else
                return Millones(data.enteros) + "" + data.letrasMonedaPlural + "" + data.letrasCentavos;
        }

        var numero = NumeroALetras(10000)
        console.log(numero)
    </script>
</body>

</html>