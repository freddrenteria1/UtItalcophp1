
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

        if (idImagen == 1 || idImagen == 2) {
            actInstalacion()
        }

        if (idImagen == 3 || idImagen == 4) {
            actApertura()
        }

        if (idImagen >= 5 && idImagen <= 9) {
            actLimpieza()
        }

        if (idImagen >= 10 && idImagen <= 15) {
            actInspeccion()
        }

        if (idImagen >= 16 && idImagen <= 30) {
            actComponentes()
        }

        if (idImagen == 31 || idImagen == 32) {
            actCierreM1()
        }

        if (idImagen == 33 || idImagen == 34) {
            actCierreM2()
        }

        if (idImagen >= 35 && idImagen <= 37) {
            actAjustes()
        }

        if (idImagen >= 38 && idImagen <= 40) {
            actTerminacion()
        }

        if (idImagen >= 41 && idImagen <= 43) {
            actAplicacion()
        }

        if (idImagen == 44 || idImagen == 45) {
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
$.post(server + 'cargarRca3320.php', {
    ods: odsq,
    tag: tag
},
    function (resp) {
        arrayDatos = resp
        console.log(arrayDatos)


        cargarDatos()


    })


function cargarDatos() {

    // CARGUE DATOS DE INSTALACION

    if (arrayDatos.instalacion != "") {

        var arrayInfo = JSON.parse(arrayDatos.instalacion)

        $('#inst1').val(arrayInfo[0].inst1)
        $('#inst2').val(arrayInfo[0].inst2)
        $('#inst3').val(arrayInfo[0].inst3)
        $('#inst4').val(arrayInfo[0].inst4)

        $('#fecha1').val(arrayInfo[0].fechaecp)
        $('#hora1').val(arrayInfo[0].horaecp)
        $('#nombre1').val(arrayInfo[0].nombreecp)

        var firmaUsuario = buscarFirma(arrayInfo[0].registroecp);

        document.querySelector("#firma1").src = firmaUsuario;

        if (arrayInfo[0].fechaecp != "") {
            $('#firma1').removeClass('oculto')
            $('#btnFirmar1').hide()
        }
        $('#registro1').val(arrayInfo[0].registroecp)

        $('#fecha2').val(arrayInfo[0].fechautsup)
        $('#hora2').val(arrayInfo[0].horautsup)
        $('#nombre2').val(arrayInfo[0].nombreutsup)

        var firmaUsuario = buscarFirma(arrayInfo[0].registroutsup);

        document.querySelector("#firma2").src = firmaUsuario;

        if (arrayInfo[0].fechautsup != "") {
            $('#firma2').removeClass('oculto')
            $('#btnFirmar2').hide()
        }

        $('#registro2').val(arrayInfo[0].registroutsup)

    }



    //CARGUE DE DATOS APERTURA

    if (arrayDatos.apertura != "") {

        var arrayInfo = JSON.parse(arrayDatos.apertura)

        $('#apertM1').val(arrayInfo[0].apertM1)
        $('#apertM2').val(arrayInfo[0].apertM2)
        $('#apertM3').val(arrayInfo[0].apertM3)
        $('#apertM4').val(arrayInfo[0].apertM4)

        $('#fecha3').val(arrayInfo[0].fechautsup)
        $('#hora3').val(arrayInfo[0].horautsup)
        $('#nombre3').val(arrayInfo[0].nombreutsup)

        var firmaUsuario = buscarFirma(arrayInfo[0].registroutsup);

        document.querySelector("#firma3").src = firmaUsuario;

        if (arrayInfo[0].fechautsup != "") {
            $('#firma3').removeClass('oculto')
            $('#btnFirmar3').hide()
        }
        $('#registro3').val(arrayInfo[0].registroutsup)

        $('#fecha4').val(arrayInfo[0].fechautsup2)
        $('#hora4').val(arrayInfo[0].horautsup2)
        $('#nombre4').val(arrayInfo[0].nombreutsup2)

        var firmaUsuario = buscarFirma(arrayInfo[0].registroutsup2);

        document.querySelector("#firma4").src = firmaUsuario;

        if (arrayInfo[0].fechautsup2 != "") {
            $('#firma4').removeClass('oculto')
            $('#btnFirmar4').hide()
        }

        $('#registro4').val(arrayInfo[0].registroutsup2)

    }

    //CARGUE DE DATOS LIMPIEZA

    if (arrayDatos.limpieza != "") {

        var num = 4;
        var numc = 0;

        var arrayInfo = JSON.parse(arrayDatos.limpieza)

        for (var i = 0; i <= 4; i++) {
            num++
            numc++


            $('#complimp' + numc).val(arrayInfo[i].complimp)

            $('#fecha' + num).val(arrayInfo[i].fechautsup)
            $('#hora' + num).val(arrayInfo[i].horautsup)
            $('#nombre' + num).val(arrayInfo[i].nombreutsup)

            var firmaUsuario = buscarFirma(arrayInfo[i].registroutsup);

            document.querySelector("#firma" + num).src = firmaUsuario;

            if (arrayInfo[i].nombreutsup != "") {
                $('#firma' + num).removeClass('oculto')
                $('#btnFirmar' + num).hide()
            }
            $('#registro' + num).val(arrayInfo[i].registroutsup)



        }

    }

    //CARGUE DE DATOS INSPECCION

    if (arrayDatos.inspeccion != "") {

        var num = 10;
        var numc = 1;

        var arrayInfo = JSON.parse(arrayDatos.inspeccion)

        for (var i = 0; i <= 4; i++) {
            num++
            numc++


            $('#compinsp' + numc).val(arrayInfo[i].compinsp)

            $('#fecha' + num).val(arrayInfo[i].fechaecp)
            $('#hora' + num).val(arrayInfo[i].horaecp)
            $('#nombre' + num).val(arrayInfo[i].nombreecp)

            var firmaUsuario = buscarFirma(arrayInfo[i].registroecp);

            document.querySelector("#firma" + num).src = firmaUsuario;

            if (arrayInfo[i].nombreecp != "") {
                $('#firma' + num).removeClass('oculto')
                $('#btnFirmar' + num).hide()
            }
            $('#registro' + num).val(arrayInfo[i].registroecp)



        }

    }


    //CARGUE DE DATOS LIBERACION

    if (arrayDatos.liberacion != "") {

		arrayInfo = JSON.parse(arrayDatos.liberacion)


		$('#itemlib1').val(arrayInfo[0].itemLib1)
		$('#itemlib2').val(arrayInfo[0].itemLib2)
		$('#itemlib3').val(arrayInfo[0].itemLib3)

		$('#numejectec').val(arrayInfo[0].numejecucion)

		
	}

    // CARGUE DE DATOS COMPONENTES DE LIBERACION
    
    if (arrayDatos.componentes != "") {
		arrayItems = JSON.parse(arrayDatos.componentes)

		var f = 16
		var c = 1

		for (var i = 0; i <= 4; i++) {

            console.log(f)

			$('#complib' + c).val(arrayItems[i].complib)

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


    // CARGUE DE DATOS DE CIERRE MANHOL1

    if (arrayDatos.cierrem1 != "") {

		arrayInfo = JSON.parse(arrayDatos.cierrem1)


		$('#manhol1').val(arrayInfo[0].manhol1)

		$('#fecha31').val(arrayInfo[0].fechautsup)
		$('#hora31').val(arrayInfo[0].horautsup)
		$('#nombre31').val(arrayInfo[0].nombreutsup)

		if (arrayInfo[0].fechautsup != "") {
            var firmaUsuario = buscarFirma(arrayInfo[0].registroutsup);
			document.querySelector("#firma31").src = firmaUsuario
			$('#firma31').removeClass('oculto')
			$('#btnFirmar31').hide()
		}

		$('#registro31').val(arrayInfo[0].registroutsup)

		$('#fecha32').val(arrayInfo[0].fechaecp)
		$('#hora32').val(arrayInfo[0].horaecp)
		$('#nombre32').val(arrayInfo[0].nombreecp)

		if (arrayInfo[0].fechaecp != "") {
            var firmaUsuario = buscarFirma(arrayInfo[0].registroecp);
			document.querySelector("#firma32").src = firmaUsuario
			$('#firma32').removeClass('oculto')
			$('#btnFirmar32').hide()
		}

		$('#registro32').val(arrayInfo[0].registroecp)
		

	}

     // CARGUE DE DATOS DE CIERRE MANHOL2

     if (arrayDatos.cierrem2 != "") {

		arrayInfo = JSON.parse(arrayDatos.cierrem2)


		$('#manhol2').val(arrayInfo[0].manhol2)

		$('#fecha33').val(arrayInfo[0].fechautsup)
		$('#hora33').val(arrayInfo[0].horautsup)
		$('#nombre33').val(arrayInfo[0].nombreutsup)

		if (arrayInfo[0].fechautsup != "") {
            var firmaUsuario = buscarFirma(arrayInfo[0].registroutsup);
			document.querySelector("#firma33").src = firmaUsuario
			$('#firma33').removeClass('oculto')
			$('#btnFirmar33').hide()
		}

		$('#registro33').val(arrayInfo[0].registroutsup)

		$('#fecha34').val(arrayInfo[0].fechaecp)
		$('#hora34').val(arrayInfo[0].horaecp)
		$('#nombre34').val(arrayInfo[0].nombreecp)

		if (arrayInfo[0].fechaecp != "") {
            var firmaUsuario = buscarFirma(arrayInfo[0].registroecp);
			document.querySelector("#firma34").src = firmaUsuario
			$('#firma34').removeClass('oculto')
			$('#btnFirmar34').hide()
		}

		$('#registro34').val(arrayInfo[0].registroecp)
		

	}


    // CARGUE DE DATOS AJUSTES BRIDAS

    if (arrayDatos.ajustes != "") {

		arrayInfo = JSON.parse(arrayDatos.ajustes)


		$('#ajuste1').val(arrayInfo[0].ajuste1)
        $('#ajuste2').val(arrayInfo[0].ajuste2)
        $('#ajuste3').val(arrayInfo[0].ajuste3)
        $('#ajuste4').val(arrayInfo[0].ajuste4)

		$('#fecha35').val(arrayInfo[0].fechautsup)
		$('#hora35').val(arrayInfo[0].horautsup)
		$('#nombre35').val(arrayInfo[0].nombreutsup)

		if (arrayInfo[0].fechautsup != "") {
            var firmaUsuario = buscarFirma(arrayInfo[0].registroutsup);
			document.querySelector("#firma35").src = firmaUsuario
			$('#firma35').removeClass('oculto')
			$('#btnFirmar35').hide()
		}

		$('#registro35').val(arrayInfo[0].registroutsup)

		$('#fecha36').val(arrayInfo[0].fechautqaqc)
		$('#hora36').val(arrayInfo[0].horautqaqc)
		$('#nombre36').val(arrayInfo[0].nombreutqaqc)

		if (arrayInfo[0].fechautqaqc != "") {
            var firmaUsuario = buscarFirma(arrayInfo[0].registroutqaqc);
			document.querySelector("#firma36").src = firmaUsuario
			$('#firma36').removeClass('oculto')
			$('#btnFirmar36').hide()
		}

		$('#registro36').val(arrayInfo[0].registroutqaqc)

        $('#fecha37').val(arrayInfo[0].fechaecpg)
		$('#hora37').val(arrayInfo[0].horaecpg)
		$('#nombre37').val(arrayInfo[0].nombreecpg)

		if (arrayInfo[0].fechaecpg != "") {
            var firmaUsuario = buscarFirma(arrayInfo[0].registroecpg);
			document.querySelector("#firma37").src = firmaUsuario;
			$('#firma37').removeClass('oculto')
			$('#btnFirmar37').hide()
		}

		$('#registro37').val(arrayInfo[0].registroecpg)
		

	}

    // CARGUE DE DATOS TERMINACION
    if (arrayDatos.terminacion != "") {

		arrayInfo = JSON.parse(arrayDatos.terminacion)


		$('#itemterm1').val(arrayInfo[0].itemterm1)
        $('#itemterm2').val(arrayInfo[0].itemterm2)
        $('#itemterm3').val(arrayInfo[0].itemterm3)
        $('#itemterm4').val(arrayInfo[0].itemterm4)

		$('#fecha38').val(arrayInfo[0].fechautsup)
		$('#hora38').val(arrayInfo[0].horautsup)
		$('#nombre38').val(arrayInfo[0].nombreutsup)

		if (arrayInfo[0].fechautsup != "") {
            var firmaUsuario = buscarFirma(arrayInfo[0].registroutsup);
			document.querySelector("#firma38").src = firmaUsuario
			$('#firma38').removeClass('oculto')
			$('#btnFirmar38').hide()
		}

		$('#registro38').val(arrayInfo[0].registroutsup)

		$('#fecha39').val(arrayInfo[0].fechautqaqc)
		$('#hora39').val(arrayInfo[0].horautqaqc)
		$('#nombre39').val(arrayInfo[0].nombreutqaqc)

		if (arrayInfo[0].fechautqaqc != "") {
            var firmaUsuario = buscarFirma(arrayInfo[0].registroutqaqc);
			document.querySelector("#firma39").src = firmaUsuario
			$('#firma39').removeClass('oculto')
			$('#btnFirmar39').hide()
		}

		$('#registro39').val(arrayInfo[0].registroutqaqc)

        $('#fecha40').val(arrayInfo[0].fechaecpg)
		$('#hora40').val(arrayInfo[0].horaecpg)
		$('#nombre40').val(arrayInfo[0].nombreecpg)

		if (arrayInfo[0].fechaecpg != "") {
            var firmaUsuario = buscarFirma(arrayInfo[0].registroecpg);
			document.querySelector("#firma40").src = firmaUsuario
			$('#firma40').removeClass('oculto')
			$('#btnFirmar40').hide()
		}

		$('#registro40').val(arrayInfo[0].registroecpg)
		

	}

    // CARGUE DE DATOS APLICACION PINTURA
    if (arrayDatos.aplicacion != "") {

		arrayInfo = JSON.parse(arrayDatos.aplicacion)


		$('#itemapli1').val(arrayInfo[0].itemapli1)
        $('#itemapli2').val(arrayInfo[0].itemapli2)

		$('#fecha41').val(arrayInfo[0].fechautsup)
		$('#hora41').val(arrayInfo[0].horautsup)
		$('#nombre41').val(arrayInfo[0].nombreutsup)

		if (arrayInfo[0].fechautsup != "") {
            var firmaUsuario = buscarFirma(arrayInfo[0].registroutsup);
			document.querySelector("#firma41").src = firmaUsuario
			$('#firma41').removeClass('oculto')
			$('#btnFirmar41').hide()
		}

		$('#registro41').val(arrayInfo[0].registroutsup)

		$('#fecha42').val(arrayInfo[0].fechautqaqc)
		$('#hora42').val(arrayInfo[0].horautqaqc)
		$('#nombre42').val(arrayInfo[0].nombreutqaqc)

		if (arrayInfo[0].fechautqaqc != "") {
            var firmaUsuario = buscarFirma(arrayInfo[0].registroutqaqc);
			document.querySelector("#firma42").src = firmaUsuario
			$('#firma42').removeClass('oculto')
			$('#btnFirmar42').hide()
		}

		$('#registro42').val(arrayInfo[0].registroutqaqc)

        $('#fecha43').val(arrayInfo[0].fechaecpg)
		$('#hora43').val(arrayInfo[0].horaecpg)
		$('#nombre43').val(arrayInfo[0].nombreecpg)

		if (arrayInfo[0].fechaecpg != "") {
            var firmaUsuario = buscarFirma(arrayInfo[0].registroecpg);
			document.querySelector("#firma43").src = firmaUsuario
			$('#firma43').removeClass('oculto')
			$('#btnFirmar43').hide()
		}

		$('#registro43').val(arrayInfo[0].registroecpg)
		

	}

    // CARGUE DE DATOS ENTREGA
    if (arrayDatos.entrega != "") {

		arrayInfo = JSON.parse(arrayDatos.entrega)


		$('#entrega1').val(arrayInfo[0].entrega1)
        $('#entrega2').val(arrayInfo[0].entrega2)
        $('#entrega3').val(arrayInfo[0].entrega3)

		$('#fecha44').val(arrayInfo[0].fechaecp)
		$('#hora44').val(arrayInfo[0].horaecp)
		$('#nombre44').val(arrayInfo[0].nombreecp)

		if (arrayInfo[0].fechaecp != "") {
            var firmaUsuario = buscarFirma(arrayInfo[0].registroecp);
			document.querySelector("#firma44").src = firmaUsuario
			$('#firma44').removeClass('oculto')
			$('#btnFirmar44').hide()
		}

		$('#registro44').val(arrayInfo[0].registroecp)

		$('#fecha45').val(arrayInfo[0].fechautsup)
		$('#hora45').val(arrayInfo[0].horautsup)
		$('#nombre45').val(arrayInfo[0].nombreutsup)

		if (arrayInfo[0].fechautsup != "") {
            var firmaUsuario = buscarFirma(arrayInfo[0].registroutsup);
			document.querySelector("#firma45").src = firmaUsuario
			$('#firma45').removeClass('oculto')
			$('#btnFirmar45').hide()
		}

		$('#registro45').val(arrayInfo[0].registroutsup)

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

function actInstalacion() {

    inst1 = $('#inst1').val()
    inst2 = $('#inst2').val()
    inst3 = $('#inst3').val()
    inst4 = $('#inst4').val()


    //operaciones ecopetrol
    var fechaecp = $('#fecha1').val()
    var horaecp = $('#hora1').val()
    var nombreecp = $('#nombre1').val()

    //var img = document.getElementById("firma1");
    var firmaecp = $('#registro1').val()

    if (fechaecp == '') {
        firmaecp = ''
    }

    var registroecp = $('#registro1').val()

    //qaqc
    var fechautsup = $('#fecha2').val()
    var horautsup = $('#hora2').val()
    var nombreutsup = $('#nombre2').val()

    //var img = document.getElementById("firma2");
    var firmautsup = $('#registro2').val()

    if (fechautsup == '') {
        firmautsup = ''
    }

    var registroutsup = $('#registro2').val()

    var arrayInfo = []

    arrayInfo.push({
        "inst1": inst1,
        "inst2": inst2,
        "inst3": inst3,
        "inst4": inst4,
        "fechaecp": fechaecp,
        "horaecp": horaecp,
        "nombreecp": nombreecp,
        "firmaecp": firmaecp,
        "registroecp": registroecp,
        "fechautsup": fechautsup,
        "horautsup": horautsup,
        "nombreutsup": nombreutsup,
        "firmautsp": firmautsup,
        "registroutsup": registroutsup
    })

    console.log(arrayInfo)

    $.post(server + 'actOs3320Instalacion.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayInfo)
    },
        function (res) {
            console.log(res)
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                width: 100,
                showConfirmButton: false,
                timer: 1500
            })
        })




}


function actApertura() {

    apertM1 = $('#apertM1').val()
    apertM2 = $('#apertM2').val()
    apertM3 = $('#apertM3').val()
    apertM4 = $('#apertM4').val()

    //supervisor
    var fechautsup = $('#fecha3').val()
    var horautsup = $('#hora3').val()
    var nombreutsup = $('#nombre3').val()

    //var img = document.getElementById("firma1");
    var firmautsup = $('#registro3').val()

    if (fechautsup == '') {
        firmautsup = ''
    }

    var registroutsup = $('#registro3').val()

    //supervisor
    var fechautsup2 = $('#fecha4').val()
    var horautsup2 = $('#hora4').val()
    var nombreutsup2 = $('#nombre4').val()

    //var img = document.getElementById("firma2");
    var firmautsup2 = $('#registro4').val()

    if (fechautsup2 == '') {
        firmautsup2 = ''
    }

    var registroutsup2 = $('#registro4').val()

    var arrayInfo = []

    arrayInfo.push({
        "apertM1": apertM1,
        "apertM2": apertM2,
        "apertM3": apertM3,
        "apertM4": apertM4,
        "fechautsup": fechautsup,
        "horautsup": horautsup,
        "nombreutsup": nombreutsup,
        "firmautsup": firmautsup,
        "registroutsup": registroutsup,
        "fechautsup2": fechautsup2,
        "horautsup2": horautsup2,
        "nombreutsup2": nombreutsup2,
        "firmautsp2": firmautsup2,
        "registroutsup2": registroutsup2
    })

    console.log(arrayInfo)

    $.post(server + 'actOs3320Apertura.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayInfo)
    },
        function (res) {
            console.log(res)
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                width: 100,
                showConfirmButton: false,
                timer: 1500
            })
        })




}

