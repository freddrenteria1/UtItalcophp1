
function agregarObs() {
    $('#tblobs').removeClass("oculto")
    $('#btnagregarObs').addClass("oculto")
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

var bdFirmas = JSON.parse(sessionStorage.getItem('bdFirmas'))

function buscarFirma(doc){
    for (var i = 0, len = bdFirmas.length; i < len; i++) {
        if (bdFirmas[i].documento === doc) {
            var firmaEnc = bdFirmas[i].firma;
            break;
        }
    }
    return firmaEnc;
}





if (tipouser == 'ecopetrol') {
    $("input, select,  textarea").prop('disabled', true);
    $('.ecp').prop('disabled', false)
    $('.ut').prop('disabled', true)
    $("input, select,  textarea").prop('disabled', false);
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
var listaArchivos = []



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

        //SE GUARADAN LOS DATOS DE LA FIRMA

       
        if (idImagen >= 1 && idImagen <= 54) {
            actCompTrab()
        }

        if (idImagen >= 55 && idImagen <= 66) {
            actPruebaConf()
        }

		if (idImagen >= 67 && idImagen <= 74) {
            actPruebaConf2()
        }

        if (idImagen >= 75 && idImagen <= 90) {
            actCierreManhole()
        }

        if (idImagen >= 91 && idImagen <= 93) {
            actAjustes()
        }

		if (idImagen >= 94 && idImagen <= 96) {
            actTerm()
        }

		if (idImagen >= 97 && idImagen <= 101) {
            actArranque()
        }

		if (idImagen >= 102 && idImagen <= 103) {
            actEntrega()
        }



        if (idImagen == 200) {
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
var cmls = []

odsq = localStorage.getItem('odsq');
equipos = sessionStorage.getItem('equipo')
alcance = sessionStorage.getItem('servicio')
esp = sessionStorage.getItem('esp')

var server = 'https://utitalco.com/calidad/034/server/';



cargando()
$.post(server + 'cargarRca3318.php', {
    ods: odsq,
    tag: tag
},
    function (resp) {
        arrayDatos = resp
        console.log(arrayDatos)


        cargarDatos()


    })


function cargarDatos() {

     
    //CARGUE DE DATOS LIMPIEZA

    if (arrayDatos.ejecucion != "") {
		arrayItems = JSON.parse(arrayDatos.ejecucion)
		console.log(arrayItems)

		var f = 1
		var c = 1

		for (var i = 0; i <= 17; i++) {

            console.log(f)

			$('#comptrab' + c).val(arrayItems[i].comptrab)

			$('#fecha' + f).val(arrayItems[i].fechautsup)
			$('#hora' + f).val(arrayItems[i].horautsup)
			$('#nombre' + f).val(arrayItems[i].nombreutsup)

			if (arrayItems[i].fechautsup != "") {


				var firmaUsuario = buscarFirma(arrayItems[i].registroutsup);
				document.querySelector("#firma"+f).src = firmaUsuario
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()

				 
			}

			$('#registro' + f).val(arrayItems[i].registroutsup)

			f++;
			console.log(f)

			console.log(arrayItems[i].nombreutqaqc)


			$('#fecha' + f).val(arrayItems[i].fechautqaqc)
			$('#hora' + f).val(arrayItems[i].horautqaqc)
			$('#nombre' + f).val(arrayItems[i].nombreutqaqc)

			if (arrayItems[i].fechautqaqc != "") {


				var firmaUsuario = buscarFirma(arrayItems[i].registroutqaqc);
				document.querySelector("#firma"+f).src = firmaUsuario
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()
 
			}

			$('#registro' + f).val(arrayItems[i].registroutqaqc)

			f++;
			console.log(f)


			$('#fecha' + f).val(arrayItems[i].fechautecp)
			$('#hora' + f).val(arrayItems[i].horautecp)
			$('#nombre' + f).val(arrayItems[i].nombreutecp)

			if (arrayItems[i].fechautecp != "") {

				var firmaUsuario = buscarFirma(arrayItems[i].registroutecp);
				document.querySelector("#firma"+f).src = firmaUsuario
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()

				 
			}

			$('#registro' + f).val(arrayItems[i].registroutecp)

			f++;
			console.log(f)

			c++;
			 
		}
	}
    
    if (arrayDatos.prueba != "") {
		arrayItems = JSON.parse(arrayDatos.prueba)

		var f = 55
		var c = 1

		for (var i = 0; i <= 3; i++) {

            //console.log(f)

			$('#compconf' + c).val(arrayItems[i].compconf)

			$('#fecha' + f).val(arrayItems[i].fechautsup)
			$('#hora' + f).val(arrayItems[i].horautsup)
			$('#nombre' + f).val(arrayItems[i].nombreutsup)

			if (arrayItems[i].fechautsup != "") {

				var firmaUsuario = buscarFirma(arrayItems[i].registroutsup);
				document.querySelector("#firma"+f).src = firmaUsuario
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()

			}

			$('#registro' + f).val(arrayItems[i].registroutsup)

			f++;

			$('#fecha' + f).val(arrayItems[i].fechautqaqc)
			$('#hora' + f).val(arrayItems[i].horautqaqc)
			$('#nombre' + f).val(arrayItems[i].nombreutqaqc)

			if (arrayItems[i].fechautqaqc != "") {

				var firmaUsuario = buscarFirma(arrayItems[i].registroutqaqc);
				document.querySelector("#firma"+f).src = firmaUsuario
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()

 
			}

			$('#registro' + f).val(arrayItems[i].registroutqaqc)

			f++;

			$('#fecha' + f).val(arrayItems[i].fechautecp)
			$('#hora' + f).val(arrayItems[i].horautecp)
			$('#nombre' + f).val(arrayItems[i].nombreutecp)

			if (arrayItems[i].fechautecp != "") {

				var firmaUsuario = buscarFirma(arrayItems[i].registroutecp);
				document.querySelector("#firma"+f).src = firmaUsuario
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()

 
			}

			$('#registro' + f).val(arrayItems[i].registroutecp)

			f++;
			c++;
			 
		}
	}

	if (arrayDatos.prueba2 != "") {
		arrayItems = JSON.parse(arrayDatos.prueba2)

		var f = 67
		var c = 5

		for (var i = 0; i <= 1; i++) {

            //console.log(f)

			$('#compconf' + c).val(arrayItems[i].compconf)

			$('#fecha' + f).val(arrayItems[i].fechautsup)
			$('#hora' + f).val(arrayItems[i].horautsup)
			$('#nombre' + f).val(arrayItems[i].nombreutsup)

			if (arrayItems[i].fechautsup != "") {

				var firmaUsuario = buscarFirma(arrayItems[i].registroutsup);
				document.querySelector("#firma"+f).src = firmaUsuario
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()

			}

			$('#registro' + f).val(arrayItems[i].registroutsup)

			f++;

			$('#fecha' + f).val(arrayItems[i].fechautqaqc)
			$('#hora' + f).val(arrayItems[i].horautqaqc)
			$('#nombre' + f).val(arrayItems[i].nombreutqaqc)

			if (arrayItems[i].fechautqaqc != "") {

				var firmaUsuario = buscarFirma(arrayItems[i].registroutqaqc);
				document.querySelector("#firma"+f).src = firmaUsuario
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()

 
			}

			$('#registro' + f).val(arrayItems[i].registroutqaqc)

			f++;

			$('#fecha' + f).val(arrayItems[i].fechautecp)
			$('#hora' + f).val(arrayItems[i].horautecp)
			$('#nombre' + f).val(arrayItems[i].nombreutecp)

			if (arrayItems[i].fechautecp != "") {

				var firmaUsuario = buscarFirma(arrayItems[i].registroutecp);
				document.querySelector("#firma"+f).src = firmaUsuario
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()

 
			}

			$('#registro' + f).val(arrayItems[i].registroutecp)

			f++;

			$('#fecha' + f).val(arrayItems[i].fechautecpo)
			$('#hora' + f).val(arrayItems[i].horautecpo)
			$('#nombre' + f).val(arrayItems[i].nombreutecpo)

			if (arrayItems[i].fechautecpo != "") {

				var firmaUsuario = buscarFirma(arrayItems[i].registroutecpo);
				document.querySelector("#firma"+f).src = firmaUsuario
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()

 
			}

			$('#registro' + f).val(arrayItems[i].registroutecpo)


			f++;
			c++;
			 
		}
	}

    if (arrayDatos.cierre != "") {
		arrayItems = JSON.parse(arrayDatos.cierre)

		var f = 75
		var c = 1

		for (var i = 0; i <= 15; i++) {

            //console.log(f)

			$('#compmangol' + c).val(arrayItems[i].compmangol)

			 
			$('#fecha' + f).val(arrayItems[i].fechautecp)
			$('#hora' + f).val(arrayItems[i].horautecp)
			$('#nombre' + f).val(arrayItems[i].nombreutecp)

			if (arrayItems[i].fechautecp != "") {
				document.querySelector("#firma"+f).src = arrayItems[i].firmautecp;
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()
			}

			$('#registro' + f).val(arrayItems[i].registroutecp)

			f++;
			c++;
			 
		}
	}

    if (arrayDatos.ajustes != "") {
		arrayItems = JSON.parse(arrayDatos.ajustes)

		var f = 91
		var c = 1

		 

            console.log(f)

            $('#itemajuste1').val(arrayItems[0].itemajuste1)
            $('#itemajuste2').val(arrayItems[0].itemajuste2)
            $('#itemajuste3').val(arrayItems[0].itemajuste3)
			$('#itemajuste4').val(arrayItems[0].itemajuste4)

			$('#fecha' + f).val(arrayItems[0].fechautsup)
			$('#hora' + f).val(arrayItems[0].horautsup)
			$('#nombre' + f).val(arrayItems[0].nombreutsup)

			if (arrayItems[0].fechautsup != "") {
				document.querySelector("#firma"+f).src = arrayItems[0].firmautsup;
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()
			}

			$('#registro' + f).val(arrayItems[0].registroutsup)

			f++;

			$('#fecha' + f).val(arrayItems[0].fechautqaqc)
			$('#hora' + f).val(arrayItems[0].horautqaqc)
			$('#nombre' + f).val(arrayItems[0].nombreutqaqc)

			if (arrayItems[0].fechautqaqc != "") {
				document.querySelector("#firma"+f).src = arrayItems[0].firmautqaqc;
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()
			}

			$('#registro' + f).val(arrayItems[0].registroutqaqc)

			f++;

			$('#fecha' + f).val(arrayItems[0].fechautecp)
			$('#hora' + f).val(arrayItems[0].horautecp)
			$('#nombre' + f).val(arrayItems[0].nombreutecp)

			if (arrayItems[0].fechautecp != "") {
				document.querySelector("#firma"+f).src = arrayItems[0].firmautecp;
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()
			}

			$('#registro' + f).val(arrayItems[0].registroutecp)

			
						 
		 
	}

	if (arrayDatos.terminacion != "") {
		arrayItems = JSON.parse(arrayDatos.terminacion)

		var f = 94
		var c = 1

		 

            console.log(f)

            $('#term1').val(arrayItems[0].term1)
            $('#term2').val(arrayItems[0].term2)
            $('#term3').val(arrayItems[0].term3)
			$('#term4').val(arrayItems[0].term4)

			$('#fecha' + f).val(arrayItems[0].fechautsup)
			$('#hora' + f).val(arrayItems[0].horautsup)
			$('#nombre' + f).val(arrayItems[0].nombreutsup)

			if (arrayItems[0].fechautsup != "") {
				document.querySelector("#firma"+f).src = arrayItems[0].firmautsup;
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()
			}

			$('#registro' + f).val(arrayItems[0].registroutsup)

			f++;

			$('#fecha' + f).val(arrayItems[0].fechautqaqc)
			$('#hora' + f).val(arrayItems[0].horautqaqc)
			$('#nombre' + f).val(arrayItems[0].nombreutqaqc)

			if (arrayItems[0].fechautqaqc != "") {
				document.querySelector("#firma"+f).src = arrayItems[0].firmautqaqc;
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()
			}

			$('#registro' + f).val(arrayItems[0].registroutqaqc)

			f++;

			$('#fecha' + f).val(arrayItems[0].fechautecp)
			$('#hora' + f).val(arrayItems[0].horautecp)
			$('#nombre' + f).val(arrayItems[0].nombreutecp)

			if (arrayItems[0].fechautecp != "") {
				document.querySelector("#firma"+f).src = arrayItems[0].firmautecp;
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()
			}

			$('#registro' + f).val(arrayItems[0].registroutecp)

			
						 
		 
	}

	if (arrayDatos.arranque != "") {
		arrayItems = JSON.parse(arrayDatos.arranque)

		var f = 97
		var c = 1

		 

            console.log(f)

            $('#parranque1').val(arrayItems[0].parranque1)
            $('#parranque2').val(arrayItems[0].parranque2)
             

			$('#fecha' + f).val(arrayItems[0].fechautsup)
			$('#hora' + f).val(arrayItems[0].horautsup)
			$('#nombre' + f).val(arrayItems[0].nombreutsup)

			if (arrayItems[0].fechautsup != "") {
				document.querySelector("#firma"+f).src = arrayItems[0].firmautsup;
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()
			}

			$('#registro' + f).val(arrayItems[0].registroutsup)

			f++;

			$('#fecha' + f).val(arrayItems[0].fechautqaqc)
			$('#hora' + f).val(arrayItems[0].horautqaqc)
			$('#nombre' + f).val(arrayItems[0].nombreutqaqc)

			if (arrayItems[0].fechautqaqc != "") {
				document.querySelector("#firma"+f).src = arrayItems[0].firmautqaqc;
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()
			}

			$('#registro' + f).val(arrayItems[0].registroutqaqc)

			f++;

			$('#fecha' + f).val(arrayItems[0].fechautecp)
			$('#hora' + f).val(arrayItems[0].horautecp)
			$('#nombre' + f).val(arrayItems[0].nombreutecp)

			if (arrayItems[0].fechautecp != "") {
				document.querySelector("#firma"+f).src = arrayItems[0].firmautecp;
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()
			}

			$('#registro' + f).val(arrayItems[0].registroutecp)

			f++

			$('#fecha' + f).val(arrayItems[0].fechautsup2)
			$('#hora' + f).val(arrayItems[0].horautsup2)
			$('#nombre' + f).val(arrayItems[0].nombreutsup2)

			if (arrayItems[0].fechautsup2 != "") {
				document.querySelector("#firma"+f).src = arrayItems[0].firmautsup2;
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()
			}

			$('#registro' + f).val(arrayItems[0].registroutsup2)

			f++;

			$('#fecha' + f).val(arrayItems[0].fechautecp2)
			$('#hora' + f).val(arrayItems[0].horautecp2)
			$('#nombre' + f).val(arrayItems[0].nombreutecp2)

			if (arrayItems[0].fechautecp2 != "") {
				document.querySelector("#firma"+f).src = arrayItems[0].firmautecp2;
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()
			}

			$('#registro' + f).val(arrayItems[0].registroutecp2)

			
						 
		 
	}

	if (arrayDatos.entrega != "") {
		arrayItems = JSON.parse(arrayDatos.entrega)

		var f = 102
		var c = 1

		 

            console.log(f)

            $('#entrega1').val(arrayItems[0].entrega1)
            $('#entrega2').val(arrayItems[0].entrega2)
            $('#entrega3').val(arrayItems[0].entrega3)

			$('#fecha' + f).val(arrayItems[0].fechautsup)
			$('#hora' + f).val(arrayItems[0].horautsup)
			$('#nombre' + f).val(arrayItems[0].nombreutsup)

			if (arrayItems[0].fechautsup != "") {
				document.querySelector("#firma"+f).src = arrayItems[0].firmautsup;
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()
			}

			$('#registro' + f).val(arrayItems[0].registroutsup)

			f++;

			$('#fecha' + f).val(arrayItems[0].fechautecp)
			$('#hora' + f).val(arrayItems[0].horautecp)
			$('#nombre' + f).val(arrayItems[0].nombreutecp)

			if (arrayItems[0].fechautecp != "") {
				document.querySelector("#firma"+f).src = arrayItems[0].firmautecp;
				$('#firma'+f).removeClass('oculto')
				$('#btnFirmar'+f).hide()
			}

			$('#registro' + f).val(arrayItems[0].registroutecp)

			
						 
		 
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

            var firmaUsuario = buscarFirma(arrayObs[i].registro);

            imagef.src = firmaUsuario

            imagef.height = "60"
            document.querySelector('#firm' + i).appendChild(imagef)

        }
    }
    if (arrayDatos.doc != "") {
        listaArchivos = JSON.parse(arrayDatos.doc)

    }


    Swal.close()
    // actInstalacion()
    // actApertura()
    //actLimpieza()
    //actRetiro()
    //actEntrega() 
}


////////ACTUALIZA INFORMACION//////////////////////


function actCompTrab() {

	var arrayItems = []

	var f = 1

	for (var i = 1; i <= 18; i++) {

        console.log(f)

		
		var comptrab = $('#comptrab' + i).val()

		var fechautsup = $('#fecha'+f).val()
		var horautsup = $('#hora'+f).val()
		var nombreutsup = $('#nombre'+f).val()

		var img = document.getElementById("firma"+f);
		var firmautsup =  $('#registro'+f).val()

		if (fechautsup == '') {
			firmautsup = ''
		}

		var registroutsup = $('#registro'+f).val()

		f++;

		var fechautqaqc = $('#fecha'+f).val()
		var horautqaqc = $('#hora'+f).val()
		var nombreutqaqc = $('#nombre'+f).val()

		var img = document.getElementById("firma"+f);
		var firmautqaqc = $('#registro'+f).val()

		if (fechautqaqc == '') {
			firmautqaqc = ''
		}

		var registroutqaqc = $('#registro'+f).val()

		f++;

		var fechautecp = $('#fecha'+f).val()
		var horautecp = $('#hora'+f).val()
		var nombreutecp = $('#nombre'+f).val()

		var img = document.getElementById("firma"+f);
		var firmautecp =  $('#registro'+f).val()

		if (fechautecp == '') {
			firmautecp = ''
		}

		var registroutecp = $('#registro'+f).val()

		f++;

        arrayItems.push({
            "comptrab": comptrab,
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
			'fechautecp': fechautecp,
			'horautecp': horautecp,
			'nombreutecp': nombreutecp,
			'firmautecp': firmautecp,
			'registroutecp': registroutecp
        })

	}

	$.post(server + 'actOs3318Componentes.php', {
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

function actPruebaConf() {

	var arrayItems = []

	var f = 55

	for (var i = 1; i <= 4; i++) {

        console.log(f)

		
		var compconf = $('#compconf' + i).val()

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

		var fechautecp = $('#fecha'+f).val()
		var horautecp = $('#hora'+f).val()
		var nombreutecp = $('#nombre'+f).val()

		var img = document.getElementById("firma"+f);
		var firmautecp = img.src

		if (fechautecp == '') {
			firmautecp = ''
		}

		var registroutecp = $('#registro'+f).val()

		f++;

        arrayItems.push({
            "compconf": compconf,
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
			'fechautecp': fechautecp,
			'horautecp': horautecp,
			'nombreutecp': nombreutecp,
			'firmautecp': firmautecp,
			'registroutecp': registroutecp
        })

	}

	$.post(server + 'actOs3318PruebaConf.php', {
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

function actPruebaConf2() {

	var arrayItems = []

	var f = 67
	var a = 4

	for (var i = 1; i <= 2; i++) {

        console.log(f)

		a++;

		var compconf = $('#compconf' + a).val()

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

		var fechautecp = $('#fecha'+f).val()
		var horautecp = $('#hora'+f).val()
		var nombreutecp = $('#nombre'+f).val()

		var img = document.getElementById("firma"+f);
		var firmautecp = img.src

		if (fechautecp == '') {
			firmautecp = ''
		}

		var registroutecp = $('#registro'+f).val()

		f++;

		var fechautecpo = $('#fecha'+f).val()
		var horautecpo = $('#hora'+f).val()
		var nombreutecpo = $('#nombre'+f).val()

		var img = document.getElementById("firma"+f);
		var firmautecpo = img.src

		if (fechautecpo == '') {
			firmautecpo = ''
		}

		var registroutecpo = $('#registro'+f).val()

		f++;

        arrayItems.push({
            "compconf": compconf,
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
			'fechautecp': fechautecp,
			'horautecp': horautecp,
			'nombreutecp': nombreutecp,
			'firmautecp': firmautecp,
			'registroutecp': registroutecp,
			'fechautecpo': fechautecpo,
			'horautecpo': horautecpo,
			'nombreutecpo': nombreutecpo,
			'firmautecpo': firmautecpo,
			'registroutecpo': registroutecpo
        })

	}

	$.post(server + 'actOs3318PruebaConf2.php', {
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


function actCierreManhole() {

	var arrayItems = []

	var f = 75

	for (var i = 1; i <= 16; i++) {

        console.log(f)
		
		var compmangol = $('#compmangol' + i).val()

		var fechautecp = $('#fecha'+f).val()
		var horautecp = $('#hora'+f).val()
		var nombreutecp = $('#nombre'+f).val()

		var img = document.getElementById("firma"+f);
		var firmautecp = img.src

		if (fechautecp == '') {
			firmautecp = ''
		}

		var registroutecp = $('#registro'+f).val()

		f++;

        arrayItems.push({
            "compmangol": compmangol,
			'fechautecp': fechautecp,
			'horautecp': horautecp,
			'nombreutecp': nombreutecp,
			'firmautecp': firmautecp,
			'registroutecp': registroutecp
        })

	}

	$.post(server + 'actOs3318CierreManhol.php', {
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

function actAjustes() {

	var arrayItems = []

	
		
		var itemajuste1 = $('#itemajuste1').val()
        var itemajuste2 = $('#itemajuste2').val()
        var itemajuste3 = $('#itemajuste3').val()
        var itemajuste4 = $('#itemajuste4').val()

		var fechautsup = $('#fecha91').val()
		var horautsup = $('#hora91').val()
		var nombreutsup = $('#nombre91').val()

		var img = document.getElementById("firma91");
		var firmautsup = img.src

		if (fechautsup == '') {
			firmautsup = ''
		}

		var registroutsup = $('#registro91').val()

        f=91;
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

		var fechautecp = $('#fecha'+f).val()
		var horautecp = $('#hora'+f).val()
		var nombreutecp = $('#nombre'+f).val()

		var img = document.getElementById("firma"+f);
		var firmautecp = img.src

		if (fechautecp == '') {
			firmautecp = ''
		}

		var registroutecp = $('#registro'+f).val()

		

        arrayItems.push({
            "itemajuste1": itemajuste1,
            "itemajuste2": itemajuste2,
            "itemajuste3": itemajuste3,
            "itemajuste4": itemajuste4,
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
			'fechautecp': fechautecp,
			'horautecp': horautecp,
			'nombreutecp': nombreutecp,
			'firmautecp': firmautecp,
			'registroutecp': registroutecp
        })

	

	$.post(server + 'actOs3318Ajustes.php', {
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

function actTerm() {

	var arrayItems = []

	
		
		var term1 = $('#term1').val()
        var term2 = $('#term2').val()
        var term3 = $('#term3').val()
        var term4 = $('#term4').val()

		var fechautsup = $('#fecha94').val()
		var horautsup = $('#hora94').val()
		var nombreutsup = $('#nombre94').val()

		var img = document.getElementById("firma94");
		var firmautsup = img.src

		if (fechautsup == '') {
			firmautsup = ''
		}

		var registroutsup = $('#registro94').val()

        f=94;
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

		var fechautecp = $('#fecha'+f).val()
		var horautecp = $('#hora'+f).val()
		var nombreutecp = $('#nombre'+f).val()

		var img = document.getElementById("firma"+f);
		var firmautecp = img.src

		if (fechautecp == '') {
			firmautecp = ''
		}

		var registroutecp = $('#registro'+f).val()

		

        arrayItems.push({
            "term1": term1,
            "term2": term2,
            "term3": term3,
            "term4": term4,
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
			'fechautecp': fechautecp,
			'horautecp': horautecp,
			'nombreutecp': nombreutecp,
			'firmautecp': firmautecp,
			'registroutecp': registroutecp
        })

	

	$.post(server + 'actOs3318Terminacion.php', {
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

function actArranque() {

	var arrayItems = []

	
		
		var parranque1 = $('#parranque1').val()
        var parranque2 = $('#parranque2').val()
        

		var fechautsup = $('#fecha97').val()
		var horautsup = $('#hora97').val()
		var nombreutsup = $('#nombre97').val()

		var img = document.getElementById("firma97");
		var firmautsup = img.src

		if (fechautsup == '') {
			firmautsup = ''
		}

		var registroutsup = $('#registro97').val()

        f=97;
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

		var fechautecp = $('#fecha'+f).val()
		var horautecp = $('#hora'+f).val()
		var nombreutecp = $('#nombre'+f).val()

		var img = document.getElementById("firma"+f);
		var firmautecp = img.src

		if (fechautecp == '') {
			firmautecp = ''
		}

		var registroutecp = $('#registro'+f).val()

		f++;

		var fechautsup2 = $('#fecha'+f).val()
		var horautsup2 = $('#hora'+f).val()
		var nombreutsup2 = $('#nombre'+f).val()

		var img = document.getElementById("firma"+f);
		var firmautsup2 = img.src

		if (fechautsup2 == '') {
			firmautsup2 = ''
		}

		var registroutsup2 = $('#registro'+f).val()

		f++;

		var fechautecp2 = $('#fecha'+f).val()
		var horautecp2 = $('#hora'+f).val()
		var nombreutecp2 = $('#nombre'+f).val()

		var img = document.getElementById("firma"+f);
		var firmautecp2 = img.src

		if (fechautecp2 == '') {
			firmautecp2 = ''
		}

		var registroutecp2 = $('#registro'+f).val()

		

        arrayItems.push({
            "parranque1": parranque1,
            "parranque2": parranque2,
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
			'fechautecp': fechautecp,
			'horautecp': horautecp,
			'nombreutecp': nombreutecp,
			'firmautecp': firmautecp,
			'registroutecp': registroutecp,
			'fechautsup2': fechautsup2,
			'horautsup2': horautsup2,
			'nombreutsup2': nombreutsup2,
			'firmautsup2': firmautsup2,
			'registroutsup2': registroutsup2,
			'fechautecp2': fechautecp2,
			'horautecp2': horautecp2,
			'nombreutecp2': nombreutecp2,
			'firmautecp2': firmautecp2,
			'registroutecp2': registroutecp2
        })

	

	$.post(server + 'actOs3318Arranque.php', {
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

function actEntrega() {

	var arrayItems = []

	
		
		var entrega1 = $('#entrega1').val()
        var entrega2 = $('#entrega2').val()
        var entrega3 = $('#entrega3').val()
        

		var fechautsup = $('#fecha102').val()
		var horautsup = $('#hora102').val()
		var nombreutsup = $('#nombre102').val()

		var img = document.getElementById("firma102");
		var firmautsup = img.src

		if (fechautsup == '') {
			firmautsup = ''
		}

		var registroutsup = $('#registro102').val()

        f=102;
		f++;

		 
		var fechautecp = $('#fecha'+f).val()
		var horautecp = $('#hora'+f).val()
		var nombreutecp = $('#nombre'+f).val()

		var img = document.getElementById("firma"+f);
		var firmautecp = img.src

		if (fechautecp == '') {
			firmautecp = ''
		}

		var registroutecp = $('#registro'+f).val()

		

        arrayItems.push({
            "entrega1": entrega1,
            "entrega2": entrega2,
            "entrega3": entrega3,
			'fechautsup': fechautsup,
			'horautsup': horautsup,
			'nombreutsup': nombreutsup,
			'firmautsup': firmautsup,
			'registroutsup': registroutsup,
			'fechautecp': fechautecp,
			'horautecp': horautecp,
			'nombreutecp': nombreutecp,
			'firmautecp': firmautecp,
			'registroutecp': registroutecp
        })

	

	$.post(server + 'actOs3318Entrega.php', {
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
                    <a href='https://utitalco.com/calidad/034/server/archivos/${listaArchivos[i].archivo}' target='_blank'>${listaArchivos[i].archivo}</a> <br>
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
                url: server + 'guardarArchivo3318.php',
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
    var observacion = $('#obs200').val()
    observacion = observacion.replace(/(\r\n|\n|\r)/gm, " ")
    observacion = observacion.replace(/["]/gm, "``")
    observacion = observacion.replace(/[“]/gm, "``")
    observacion = observacion.replace(/[”]/gm, "``")
    observacion = observacion.replace(/[']/gm, "`")
    var nombreobs = $('#nombre200').val()
    var registroobs = $('#registro200').val()
    var img = document.getElementById("firma200");

    // crea un nuevo objeto `Date`
    var today = new Date();

    // obtener la fecha y la hora
    var now = today.toLocaleString();
    var firmaobs = registroobs

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


    $.post(server + 'actOs3318Obs.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayLmp)
    },
        function (res) {
            console.log(res)
            location.reload()
        })

}
