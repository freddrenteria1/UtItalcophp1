


function agregarObs() {
	$('#tblobs').removeClass("oculto")
	$('#btnagregarObs').addClass("oculto")
}

function agregarObs2() {
	$('#tblobs2').removeClass("oculto")
	$('#btnagregarObs2').addClass("oculto")
}

var imagencargada = null
var idImagen = null

var user = sessionStorage.getItem('usercal')
var verifuser = sessionStorage.getItem('datosuserqaqc')

if (verifuser != null) {
	var datosuserqaqc = JSON.parse(sessionStorage.getItem('datosuserqaqc'))
} else {
	location = 'index.php'
}
var tipouser = sessionStorage.getItem('tipouser')

if (tipouser == 'ecopetrol') {
	$("input, select,  textarea").prop('disabled', true);
	$('.ecp').prop('disabled', false)
	$('.ut').prop('disabled', true)
	//$("#info input").prop("disabled", true);
}

if (tipouser == 'italco') {
	// $("input, select,  textarea").prop('disabled', false);
	$('.ecp').prop('disabled', true)
	// $('.ut').prop('disabled', true)
	//$("#info input").prop("disabled", true);
}

$('.activo').prop('disabled', false)

var items = []
// Set up the canvas
var canvas = document.querySelector("#canvas");
var ctx = canvas.getContext("2d");
ctx.strokeStyle = "#222222";
ctx.lineWidth = 2;


$btnDescargar = document.querySelector("#btnDescargar")
$btnLimpiar = document.querySelector("#btnLimpiar")
$btnGenerarDocumento = document.querySelector("#btnGenerarDocumento");



// Get a regular interval for drawing to the screen
window.requestAnimFrame = (function (callback) {
	return window.requestAnimationFrame ||
		window.webkitRequestAnimationFrame ||
		window.mozRequestAnimationFrame ||
		window.oRequestAnimationFrame ||
		window.msRequestAnimaitonFrame ||
		function (callback) {
			window.setTimeout(callback, 1000 / 60);
		};
})();


const limpiarCanvas = () => {
	// Colocar color blanco en fondo de canvas
	clearCanvas();
};
limpiarCanvas();
$btnLimpiar.onclick = limpiarCanvas;
// Escuchar clic del botón para descargar el canvas



window.obtenerImagen = () => {
	return $canvas.toDataURL();
};


// Set up mouse events for drawing
var drawing = false;
var mousePos = {
	x: 0,
	y: 0
};
var lastPos = mousePos;
canvas.addEventListener("mousedown", function (e) {
	drawing = true;
	lastPos = getMousePos(canvas, e);
}, false);
canvas.addEventListener("mouseup", function (e) {
	drawing = false;
}, false);
canvas.addEventListener("mousemove", function (e) {
	mousePos = getMousePos(canvas, e);
}, false);

// Set up touch events for mobile, etc
canvas.addEventListener("touchstart", function (e) {
	mousePos = getTouchPos(canvas, e);
	var touch = e.touches[0];
	var mouseEvent = new MouseEvent("mousedown", {
		clientX: touch.clientX,
		clientY: touch.clientY
	});
	canvas.dispatchEvent(mouseEvent);
}, false);
canvas.addEventListener("touchend", function (e) {
	var mouseEvent = new MouseEvent("mouseup", {});
	canvas.dispatchEvent(mouseEvent);
}, false);
canvas.addEventListener("touchmove", function (e) {
	var touch = e.touches[0];
	var mouseEvent = new MouseEvent("mousemove", {
		clientX: touch.clientX,
		clientY: touch.clientY
	});
	canvas.dispatchEvent(mouseEvent);
}, false);


// Prevent scrolling when touching the canvas
document.body.addEventListener("touchstart", function (e) {
	if (e.target == canvas) {
		e.preventDefault();
	}
}, {
	passive: false
});
document.body.addEventListener("touchend", function (e) {
	if (e.target == canvas) {
		e.preventDefault();
	}
}, false);
document.body.addEventListener("touchmove", function (e) {
	if (e.target == canvas) {
		e.preventDefault();
	}
}, false);

// Get the position of the mouse relative to the canvas
function getMousePos(canvasDom, mouseEvent) {
	var rect = canvasDom.getBoundingClientRect();
	return {
		x: mouseEvent.clientX - rect.left,
		y: mouseEvent.clientY - rect.top
	};
}

// Get the position of a touch relative to the canvas
function getTouchPos(canvasDom, touchEvent) {
	var rect = canvasDom.getBoundingClientRect();
	return {
		x: touchEvent.touches[0].clientX - rect.left,
		y: touchEvent.touches[0].clientY - rect.top
	};
}

// Draw to the canvas
function renderCanvas() {
	if (drawing) {
		ctx.moveTo(lastPos.x, lastPos.y);
		ctx.lineTo(mousePos.x, mousePos.y);
		ctx.lineWidth = 5;
		ctx.stroke();
		lastPos = mousePos;
	}
}