function actLimpieza() {

    var num = 4;
    var numc = 0;

    var arrayInfo = []


    for (var i = 1; i <= 5; i++) {

        num++
        numc++

        var complimp = $('#complimp' + numc).val()

        var fechautsup = $('#fecha' + num).val()
        var horautsup = $('#hora' + num).val()
        var nombreutsup = $('#nombre' + num).val()

        //var img = document.getElementById("firma" + num);

        if (fechautsup != '') {
            var firmautsup = $('#registro' + num).val()
        } else {
            var firmautsup = ''
        }

        var registroutsup = $('#registro' + num).val()



        arrayInfo.push({
            "complimp": complimp,
            "fechautsup": fechautsup,
            "horautsup": horautsup,
            "nombreutsup": nombreutsup,
            "firmautsup": firmautsup,
            "registroutsup": registroutsup
        })
    }

    console.log(arrayInfo)

    $.post(server + 'actOs3320Limpieza.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayInfo)
    },
        function (res) {
            console.log(res)
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                width: 100,
                showConfirmButton: false,
                timer: 1500
            })
        })



}

function actInspeccion() {

    var num = 9;
    var numc = 1;

    var arrayInfo = []


    for (var i = 1; i <= 5; i++) {

        num++
        numc++

        var compinsp = $('#compinsp' + numc).val()

        var fechaecp = $('#fecha' + num).val()
        var horaecp = $('#hora' + num).val()
        var nombreecp = $('#nombre' + num).val()

        //var img = document.getElementById("firma" + num);

        if (fechaecp != '') {
            var firmaecp = $('#registro' + num).val()
        } else {
            var firmaecp = ''
        }

        var registroecp = $('#registro' + num).val()



        arrayInfo.push({
            "compinsp": compinsp,
            "fechaecp": fechaecp,
            "horaecp":  horaecp,
            "nombreecp": nombreecp,
            "firmaecp": firmaecp,
            "registroecp": registroecp
        })
    }

    console.log(arrayInfo)

    $.post(server + 'actOs3320Inspeccion.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayInfo)
    },
        function (res) {
            console.log(res)
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
	var itemLib1 = $('#itemlib1').val()
	var itemLib2 = $('#itemlib2').val()
	var itemLib3 = $('#itemlib3').val()

	var numejecucion = $('#numejectec').val()
	
	var arrayInfo = []

	arrayInfo.push({
		"itemLib1": itemLib1,
		"itemLib2": itemLib2,
		"itemLib3": itemLib3,
		"numejecucion": numejecucion,
	})

	$.post(server + 'actOs3320Liberacion.php', {
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

function actComponentes() {

	var arrayItems = []

	var f = 16

	for (var i = 1; i <= 5; i++) {

        console.log(f)

		
		var complib = $('#complib' + i).val()

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
            "complib": complib,
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

	$.post(server + 'actOs3320Componentes.php', {
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



function actCierreM1() {

    manhol1 = $('#manhol1').val()


    //supervisor
    var fechautsup = $('#fecha31').val()
    var horautsup = $('#hora31').val()
    var nombreutsup = $('#nombre31').val()

    //var img = document.getElementById("firma1");
    var firmautsup = $('#registro31').val()

    if (fechautsup == '') {
        firmautsup = ''
    }

    var registroutsup = $('#registro31').val()

    //operciones ecopetrol
    var fechaecp = $('#fecha32').val()
    var horaecp = $('#hora32').val()
    var nombreecp = $('#nombre32').val()

    //var img = document.getElementById("firma2");
    var firmaecp = $('#registro32').val()

    if (fechaecp == '') {
        firmaecp = ''
    }

    var registroecp = $('#registro32').val()

    var arrayInfo = []

    arrayInfo.push({
        "manhol1": manhol1,
        "fechautsup": fechautsup,
        "horautsup": horautsup,
        "nombreutsup": nombreutsup,
        "firmautsup": firmautsup,
        "registroutsup": registroutsup,
        "fechaecp": fechaecp,
        "horaecp": horaecp,
        "nombreecp": nombreecp,
        "firmaecp": firmaecp,
        "registroecp": registroecp
    })

    console.log(arrayInfo)

    $.post(server + 'actOs3320CierreM1.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayInfo)
    },
        function (res) {
            console.log(res)
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                width: 100,
                showConfirmButton: false,
                timer: 1500
            })
        })




}

function actCierreM2() {

    manhol2 = $('#manhol2').val()


    //supervisor
    var fechautsup = $('#fecha33').val()
    var horautsup = $('#hora33').val()
    var nombreutsup = $('#nombre33').val()

    //var img = document.getElementById("firma1");
    var firmautsup = $('#registro33').val()

    if (fechautsup == '') {
        firmautsup = ''
    }

    var registroutsup = $('#registro33').val()

    //operciones ecopetrol
    var fechaecp = $('#fecha34').val()
    var horaecp = $('#hora34').val()
    var nombreecp = $('#nombre34').val()

    //var img = document.getElementById("firma2");
    var firmaecp = $('#registro34').val()

    if (fechaecp == '') {
        firmaecp = ''
    }

    var registroecp = $('#registro34').val()

    var arrayInfo = []

    arrayInfo.push({
        "manhol2": manhol2,
        "fechautsup": fechautsup,
        "horautsup": horautsup,
        "nombreutsup": nombreutsup,
        "firmautsup": firmautsup,
        "registroutsup": registroutsup,
        "fechaecp": fechaecp,
        "horaecp": horaecp,
        "nombreecp": nombreecp,
        "firmaecp": firmaecp,
        "registroecp": registroecp
    })

    console.log(arrayInfo)

    $.post(server + 'actOs3320CierreM2.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayInfo)
    },
        function (res) {
            console.log(res)
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

    ajuste1 = $('#ajuste1').val()
    ajuste2 = $('#ajuste2').val()
    ajuste3 = $('#ajuste3').val()
    ajuste4 = $('#ajuste4').val()


    //supervisor
    var fechautsup = $('#fecha35').val()
    var horautsup = $('#hora35').val()
    var nombreutsup = $('#nombre35').val()

    //var img = document.getElementById("firma1");
    var firmautsup = $('#registro35').val()

    if (fechautsup == '') {
        firmautsup = ''
    }

    var registroutsup = $('#registro35').val()

    //qaqc
    var fechautqaqc = $('#fecha36').val()
    var horautqaqc = $('#hora36').val()
    var nombreutqaqc = $('#nombre36').val()

    //var img = document.getElementById("firma2");
    var firmautqaqc = $('#registro36').val()

    if (fechautqaqc == '') {
        firmautqaqc = ''
    }

    var registroutqaqc = $('#registro36').val()

    //gestor ecopetrol
    var fechaecpg = $('#fecha37').val()
    var horaecpg = $('#hora37').val()
    var nombreecpg = $('#nombre37').val()

    //var img = document.getElementById("firma2");
    var firmaecpg = $('#registro37').val()

    if (fechaecpg == '') {
        firmaecpg = ''
    }

    var registroecpg = $('#registro37').val()


    var arrayInfo = []

    arrayInfo.push({
        "ajuste1": ajuste1,
        "ajuste2": ajuste2,
        "ajuste3": ajuste3,
        "ajuste4": ajuste4,
        "fechautsup": fechautsup,
        "horautsup": horautsup,
        "nombreutsup": nombreutsup,
        "firmautsup": firmautsup,
        "registroutsup": registroutsup,
        "fechautqaqc": fechautqaqc,
        "horautqaqc": horautqaqc,
        "nombreutqaqc": nombreutqaqc,
        "firmautqaqc": firmautqaqc,
        "registroutqaqc": registroutqaqc,
        "fechaecpg": fechaecpg,
        "horaecpg": horaecpg,
        "nombreecpg": nombreecpg,
        "firmaecpg": firmaecpg,
        "registroecpg": registroecpg
    })

    console.log(arrayInfo)

    $.post(server + 'actOs3320Ajustes.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayInfo)
    },
        function (res) {
            console.log(res)
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                width: 100,
                showConfirmButton: false,
                timer: 1500
            })
        })

}

function actTerminacion() {

    itemterm1 = $('#itemterm1').val()
    itemterm2 = $('#itemterm2').val()
    itemterm3 = $('#itemterm3').val()
    itemterm4 = $('#itemterm4').val()


    //supervisor
    var fechautsup = $('#fecha38').val()
    var horautsup = $('#hora38').val()
    var nombreutsup = $('#nombre38').val()

    //var img = document.getElementById("firma1");
    var firmautsup = $('#registro38').val()

    if (fechautsup == '') {
        firmautsup = ''
    }

    var registroutsup = $('#registro38').val()

    //qaqc
    var fechautqaqc = $('#fecha39').val()
    var horautqaqc = $('#hora39').val()
    var nombreutqaqc = $('#nombre39').val()

    //var img = document.getElementById("firma2");
    var firmautqaqc = $('#registro39').val()

    if (fechautqaqc == '') {
        firmautqaqc = ''
    }

    var registroutqaqc = $('#registro39').val()

    //gestor ecopetrol
    var fechaecpg = $('#fecha40').val()
    var horaecpg = $('#hora40').val()
    var nombreecpg = $('#nombre40').val()

    //var img = document.getElementById("firma2");
    var firmaecpg = $('#registro40').val()

    if (fechaecpg == '') {
        firmaecpg = ''
    }

    var registroecpg = $('#registro40').val()


    var arrayInfo = []

    arrayInfo.push({
        "itemterm1": itemterm1,
        "itemterm2": itemterm2,
        "itemterm3": itemterm3,
        "itemterm4": itemterm4,
        "fechautsup": fechautsup,
        "horautsup": horautsup,
        "nombreutsup": nombreutsup,
        "firmautsup": firmautsup,
        "registroutsup": registroutsup,
        "fechautqaqc": fechautqaqc,
        "horautqaqc": horautqaqc,
        "nombreutqaqc": nombreutqaqc,
        "firmautqaqc": firmautqaqc,
        "registroutqaqc": registroutqaqc,
        "fechaecpg": fechaecpg,
        "horaecpg": horaecpg,
        "nombreecpg": nombreecpg,
        "firmaecpg": firmaecpg,
        "registroecpg": registroecpg
    })

    console.log(arrayInfo)

    $.post(server + 'actOs3320Terminacion.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayInfo)
    },
        function (res) {
            console.log(res)
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                width: 100,
                showConfirmButton: false,
                timer: 1500
            })
        })

}

