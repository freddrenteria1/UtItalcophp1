<?php
//============================================================+
// File name   : example_021.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 021 for TCPDF class
//               WriteHTML text flow
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML text flow.
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
include("conectar.php"); 
$conexion=conectar();

$zip = new ZipArchive();
$filename = "hojasdevida.zip";
$zip->open($filename, ZipArchive::CREATE);


$sql="SELECT * FROM registro";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

	// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('UT Italco');
$pdf->SetTitle('HOJA DE VIDA');


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 9);

	// add a page
$pdf->AddPage();

	$doc = $obj->doc;

    $info = array(
        'id'=>$obj->id,
        'fechareg'=>$obj->fechareg,
        'tipodoc'=>$obj->tipodoc,
        'doc'=>$obj->doc,
        'email'=>$obj->email,
        'nombres'=>$obj->nombres,
        'nacimiento'=>$obj->nacimiento,
        'tel'=>$obj->tel
    );

	$sql2="SELECT * FROM infobasica Where doc = '$doc'";
	$exito2=mysqli_query($conexion, $sql2);
	$enc2 = mysqli_num_rows($exito2);

	if($enc2 != 0){
		$row = mysqli_fetch_object($exito2);

		$infobasica = array(
			'id'=>$row->id,
			'datospersonales'=>$row->datospersonales,
			'datoscontacto'=>$row->datoscontacto,
			'domicilio'=>$row->domicilio,
			'perfil'=>$row->perfil,
			'niveleducativo'=>$row->niveleducativo,
			'explaboral'=>$row->explaboral,
			'edinformal'=>$row->edinformal
		);

		$arrayDatosContactos =  json_decode($row->datoscontacto);

	}



// create some HTML content
$html = '

