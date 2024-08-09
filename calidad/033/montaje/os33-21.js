


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
			actAlistamiento()
		}

		

		if (idImagen >= 3 && idImagen <= 67) {
			actComp()
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

$.post(server + 'cargarRca3321.php', {
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
	// $('#familia').html(arrayDatos.familia)
	// $('#tag').html(arrayDatos.tag)

	if (arrayDatos.alistamiento != "") {

		arrayInfo = JSON.parse(arrayDatos.alistamiento)


		$('#okna1').val(arrayInfo[0].okna1)
		$('#okna2').val(arrayInfo[0].okna2)
		$('#okna3').val(arrayInfo[0].okna3)

		$('#fecha1').val(arrayInfo[0].fechautsup)
		$('#hora1').val(arrayInfo[0].horautsup)
		$('#nombre1').val(arrayInfo[0].nombreutsup)

		if (arrayInfo[0].fechautsup != "") {
			document.querySelector("#firma1").src = arrayInfo[0].firmautsup;
			$('#firma1').removeClass('oculto')
			$('#btnFirmar1').hide()
		}

		$('#registro1').val(arrayInfo[0].registroutsup)

		$('#fecha2').val(arrayInfo[0].fechautqaqc)
		$('#hora2').val(arrayInfo[0].horautqaqc)
		$('#nombre2').val(arrayInfo[0].nombreutqaqc)

		if (arrayInfo[0].fechautqaqc != "") {
			document.querySelector("#firma2").src = arrayInfo[0].firmautqaqc;
			$('#firma2').removeClass('oculto')
			$('#btnFirmar2').hide()
		}

		$('#registro2').val(arrayInfo[0].registroutqaqc)

		
		 



	}

	if (arrayDatos.liberacion != "") {

		arrayInfo = JSON.parse(arrayDatos.liberacion)


		$('#itemLib1').val(arrayInfo[0].itemLib1)
		$('#itemLib2').val(arrayInfo[0].itemLib2)
		$('#itemLib3').val(arrayInfo[0].itemLib3)

		$('#numrt').val(arrayInfo[0].numrt)

		
		

	}


	if (arrayDatos.componentes != "") {
		arrayItems = JSON.parse(arrayDatos.componentes)

		var f = 5
		var c = 1

		for (var i = 0; i <= 20; i++) {

			$('#comp' + c).val(arrayItems[i].comp)

			$('#fecha' + f).val(arrayItems[i].fechautsup)
			$('#hora' + f).val(arrayItems[i].horautsup)
			$('#nombre' + f).val(arrayItems[i].nombreutsup)

			if (arrayItems[i].fechautsup != "") {
				document.querySelector("#firma"+f).src = arrayItems[i].firmautsup;
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()
			}

			$('#registro' + f).val(arrayItems[i].registroutsup)

			f++;

			$('#fecha' + f).val(arrayItems[i].fechautqaqc)
			$('#hora' + f).val(arrayItems[i].horautqaqc)
			$('#nombre' + f).val(arrayItems[i].nombreutqaqc)

			if (arrayItems[i].fechautqaqc != "") {
				document.querySelector("#firma"+f).src = arrayItems[i].firmautqaqc;
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()
			}

			$('#registro' + f).val(arrayItems[i].registroutqaqc)

			f++;

			$('#fecha' + f).val(arrayItems[i].fechautec)
			$('#hora' + f).val(arrayItems[i].horautec)
			$('#nombre' + f).val(arrayItems[i].nombreutec)

			if (arrayItems[i].fechautec != "") {
				document.querySelector("#firma"+f).src = arrayItems[i].firmautec;
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()
			}

			$('#registro' + f).val(arrayItems[i].registroutec)

			f++;
			c++;
			 
		}
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

function actAlistamiento() {
	var okna1 = $('#okna1').val()
	var okna2 = $('#okna2').val()
	var okna3 = $('#okna3').val()

	var fechautsup = $('#fecha1').val()
	var horautsup = $('#hora1').val()
	var nombreutsup = $('#nombre1').val()

	var img = document.getElementById("firma1");
	var firmautsup = img.src

	if (fechautsup == '') {
		firmautsup = ''
	}

	var registroutsup = $('#registro1').val()

	var fechautqaqc = $('#fecha2').val()
	var horautqaqc = $('#hora2').val()
	var nombreutqaqc = $('#nombre2').val()

	var img = document.getElementById("firma2");
	var firmautqaqc = img.src

	if (fechautqaqc == '') {
		firmautqaqc = ''
	}

	var registroutqaqc = $('#registro2').val()

	var arrayInfo = []

	arrayInfo.push({
		"okna1": okna1,
		"okna2": okna2,
		"okna3": okna3,
		'fechautsup': fechautsup,
		'horautsup': horautsup,
		'nombreutsup': nombreutsup,
		'firmautsup': firmautsup,
		'registroutsup': registroutsup,
		'fechautqaqc': fechautqaqc,
		'horautqaqc': horautqaqc,
		'nombreutqaqc': nombreutqaqc,
		'firmautqaqc': firmautqaqc,
		'registroutqaqc': registroutqaqc
	})

	$.post(server + 'act3321alistamiento.php', {
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

function actLiberacion() {
	var itemLib1 = $('#itemLib1').val()
	var itemLib2 = $('#itemLib2').val()
	var itemLib3 = $('#itemLib3').val()
	
	var numrt = $('#numrt').val()
	


	var arrayInfo = []

	arrayInfo.push({
		"itemLib1": itemLib1,
		"itemLib2": itemLib2,
		"itemLib3": itemLib3,
		"numrt": numrt
	})

	$.post(server + 'act3321Liberacion.php', {
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



function actComp() {

	var arrayItems = []

	var f = 5

	for (var i = 1; i <= 21; i++) {

        console.log(f)

		
		var comp = $('#comp' + i).val()

		var fechautsup = $('#fecha'+f).val()
		var horautsup = $('#hora'+f).val()
		var nombreutsup = $('#nombre'+f).val()

		var img = document.getElementById("firma"+f);
		var firmautsup = img.src

		if (fechautsup == '') {
			firmautsup = ''
		}

		var registroutsup = $('#registro'+f).val()

		f++;

		var fechautqaqc = $('#fecha'+f).val()
		var horautqaqc = $('#hora'+f).val()
		var nombreutqaqc = $('#nombre'+f).val()

		var img = document.getElementById("firma"+f);
		var firmautqaqc = img.src

		if (fechautqaqc == '') {
			firmautqaqc = ''
		}

		var registroutqaqc = $('#registro'+f).val()

		f++;

		var fechautec = $('#fecha'+f).val()
		var horautec = $('#hora'+f).val()
		var nombreutec = $('#nombre'+f).val()

		var img = document.getElementById("firma"+f);
		var firmautec = img.src

		if (fechautec == '') {
			firmautec = ''
		}

		var registroutec = $('#registro'+f).val()

		f++;

        arrayItems.push({
            "comp": comp,
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
			'fechautec': fechautec,
			'horautec': horautec,
			'nombreutec': nombreutec,
			'firmautec': firmautec,
			'registroutec': registroutec
        })

	}

	$.post(server + 'ac3321Componentes.php', {
		ods: odsq,
		tag: tag,
		datos: JSON.stringify(arrayItems)
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
				url: server + 'guardarArchivo3321.php',
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


	$.post(server + 'actOs3321Obs.php', {
		ods: odsq,
		tag: tag,
		datos: JSON.stringify(arrayLmp)
	},
		function (res) {
			console.log(res)
			location.reload()
		})

}

