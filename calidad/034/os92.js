

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
            actFirmas()
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


var server = 'https://utitalco.com/calidad/034/server/';

$.post(server + 'cargarRca92.php', {
    ods: odsq,
    tag: tag
},
    function (resp) {
        arrayDatos = resp
        cargarDatos()
    })

function cargarDatos(){

    $('#contrato').html(arrayDatos.contrato)
    $('#unidad').html(arrayDatos.unidad)
    $('#planta').html(arrayDatos.planta)
    
    $('#serie').val(arrayDatos.serie)

    $('#ods').html(arrayDatos.ods)
    $('#familia').html(arrayDatos.familia)
    $('#tag').html(arrayDatos.tag)

    
    $('#equipomedicion').val(arrayDatos.equipo)
    $('#marcamedicion').val(arrayDatos.marca)
    $('#seriemedicion').val(arrayDatos.serie_numero)
    $('#tension').val(arrayDatos.tension_aplicada)
    $('#fechacalibracion').val(arrayDatos.fecha_calibracion)

    //info prueba

    $('#tiempoprueba').val(arrayDatos.tiempo_prueba)
    $('#tipocable').val(arrayDatos.tipo_cable)
    $('#potencia').val(arrayDatos.potencia)
    $('#control').val(arrayDatos.control)

    //datos prueba

    if (arrayDatos.datosprueba != "") {

        arrayInfo = JSON.parse(arrayDatos.datosprueba)


        $('#conductor').val(arrayInfo[0].conductor)
        $('#origen').val(arrayInfo[0].origen)
        $('#destino').val(arrayInfo[0].destino)
        $('#timbrado').val(arrayInfo[0].timbrado)
        $('#calibre').val(arrayInfo[0].calibre)
        $('#longitud').val(arrayInfo[0].longitud)
        $('#par1n1b1').val(arrayInfo[0].par1n1b1)
        $('#par1n1s').val(arrayInfo[0].par1n1s)
        $('#par1b1s').val(arrayInfo[0].par1b1s)
        $('#par2n2b2').val(arrayInfo[0].par2n2b2)
        $('#par2n2s').val(arrayInfo[0].par2n2s)
        $('#par2b2s').val(arrayInfo[0].par2b2s)
        $('#cumple1').val(arrayInfo[0].cumple1)
        $('#aceptada1').val(arrayInfo[0].aceptada1)
         
    }

    if (arrayDatos.firmas != "") {
        var arrayFirmasItems = JSON.parse(arrayDatos.firmas)

        //ecp

        $('#fecha2').val(arrayFirmasItems[0].fechaec)
        $('#hora2').val(arrayFirmasItems[0].horaec)
        $('#nombre2').val(arrayFirmasItems[0].nombreec)

        if (arrayFirmasItems[0].fechaec != "") {
            document.querySelector("#firma2").src = arrayFirmasItems[0].firmaec;
            $('#firma2').removeClass('oculto')
            $('#btnFirmar2').hide()
        }

        $('#registro2').val(arrayFirmasItems[0].registroec)

        //ut

        $('#fecha1').val(arrayFirmasItems[0].fechaut)
        $('#hora1').val(arrayFirmasItems[0].horaut)
        $('#nombre1').val(arrayFirmasItems[0].nombreut)

        if (arrayFirmasItems[0].fechaut != "") {
            document.querySelector("#firma1").src = arrayFirmasItems[0].firmaut;
            $('#firma1').removeClass('oculto')
            $('#btnFirmar1').hide()
        }

        $('#registro1').val(arrayFirmasItems[0].registrout)


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
     


    Swal.close()



}


function actInfo() {

    var serie = $('#serie').val()
     
    var equipo = $('#equipomedicion').val()
    var marca = $('#marcamedicion').val()
    var serie_numero = $('#seriemedicion').val()
    var tension_aplicada = $('#tension').val()
    var fecha_calibracion = $('#fechacalibracion').val()


    $.post(server + 'act92info.php', {
        ods: odsq,
        tag: tag,
        serie: serie,
        equipo: equipo,
        marca: marca,
        serie_numero: serie_numero,
        tension_aplicada: tension_aplicada,
        fecha_calibracion: fecha_calibracion
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

function actInfoPrueba() {
     
    var tiempo_prueba = $('#tiempoprueba').val()
    var tipo_cable = $('#tipocable').val()
    var potencia = $('#potencia').val()
    var control = $('#control').val()

    $.post(server + 'act92infoPrueba.php', {
        ods: odsq,
        tag: tag,
        tiempo_prueba: tiempo_prueba,
        tipo_cable: tipo_cable,
        potencia: potencia,
        control: control
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

function actPrueba() {

    var conductor = $('#conductor').val()
    var origen = $('#origen').val()
    var destino = $('#destino').val()
    var timbrado = $('#timbrado').val()
    var calibre = $('#calibre').val()
    var longitud = $('#longitud').val()
    var par1n1b1 = $('#par1n1b1').val()
    var par1n1s = $('#par1n1s').val()
    var par1b1s = $('#par1b1s').val()
    var par2n2b2 = $('#par2n2b2').val()
    var par2n2s = $('#par2n2s').val()
    var par2b2s = $('#par2b2s').val()
    var cumple1 = $('#cumple1').val()
    var aceptada1 = $('#aceptada1').val()
     
    var arrayInfo = []

    arrayInfo.push({
        "conductor": conductor,
        "origen": origen,
        "destino": destino,
        "timbrado": timbrado,
        "calibre": calibre,
        "longitud": longitud,
        "par1n1b1": par1n1b1,
        "par1n1b1": par1n1b1,
        "par1n1s": par1n1s,
        "par1b1s": par1b1s,
        "par2n2b2": par2n2b2,
        "par2n2s": par2n2s,
        "par2b2s": par2b2s,
        "cumple1": cumple1,
        "aceptada1": aceptada1
    })

    $.post(server + 'act92DatosPrueba.php', {
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


    $.post(server + 'actOs92Obs.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayLmp)
    },
        function (res) {
            console.log(res)
            location.reload()
        })

}

function actFirmas() {

    var fechaec = $('#fecha2').val()
    var horaec = $('#hora2').val()
    var nombreec = $('#nombre2').val()

    var img = document.getElementById("firma2");
    var firmaec = img.src

    if (fechaec == '') {
        firmaec = ''
    }

    var registroec = $('#registro2').val()

    var fechaut = $('#fecha1').val()
    var horaut = $('#hora1').val()
    var nombreut = $('#nombre1').val()

    var img = document.getElementById("firma1");
    var firmaut = img.src

    if (fechaut == '') {
        firmaut = ''
    }

    var registrout = $('#registro1').val()

    var arrayFirmasItems = []

    arrayFirmasItems.push({
        'fechaec': fechaec,
        'horaec': horaec,
        'nombreec': nombreec,
        'firmaec': firmaec,
        'registroec': registroec,
        'fechaut': fechaut,
        'horaut': horaut,
        'nombreut': nombreut,
        'firmaut': firmaut,
        'registrout': registrout,
    })

    $.post(server + 'act92Firmas.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayFirmasItems)
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