<style>
        body {
            background-color: #242424;
            background-image: url("img/fondo.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .container {
            max-width: 1200px;
        }

        .site-header {
            background-color: rgba(0, 0, 0, .85);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            backdrop-filter: saturate(180%) blur(20px);
        }

        .site-header a {
            color: #8e8e8e;
            transition: color .15s ease-in-out;
            text-decoration: none;
        }

        .linkrecup a {
            color: orange;
            text-decoration: none;
        }

        .site-header a:hover {
            color: #fff;
            text-decoration: none;
        }

        .clogin {
            margin: 0 auto;
            margin-top: 50px;
            width: 350px;
            color: #fff;
            background-color: rgba(0, 0, 0, .5);
            padding: 20px;
            border-radius: 15px;
        }

        .registro {
            margin: 0 auto;
            width: 600px;
        }

        .info {
            background-color: #ececec;
            padding: 15px;
            border-style: solid;
            border-width: 1px;
            border-color: #cccccc;
        }

        .datos {
            padding: 15px;
            border-style: solid;
            border-width: 1px;
            border-color: #cccccc;
            background-color: #fff;
        }

        .titrojo {
            color: darkblue
        }

        .titp {
            font-weight: bold;
        }

        .tithv {
            color: #034e8b;
			font-size: 24px;
        }
    </style>';

$html .= '

	<div id="hoja-de-vida">




	<h5 class="tithv">HOJA DE VIDA </h5>
<hr>
<h2>'.$info["nombres"].'</h2>

<p>'.$row->domicilio.' - '.$arrayDatosContactos->barrio.', '.$arrayDatosContactos->municipiores.' - '.$arrayDatosContactos->depresidencia.' <br>
	Teléfono: '.$info["tel"].', Otro teléfono: '.$arrayDatosContactos->otrotel.' <br>
	'.$info["email"].'
</p>
<hr>
<h5 class="tithv mb-4">DATOS PERSONALES</h5>


<div class="row" style="width: 95%; margin-left: 15px;">
	<div class="col-sm-6">
		<span class="titp">Edad: </span> {{edad}} Años
	</div>
	<div class="col-sm-6">
		<span class="titp">No. documento: </span> {{doc}}
	</div>

	<div class="col-sm-6">
		<span class="titp">Estado Civil: </span> {{estcivil}}
	</div>
	<div class="col-sm-6">
		<span class="titp">Sexo: </span> {{sexo}}
	</div>
	<div class="col-sm-6">
		<span class="titp">Nacionalidad: </span> {{nacionalidad}}
	</div>
	<div class="col-sm-6">
		<span class="titp">Departamento de nacimiento: </span> {{depnac}}
	</div>
	<div class="col-sm-6">
		<span class="titp">Municipio de nacimiento: </span> {{municipionac}}
	</div>
	<div class="col-sm-6">
		<span class="titp">Departamento de residencia: </span> {{depresidencia}}
	</div>
	<div class="col-sm-6">
		<span class="titp">Municipio de residencia: </span> {{municipiores}}
	</div>
	<div class="col-sm-6">
		<span class="titp">Barrio: </span> {{barrio}}
	</div>

</div>
<hr>

<h5 class="tithv mb-4 mt-3">NIVEL EDUCATIVO</h5>
<b>{{maxNivelEdu}}</b>
<div class="row mt-3" style="width: 95%; margin-left: 15px;">

	<div class="col-sm-6">
		<span class="titp">Nivel educativo: </span> {{arrayDataNivelEdu.niveleduc}}
	</div>
	<div class="col-sm-6">
		<span class="titp">Estado: </span> {{arrayDataNivelEdu.estadotit}}
	</div>

	<div class="col-sm-6">
		<span class="titp">Título obtenido: </span> {{arrayDataNivelEdu.titulo}}
	</div>
	<div class="col-sm-6">
		<span class="titp">Ubicación: </span> {{arrayDataNivelEdu.paistit}}
	</div>

	<div class="col-sm-6">
		<span class="titp">Institución: </span> {{arrayDataNivelEdu.institucion}}
	</div>

</div>
<hr>

<h5 class="tithv mb-4 mt-3">PERFIL LABORAL</h5>
<b>{{perfil}}</b>
<div class="row mt-3" style="width: 95%; margin-left: 15px;">

	<div class="col-sm-6">
		<span class="titp">Nivel educativo: </span> {{arrayDataNivelEdu.niveleduc}}
	</div>
	<div class="col-sm-6">
		<span class="titp">Situación Laboral Actual: </span> {{sitlabact}}
	</div>

	<div class="col-sm-6">
		<span class="titp">Propiedad medio de transporte: </span> {{proptransp}}
	</div>

</div>
<hr>

<h5 class="tithv mb-4 mt-3">EXPERIENCIA LABORAL</h5>

<div class="card mt-4" v-for="datosexp in arrayDatosExpLab">
	<div class="card-header">
		{{datosexp.cargo}}
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-sm-6 mt-4">
				<span class="titp">Tipo experiencia laboral: </span> {{datosexp.tipoexplab}}
				<br>
				<span class="titp">Nombre de la empresa: </span> {{datosexp.empresa}} <br>
				<span class="titp">Teléfono de la empresa: </span> {{datosexp.telemp}} <br>
				<span class="titp">Cargo: </span> {{datosexp.cargo}} <br>
				<span class="titp">Ubicación: </span> {{datosexp.ubicaemp}} <br>
				<span class="titp">Fecha de ingreso: </span> {{datosexp.fingreso}} <br>
				<span class="titp">Fecha de retiro: </span> {{datosexp.fretiro}} <br>
			</div>

			<div class="col-sm-6 mt-4">
				<span class="titp">Funciones y Logros: </span> <br>
				{{datosexp.funciones}}
			</div>
		</div>
	</div>
</div>

<hr>

<h5 class="tithv mb-4 mt-3">EDUCACIÓN INFORMAL</h5>

<div class="card mt-4" v-for="datoscap in arrayDatosEduInformal">
	<div class="card-header">
		{{datoscap.programacap}}
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-sm-6 ">
				<span class="titp">Tipo Capacitación o Certificación: </span>
				{{datoscap.tipocap}}
			</div>
			<div class="col-sm-6 ">
				<span class="titp">Nombre del programa: </span> {{datoscap.programacap}}
			</div>
			<div class="col-sm-6 ">
				<span class="titp">Institución: </span> {{datoscap.instcap}}
			</div>
			<div class="col-sm-6 ">
				<span class="titp">Ubicación: </span> {{datoscap.ubicacap}}
			</div>


			<div class="col-sm-6 ">
				<span class="titp">Estado: </span> {{datoscap.estadocap}}
			</div>
			<div class="col-sm-6 ">
				<span class="titp">Duración en horas: </span> {{datoscap.duracioncap}}
			</div>
		</div>
	</div>
</div>

<hr>

</div>';



// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('/tmp/hojadevida_' . $doc . '.pdf', 'F');
$zip->addFile('/tmp/hojadevida_' . $doc. '.pdf', $doc . '.pdf');

}

$zip->close();

header('Content-type: application/zip');
header('Content-Disposition: attachment; filename="hojasdevida.zip"');
readfile($filename);


//============================================================+
// END OF FILE
//============================================================+
