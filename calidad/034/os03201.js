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

if (tipouser == 'ecopetrol') {
    $("input, select,  textarea").prop('disabled', true);
    $('.ecp').prop('disabled', false)
    $('.ut').prop('disabled', true)
    $('.lib').prop('disabled', false)
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


        //SE GUARADAN LOS DATOS DE LA FIRMA
        if (idImagen == 1 || idImagen == 2) {
            actPermiso()
        }

        if (idImagen == 3) {
            actLimpInt()
        }

        if (idImagen == 4) {
            actLimpExt()
        }

        if (idImagen == 5) {
            actInspInt()
        }

        if (idImagen == 6) {
            actInspExt()
        }

        if (idImagen == 7 ||  idImagen == 8 ||  idImagen == 9 ||  idImagen == 10) {
			actLibInt()
		}

        if (idImagen == 11 ||  idImagen == 12 ||  idImagen == 13) {
			actLibExt()
		}

        if (idImagen == 14 || idImagen == 15) {
			actCierreM1()
		}

        if (idImagen == 16 || idImagen == 17) {
			actCierreM2()
		}

        if (idImagen == 18 || idImagen == 19) {
            actTerminacion()
        }

        if (idImagen == 20 || idImagen == 21) {
            actPintura()
        }

        if (idImagen == 22 || idImagen == 23) {
            actEntrega()
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
var cmls = []

odsq = localStorage.getItem('odsq');
equipos = sessionStorage.getItem('equipo')
alcance = sessionStorage.getItem('servicio')
esp = sessionStorage.getItem('esp')

var server = 'https://utitalco.com/calidad/034/server/';

cargando()
$.post(server + 'cargarRca03201.php', {
    ods: odsq,
    tag: tag
},
    function (resp) {
        arrayDatos = resp
        console.log(arrayDatos)

        cargarDatos()


    })



function cargarDatos() {
    $('#unidad').html(arrayDatos.unidad)
    $('#planta').html(arrayDatos.planta)

    $('#ods').html(arrayDatos.ods)
    $('#tipo').html(arrayDatos.tipo)
    $('#tag').html(arrayDatos.tag)
    $('#servicio').val(arrayDatos.servicio)
    $('#material').val(arrayDatos.material)

    if (arrayDatos.permiso != "") {

        var arrayPermiso = JSON.parse(arrayDatos.permiso)

        $('#item1').val(arrayPermiso[0].item1)
        $('#item2').val(arrayPermiso[0].item2)
        $('#item3').val(arrayPermiso[0].item3)
        $('#item4').val(arrayPermiso[0].item4)

        $('#fecha1').val(arrayPermiso[0].fechaut)
        $('#hora1').val(arrayPermiso[0].horaut)
        $('#nombre1').val(arrayPermiso[0].nombreut)

        document.querySelector("#firma1").src = arrayPermiso[0].firmaut;

        if (arrayPermiso[0].fechaut != "") {
            $('#firma1').removeClass('oculto')
            $('#btnFirmar1').hide()
        }
        $('#registro1').val(arrayPermiso[0].registrout)

        $('#fecha2').val(arrayPermiso[0].fechaec)
        $('#hora2').val(arrayPermiso[0].horaec)
        $('#nombre2').val(arrayPermiso[0].nombreec)

        document.querySelector("#firma2").src = arrayPermiso[0].firmaec;

        $('#registro2').val(arrayPermiso[0].registroec)

        if (arrayPermiso[0].fechaec != "") {
            $('#firma2').removeClass('oculto')
            $('#btnFirmar2').hide()
        }
    }

    // //cargue de datos de limpieza interna

    if (arrayDatos.limpieza != "") {
        var arrayLimpInt = JSON.parse(arrayDatos.limpieza)

        $('#limpint1').val(arrayLimpInt[0].limpint1)
        $('#limpint2').val(arrayLimpInt[0].limpint2)
        $('#limpint3').val(arrayLimpInt[0].limpint3)
        $('#limpint4').val(arrayLimpInt[0].limpint4)


        $('#fecha3').val(arrayLimpInt[0].fechaut)
        $('#hora3').val(arrayLimpInt[0].horaut)
        $('#nombre3').val(arrayLimpInt[0].nombreut)

        document.querySelector("#firma3").src = arrayLimpInt[0].firmaut;
        if (arrayLimpInt[0].fechaut != "") {
            $('#firma3').removeClass('oculto')
            $('#btnFirmar3').hide()
        }

        $('#registro3').val(arrayLimpieza[0].registrout)

    }

    // //cargue de datos de limpieza externa

    if (arrayDatos.limpieza != "") {
        var arrayLimpExt = JSON.parse(arrayDatos.limpieza)

        $('#limpext1').val(arrayLimpExt[0].limpext1)
        $('#limpext2').val(arrayLimpExt[0].limpext2)
        $('#limpext3').val(arrayLimpExt[0].limpext3)

        $('#fecha4').val(arrayLimpExt[0].fechaut)
        $('#hora4').val(arrayLimpExt[0].horaut)
        $('#nombre4').val(arrayLimpExt[0].nombreut)

        document.querySelector("#firma4").src = arrayLimpExt[0].firmaut;
        if (arrayLimpExt[0].fechaut != "") {
            $('#firma4').removeClass('oculto')
            $('#btnFirmar4').hide()
        }

        $('#registro4').val(arrayLimpExt[0].registrout)

    }

    // //cargue de datos de inspección interior

    if (arrayDatos.ejecucion != "") {
        var arrayInspInt = JSON.parse(arrayDatos.ejecucion)

        $('#inspint1').val(arrayInspInt[0].inspint1)
        $('#inspint2').val(arrayInspInt[0].inspint2)
        $('#inspint3').val(arrayInspInt[0].inspint3)
        $('#inspint4').val(arrayInspInt[0].inspint4)

        $('#fecha5').val(arrayInspInt[0].fechaec)
        $('#hora5').val(arrayInspInt[0].horaec)
        $('#nombre5').val(arrayInspInt[0].nombreec)

        document.querySelector("#firma5").src = arrayInspInt[0].firmaec;
        if (arrayInspInt[0].fechaec != "") {
            $('#firma5').removeClass('oculto')
            $('#btnFirmar5').hide()
        }

        $('#registro5').val(arrayInspInt[0].registroec)

    }

    // //cargue de datos de inspección exterior

    if (arrayDatos.ejecucion != "") {
        var arrayInspExt = JSON.parse(arrayDatos.ejecucion)

        $('#inspint1').val(arrayInspExt[0].inspint1)
        $('#inspint2').val(arrayInspExt[0].inspint2)
        $('#inspint3').val(arrayInspExt[0].inspint3)

        $('#fecha6').val(arrayInspExt[0].fechaec)
        $('#hora6').val(arrayInspExt[0].horaec)
        $('#nombre6').val(arrayInspExt[0].nombreec)

        document.querySelector("#firma6").src = arrayInspExt[0].firmaec;
        if (arrayInspExt[0].fechaec != "") {
            $('#firma6').removeClass('oculto')
            $('#btnFirmar6').hide()
        }

        $('#registro6').val(arrayInspExt[0].registroec)

    }


    // //cargue de datos de liberación

    if (arrayDatos.liberacion != "") {

        var arrayLiberacion = JSON.parse(arrayDatos.liberacion)

        $('#lib1').val(arrayLiberacion[0].lib1)
        $('#lib2').val(arrayLiberacion[0].lib2)
    }


    // //cargue de datos de liberacion interna

    if (arrayDatos.liberacionint != "") {
		var arrayLibInt = JSON.parse(arrayDatos.liberacionint)

        $('#itemint').val(arrayLibInt[0].itemint)

        $('#fecha7').val(arrayLibInt[0].fechasup)
        $('#hora7').val(arrayLibInt[0].horasup)
        $('#nombre7').val(arrayLibInt[0].nombresup)

        document.querySelector("#firma7").src = arrayLibInt[0].firmasup;
        if (arrayLibInt[0].fechasup != "") {
            $('#firma7').removeClass('oculto')
            $('#btnFirmar7').hide()
        }

        $('#registro7').val(arrayLibInt[0].registrosup)

        $('#fecha8').val(arrayLibInt[0].fechaqaqc)
        $('#hora8').val(arrayLibInt[0].horaqaqc)
        $('#nombre8').val(arrayLibInt[0].nombreqaqc)

        document.querySelector("#firma8").src = arrayLibInt[0].firmaqaqc;
        if (arrayLibInt[0].fechaqaqc != "") {
            $('#firma8').removeClass('oculto')
            $('#btnFirmar8').hide()
        }

        $('#registro8').val(arrayLibInt[0].registroqaqc)

        $('#fecha9').val(arrayLibInt[0].fechaec)
        $('#hora9').val(arrayLibInt[0].horaec)
        $('#nombre9').val(arrayLibInt[0].nombreec)

        document.querySelector("#firma9").src = arrayLibInt[0].firmaec;
        if (arrayLibInt[0].fechaec != "") {
            $('#firma9').removeClass('oculto')
            $('#btnFirmar9').hide()
        }

        $('#registro9').val(arrayLibInt[0].registroec)

        $('#fecha10').val(arrayLibInt[0].fechaec2)
        $('#hora10').val(arrayLibInt[0].horaec2)
        $('#nombre10').val(arrayLibInt[0].nombreec2)

        document.querySelector("#firma10").src = arrayLibInt[0].firmaec2;
        if (arrayLibInt[0].fechaec2 != "") {
            $('#firma10').removeClass('oculto')
            $('#btnFirmar10').hide()
        }

        $('#registro10').val(arrayLibInt[0].registroec2)
    }

    // //cargue de datos de liberacion externa

    if (arrayDatos.liberacionext != "") {
		var arrayLibExt = JSON.parse(arrayDatos.liberacionext)

        $('#itemext').val(arrayLibExt[0].itemext)

        $('#fecha11').val(arrayLibExt[0].fechasup)
        $('#hora11').val(arrayLibExt[0].horasup)
        $('#nombre11').val(arrayLibExt[0].nombresup)

        document.querySelector("#firma11").src = arrayLibExt[0].firmasup;
        if (arrayLibExt[0].fechasup != "") {
            $('#firma11').removeClass('oculto')
            $('#btnFirmar11').hide()
        }

        $('#registro11').val(arrayLibExt[0].registrosup)

        $('#fecha12').val(arrayLibExt[0].fechaqaqc)
        $('#hora12').val(arrayLibExt[0].horaqaqc)
        $('#nombre12').val(arrayLibExt[0].nombreqaqc)

        document.querySelector("#firma12").src = arrayLibExt[0].firmaqaqc;
        if (arrayLibExt[0].fechaqaqc != "") {
            $('#firma12').removeClass('oculto')
            $('#btnFirmar12').hide()
        }

        $('#registro12').val(arrayLibExt[0].registroqaqc)

        $('#fecha13').val(arrayLibExt[0].fechaec)
        $('#hora13').val(arrayLibExt[0].horaec)
        $('#nombre13').val(arrayLibExt[0].nombreec)

        document.querySelector("#firma13").src = arrayLibExt[0].firmaec;
        if (arrayLibExt[0].fechaec != "") {
            $('#firma13').removeClass('oculto')
            $('#btnFirmar13').hide()
        }

        $('#registro13').val(arrayLibExt[0].registroec)
    }


    //cargue de datos de cierre manhol1

    if (arrayDatos.cierre != "") {

        var arrayCierreM1 = JSON.parse(arrayDatos.cierre)

        $('#manhol1').val(arrayCierreM1[0].manhol1)
       
        $('#fecha14').val(arrayCierreM1[0].fechaut)
        $('#hora14').val(arrayCierreM1[0].horaut)
        $('#nombre14').val(arrayCierreM1[0].nombreut)

        document.querySelector("#firma14").src = arrayCierreM1[0].firmaut;

        if (arrayCierreM1[0].fechaut != "") {
            $('#firma14').removeClass('oculto')
            $('#btnFirmar14').hide()
        }

        $('#registro14').val(arrayCierreM1[0].registrout)


        $('#fecha15').val(arrayCierreM1[0].fechaec)
        $('#hora15').val(arrayCierreM1[0].horaec)
        $('#nombre15').val(arrayCierreM1[0].nombreec)

        document.querySelector("#firma15").src = arrayCierreM1[0].firmaec;

        if (arrayCierreM1[0].fechaec != "") {
            $('#firma15').removeClass('oculto')
            $('#btnFirmar15').hide()
        }

        $('#registro15').val(arrayCierreM1[0].registroec)
    }

    //cargue de datos de cierre manhol2

    if (arrayDatos.cierre != "") {

        var arrayCierreM2 = JSON.parse(arrayDatos.cierre)

        $('#manhol2').val(arrayCierreM2[0].manhol2)

        $('#fecha16').val(arrayCierreM2[0].fechaut)
        $('#hora16').val(arrayCierreM2[0].horaut)
        $('#nombre16').val(arrayCierreM2[0].nombreut)

        document.querySelector("#firma16").src = arrayCierreM2[0].firmaut;

        if (arrayCierreM2[0].fechaut != "") {
            $('#firma16').removeClass('oculto')
            $('#btnFirmar16').hide()
        }

        $('#registro16').val(arrayCierreM2[0].registrout)

        $('#fecha17').val(arrayCierreM2[0].fechaec)
        $('#hora17').val(arrayCierreM2[0].horaec)
        $('#nombre17').val(arrayCierreM2[0].nombreec)

        document.querySelector("#firma17").src = arrayCierreM2[0].firmaec;

        if (arrayCierreM2[0].fechaec != "") {
            $('#firma17').removeClass('oculto')
            $('#btnFirmar17').hide()
        }

        $('#registro17').val(arrayCierreM2[0].registroec)

    }


    // //cargue de datos de terminación

    if (arrayDatos.terminacion != "") {

        var arrayTerminacion = JSON.parse(arrayDatos.terminacion)

        $('#term1').val(arrayTerminacion[0].term1)
        $('#term2').val(arrayTerminacion[0].term2)
        $('#term3').val(arrayTerminacion[0].term3)
        $('#term4').val(arrayTerminacion[0].term4)
        $('#term5').val(arrayTerminacion[0].term5)
        $('#term6').val(arrayTerminacion[0].term6)


        $('#fecha18').val(arrayTerminacion[0].fechaut)
        $('#hora18').val(arrayTerminacion[0].horaut)
        $('#nombre18').val(arrayTerminacion[0].nombreut)

        document.querySelector("#firma18").src = arrayTerminacion[0].firmaut;

        if (arrayTerminacion[0].fechaut != "") {
            $('#firma18').removeClass('oculto')
            $('#btnFirmar18').hide()
        }

        $('#registro18').val(arrayTerminacion[0].registrout)


        $('#fecha19').val(arrayTerminacion[0].fechaec)
        $('#hora19').val(arrayTerminacion[0].horaec)
        $('#nombre1').val(arrayTerminacion[0].nombreec)

        document.querySelector("#firma19").src = arrayTerminacion[0].firmaec;

        if (arrayTerminacion[0].fechaec != "") {
            $('#firma19').removeClass('oculto')
            $('#btnFirmar19').hide()
        }

        $('#registro19').val(arrayTerminacion[0].registroec)


    }

    // //cargue de datos de pintura

    if (arrayDatos.pintura != "") {

        var arrayPintura = JSON.parse(arrayDatos.pintura)

        $('#pint1').val(arrayPintura[0].pint1)
        $('#pint2').val(arrayPintura[0].pint2)
        $('#pint3').val(arrayPintura[0].pint3)
        $('#pint4').val(arrayPintura[0].pint4)
        $('#pint5').val(arrayPintura[0].pint5)

        $('#pint6').val(arrayPintura[0].pint6)
        $('#pint7').val(arrayPintura[0].pint7)
        $('#pint8').val(arrayPintura[0].pint8)
        $('#pint9').val(arrayPintura[0].pint9)
        $('#grado').val(arrayPintura[0].grado)
        $('#espesor').val(arrayPintura[0].espesor)


        $('#fecha20').val(arrayPintura[0].fechaut)
        $('#hora20').val(arrayPintura[0].horaut)
        $('#nombre20').val(arrayPintura[0].nombreut)

        document.querySelector("#firma20").src = arrayPintura[0].firmaut;

        if (arrayPintura[0].fechaut != "") {
            $('#firma20').removeClass('oculto')
            $('#btnFirmar20').hide()
        }

        $('#registro20').val(arrayPintura[0].registrout)


        $('#fecha21').val(arrayPintura[0].fechaec)
        $('#hora21').val(arrayPintura[0].horaec)
        $('#nombre21').val(arrayPintura[0].nombreec)

        document.querySelector("#firma21").src = arrayPintura[0].firmaec;

        if (arrayPintura[0].fechaec != "") {
            $('#firma21').removeClass('oculto')
            $('#btnFirmar21').hide()
        }

        $('#registro21').val(arrayPintura[0].registroec)


    }

    // //cargue de datos de entrega

    if (arrayDatos.entrega != "") {

        var arrayEntrega = JSON.parse(arrayDatos.entrega)

        $('#entrega1').val(arrayEntrega[0].entrega1)
        $('#entrega2').val(arrayEntrega[0].entrega2)

        $('#fecha22').val(arrayEntrega[0].fechaut)
        $('#hora22').val(arrayEntrega[0].horaut)
        $('#nombre22').val(arrayEntrega[0].nombreut)

        document.querySelector("#firma22").src = arrayEntrega[0].firmaut;

        if (arrayEntrega[0].fechaut != "") {
            $('#firma22').removeClass('oculto')
            $('#btnFirmar22').hide()
        }

        $('#registro22').val(arrayEntrega[0].registrout)


        $('#fecha23').val(arrayEntrega[0].fechaec)
        $('#hora23').val(arrayEntrega[0].horaec)
        $('#nombre23').val(arrayEntrega[0].nombreec)

        document.querySelector("#firma23").src = arrayEntrega[0].firmaec;

        if (arrayEntrega[0].fechaec != "") {
            $('#firma23').removeClass('oculto')
            $('#btnFirmar23').hide()
        }

        $('#registro23').val(arrayEntrega[0].registroec)


    }

    // //CARGUE DE OBSERVACIONES

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


function actPermiso() {

    var item1 = $('#item1').val()
    var item2 = $('#item2').val()
    var item3 = $('#item3').val()
    var item4 = $('#item4').val()

    var fechapermut = $('#fecha1').val()
    var horapermut = $('#hora1').val()
    var nombrepermut = $('#nombre1').val()

    var img = document.getElementById("firma1");
    var firmapermut = img.src

    if (fechapermut == '') {
        firmapermut = ''
    }

    var registropermut = $('#registro1').val()

    var fechapermec = $('#fecha2').val()
    var horapermec = $('#hora2').val()
    var nombrepermec = $('#nombre2').val()

    var img = document.getElementById("firma2");
    var firmapermec = img.src

    if (fechapermec == '') {
        firmapermec = ''
    }
    var registropermec = $('#registro2').val()

    var arrayPerm = []

    arrayPerm.push({
        "item1": item1,
        "item2": item2,
        "item3": item3,
        "item4": item4,
        "fechaut": fechapermut,
        "horaut": horapermut,
        "nombreut": nombrepermut,
        "firmaut": firmapermut,
        "registrout": registropermut,
        "fechaec": fechapermec,
        "horaec": horapermec,
        "nombreec": nombrepermec,
        "firmaec": firmapermec,
        "registroec": registropermec
    })

    console.log(arrayPerm)

    $.post(server + 'actOs03201Perm.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayPerm)
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


function actLimpInt() {

    var limpint1 = $('#limpint1').val()
    var limpint2 = $('#limpint2').val()
    var limpint3 = $('#limpint3').val()
    var limpint4 = $('#limpint4').val()

    var fechaut = $('#fecha3').val()
    var horaut = $('#hora3').val()
    var nombreut = $('#nombre3').val()

    var img = document.getElementById("firma3");
    var firmaut = img.src

    if (fechaut == '') {
        firmaut = ''
    }

    var registrout = $('#registro3').val()

    var arrayLimpInt = []

    arrayLimpInt.push({
        "limpint1": limpint1,
        "limpint2": limpint2,
        "limpint3": limpint3,
        "limpint4": limpint4,
        "fechaut": fechaut,
        "horaut": horaut,
        "nombreut": nombreut,
        "firmaut": firmaut,
        "registrout": registrout,
    })

    console.log(arrayLimpInt)

    $.post(server + 'actOs03201Limpint.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayLimpInt)
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

function actLimpExt() {

    var limpext1 = $('#limpext1').val()
    var limpext2 = $('#limpext2').val()
    var limpext3 = $('#limpext3').val()

    var fechaut = $('#fecha3').val()
    var horaut = $('#hora3').val()
    var nombreut = $('#nombre3').val()

    var img = document.getElementById("firma3");
    var firmaut = img.src

    if (fechaut == '') {
        firmaut = ''
    }

    var registrout = $('#registro3').val()

    var arrayLimpExt = []

    arrayLimpExt.push({
        "limpext1": limpext1,
        "limpext2": limpext2,
        "limpext3": limpext3,
        "fechaut": fechaut,
        "horaut": horaut,
        "nombreut": nombreut,
        "firmaut": firmaut,
        "registrout": registrout,
    })

    console.log(arrayLimpExt)

    $.post(server + 'actOs03201Limpext.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayLimpExt)
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

function actInspInt() {

    var inspint1 = $('#inspint1').val()
    var inspint2 = $('#inspint2').val()
    var inspint3 = $('#inspint3').val()
    var inspint4 = $('#inspint4').val()

    var fechaec = $('#fecha5').val()
    var horaec = $('#hora5').val()
    var nombreec = $('#nombre5').val()

    var img = document.getElementById("firma5");
    var firmaec = img.src

    if (fechaec == '') {
        firmaec = ''
    }

    var registroec = $('#registro5').val()

    var arrayInspInt = []

    arrayInspInt.push({
        "inspint1": inspint1,
        "inspint2": inspint2,
        "inspint3": inspint3,
        "inspint4": inspint4,
        "fechaec": fechaec,
        "horaec": horaec,
        "nombreec": nombreec,
        "firmaec": firmaec,
        "registroec": registroec,
    })

    console.log(arrayInspInt)

    $.post(server + 'actOs03201Inspint.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayInspInt)
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

function actInspExt() {

    var inspext1 = $('#inspext1').val()
    var inspext2 = $('#inspext2').val()
    var inspext3 = $('#inspext3').val()

    var fechaec = $('#fecha6').val()
    var horaec = $('#hora6').val()
    var nombreec = $('#nombre6').val()

    var img = document.getElementById("firma6");
    var firmaec = img.src

    if (fechaec == '') {
        firmaec = ''
    }

    var registroec = $('#registro6').val()

    var arrayInspExt = []

    arrayInspExt.push({
        "inspext1": inspext1,
        "inspext2": inspext2,
        "inspext3": inspext3,
        "fechaec": fechaec,
        "horaec": horaec,
        "nombreec": nombreec,
        "firmaec": firmaec,
        "registroec": registroec,
    })

    console.log(arrayInspExt)

    $.post(server + 'actOs03201Inspint.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayInspExt)
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

    var lib1 = $('#lib1').val()
    var lib2 = $('#lib2').val()

    arrayLiberacion.push({
        "lib1": lib1,
        "lib2": lib2,
    })

    console.log(arrayLiberacion)

    $.post(server + 'actOs80Liberacion.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayLiberacion)
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

function actLibInt() {

    var itemint = $('#itemint').val()
    
    var fechasup = $('#fecha7').val()
    var horasup = $('#hora7').val()
    var nombresup = $('#nombre7').val()

    var img = document.getElementById("firma7");
    var firmasup = img.src

    if (fechasup == '') {
        firmasup = ''
    }

    var registrosup = $('#registro7').val()

    var fechaqaqc = $('#fecha8').val()
    var horaqaqc = $('#hora8').val()
    var nombreqaqc = $('#nombre8').val()

    var img = document.getElementById("firma8");
    var firmaqaqc = img.src

    if (fechaqaqc == '') {
        firmaqaqc = ''
    }

    var registroqaqc = $('#registro8').val()

    var fechaec = $('#fecha9').val()
    var horaec = $('#hora9').val()
    var nombreec = $('#nombre9').val()

    var img = document.getElementById("firma9");
    var firmaec = img.src

    if (fechaec == '') {
        firmaec = ''
    }

    var registroec = $('#registro10').val()

    var fechaec2 = $('#fecha10').val()
    var horaec2 = $('#hora10').val()
    var nombreec2 = $('#nombre10').val()

    var img = document.getElementById("firma10");
    var firmaec2 = img.src

    if (fechaec2 == '') {
        firmaec2 = ''
    }

    var registroec2 = $('#registro10').val()

    var arrayLibInt = []

    arrayLibInt.push({
        "itemint": itemint,
        "fechasup": fechasup,
        "horasup": horasup,
        "nombresup": nombresup,
        "firmasup": firmasup,
        "registrosup": registrosup,
        "fechaqaqc": fechaqaqc,
        "horaqaqc": horaqaqc,
        "nombreqaqc": nombreqaqc,
        "firmaqaqc": firmaqaqc,
        "registroqaqc": registroqaqc,
        "fechaec": fechaec,
        "horaec": horaec,
        "nombreec": nombreec,
        "firmaec": firmaec,
        "registroec": registroec,
        "fechaec2": fechaec2,
        "horaec2": horaec2,
        "nombreec2": nombreec2,
        "firmaec2": firmaec2,
        "registroec2": registroec2,
    })

    console.log(arrayLibInt)

    $.post(server + 'actOs03201Libint.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayLibInt)
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

function actLibExt() {

    var itemext = $('#itemext').val()
    
    var fechasup = $('#fecha11').val()
    var horasup = $('#hora11').val()
    var nombresup = $('#nombre11').val()

    var img = document.getElementById("firma11");
    var firmasup = img.src

    if (fechasup == '') {
        firmasup = ''
    }

    var registrosup = $('#registro11').val()

    var fechaqaqc = $('#fecha12').val()
    var horaqaqc = $('#hora12').val()
    var nombreqaqc = $('#nombre12').val()

    var img = document.getElementById("firma12");
    var firmaqaqc = img.src

    if (fechaqaqc == '') {
        firmaqaqc = ''
    }

    var registroqaqc = $('#registro12').val()

    var fechaec = $('#fecha13').val()
    var horaec = $('#hora13').val()
    var nombreec = $('#nombre13').val()

    var img = document.getElementById("firma13");
    var firmaec = img.src

    if (fechaec == '') {
        firmaec = ''
    }

    var registroec = $('#registro13').val()

    var arrayLibInt = []

    arrayLibInt.push({
        "itemext": itemext,
        "fechasup": fechasup,
        "horasup": horasup,
        "nombresup": nombresup,
        "firmasup": firmasup,
        "registrosup": registrosup,
        "fechaqaqc": fechaqaqc,
        "horaqaqc": horaqaqc,
        "nombreqaqc": nombreqaqc,
        "firmaqaqc": firmaqaqc,
        "registroqaqc": registroqaqc,
        "fechaec": fechaec,
        "horaec": horaec,
        "nombreec": nombreec,
        "firmaec": firmaec,
        "registroec": registroec
    })

    console.log(arrayLibExt)

    $.post(server + 'actOs03201Libext.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayLibExt)
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


function actCierreM1() {

    var manhol1 = $('#manhol1').val()

    var fechaut = $('#fecha14').val()
    var horaut = $('#hora14').val()
    var nombreut = $('#nombre14').val()

    var img = document.getElementById("firma14");
    var firmaut = img.src

    if (fechaut == '') {
        firmaut = ''
    }

    var registrout = $('#registro14').val()

    var fechaec = $('#fecha15').val()
    var horaec = $('#hora15').val()
    var nombreec = $('#nombre15').val()

    var img = document.getElementById("firma15");
    var firmaec = img.src

    if (fechaut == '') {
        firmaut = ''
    }

    var registroec = $('#registro15').val()

    var arrayCierreM1 = []

    arrayCierreM1.push({
        "manhol1": manhol1,
        "manhol2": manhol2,
        "fechaut": fechaut,
        "horaut": horaut,
        "nombreut": nombreut,
        "firmaut": firmaut,
        "registrout": registrout,
        "fechaec": fechaec,
        "horaec": horaec,
        "nombreec": nombreec,
        "firmaec": firmaec,
        "registroec": registroec,
    })

    console.log(arrayCierreM1)

    $.post(server + 'actOs03201Cierrem1.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayCierreM1)
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

    var manhol2 = $('#manhol2').val()

    var fechaut = $('#fecha16').val()
    var horaut = $('#hora16').val()
    var nombreut = $('#nombre16').val()

    var img = document.getElementById("firma16");
    var firmaut = img.src

    if (fechaut == '') {
        firmaut = ''
    }

    var registrout = $('#registro16').val()

    var fechaec = $('#fecha17').val()
    var horaec = $('#hora17').val()
    var nombreec = $('#nombre17').val()

    var img = document.getElementById("firma17");
    var firmaec = img.src

    if (fechaut == '') {
        firmaut = ''
    }

    var registroec = $('#registro17').val()

    var arrayCierreM1 = []

    arrayCierreM1.push({
        "manhol2": manhol2,
        "fechaut": fechaut,
        "horaut": horaut,
        "nombreut": nombreut,
        "firmaut": firmaut,
        "registrout": registrout,
        "fechaec": fechaec,
        "horaec": horaec,
        "nombreec": nombreec,
        "firmaec": firmaec,
        "registroec": registroec,
    })

    console.log(arrayCierreM1)

    $.post(server + 'actOs03201Cierrem2.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayCierreM1)
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

    var term1 = $('#term1').val()
    var term2 = $('#term2').val()
    var term3 = $('#term3').val()
    var term4 = $('#term4').val()
    var term5 = $('#term5').val()
    var term6 = $('#term6').val()

    var fechaut = $('#fecha18').val()
    var horaut = $('#hora18').val()
    var nombreut = $('#nombre18').val()

    var img = document.getElementById("firma18");
    var firmaut = img.src

    if (fechaut == '') {
        firmaut = ''
    }

    var registrout = $('#registro18').val()

    var fechaec = $('#fecha19').val()
    var horaec = $('#hora19').val()
    var nombreec = $('#nombre19').val()

    var img = document.getElementById("firma19");
    var firmaec = img.src

    if (fechaec == '') {
        firmaec = ''
    }
    var registroec = $('#registro19').val()

    var arrayTermimacion = []

    arrayTerm.push({
        "term1": term1,
        "term2": term2,
        "term3": term3,
        "term4": term4,
        "term5": term5,
        "term6": term6,
        "fechaut": fechaut,
        "horaut": horaut,
        "nombreut": nombreut,
        "firmaut": firmaut,
        "registrout": registrout,
        "fechaec": fechaec,
        "horaec": horaec,
        "nombreec": nombreec,
        "firmaec": firmaec,
        "registroec": registroec
    })

    console.log(arrayTerminacion)

    $.post(server + 'actOs03201Terminacion.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayTerm)
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

function actPintura() {

    var pint1 = $('#pint1').val()
    var pint2 = $('#pint2').val()
    var pint3 = $('#pint3').val()
    var pint4 = $('#pint4').val()
    var pint5 = $('#pint5').val()
    var pint6 = $('#pint6').val()
    var pint7 = $('#pint7').val()
    var pint8 = $('#pint8').val()
    var pint9 = $('#pint9').val()
    var grado = $('#grado').val()
    var espesor = $('#espesor').val()


    var fechaut = $('#fecha20').val()
    var horaut = $('#hora20').val()
    var nombreut = $('#nombre20').val()

    var img = document.getElementById("firma20");
    var firmaut = img.src

    if (fechaut == '') {
        firmaut = ''
    }

    var registrout = $('#registro20').val()

    var fechaec = $('#fecha21').val()
    var horaec = $('#hora21').val()
    var nombreec = $('#nombre21').val()

    var img = document.getElementById("firma21");
    var firmaec = img.src

    if (fechaec == '') {
        firmaec = ''
    }
    var registroec = $('#registro21').val()

    var arrayPintura = []

    arrayPintura.push({
        "pint1": pint1,
        "pint2": pint2,
        "pint3": pint3,
        "pint4": pint4,
        "pint5": pint5,
        "pint6": pint6,
        "pint7": pint7,
        "pint8": pint8,
        "pint9": pint9,
        "grado": grado,
        "espesor": espesor,
        "fechaut": fechaut,
        "horaut": horaut,
        "nombreut": nombreut,
        "firmaut": firmaut,
        "registrout": registrout,
        "fechaec": fechaec,
        "horaec": horaec,
        "nombreec": nombreec,
        "firmaec": firmaec,
        "registroec": registroec
    })

    console.log(arrayPintura)

    $.post(server + 'actOs03201Pintura.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayPintura)
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

    var entrega1 = $('#entrega1').val()
    var entrega2 = $('#entrega2').val()

    var fechaut = $('#fecha22').val()
    var horaut = $('#hora22').val()
    var nombreut = $('#nombre22').val()

    var img = document.getElementById("firma22");
    var firmaut = img.src

    if (fechaut == '') {
        firmaut = ''
    }

    var registrout = $('#registro22').val()

    var fechaec = $('#fecha23').val()
    var horaec = $('#hora23').val()
    var nombreec = $('#nombre23').val()

    var img = document.getElementById("firma23");
    var firmaec = img.src

    if (fechaec == '') {
        firmaec = ''
    }
    var registroec = $('#registro23').val()

    var arrayEntrega = []

    arrayEntrega.push({
        "entrega1": entrega1,
        "entrega2": entrega2,
        "fechaut": fechaut,
        "horaut": horaut,
        "nombreut": nombreut,
        "firmaut": firmaut,
        "registrout": registrout,
        "fechaec": fechaec,
        "horaec": horaec,
        "nombreec": nombreec,
        "firmaec": firmaec,
        "registroec": registroec
    })

    console.log(arrayEntrega)

    $.post(server + 'actOs03201Entrega.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayEntrega)
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


    $.post(server + 'actOs03201Obs.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayLmp)
    },
        function (res) {
            console.log(res)
            location.reload()
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
                url: server + 'guardarArchivo03201.php',
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


    $.post(server + 'actOs03201Obs.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayLmp)
    },
        function (res) {
            console.log(res)
            location.reload()
        })

}