// Clear the canvas
function clearCanvas() {
	canvas.width = canvas.width;
}

// Allow for animation
(function drawLoop() {
	requestAnimFrame(drawLoop);
	renderCanvas();
})();


function abrirFirma(id) {

	if (id == 200) {
		if ($('#obs200').val() == '') {
			Swal.fire({
				position: 'top-end',
				icon: 'info',
				title: 'Por favor registre primero la observación, nombre y registro...',
				showConfirmButton: false,
				timer: 2500
			})
		} else {
			idImagen = id;
			pasarFirma()
		}
	} 

	if (id == 100) {
		if ($('#obs100').val() == '') {
			Swal.fire({
				position: 'top-end',
				icon: 'info',
				title: 'Por favor registre primero la observación, nombre y registro...',
				showConfirmButton: false,
				timer: 2500
			})
		} else {
			idImagen = id;
			pasarFirma()
		}
	} else {

		if ($('#fecha' + id).val() == "" || $('#hora' + id).val() == "") {
			Swal.fire({
				position: 'top-end',
				icon: 'info',
				title: 'Por favor registre primero fecha y hora...',
				showConfirmButton: false,
				timer: 2500
			})
		} else {
			idImagen = id;
			pasarFirma()

		}

	}


}

function pasarFirma() {
	if ($('#poldatos').prop('checked')) {
		document.querySelector("#firma" + idImagen).src = datosuserqaqc.firma;

		$('#firma' + idImagen).removeClass('oculto')
		$('#btnFirmar' + idImagen).hide()

		$('#nombre' + idImagen).val(datosuserqaqc.nombres)
		$('#registro' + idImagen).val(datosuserqaqc.documento)

		if (idImagen == 1 || idImagen == 2) {
			actDeconexion()
		}

		if (idImagen >= 3 && idImagen <= 5) {
			actMantenimiento()
		}
        

		if (idImagen >= 6 && idImagen <= 9) {
			actInstalacion()
		}

        if (idImagen >= 10 && idImagen <= 12) {
			actNormalizacion()
		}

	 


		if (idImagen == 100) {
			guardarObs()
		}

		 


	} else {
		Swal.fire({
			position: 'top-end',
			icon: 'info',
			title: 'Debe aceptar las políticas de protección de datos perasonales',
			showConfirmButton: false,
			timer: 1500
		})
	}


	//document.querySelector("#btnfirmar").style.display = 'none';

}

