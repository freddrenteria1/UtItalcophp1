



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
            actDatos2()
        }

        if (idImagen == 3 || idImagen == 4) {
            actEstadoInicial()
        }

        if (idImagen == 5 || idImagen == 6) {
            actEstadoFinal()
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

$.post(server + 'cargarRca160.php', {
    ods: odsq,
    tag: tag
},
    function (resp) {
        arrayDatos = resp
        cargarDatos()
    })

function cargarDatos() {

    $('#unidad').html(arrayDatos.unidad)
    $('#planta').html(arrayDatos.planta)

    $('#ods').html(arrayDatos.ods)
    $('#familia').html(arrayDatos.familia)
    $('#tag').html(arrayDatos.tag)

    if (arrayDatos.info != "") {

        arrayInfo = JSON.parse(arrayDatos.info)

        $('#serie').val(arrayInfo[0].serie)
        $('#fecha').val(arrayInfo[0].fecha)
        $('#unding').val(arrayInfo[0].unding)
        $('#diametrorating').val(arrayInfo[0].diametrorating)
        $('#marca').val(arrayInfo[0].marca)
        $('#modelo').val(arrayInfo[0].modelo)
        $('#rangocal').val(arrayInfo[0].rangocal)
        $('#servicio').val(arrayInfo[0].servicio)

    }



    if (arrayDatos.datoscampo != "") {
        arrayItems = JSON.parse(arrayDatos.datoscampo)
        for (var i = 0; i <= 8; i++) {
            b = i + 1;
            $('#einicial' + b).val(arrayItems[i].einicial)
            $('#efinal' + b).val(arrayItems[i].efinal)
            $('#obs' + b).val(arrayItems[i].obs)
        }
    }

    if (arrayDatos.datosprueba != "") {
        arrayItems = JSON.parse(arrayDatos.datosprueba)
        for (var i = 0; i <= 1; i++) {
            b = i + 1;
            $('#iniOpen' + b).val(arrayItems[i].iniOpen)
            $('#iniClosed' + b).val(arrayItems[i].iniClosed)
        }
    }

    if (arrayDatos.firmadatos != "") {
        var arrayFirmasItems = JSON.parse(arrayDatos.firmadatos)

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


    if (arrayDatos.estadoinicial != "") {
        var arrayFirmasItems = JSON.parse(arrayDatos.estadoinicial)

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

        $('#fecha6').val(arrayFirmasItems[0].fechaec)
        $('#hora6').val(arrayFirmasItems[0].horaec)
        $('#nombre6').val(arrayFirmasItems[0].nombreec)

        if (arrayFirmasItems[0].fechaec != "") {
            document.querySelector("#firma6").src = arrayFirmasItems[0].firmaec;
            $('#firma6').removeClass('oculto')
            $('#btnFirmar6').hide()
        }

        $('#registro6').val(arrayFirmasItems[0].registroec)

        //ut

        $('#fecha5').val(arrayFirmasItems[0].fechaut)
        $('#hora5').val(arrayFirmasItems[0].horaut)
        $('#nombre5').val(arrayFirmasItems[0].nombreut)

        if (arrayFirmasItems[0].fechaut != "") {
            document.querySelector("#firma5").src = arrayFirmasItems[0].firmaut;
            $('#firma5').removeClass('oculto')
            $('#btnFirmar5').hide()
        }

        $('#registro5').val(arrayFirmasItems[0].registrout)


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

function actInfo() {
    var serie = $('#serie').val()
    var fecha = $('#fecha').val()
    var unding = $('#unding').val()
    var diametrorating = $('#diametrorating').val()
    var marca = $('#marca').val()
    var modelo = $('#modelo').val()
    var rangocal = $('#rangocal').val()
    var servicio = $('#servicio').val()

    var arrayInfo = []

    arrayInfo.push({
        "serie": serie,
        "fecha": fecha,
        "unding": unding,
        "diametrorating": diametrorating,
        "marca": marca,
        "modelo": modelo,
        "rangocal": rangocal,
        "servicio": servicio
    })

    $.post(server + 'act160info.php', {
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

function actItem() {

    var arrayItems = []

    for (var i = 1; i <= 9; i++) {
        var einicial = $('#einicial' + i).val()
        var efinal = $('#efinal' + i).val()
        var obs = $('#obs' + i).val()

        arrayItems.push({
            'einicial': einicial,
            'efinal': efinal,
            'obs': obs
        })

    }

    $.post(server + 'act160Items.php', {
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

function actDatos() {

    var arrayItems = []

    for (var i = 1; i <= 2; i++) {
        var iniOpen = $('#iniOpen' + i).val()
        var iniClosed = $('#iniClosed' + i).val()

        arrayItems.push({
            'iniOpen': iniOpen,
            'iniClosed': iniClosed
        })

    }

    $.post(server + 'act160DatosPrueba.php', {
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

function actDatos2() {

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

    $.post(server + 'act160FirmaItems.php', {
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

    var fechaec = $('#fecha4').val()
    var horaec = $('#hora4').val()
    var nombreec = $('#nombre4').val()

    var img = document.getElementById("firma4");
    var firmaec = img.src

    if (fechaec == '') {
        firmaec = ''
    }

    var registroec = $('#registro4').val()

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
        'fechaut': fechaut,
        'horaut': horaut,
        'nombreut': nombreut,
        'firmaut': firmaut,
        'registrout': registrout,
    })

    $.post(server + 'act160FirmaEstInicial.php', {
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

    var fechaec = $('#fecha6').val()
    var horaec = $('#hora6').val()
    var nombreec = $('#nombre6').val()

    var img = document.getElementById("firma6");
    var firmaec = img.src

    if (fechaec == '') {
        firmaec = ''
    }

    var registroec = $('#registro6').val()

    var fechaut = $('#fecha5').val()
    var horaut = $('#hora5').val()
    var nombreut = $('#nombre5').val()

    var img = document.getElementById("firma5");
    var firmaut = img.src

    if (fechaut == '') {
        firmaut = ''
    }

    var registrout = $('#registro5').val()

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

    $.post(server + 'act160FirmaEstFinal.php', {
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
                url: server + 'guardarArchivo160.php',
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


    $.post(server + 'actOs160Obs.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayLmp)
    },
        function (res) {
            console.log(res)
            location.reload()
        })

}