function actAplicacion() {

    itemapli1 = $('#itemapli1').val()
    itemapli2 = $('#itemapli2').val()
    
    //supervisor
    var fechautsup = $('#fecha41').val()
    var horautsup = $('#hora41').val()
    var nombreutsup = $('#nombre41').val()

    //var img = document.getElementById("firma1");
    var firmautsup = $('#registro41').val()

    if (fechautsup == '') {
        firmautsup = ''
    }

    var registroutsup = $('#registro41').val()

    //qaqc
    var fechautqaqc = $('#fecha42').val()
    var horautqaqc = $('#hora42').val()
    var nombreutqaqc = $('#nombre42').val()

    //var img = document.getElementById("firma2");
    var firmautqaqc = $('#registro42').val()

    if (fechautqaqc == '') {
        firmautqaqc = ''
    }

    var registroutqaqc = $('#registro42').val()

    //gestor ecopetrol
    var fechaecpg = $('#fecha43').val()
    var horaecpg = $('#hora43').val()
    var nombreecpg = $('#nombre43').val()

    //var img = document.getElementById("firma2");
    var firmaecpg = $('#registro43').val()

    if (fechaecpg == '') {
        firmaecpg = ''
    }

    var registroecpg = $('#registro43').val()


    var arrayInfo = []

    arrayInfo.push({
        "itemapli1": itemapli1,
        "itemapli2": itemapli2,
        "fechautsup": fechautsup,
        "horautsup": horautsup,
        "nombreutsup": nombreutsup,
        "firmautsup": firmautsup,
        "registroutsup": registroutsup,
        "fechautqaqc": fechautqaqc,
        "horautqaqc": horautqaqc,
        "nombreutqaqc": nombreutqaqc,
        "firmautqaqc": firmautqaqc,
        "registroutqaqc": registroutqaqc,
        "fechaecpg": fechaecpg,
        "horaecpg": horaecpg,
        "nombreecpg": nombreecpg,
        "firmaecpg": firmaecpg,
        "registroecpg": registroecpg
    })

    console.log(arrayInfo)

    $.post(server + 'actOs3320Aplicacion.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayInfo)
    },
        function (res) {
            console.log(res)
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

    entrega1 = $('#entrega1').val()
    entrega2 = $('#entrega2').val()
    entrega3 = $('#entrega3').val()
    
    //gestor ecopetrol
    var fechaecp = $('#fecha44').val()
    var horaecp = $('#hora44').val()
    var nombreecp = $('#nombre44').val()

    //var img = document.getElementById("firma2");
    var firmaecp = $('#registro44').val()

    if (fechaecp == '') {
        firmaecp = ''
    }

    var registroecp = $('#registro44').val()

    //supervisor
    var fechautsup = $('#fecha45').val()
    var horautsup = $('#hora45').val()
    var nombreutsup = $('#nombre45').val()

    //var img = document.getElementById("firma1");
    var firmautsup = $('#registro45').val()

    if (fechautsup == '') {
        firmautsup = ''
    }

    var registroutsup = $('#registro45').val()


    var arrayInfo = []

    arrayInfo.push({
        "entrega1": entrega1,
        "entrega2": entrega2,  
        "entrega3": entrega3,  
        "fechaecp": fechaecp,
        "horaecp": horaecp,
        "nombreecp": nombreecp,
        "firmaecp": firmaecp,
        "registroecp": registroecp,
        "fechautsup": fechautsup,
        "horautsup": horautsup,
        "nombreutsup": nombreutsup,
        "firmautsup": firmautsup,
        "registroutsup": registroutsup
    })

    console.log(arrayInfo)

    $.post(server + 'actOs3320Entrega.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayInfo)
    },
        function (res) {
            console.log(res)
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
                url: server + 'guardarArchivo3320.php',
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


    $.post(server + 'actOs3320Obs.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayLmp)
    },
        function (res) {
            console.log(res)
            location.reload()
        })

}