function getParameterByName(name) {
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
	return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

var tag = getParameterByName('tag');
var arrayDatos = []
var firmasItems = []
var arrayInfo = []

odsq = localStorage.getItem('odsq');
equipos = sessionStorage.getItem('equipo')
alcance = sessionStorage.getItem('servicio')
esp = sessionStorage.getItem('esp')


var server = 'https://utitalco.com/calidad/033/montaje/server/';

cargando()

$.post(server + 'cargarRca06.php', {
	ods: odsq,
	tag: tag
},
	function (resp) {
		arrayDatos = resp
		cargarDatos()
	})

function cargarDatos() {

	// $('#unidad').html(arrayDatos.unidad)
	// $('#planta').html(arrayDatos.planta)

	// $('#ods').html(arrayDatos.ods)
	$('#tag').html(arrayDatos.tag)
	$('#tipo').html(arrayDatos.tipo)
    $('#marca').html(arrayDatos.marca)
    

	if (arrayDatos.desconexion != "") {

		arrayInfo = JSON.parse(arrayDatos.desconexion)


		$('#desc1').val(arrayInfo[0].desc1)
		$('#desc2').val(arrayInfo[0].desc2)
		$('#desc3').val(arrayInfo[0].desc3)
        $('#desc4').val(arrayInfo[0].desc4)
		$('#desc5').val(arrayInfo[0].desc5)

        $('#obsdesc1').val(arrayInfo[0].obsdesc1)
		$('#obsdesc2').val(arrayInfo[0].obsdesc2)
		$('#obsdesc3').val(arrayInfo[0].obsdesc3)
        $('#obsdesc4').val(arrayInfo[0].obsdesc4)
		$('#obsdesc5').val(arrayInfo[0].obsdesc5)


		$('#fecha1').val(arrayInfo[0].fechautsup)
		$('#hora1').val(arrayInfo[0].horautsup)
		$('#nombre1').val(arrayInfo[0].nombreutsup)

		if (arrayInfo[0].fechautsup != "") {
			document.querySelector("#firma1").src = arrayInfo[0].firmautsup;
			$('#firma1').removeClass('oculto')
			$('#btnFirmar1').hide()
		}

		$('#registro1').val(arrayInfo[0].registroutsup)

		$('#fecha2').val(arrayInfo[0].fechaecp)
		$('#hora2').val(arrayInfo[0].horaecp)
		$('#nombre2').val(arrayInfo[0].nombreecp)

		if (arrayInfo[0].fechaecp != "") {
			document.querySelector("#firma2").src = arrayInfo[0].firmaecp;
			$('#firma2').removeClass('oculto')
			$('#btnFirmar2').hide()
		}

		$('#registro2').val(arrayInfo[0].registroecp)

		

	}

    if (arrayDatos.mantenimiento != "") {

		arrayInfo = JSON.parse(arrayDatos.mantenimiento)


		$('#mant1').val(arrayInfo[0].mant1)
		$('#mant2').val(arrayInfo[0].mant2)
		$('#mant3').val(arrayInfo[0].mant3)
        $('#mant4').val(arrayInfo[0].mant4)
		$('#mant5').val(arrayInfo[0].mant5)
        $('#mant6').val(arrayInfo[0].mant6)
        $('#mant7').val(arrayInfo[0].mant7)
		$('#mant8').val(arrayInfo[0].mant8)
        $('#mant9').val(arrayInfo[0].mant9)
		$('#mant10').val(arrayInfo[0].mant10)
        $('#mant11').val(arrayInfo[0].mant11)
		$('#mant12').val(arrayInfo[0].mant12)
		$('#mant13').val(arrayInfo[0].mant13)
        $('#mant14').val(arrayInfo[0].mant14)
		$('#mant15').val(arrayInfo[0].mant15)
        $('#mant16').val(arrayInfo[0].mant16)
        $('#mant17').val(arrayInfo[0].mant17)
		$('#mant18').val(arrayInfo[0].mant18)
        

        $('#obsmant1').val(arrayInfo[0].obsmant1)
		$('#obsmant2').val(arrayInfo[0].obsmant2)
		$('#obsmant3').val(arrayInfo[0].obsmant3)
        $('#obsmant4').val(arrayInfo[0].obsmant4)
		$('#obsmant5').val(arrayInfo[0].obsmant5)
        $('#obsmant6').val(arrayInfo[0].obsmant6)
        $('#obsmant7').val(arrayInfo[0].obsmant7)
		$('#obsmant8').val(arrayInfo[0].obsmant8)
        $('#obsmant9').val(arrayInfo[0].obsmant9)
		$('#obsmant10').val(arrayInfo[0].obsmant10)
        $('#obsmant11').val(arrayInfo[0].obsmant11)
		$('#obsmant12').val(arrayInfo[0].obsmant12)
		$('#obsmant13').val(arrayInfo[0].obsmant13)
        $('#obsmant14').val(arrayInfo[0].obsmant14)
		$('#obsmant15').val(arrayInfo[0].obsmant15)
        $('#obsmant16').val(arrayInfo[0].obsmant16)
        $('#obsmant17').val(arrayInfo[0].obsmant17)
		$('#obsmant18').val(arrayInfo[0].obsmant18)


		$('#fecha3').val(arrayInfo[0].fechautsup)
		$('#hora3').val(arrayInfo[0].horautsup)
		$('#nombre3').val(arrayInfo[0].nombreutsup)

		if (arrayInfo[0].fechautsup != "") {
			document.querySelector("#firma3").src = arrayInfo[0].firmautsup;
			$('#firma3').removeClass('oculto')
			$('#btnFirmar3').hide()
		}

		$('#registro3').val(arrayInfo[0].registroutsup)


        $('#fecha4').val(arrayInfo[0].fechautqaqc)
		$('#hora4').val(arrayInfo[0].horautqaqc)
		$('#nombre4').val(arrayInfo[0].nombreutqaqc)

		if (arrayInfo[0].fechautqaqc != "") {
			document.querySelector("#firma4").src = arrayInfo[0].firmautqaqc;
			$('#firma4').removeClass('oculto')
			$('#btnFirmar4').hide()
		}

		$('#registro4').val(arrayInfo[0].registroutqaqc)



		$('#fecha5').val(arrayInfo[0].fechaecp)
		$('#hora5').val(arrayInfo[0].horaecp)
		$('#nombre5').val(arrayInfo[0].nombreecp)

		if (arrayInfo[0].fechaecp != "") {
			document.querySelector("#firma5").src = arrayInfo[0].firmaecp;
			$('#firma5').removeClass('oculto')
			$('#btnFirmar5').hide()
		}

		$('#registro5').val(arrayInfo[0].registroecp)
		

	}

    if (arrayDatos.instalacion != "") {

		arrayInfo = JSON.parse(arrayDatos.instalacion)


		$('#inst1').val(arrayInfo[0].inst1)
		$('#inst2').val(arrayInfo[0].inst2)
		$('#inst3').val(arrayInfo[0].inst3)
        $('#inst4').val(arrayInfo[0].inst4)
		$('#inst5').val(arrayInfo[0].inst5)
        $('#inst6').val(arrayInfo[0].inst6)
        $('#inst7').val(arrayInfo[0].inst7)
		$('#inst8').val(arrayInfo[0].inst8)
		$('#inst9').val(arrayInfo[0].inst9)
        $('#inst10').val(arrayInfo[0].inst10)
		$('#inst11').val(arrayInfo[0].inst11)
        

        $('#obsinst1').val(arrayInfo[0].obsinst1)
		$('#obsinst2').val(arrayInfo[0].obsinst2)
		$('#obsinst3').val(arrayInfo[0].obsinst3)
        $('#obsinst4').val(arrayInfo[0].obsinst4)
		$('#obsinst5').val(arrayInfo[0].obsinst5)
        $('#obsinst6').val(arrayInfo[0].obsinst6)
        $('#obsinst7').val(arrayInfo[0].obsinst7)
		$('#obsinst8').val(arrayInfo[0].obsinst8)
		$('#obsinst9').val(arrayInfo[0].obsinst9)
        $('#obsinst10').val(arrayInfo[0].obsinst10)
		$('#obsinst11').val(arrayInfo[0].obsinst11)
     


		$('#fecha6').val(arrayInfo[0].fechautsup)
		$('#hora6').val(arrayInfo[0].horautsup)
		$('#nombre6').val(arrayInfo[0].nombreutsup)

		if (arrayInfo[0].fechautsup != "") {
			document.querySelector("#firma6").src = arrayInfo[0].firmautsup;
			$('#firma6').removeClass('oculto')
			$('#btnFirmar6').hide()
		}

		$('#registro6').val(arrayInfo[0].registroutsup)


        $('#fecha7').val(arrayInfo[0].fechautqaqc)
		$('#hora7').val(arrayInfo[0].horautqaqc)
		$('#nombre7').val(arrayInfo[0].nombreutqaqc)

		if (arrayInfo[0].fechautqaqc != "") {
			document.querySelector("#firma7").src = arrayInfo[0].firmautqaqc;
			$('#firma7').removeClass('oculto')
			$('#btnFirmar7').hide()
		}

		$('#registro7').val(arrayInfo[0].registroutqaqc)



		$('#fecha8').val(arrayInfo[0].fechaecp)
		$('#hora8').val(arrayInfo[0].horaecp)
		$('#nombre8').val(arrayInfo[0].nombreecp)

		if (arrayInfo[0].fechaecp != "") {
			document.querySelector("#firma8").src = arrayInfo[0].firmaecp;
			$('#firma8').removeClass('oculto')
			$('#btnFirmar8').hide()
		}

		$('#registro8').val(arrayInfo[0].registroecp)

        $('#fecha9').val(arrayInfo[0].fechaecpi)
		$('#hora9').val(arrayInfo[0].horaecpi)
		$('#nombre9').val(arrayInfo[0].nombreecpi)

		if (arrayInfo[0].fechaecpi != "") {
			document.querySelector("#firma9").src = arrayInfo[0].firmaecpi;
			$('#firma9').removeClass('oculto')
			$('#btnFirmar9').hide()
		}

		$('#registro9').val(arrayInfo[0].registroecpi)

         
		

	}


    if (arrayDatos.entrega != "") {

		arrayInfo = JSON.parse(arrayDatos.entrega)


		$('#norm1').val(arrayInfo[0].norm1)
		$('#norm2').val(arrayInfo[0].norm2)
        $('#norm3').val(arrayInfo[0].norm3)
		$('#norm4').val(arrayInfo[0].norm4)
		 

        $('#obsnorm1').val(arrayInfo[0].obsnorm1)
		$('#obsnorm2').val(arrayInfo[0].obsnorm2)
        $('#obsnorm3').val(arrayInfo[0].obsnorm3)
		$('#obsnorm4').val(arrayInfo[0].obsnorm4)
		 


		$('#fecha10').val(arrayInfo[0].fechautsup)
		$('#hora10').val(arrayInfo[0].horautsup)
		$('#nombre10').val(arrayInfo[0].nombreutsup)

		if (arrayInfo[0].fechautsup != "") {
			document.querySelector("#firma10").src = arrayInfo[0].firmautsup;
			$('#firma10').removeClass('oculto')
			$('#btnFirmar10').hide()
		}

		$('#registro10').val(arrayInfo[0].registroutsup)

        $('#fecha11').val(arrayInfo[0].fechautqaqc)
		$('#hora11').val(arrayInfo[0].horautqaqc)
		$('#nombre11').val(arrayInfo[0].nombreutqaqc)

		if (arrayInfo[0].fechautqaqc != "") {
			document.querySelector("#firma11").src = arrayInfo[0].firmautqaqc;
			$('#firma11').removeClass('oculto')
			$('#btnFirmar11').hide()
		}

		$('#registro11').val(arrayInfo[0].registroutqaqc)


		$('#fecha12').val(arrayInfo[0].fechaecp)
		$('#hora12').val(arrayInfo[0].horaecp)
		$('#nombre12').val(arrayInfo[0].nombreecp)

		if (arrayInfo[0].fechaecp != "") {
			document.querySelector("#firma12").src = arrayInfo[0].firmaecp;
			$('#firma12').removeClass('oculto')
			$('#btnFirmar12').hide()
		}

		$('#registro12').val(arrayInfo[0].registroecp)

		

	}
	 
	 

	 


	//CARGUE DE OBSERVACIONES

	if (arrayDatos.observaciones != "") {
		var arrayObs = JSON.parse(arrayDatos.observaciones)
		var html = ''
		for (var i = 0; i < arrayObs.length; i++) {
			html = `<b>Nota ${i + 1}: </b>
                    ${arrayObs[i].obs} | ${arrayObs[i].nombre} | Registro: ${arrayObs[i].registro} | Fecha: ${arrayObs[i].fecha} | Firma: <span id="firm${i}" style="width: 60px;"></span> <br>--------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>
                    `
			$('#observaciones').append(html)
			const imagef = document.createElement('img')
			imagef.src = arrayObs[i].firma
			imagef.height = "60"
			document.querySelector('#firm' + i).appendChild(imagef)

		}
	}


	if (arrayDatos.doc != "") {
		listaArchivos = JSON.parse(arrayDatos.doc)
	}




	Swal.close()


}


//actualiza informacion

function actDeconexion() {
	var desc1 = $('#desc1').val()
	var desc2 = $('#desc2').val()
	var desc3 = $('#desc3').val()
    var desc4 = $('#desc4').val()
	var desc5 = $('#desc5').val()

    var obsdesc1 = $('#obsdesc1').val()
	var obsdesc2 = $('#obsdesc2').val()
	var obsdesc3 = $('#obsdesc3').val()
    var obsdesc4 = $('#obsdesc4').val()
	var obsdesc5 = $('#obsdesc5').val()

	var fechautsup = $('#fecha1').val()
	var horautsup = $('#hora1').val()
	var nombreutsup = $('#nombre1').val()

	var img = document.getElementById("firma1");
	var firmautsup = img.src

	if (fechautsup == '') {
		firmautsup = ''
	}

	var registroutsup = $('#registro1').val()

	var fechaecp = $('#fecha2').val()
	var horaecp = $('#hora2').val()
	var nombreecp = $('#nombre2').val()

	var img = document.getElementById("firma2");
	var firmaecp = img.src

	if (fechaecp == '') {
		firmaecp = ''
	}

	var registroecp = $('#registro2').val()

	var arrayInfo = []

	arrayInfo.push({
		"desc1": desc1,
		"desc2": desc2,
		"desc3": desc3,
        "desc4": desc4,
		"desc5": desc5,
        "obsdesc1": obsdesc1,
		"obsdesc2": obsdesc2,
		"obsdesc3": obsdesc3,
        "obsdesc4": obsdesc4,
		"obsdesc5": obsdesc5,
		'fechautsup': fechautsup,
		'horautsup': horautsup,
		'nombreutsup': nombreutsup,
		'firmautsup': firmautsup,
		'registroutsup': registroutsup,
		'fechaecp': fechaecp,
		'horaecp': horaecp,
		'nombreecp': nombreecp,
		'firmaecp': firmaecp,
		'registroecp': registroecp
	})

	$.post(server + 'act06Desconexion.php', {
		ods: odsq,
		tag: tag,
		datos: JSON.stringify(arrayInfo)
	},
		function (res) {
			Swal.fire({
				position: 'top-end',
				icon: 'success',
				width: 100,
				showConfirmButton: false,
				timer: 1500
			})
		})



}

function actMantenimiento() {

	var mant1 = $('#mant1').val()
	var mant2 = $('#mant2').val()
	var mant3 = $('#mant3').val()
    var mant4 = $('#mant4').val()
	var mant5 = $('#mant5').val()
    var mant6 = $('#mant6').val()
    var mant7 = $('#mant7').val()
	var mant8 = $('#mant8').val()
    var mant9 = $('#mant9').val()
	var mant10 = $('#mant10').val()
	var mant11 = $('#mant11').val()
    var mant12 = $('#mant12').val()
	var mant13 = $('#mant13').val()
    var mant14 = $('#mant14').val()
    var mant15 = $('#mant15').val()
	var mant16 = $('#mant16').val()
    var mant17 = $('#mant17').val()
	var mant18 = $('#mant18').val()

    var obsmant1 = $('#obsmant1').val()
	var obsmant2 = $('#obsmant2').val()
	var obsmant3 = $('#obsmant3').val()
    var obsmant4 = $('#obsmant4').val()
	var obsmant5 = $('#obsmant5').val()
    var obsmant6 = $('#obsmant6').val()
    var obsmant7 = $('#obsmant7').val()
	var obsmant8 = $('#obsmant8').val()
    var obsmant9 = $('#obsmant9').val()
	var obsmant10 = $('#obsmant10').val()
	var obsmant11 = $('#obsmant11').val()
    var obsmant12 = $('#obsmant12').val()
	var obsmant13 = $('#obsmant13').val()
    var obsmant14 = $('#obsmant14').val()
    var obsmant15 = $('#obsmant15').val()
	var obsmant16 = $('#obsmant16').val()
    var obsmant17 = $('#obsmant17').val()
	var obsmant18 = $('#obsmant18').val()

	var fechautsup = $('#fecha3').val()
	var horautsup = $('#hora3').val()
	var nombreutsup = $('#nombre3').val()

	var img = document.getElementById("firma3");
	var firmautsup = img.src

	if (fechautsup == '') {
		firmautsup = ''
	}

	var registroutsup = $('#registro3').val()


    var fechautqaqc = $('#fecha4').val()
	var horautqaqc = $('#hora4').val()
	var nombreutqaqc = $('#nombre4').val()

	var img = document.getElementById("firma4");
	var firmautqaqc = img.src

	if (fechautqaqc == '') {
		firmautqaqc = ''
	}

	var registroutqaqc = $('#registro4').val()
    

	var fechaecp = $('#fecha5').val()
	var horaecp = $('#hora5').val()
	var nombreecp = $('#nombre5').val()

	var img = document.getElementById("firma5");
	var firmaecp = img.src

	if (fechaecp == '') {
		firmaecp = ''
	}

	var registroecp = $('#registro5').val()

    

	var arrayInfo = []

	arrayInfo.push({
		"mant1": mant1,
		"mant2": mant2,
		"mant3": mant3,
        "mant4": mant4,
		"mant5": mant5,
        "mant6": mant6,
        "mant7": mant7,
		"mant8": mant8,
        "mant9": mant9,
		"mant10": mant10,
        "mant11": mant11,
		"mant12": mant12,
		"mant13": mant13,
        "mant14": mant14,
		"mant15": mant15,
        "mant16": mant16,
        "mant17": mant17,
		"mant18": mant18,
        "obsmant1": obsmant1,
		"obsmant2": obsmant2,
		"obsmant3": obsmant3,
        "obsmant4": obsmant4,
		"obsmant5": obsmant5,
        "obsmant6": obsmant6,
        "obsmant7": obsmant7,
		"obsmant8": obsmant8,
        "obsmant9": obsmant9,
		"obsmant10": obsmant10,
        "obsmant11": obsmant11,
		"obsmant12": obsmant12,
		"obsmant13": obsmant13,
        "obsmant14": obsmant14,
		"obsmant15": obsmant15,
        "obsmant16": obsmant16,
        "obsmant17": obsmant17,
		"obsmant18": obsmant18,
		'fechautsup': fechautsup,
		'horautsup': horautsup,
		'nombreutsup': nombreutsup,
		'firmautsup': firmautsup,
		'registroutsup': registroutsup,
        'fechautqaqc': fechautqaqc,
		'horautqaqc': horautqaqc,
		'nombreutqaqc': nombreutqaqc,
		'firmautqaqc': firmautqaqc,
		'registroutqaqc': registroutqaqc,
		'fechaecp': fechaecp,
		'horaecp': horaecp,
		'nombreecp': nombreecp,
		'firmaecp': firmaecp,
		'registroecp': registroecp
	})

	$.post(server + 'act06Mantenimiento.php', {
		ods: odsq,
		tag: tag,
		datos: JSON.stringify(arrayInfo)
	},
		function (res) {
			Swal.fire({
				position: 'top-end',
				icon: 'success',
				width: 100,
				showConfirmButton: false,
				timer: 1500
			})
		})



}

function actInstalacion() {

	var inst1 = $('#inst1').val()
	var inst2 = $('#inst2').val()
	var inst3 = $('#inst3').val()
    var inst4 = $('#inst4').val()
	var inst5 = $('#inst5').val()
    var inst6 = $('#inst6').val()
    var inst7 = $('#inst7').val()
	var inst8 = $('#inst8').val()
	var inst9 = $('#inst9').val()
    var inst10 = $('#inst10').val()
	var inst11 = $('#inst11').val()
    

    var obsinst1 = $('#obsinst1').val()
	var obsinst2 = $('#obsinst2').val()
	var obsinst3 = $('#obsinst3').val()
    var obsinst4 = $('#obsinst4').val()
	var obsinst5 = $('#obsinst5').val()
    var obsinst6 = $('#obsinst6').val()
    var obsinst7 = $('#obsinst7').val()
	var obsinst8 = $('#obsinst8').val()
	var obsinst9 = $('#obsinst9').val()
    var obsinst10 = $('#obsinst10').val()
	var obsinst11 = $('#obsinst11').val()
     

	var fechautsup = $('#fecha6').val()
	var horautsup = $('#hora6').val()
	var nombreutsup = $('#nombre6').val()

	var img = document.getElementById("firma6");
	var firmautsup = img.src

	if (fechautsup == '') {
		firmautsup = ''
	}

	var registroutsup = $('#registro6').val()


    var fechautqaqc = $('#fecha7').val()
	var horautqaqc = $('#hora7').val()
	var nombreutqaqc = $('#nombre7').val()

	var img = document.getElementById("firma7");
	var firmautqaqc = img.src

	if (fechautqaqc == '') {
		firmautqaqc = ''
	}

	var registroutqaqc = $('#registro7').val()
    

	var fechaecp = $('#fecha8').val()
	var horaecp = $('#hora8').val()
	var nombreecp = $('#nombre8').val()

	var img = document.getElementById("firma8");
	var firmaecp = img.src

	if (fechaecp == '') {
		firmaecp = ''
	}

	var registroecp = $('#registro8').val()


    var fechaecpi = $('#fecha9').val()
	var horaecpi = $('#hora9').val()
	var nombreecpi = $('#nombre9').val()

	var img = document.getElementById("firma9");
	var firmaecpi = img.src

	if (fechaecpi == '') {
		firmaecpi = ''
	}

	var registroecpi = $('#registro9').val()

    

	var arrayInfo = []

	arrayInfo.push({
		"inst1": inst1,
		"inst2": inst2,
		"inst3": inst3,
        "inst4": inst4,
		"inst5": inst5,
        "inst6": inst6,
        "inst7": inst7,
		"inst8": inst8,
		"inst9": inst9,
        "inst10": inst10,
		"inst11": inst11,
        "obsinst1": obsinst1,
		"obsinst2": obsinst2,
		"obsinst3": obsinst3,
        "obsinst4": obsinst4,
		"obsinst5": obsinst5,
        "obsinst6": obsinst6,
        "obsinst7": obsinst7,
		"obsinst8": obsinst8,
		"obsinst9": obsinst9,
        "obsinst10": obsinst10,
		"obsinst11": obsinst11,
		'fechautsup': fechautsup,
		'horautsup': horautsup,
		'nombreutsup': nombreutsup,
		'firmautsup': firmautsup,
		'registroutsup': registroutsup,
        'fechautqaqc': fechautqaqc,
		'horautqaqc': horautqaqc,
		'nombreutqaqc': nombreutqaqc,
		'firmautqaqc': firmautqaqc,
		'registroutqaqc': registroutqaqc,
		'fechaecp': fechaecp,
		'horaecp': horaecp,
		'nombreecp': nombreecp,
		'firmaecp': firmaecp,
		'registroecp': registroecp,
        'fechaecpi': fechaecpi,
		'horaecpi': horaecpi,
		'nombreecpi': nombreecpi,
		'firmaecpi': firmaecpi,
		'registroecpi': registroecpi
	})

	$.post(server + 'act06Instalacion.php', {
		ods: odsq,
		tag: tag,
		datos: JSON.stringify(arrayInfo)
	},
		function (res) {
			Swal.fire({
				position: 'top-end',
				icon: 'success',
				width: 100,
				showConfirmButton: false,
				timer: 1500
			})
		})



}



function actNormalizacion() {
	var norm1 = $('#norm1').val()
	var norm2 = $('#norm2').val()
    var norm3 = $('#norm3').val()
	var norm4 = $('#norm4').val()
	 

    var obsnorm1 = $('#obsnorm1').val()
	var obsnorm2 = $('#obsnorm2').val()
    var obsnorm3 = $('#obsnorm3').val()
	var obsnorm4 = $('#obsnorm4').val()
	 

	var fechautsup = $('#fecha10').val()
	var horautsup = $('#hora10').val()
	var nombreutsup = $('#nombre10').val()

	var img = document.getElementById("firma10");
	var firmautsup = img.src

	if (fechautsup == '') {
		firmautsup = ''
	}

	var registroutsup = $('#registro10').val()

    var fechautqaqc = $('#fecha11').val()
	var horautqaqc = $('#hora11').val()
	var nombreutqaqc = $('#nombre11').val()

	var img = document.getElementById("firma11");
	var firmautqaqc = img.src

	if (fechautqaqc == '') {
		firmautqaqc = ''
	}

	var registroutqaqc = $('#registro11').val()


	var fechaecp = $('#fecha12').val()
	var horaecp = $('#hora12').val()
	var nombreecp = $('#nombre12').val()

	var img = document.getElementById("firma12");
	var firmaecp = img.src

	if (fechaecp == '') {
		firmaecp = ''
	}

	var registroecp = $('#registro12').val()

	var arrayInfo = []

	arrayInfo.push({
		"norm1": norm1,
		"norm2": norm2,
        "norm3": norm3,
		"norm4": norm4,
        "obsnorm1": obsnorm1,
		"obsnorm2": obsnorm2,
        "obsnorm3": obsnorm3,
		"obsnorm4": obsnorm4,
		'fechautsup': fechautsup,
		'horautsup': horautsup,
		'nombreutsup': nombreutsup,
		'firmautsup': firmautsup,
		'registroutsup': registroutsup,
        'fechautqaqc': fechautqaqc,
		'horautqaqc': horautqaqc,
		'nombreutqaqc': nombreutqaqc,
		'firmautqaqc': firmautqaqc,
		'registroutqaqc': registroutqaqc,
		'fechaecp': fechaecp,
		'horaecp': horaecp,
		'nombreecp': nombreecp,
		'firmaecp': firmaecp,
		'registroecp': registroecp
	})

	$.post(server + 'act06Normalizacion.php', {
		ods: odsq,
		tag: tag,
		datos: JSON.stringify(arrayInfo)
	},
		function (res) {
			Swal.fire({
				position: 'top-end',
				icon: 'success',
				width: 100,
				showConfirmButton: false,
				timer: 1500
			})
		})



}












function mostraraviso() {
	let timerInterval
	Swal.fire({
		title: 'Políticas de protección de datos personales',
		text: 'En cumplimiento con la Ley 1581 de protección de datos personales, se le informa que los datos suministrados serán incorporados a una base de datos cuya finalidad es el registro de control de actividades RCA y las actuaciones que se deriven de dicha gestión, cuyo responsable del tratamiento es UT ITALCO. Mediante el registro de sus datos  a través de este formato usted autoriza a UT ITALCO, a tratar los datos con la finalidad descrita arriba.  Como Titular se le informa que podrá ejercer sus derechos de acceso y reclamos a través del correo de contacto pqrsbca@utitalco.com.',
		timer: 20000,
		timerProgressBar: true,
		didOpen: () => {
			Swal.showLoading()
			const b = Swal.getHtmlContainer().querySelector('b')
			timerInterval = setInterval(() => {
				b.textContent = Swal.getTimerLeft()
			}, 100)
		},
		willClose: () => {
			clearInterval(timerInterval)
		}
	}).then((result) => {
		/* Read more about handling dismissals below */
		if (result.dismiss === Swal.DismissReason.timer) {
			console.log('I was closed by the timer')
		}
	})
}

function cargando() {
	let timerInterval
	Swal.fire({
		title: 'Cargando formato...!',
		timer: 20000,
		timerProgressBar: true,
		didOpen: () => {
			Swal.showLoading()
			const b = Swal.getHtmlContainer().querySelector('b')
			timerInterval = setInterval(() => {
				// b.textContent = Swal.getTimerLeft()
			}, 100)
		},
		willClose: () => {
			clearInterval(timerInterval)
		}
	}).then((result) => {
		/* Read more about handling dismissals below */
		if (result.dismiss === Swal.DismissReason.timer) {
			console.log('I was closed by the timer')
		}
	})
}

function verArchivos() {
	var htmltexto = ''
	for (var i = 0; i < listaArchivos.length; i++) {
		htmltexto += `
                    <a href='https://utitalco.com/calidad/033/montaje/server/archivos/${listaArchivos[i].archivo}' target='_blank'>${listaArchivos[i].archivo}</a> <br>
                `
	}

	Swal.fire({
		title: '<strong>Lista de adjuntos</strong>',
		icon: 'info',
		html: `
                Pulse click sobre el archivo que desea descargar... <br>
                ${htmltexto}
                `

	})
}



function adjuntar() {
	Swal.fire({
		title: 'Adjuntar archivo',
		html: `
                <input type="file" id="archivo" class="form-control" placeholder="Buscar..."> <br>
				Según el tamaño del archivo puede tardar un tiempo... espere el aviso de archivo cagado. 
                `,
		showCancelButton: true,
		confirmButtonText: 'Adjuntar'
	}).then((result) => {
		/* Read more about isConfirmed, isDenied below */
		if (result.isConfirmed) {

			var formData = new FormData();
			var files = $('#archivo')[0].files[0];
			formData.append('archivo', files);
			formData.append('ods', odsq);
			formData.append('tag', tag);
			$.ajax({
				url: server + 'guardarArchivo06.php',
				type: 'post',
				data: formData,
				contentType: false,
				processData: false,
				success: function (response) {
					console.log(response)

					if (response.msn == "Ok") {
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Archivo cargado correctamente...',
							showConfirmButton: false,
							timer: 1500
						}).then(() => {

							location.reload();
						})
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Formato de archivo incorrecto...!',
						})
					}
				}
			});

		}
	})
}



function guardarObs() {
	var observacion = $('#obs100').val()
	observacion = observacion.replace(/(\r\n|\n|\r)/gm, " ")
	observacion = observacion.replace(/["]/gm, "``")
	observacion = observacion.replace(/[“]/gm, "``")
	observacion = observacion.replace(/[”]/gm, "``")
	observacion = observacion.replace(/[']/gm, "`")
	var nombreobs = $('#nombre100').val()
	var registroobs = $('#registro100').val()
	var img = document.getElementById("firma100");

	// crea un nuevo objeto `Date`
	var today = new Date();

	// obtener la fecha y la hora
	var now = today.toLocaleString();
	var firmaobs = img.src

	if (arrayDatos.observaciones != "") {

		var arrayLmp = JSON.parse(arrayDatos.observaciones)
	} else {
		var arrayLmp = []
	}


	arrayLmp.push({
		"obs": observacion,
		"nombre": nombreobs,
		"registro": registroobs,
		"firma": firmaobs,
		"fecha": now
	})


	$.post(server + 'actOs06Obs.php', {
		ods: odsq,
		tag: tag,
		datos: JSON.stringify(arrayLmp)
	},
		function (res) {
			console.log(res)
			location.reload()
		})

}

