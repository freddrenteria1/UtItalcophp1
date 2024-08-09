
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


        if (idImagen >= 3 && idImagen <= 11) {
            actApertura()
        }

        if (idImagen >= 12 && idImagen <= 17) {
            actLimpieza()
        }

        if (idImagen >= 18 && idImagen <= 89) {
            actRetiro()
        }

        if (idImagen >= 90 && idImagen <= 115) {
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

var server = 'https://utitalco.com/calidad/033/desmantelamiento/server/';



cargando()
$.post(server + 'cargarRca3317.php', {
    ods: odsq,
    tag: tag
},
    function (resp) {
        arrayDatos = resp
        console.log(arrayDatos)


        cargarDatos()


    })


function cargarDatos() {

    if (arrayDatos.sas != "") {

        var sas = JSON.parse(arrayDatos.sas)

        $('#inst1').val(sas[0].inst1)
        $('#inst2').val(sas[0].inst2)
        $('#inst3').val(sas[0].inst3)
        $('#inst4').val(sas[0].inst4)

        $('#fecha1').val(sas[0].fechautsup)
        $('#hora1').val(sas[0].horautsup)
        $('#nombre1').val(sas[0].nombreutsup)

        var firmaUsuario = buscarFirma(sas[0].registroutsup);

        document.querySelector("#firma1").src = firmaUsuario;

        if (sas[0].fechautsup != "") {
            $('#firma1').removeClass('oculto')
            $('#btnFirmar1').hide()
        }
        $('#registro1').val(sas[0].registroutsup)

        $('#fecha2').val(sas[0].fechautqaqc)
        $('#hora2').val(sas[0].horautqaqc)
        $('#nombre2').val(sas[0].nombreutqaqc)

        var firmaUsuario = buscarFirma(sas[0].registroutqaqc);

        document.querySelector("#firma2").src = firmaUsuario;

        if (sas[0].fechautqaqc != "") {
            $('#firma2').removeClass('oculto')
            $('#btnFirmar2').hide()
        }

        $('#registro2').val(sas[0].registroutqaqc)

    }



    //cargue de datos de apertura

    if (arrayDatos.apertura != "") {

        var num = 2;
        var numc = 0;

        var arrayInfo = JSON.parse(arrayDatos.apertura)

        for (var i = 0; i <= 8; i++) {
            num++
            numc++


            $('#apertM' + numc).val(arrayInfo[i].comp)

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

    //cargue de datos de limpieza

    if (arrayDatos.limpieza != "") {

        var num = 11;
        var numc = 0;

        var arrayInfo = JSON.parse(arrayDatos.limpieza)

        for (var i = 0; i <= 5; i++) {
            num++
            numc++


            $('#compLimp' + numc).val(arrayInfo[i].comp)

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


    //cargue de datos de retiro
    if (arrayDatos.retiro != "") {

        var num = 17;
        var numc = 0;

        var arrayInfo = JSON.parse(arrayDatos.retiro)

        for (var i = 0; i <= 17; i++) {
            num++
            numc++


            $('#compRet' + numc).val(arrayInfo[i].comp)

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

            num++

            $('#fecha' + num).val(arrayInfo[i].fechautqaqc)
            $('#hora' + num).val(arrayInfo[i].horautqaqc)
            $('#nombre' + num).val(arrayInfo[i].nombreutqaqc)

            var firmaUsuario = buscarFirma(arrayInfo[i].registroutqaqc);

            document.querySelector("#firma" + num).src = firmaUsuario;

            if (arrayInfo[i].nombreutqaqc != "") {
                $('#firma' + num).removeClass('oculto')
                $('#btnFirmar' + num).hide()
            }
            $('#registro' + num).val(arrayInfo[i].registroutqaqc)

            num++

            $('#fecha' + num).val(arrayInfo[i].fechaec)
            $('#hora' + num).val(arrayInfo[i].horaec)
            $('#nombre' + num).val(arrayInfo[i].nombreec)

            var firmaUsuario = buscarFirma(arrayInfo[i].registroec);

            document.querySelector("#firma" + num).src = firmaUsuario;

            if (arrayInfo[i].nombreec != "") {
                $('#firma' + num).removeClass('oculto')
                $('#btnFirmar' + num).hide()
            }
            $('#registro' + num).val(arrayInfo[i].registroec)

            num++

            $('#fecha' + num).val(arrayInfo[i].fechaecg)
            $('#hora' + num).val(arrayInfo[i].horaecg)
            $('#nombre' + num).val(arrayInfo[i].nombreecg)

            var firmaUsuario = buscarFirma(arrayInfo[i].registroecg);

            document.querySelector("#firma" + num).src = firmaUsuario;

            if (arrayInfo[i].nombreecg != "") {
                $('#firma' + num).removeClass('oculto')
                $('#btnFirmar' + num).hide()
            }
            $('#registro' + num).val(arrayInfo[i].registroecg)

        }

    }

    //cargue de datos de entrega
    if (arrayDatos.entrega != "") {

        var num = 89;
        var numc = 0;

        var arrayInfo = JSON.parse(arrayDatos.entrega)

        for (var i = 0; i <= 12; i++) {
            num++
            numc++


            $('#compEnt' + numc).val(arrayInfo[i].comp)

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



            num++

            $('#fecha' + num).val(arrayInfo[i].fechaec)
            $('#hora' + num).val(arrayInfo[i].horaec)
            $('#nombre' + num).val(arrayInfo[i].nombreec)

            var firmaUsuario = buscarFirma(arrayInfo[i].registroec);

            document.querySelector("#firma" + num).src = firmaUsuario;

            if (arrayInfo[i].nombreec != "") {
                $('#firma' + num).removeClass('oculto')
                $('#btnFirmar' + num).hide()
            }
            $('#registro' + num).val(arrayInfo[i].registroec)



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


function actInstalacion() {

    inst1 = $('#inst1').val()
    inst2 = $('#inst2').val()
    inst3 = $('#inst3').val()
    inst4 = $('#inst4').val()


    //supervisor
    var fechautsup = $('#fecha1').val()
    var horautsup = $('#hora1').val()
    var nombreutsup = $('#nombre1').val()

    //var img = document.getElementById("firma1");
    var firmautsup = $('#registro1').val()

    if (fechautsup == '') {
        firmautsup = ''
    }

    var registroutsup = $('#registro1').val()

    //qaqc
    var fechautqaqc = $('#fecha2').val()
    var horautqaqc = $('#hora2').val()
    var nombreutqaqc = $('#nombre2').val()

    //var img = document.getElementById("firma2");
    var firmautqaqc = $('#registro2').val()

    if (fechautqaqc == '') {
        firmautqaqc = ''
    }

    var registroutqaqc = $('#registro2').val()

    var arrayAlist = []

    arrayAlist.push({
        "inst1": inst1,
        "inst2": inst2,
        "inst3": inst3,
        "inst4": inst4,
        "fechautsup": fechautsup,
        "horautsup": horautsup,
        "nombreutsup": nombreutsup,
        "firmautsup": firmautsup,
        "registroutsup": registroutsup,
        "fechautqaqc": fechautqaqc,
        "horautqaqc": horautqaqc,
        "nombreutqaqc": nombreutqaqc,
        "firmautqaqc": firmautqaqc,
        "registroutqaqc": registroutqaqc
    })

    console.log(arrayAlist)

    $.post(server + 'actOs3317Sas.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayAlist)
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

    var num = 2;
    var numc = 0;

    var arrayFirmas = []


    for (var i = 1; i <= 9; i++) {

        num++
        numc++

        var comp = $('#apertM' + numc).val()

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



        arrayFirmas.push({
            "comp": comp,
            "fechautsup": fechautsup,
            "horautsup": horautsup,
            "nombreutsup": nombreutsup,
            "firmautsup": firmautsup,
            "registroutsup": registroutsup
        })
    }

    console.log(arrayFirmas)

    $.post(server + 'act33317Apertura.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayFirmas)
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

    var num = 11;
    var numc = 0;

    var arrayFirmas = []


    for (var i = 1; i <= 6; i++) {

        num++
        numc++

        var comp = $('#compLimp' + numc).val()

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



        arrayFirmas.push({
            "comp": comp,
            "fechautsup": fechautsup,
            "horautsup": horautsup,
            "nombreutsup": nombreutsup,
            "firmautsup": firmautsup,
            "registroutsup": registroutsup
        })
    }

    console.log(arrayFirmas)

    $.post(server + 'act33317Limpieza.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayFirmas)
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

function actRetiro() {

    var num = 17;
    var numc = 0;

    var arrayFirmas = []


    for (var i = 1; i <= 18; i++) {

        num++
        numc++

        var comp = $('#compRet' + numc).val()

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

        num++

        var fechautqaqc = $('#fecha' + num).val()
        var horautqaqc = $('#hora' + num).val()
        var nombreutqaqc = $('#nombre' + num).val()

        //var img = document.getElementById("firma" + num);

        if (fechautqaqc != '') {
            var firmautqaqc = $('#registro' + num).val()
        } else {
            var firmautqaqc = ''
        }

        var registroutqaqc = $('#registro' + num).val()

        num++

        var fechaec = $('#fecha' + num).val()
        var horaec = $('#hora' + num).val()
        var nombreec = $('#nombre' + num).val()

        var img = document.getElementById("firma" + num);

        if (img.src.includes('data:image/png;base64')) {
            var firmaec = $('#registro' + num).val()
        } else {
            var firmaec = ''
        }

        var registroec = $('#registro' + num).val()

        num++

        var fechaecg = $('#fecha' + num).val()
        var horaecg = $('#hora' + num).val()
        var nombreecg = $('#nombre' + num).val()

        var img = document.getElementById("firma" + num);

        if (img.src.includes('data:image/png;base64')) {
            var firmaecg = $('#registro' + num).val()
        } else {
            var firmaecg = ''
        }

        var registroecg = $('#registro' + num).val()

        arrayFirmas.push({
            "comp": comp,
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
            "fechaec": fechaec,
            "horaec": horaec,
            "nombreec": nombreec,
            "firmaec": firmaec,
            "registroec": registroec,
            "fechaecg": fechaecg,
            "horaecg": horaecg,
            "nombreecg": nombreecg,
            "firmaecg": firmaecg,
            "registroecg": registroecg
        })
    }

    console.log(arrayFirmas)

    $.post(server + 'act33317Retiro.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayFirmas)
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

    var num = 89;
    var numc = 0;

    var arrayFirmas = []


    for (var i = 1; i <= 13; i++) {

        num++
        numc++

        var comp = $('#compEnt' + numc).val()

        var fechautsup = $('#fecha' + num).val()
        var horautsup = $('#hora' + num).val()
        var nombreutsup = $('#nombre' + num).val()

        var img = document.getElementById("firma" + num);
        if (fechautsup != '') {
            var firmautsup = $('#registro' + num).val()
        } else {
            var firmautsup = ''
        }

        var registroutsup = $('#registro' + num).val()



        num++

        var fechaec = $('#fecha' + num).val()
        var horaec = $('#hora' + num).val()
        var nombreec = $('#nombre' + num).val()

        var img = document.getElementById("firma" + num);

        console.log(num)

        if (img.src.includes('data:image/png;base64')) {
            var firmaec = $('#registro' + num).val()
        } else {
            var firmaec = ''
        }

        var registroec = $('#registro' + num).val()



        arrayFirmas.push({
            "comp": comp,
            "fechautsup": fechautsup,
            "horautsup": horautsup,
            "nombreutsup": nombreutsup,
            "firmautsup": firmautsup,
            "registroutsup": registroutsup,
            "fechaec": fechaec,
            "horaec": horaec,
            "nombreec": nombreec,
            "firmaec": firmaec,
            "registroec": registroec,

        })
    }

    console.log(arrayFirmas)

    $.post(server + 'act33317Entrega.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayFirmas)
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
                    <a href='https://utitalco.com/calidad/033/desmantelamiento/server/archivos/${listaArchivos[i].archivo}' target='_blank'>${listaArchivos[i].archivo}</a> <br>
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
                url: server + 'guardarArchivo3317.php',
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


    $.post(server + 'actOs3317Obs.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayLmp)
    },
        function (res) {
            console.log(res)
            location.reload()
        })

}
