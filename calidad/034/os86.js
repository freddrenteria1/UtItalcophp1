



function agregarObs() {
    $('#tblobs').removeClass("oculto")
    $('#btnagregarObs').addClass("oculto")
}

function agregarObsCal() {
    $('#tblobsCal').removeClass("oculto")
    $('#btnagregarObs').addClass("oculto")
}

var imagencargada = null
var idImagen = null

var user = sessionStorage.getItem('usercal')
var verifuser = sessionStorage.getItem('datosuserqaqc')

var listaArchivosCal = []
var listaArchivos = []

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


        if (idImagen >= 1 && idImagen <= 3) {
            actEstadoInicial()
        }

        if (idImagen >= 4 && idImagen <= 6) {
            actEstadoFinal()
        }
        
        if (idImagen >= 7 && idImagen <= 8) {
            actFirmasCal()
        }

        if (idImagen >= 9 && idImagen <= 10) {
            actDatosPrueba()
        }

        



        if (idImagen == 100) {
            guardarObs()
        }

        if (idImagen == 200) {
            guardarObsCal()
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

$.post(server + 'cargarRca86.php', {
    ods: odsq,
    tag: tag
},
    function (resp) {
        arrayDatos = resp
        cargarDatos()
    })

function cargarDatos() {

    $('#unidad').val(arrayDatos.unidad)
    $('#planta').val(arrayDatos.planta)

    $('#ods').val(arrayDatos.ods)
    $('#familia').val(arrayDatos.familia)
    $('#tag').val(arrayDatos.tag)

    if (arrayDatos.info != "") {
        arrayInfo = JSON.parse(arrayDatos.info)

        $('#serie').val(arrayInfo[0].serie)
        $('#fecha').val(arrayInfo[0].fecha)
        $('#marca').val(arrayInfo[0].marca)
        $('#modelo').val(arrayInfo[0].modelo)
        $('#servicio').val(arrayInfo[0].servicio)
        $('#pmedicion').val(arrayInfo[0].pmedicion)
        $('#rangocal').val(arrayInfo[0].rangocal)
        $('#sistpurga').val(arrayInfo[0].sistpurga)
        $('#unding').val(arrayInfo[0].unding)
        $('#sistcal').val(arrayInfo[0].sistcal)
        $('#manifold').val(arrayInfo[0].manifold)
        $('#tiptrans').val(arrayInfo[0].tiptrans)
        $('#tipoelem').val(arrayInfo[0].tipoelem)
        $('#cual').val(arrayInfo[0].cual)
        $('#conexion').val(arrayInfo[0].conexion)
        $('#tipori').val(arrayInfo[0].tipori)
        $('#entcustodia').val(arrayInfo[0].entcustodia)

        

    }

    // $('#entcustodia').val(arrayDatos.entcustodia)
    // $('#fechaentcustodia').val(arrayDatos.fechaentcustodia)

    if (arrayDatos.items != "") {
        arrayItems = JSON.parse(arrayDatos.items)
        for (var i = 0; i <= 15; i++) {
            b = i + 1;
            $('#itemi' + b).val(arrayItems[i].itemi)
            $('#itemf' + b).val(arrayItems[i].itemf)
            $('#obsitem' + b).val(arrayItems[i].obsitem)
        }
    }

    


    if (arrayDatos.estadoinicial != "") {
        var arrayFirmasItems = JSON.parse(arrayDatos.estadoinicial)

        //ecp

        $('#fecha1').val(arrayFirmasItems[0].fechaec)
        $('#hora1').val(arrayFirmasItems[0].horaec)
        $('#nombre1').val(arrayFirmasItems[0].nombreec)

        if (arrayFirmasItems[0].fechaec != "") {
            document.querySelector("#firma1").src = arrayFirmasItems[0].firmaec;
            $('#firma1').removeClass('oculto')
            $('#btnFirmar1').hide()
        }

        $('#registro1').val(arrayFirmasItems[0].registroec)

        //ecp2

        $('#fecha2').val(arrayFirmasItems[0].fechaec2)
        $('#hora2').val(arrayFirmasItems[0].horaec2)
        $('#nombre2').val(arrayFirmasItems[0].nombreec2)

        if (arrayFirmasItems[0].fechaec2 != "") {
            document.querySelector("#firma2").src = arrayFirmasItems[0].firmaec2;
            $('#firma2').removeClass('oculto')
            $('#btnFirmar2').hide()
        }

        $('#registro2').val(arrayFirmasItems[0].registroec2)

        //ut

        $('#fecha3').val(arrayFirmasItems[0].fechaut)
        $('#hora3').val(arrayFirmasItems[0].horaut)
        $('#nombre3').val(arrayFirmasItems[0].nombreut)

        if (arrayFirmasItems[0].fechaut != "") {
            document.querySelector("#firma3").src = arrayFirmasItems[0].firmaut;
            $('#firma3').removeClass('oculto')
            $('#btnFirmar3').hide()
        }

        $('#registro3').val(arrayFirmasItems[0].registrout)


    }

    if (arrayDatos.estadofinal != "") {
        var arrayFirmasItems = JSON.parse(arrayDatos.estadofinal)

        //ecp

        $('#fecha4').val(arrayFirmasItems[0].fechaec)
        $('#hora4').val(arrayFirmasItems[0].horaec)
        $('#nombre4').val(arrayFirmasItems[0].nombreec)

        if (arrayFirmasItems[0].fechaec != "") {
            document.querySelector("#firma4").src = arrayFirmasItems[0].firmaec;
            $('#firma4').removeClass('oculto')
            $('#btnFirmar4').hide()
        }

        $('#registro4').val(arrayFirmasItems[0].registroec)

         //ecp2

         $('#fecha5').val(arrayFirmasItems[0].fechaec2)
         $('#hora5').val(arrayFirmasItems[0].horaec2)
         $('#nombre5').val(arrayFirmasItems[0].nombreec2)
 
         if (arrayFirmasItems[0].fechaec2 != "") {
             document.querySelector("#firma5").src = arrayFirmasItems[0].firmaec2;
             $('#firma5').removeClass('oculto')
             $('#btnFirmar5').hide()
         }
 
         $('#registro5').val(arrayFirmasItems[0].registroec2)

        //ut

        $('#fecha6').val(arrayFirmasItems[0].fechaut)
        $('#hora6').val(arrayFirmasItems[0].horaut)
        $('#nombre6').val(arrayFirmasItems[0].nombreut)

        if (arrayFirmasItems[0].fechaut != "") {
            document.querySelector("#firma6").src = arrayFirmasItems[0].firmaut;
            $('#firma6').removeClass('oculto')
            $('#btnFirmar6').hide()
        }

        $('#registro6').val(arrayFirmasItems[0].registrout)


    }

    if (arrayDatos.infocal != "") {
        arrayInfo = JSON.parse(arrayDatos.infocal)

         
        $('#fechacal').val(arrayInfo[0].fecha)
        $('#undingcal').val(arrayInfo[0].unding)
        $('#rangocal2').val(arrayInfo[0].rangocal)
        $('#marcacal').val(arrayInfo[0].marca)
        $('#modelocal').val(arrayInfo[0].modelo)
        $('#elemprimcal').val(arrayInfo[0].elemprim)
        $('#serviciocal').val(arrayInfo[0].servicio)

    }

    if (arrayDatos.datoscal != "") {
        var arrayFirmasItems = JSON.parse(arrayDatos.datoscal)

        //ut

        $('#fecha7').val(arrayFirmasItems[0].fechaut1)
        $('#hora7').val(arrayFirmasItems[0].horaut1)
        $('#nombre7').val(arrayFirmasItems[0].nombreut1)

        if (arrayFirmasItems[0].fechaut1 != "") {
            document.querySelector("#firma7").src = arrayFirmasItems[0].firmaut1;
            $('#firma7').removeClass('oculto')
            $('#btnFirmar7').hide()
        }

        $('#registro7').val(arrayFirmasItems[0].registrout1)

        //ecp

        $('#fecha8').val(arrayFirmasItems[0].fechaut2)
        $('#hora8').val(arrayFirmasItems[0].horaut2)
        $('#nombre8').val(arrayFirmasItems[0].nombreut2)

        if (arrayFirmasItems[0].fechaut2 != "") {
            document.querySelector("#firma8").src = arrayFirmasItems[0].firmaut2;
            $('#firma8').removeClass('oculto')
            $('#btnFirmar8').hide()
        }

        $('#registro8').val(arrayFirmasItems[0].registrout2)


    }

    if (arrayDatos.itemscal != "") {
        arrayItems = JSON.parse(arrayDatos.itemscal)
        for (var i = 0; i <= 4; i++) {
            b = i + 1;
            $('#señal' + b).val(arrayItems[i].señal)
            $('#lectura' + b).val(arrayItems[i].lectura)
            $('#salida' + b).val(arrayItems[i].salida)
        }
    }

    if (arrayDatos.datosprueba != "") {
        var arrayFirmasItems = JSON.parse(arrayDatos.datosprueba)

        //ecp

        $('#fecha10').val(arrayFirmasItems[0].fechaec)
        $('#hora10').val(arrayFirmasItems[0].horaec)
        $('#nombre10').val(arrayFirmasItems[0].nombreec)

        if (arrayFirmasItems[0].fechaec != "") {
            document.querySelector("#firma10").src = arrayFirmasItems[0].firmaec;
            $('#firma10').removeClass('oculto')
            $('#btnFirmar10').hide()
        }

        $('#registro10').val(arrayFirmasItems[0].registroec)

        //ut

        $('#fecha9').val(arrayFirmasItems[0].fechaut)
        $('#hora9').val(arrayFirmasItems[0].horaut)
        $('#nombre9').val(arrayFirmasItems[0].nombreut)

        if (arrayFirmasItems[0].fechaut != "") {
            document.querySelector("#firma9").src = arrayFirmasItems[0].firmaut;
            $('#firma9').removeClass('oculto')
            $('#btnFirmar9').hide()
        }

        $('#registro9').val(arrayFirmasItems[0].registrout)


    }

    if (arrayDatos.itemsprueba != "") {
        arrayItems = JSON.parse(arrayDatos.itemsprueba)
        for (var i = 0; i <= 4; i++) {
            b = i + 1;
            $('#señalp' + b).val(arrayItems[i].señalp)
            $('#lecturap' + b).val(arrayItems[i].lecturap)
            $('#lecturapdcs' + b).val(arrayItems[i].lecturapdcs)
        }
    }

    if (arrayDatos.equipos != "") {
        arrayInfo = JSON.parse(arrayDatos.equipos)

        $('#marcaEU').val(arrayInfo[0].marcaEU)
        $('#modeloEU').val(arrayInfo[0].modeloEU)
        $('#serieEU').val(arrayInfo[0].serieEU)
        $('#fechaCalibracionEU').val(arrayInfo[0].fechaCalibracionEU)


    }




    //CARGUE DE OBSERVACIONES CUSTODIA

    if (arrayDatos.obscustodia != "") {
        var arrayObs = JSON.parse(arrayDatos.obscustodia)
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
    if (arrayDatos.doccustodia != "") {
        listaArchivos = JSON.parse(arrayDatos.doccustodia)
    }

    //CARGUE DE OBSERVACIONES CALIBRACIÓN

    if (arrayDatos.obscal != "") {
        var arrayObs = JSON.parse(arrayDatos.obscal)
        var html = ''
        for (var i = 0; i < arrayObs.length; i++) {
            html = `<b>Nota ${i + 1}: </b>
                    ${arrayObs[i].obs} | ${arrayObs[i].nombre} | Registro: ${arrayObs[i].registro} | Fecha: ${arrayObs[i].fecha} | Firma: <span id="firmCal${i}" style="width: 60px;"></span> <br>--------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>
                    `
            $('#observacionesCal').append(html)
            const imagef = document.createElement('img')
            imagef.src = arrayObs[i].firma
            imagef.height = "60"
            document.querySelector('#firmCal' + i).appendChild(imagef)

        }
    }
    if (arrayDatos.doccal != "") {
        listaArchivosCal = JSON.parse(arrayDatos.doccal)
    }


    Swal.close()


}


//actualiza informacion

function actInfo() {
    var serie = $('#serie').val()
    var fecha = $('#fecha').val()
    var marca = $('#marca').val()
    var modelo = $('#modelo').val()
    var servicio = $('#servicio').val()
    var pmedicion = $('#pmedicion').val()
    var rangocal = $('#rangocal').val()
    var sistpurga = $('#sistpurga').val()
    var unding = $('#unding').val()
    var sistcal = $('#sistcal').val()
    var manifold = $('#manifold').val()
    var tiptrans = $('#tiptrans').val()
    var tipoelem = $('#tipoelem').val()
    var cual = $('#cual').val()
    var conexion = $('#conexion').val()
    var tipori = $('#tipori').val()
    var entcustodia = $('#entcustodia').val()

    var arrayInfo = []

    arrayInfo.push({
        "serie": serie,
        "fecha": fecha,
        "marca": marca,
        "modelo": modelo,
        "servicio": servicio,
        "pmedicion": pmedicion,
        "rangocal": rangocal,
        "sistpurga": sistpurga,
        "unding": unding,
        "sistcal": sistcal,
        "manifold": manifold,
        "tiptrans": tiptrans,
        "tipoelem": tipoelem,
        "cual": cual,
        "conexion": conexion,
        "tipori": tipori,
        "entcustodia": entcustodia
    })

    $.post(server + 'act86info.php', {
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


function actItems() {

    var arrayItems = []

    for (var i = 1; i <= 16; i++) {
        var itemi = $('#itemi' + i).val()
        var itemf = $('#itemf' + i).val()
        var obsitem = $('#obsitem' + i).val()

        arrayItems.push({
            'itemi': itemi,
            'itemf': itemf,
            'obsitem': obsitem
        })

    }

    $.post(server + 'act86Items.php', {
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

function actFirmasItems() {

    var fechaec = $('#fecha1').val()
    var horaec = $('#hora1').val()
    var nombreec = $('#nombre1').val()

    var img = document.getElementById("firma1");
    var firmaec = img.src

    if (fechaec == '') {
        firmaec = ''
    }

    var registroec = $('#registro1').val()

    var fechaut = $('#fecha2').val()
    var horaut = $('#hora2').val()
    var nombreut = $('#nombre2').val()

    var img = document.getElementById("firma2");
    var firmaut = img.src

    if (fechaut == '') {
        firmaut = ''
    }

    var registrout = $('#registro2').val()

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

    $.post(server + 'act86FirmaItems.php', {
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

function actEstadoInicial() {

    var fechaec = $('#fecha1').val()
    var horaec = $('#hora1').val()
    var nombreec = $('#nombre1').val()

    var img = document.getElementById("firma1");
    var firmaec = img.src

    if (fechaec == '') {
        firmaec = ''
    }

    var registroec = $('#registro2').val()

    var fechaec2 = $('#fecha2').val()
    var horaec2 = $('#hora2').val()
    var nombreec2 = $('#nombre2').val()

    var img = document.getElementById("firma2");
    var firmaec2 = img.src

    if (fechaec2 == '') {
        firmaec2 = ''
    }

    var registroec2 = $('#registro2').val()

    var fechaut = $('#fecha3').val()
    var horaut = $('#hora3').val()
    var nombreut = $('#nombre3').val()

    var img = document.getElementById("firma3");
    var firmaut = img.src

    if (fechaut == '') {
        firmaut = ''
    }

    var registrout = $('#registro3').val()

    var arrayFirmasItems = []

    arrayFirmasItems.push({
        'fechaec': fechaec,
        'horaec': horaec,
        'nombreec': nombreec,
        'firmaec': firmaec,
        'registroec': registroec,
        'fechaec2': fechaec2,
        'horaec2': horaec2,
        'nombreec2': nombreec2,
        'firmaec2': firmaec2,
        'registroec2': registroec2,
        'fechaut': fechaut,
        'horaut': horaut,
        'nombreut': nombreut,
        'firmaut': firmaut,
        'registrout': registrout,
    })

    $.post(server + 'act86FirmaEstInicial.php', {
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

function actEstadoFinal() {

    var fechaec = $('#fecha4').val()
    var horaec = $('#hora4').val()
    var nombreec = $('#nombre4').val()

    var img = document.getElementById("firma4");
    var firmaec = img.src

    if (fechaec == '') {
        firmaec = ''
    }

    var registroec = $('#registro4').val()

    var fechaec2 = $('#fecha5').val()
    var horaec2 = $('#hora5').val()
    var nombreec2 = $('#nombre5').val()

    var img = document.getElementById("firma5");
    var firmaec2 = img.src

    if (fechaec2 == '') {
        firmaec2 = ''
    }

    var registroec2 = $('#registro5').val()

    var fechaut = $('#fecha6').val()
    var horaut = $('#hora6').val()
    var nombreut = $('#nombre6').val()

    var img = document.getElementById("firma6");
    var firmaut = img.src

    if (fechaut == '') {
        firmaut = ''
    }

    var registrout = $('#registro6').val()

    var arrayFirmasItems = []

    arrayFirmasItems.push({
        'fechaec': fechaec,
        'horaec': horaec,
        'nombreec': nombreec,
        'firmaec': firmaec,
        'registroec': registroec,
        'fechaec2': fechaec2,
        'horaec2': horaec2,
        'nombreec2': nombreec2,
        'firmaec2': firmaec2,
        'registroec2': registroec2,
        'fechaut': fechaut,
        'horaut': horaut,
        'nombreut': nombreut,
        'firmaut': firmaut,
        'registrout': registrout,
    })

    $.post(server + 'act86FirmaEstFinal.php', {
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

//actualiza informacion

function actInfoCal() {
     
    var fecha = $('#fechacal').val()
    var unding = $('#undingcal').val()
    var rangocal = $('#rangocal2').val()
    var marca = $('#marcacal').val()
    var modelo = $('#modelocal').val()
    var elemprim = $('#elemprimcal').val()
    var servicio = $('#serviciocal').val()




    var arrayInfo = []

    arrayInfo.push({
        "fecha": fecha,
        "unding": unding,
        "rangocal": rangocal,
        "marca": marca,
        "modelo": modelo,
        "elemprim": elemprim,
        "servicio": servicio,

    })

    $.post(server + 'act86infocal.php', {
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

function actFirmasCal() {

    var fechaut1 = $('#fecha7').val()
    var horaut1 = $('#hora7').val()
    var nombreut1 = $('#nombre7').val()

    var img = document.getElementById("firma7");
    var firmaut1 = img.src

    if (fechaut1 == '') {
        firmaut1 = ''
    }

    var registrout1 = $('#registro7').val()

    var fechaut2 = $('#fecha8').val()
    var horaut2 = $('#hora8').val()
    var nombreut2 = $('#nombre8').val()

    var img = document.getElementById("firma8");
    var firmaut2 = img.src

    if (fechaut2 == '') {
        firmaut2 = ''
    }

    var registrout2 = $('#registro8').val()

    var arrayFirmasItems = []

    arrayFirmasItems.push({
        'fechaut1': fechaut1,
        'horaut1': horaut1,
        'nombreut1': nombreut1,
        'firmaut1': firmaut1,
        'registrout1': registrout1,
        'fechaut2': fechaut2,
        'horaut2': horaut2,
        'nombreut2': nombreut2,
        'firmaut2': firmaut2,
        'registrout2': registrout2
    })

    $.post(server + 'act86FirmasCal.php', {
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

function actDatos() {

    var arrayItems = []

    for (var i = 1; i <= 5; i++) {
        var señal = $('#señal' + i).val()
        var lectura = $('#lectura' + i).val()
        var salida = $('#salida' + i).val()

        arrayItems.push({
            'señal': señal,
            'lectura': lectura,
            'salida': salida
        })

    }

    $.post(server + 'act86Datos.php', {
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

function actDatosPrueba() {

    var fechaut = $('#fecha9').val()
    var horaut = $('#hora9').val()
    var nombreut = $('#nombre9').val()

    var img = document.getElementById("firma9");
    var firmaut = img.src

    if (fechaut == '') {
        firmaut = ''
    }

    var registrout = $('#registro9').val()


    var fechaec = $('#fecha10').val()
    var horaec = $('#hora10').val()
    var nombreec = $('#nombre10').val()

    var img = document.getElementById("firma10");
    var firmaec = img.src

    if (fechaec == '') {
        firmaec = ''
    }

    var registroec = $('#registro10').val()

    var arrayFirmasItems = []

    arrayFirmasItems.push({
        'fechaut': fechaut,
        'horaut': horaut,
        'nombreut': nombreut,
        'firmaut': firmaut,
        'registrout': registrout,
        'fechaec': fechaec,
        'horaec': horaec,
        'nombreec': nombreec,
        'firmaec': firmaec,
        'registroec': registroec
    })

    $.post(server + 'act86DatosPrueba.php', {
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

function actDatosPruebaItems() {

    var arrayItems = []

    for (var i = 1; i <= 5; i++) {
        var señalp = $('#señalp' + i).val()
        var lecturap = $('#lecturap' + i).val()
        var lecturapdcs = $('#lecturapdcs' + i).val()

        arrayItems.push({
            'señalp': señalp,
            'lecturap': lecturap,
            'lecturapdcs': lecturapdcs
        })

    }

    $.post(server + 'act86DatosPruebasItems.php', {
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



function actEquipos() {

    var marcaEU = $('#marcaEU').val()
    var modeloEU = $('#modeloEU').val()
    var serieEU = $('#serieEU').val()
    var fechaCalibracionEU = $('#fechaCalibracionEU').val()


    var arrayInfo = []

    arrayInfo.push({
        "marcaEU": marcaEU,
        "modeloEU": modeloEU,
        "serieEU": serieEU,
        "fechaCalibracionEU": fechaCalibracionEU

    })

    $.post(server + 'act86Equipos.php', {
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
                url: server + 'guardarArchivo86.php',
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

    if (arrayDatos.obscustodia != "") {

        var arrayLmp = JSON.parse(arrayDatos.obscustodia)
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


    $.post(server + 'actOs86Obs.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayLmp)
    },
        function (res) {
            console.log(res)
            location.reload()
        })

}

function verArchivosCal() {
    var htmltexto = ''
    for (var i = 0; i < listaArchivosCal.length; i++) {
        htmltexto += `
                    <a href='https://utitalco.com/calidad/034/server/archivos/${listaArchivosCal[i].archivo}' target='_blank'>${listaArchivosCal[i].archivo}</a> <br>
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

function adjuntarCal() {
    Swal.fire({
        title: 'Adjuntar archivo',
        html: `
                <input type="file" id="archivoCal" class="form-control" placeholder="Buscar..."> <br>
				Según el tamaño del archivo puede tardar un tiempo... espere el aviso de archivo cagado.
                `,
        showCancelButton: true,
        confirmButtonText: 'Adjuntar'
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {

            var formData = new FormData();
            var files = $('#archivoCal')[0].files[0];
            formData.append('archivo', files);
            formData.append('ods', odsq);
            formData.append('tag', tag);
            $.ajax({
                url: server + 'guardarArchivo86Cal.php',
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

function guardarObsCal() {
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
    var firmaobs = img.src

    if (arrayDatos.obscal != "") {

        var arrayLmp = JSON.parse(arrayDatos.obscal)
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


    $.post(server + 'actOs86ObsCal.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayLmp)
    },
        function (res) {
            console.log(res)
            location.reload()
        })

}