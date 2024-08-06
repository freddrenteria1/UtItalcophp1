


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
            if(id == 3){
                idImagen = id;
                pasarFirma()
            }else{

                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Por favor registre primero fecha y hora...',
                    showConfirmButton: false,
                    timer: 2500
                })
            }
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
            actVerificado()
        }

        if (idImagen == 3) {
            actPruebaHidro()
        }

        if (idImagen == 4 || idImagen == 5) {
            actEstadoInicial()
        }

        if (idImagen == 6 || idImagen == 7) {
            actEstadoFinal()
        }

        if (idImagen == 8 || idImagen == 9) {
            actDatos()
        }

        if (idImagen == 10|| idImagen == 11) {
            actDatosPrueba()
        }





        if (idImagen == 100) {
            guardarObs()
        }

        if (idImagen == 200) {
            guardarObs2()
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

$.post(server + 'cargarRca90.php', {
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
        $('#marca').val(arrayInfo[0].marca)
        $('#modelo').val(arrayInfo[0].modelo)
        $('#servicio').val(arrayInfo[0].servicio)
        $('#unding').val(arrayInfo[0].unding)

        $('#transTemp').val(arrayInfo[0].transTemp)
        $('#tipoTrans').val(arrayInfo[0].tipoTrans)
        $('#rangocal').val(arrayInfo[0].rangocal)
        $('#elemPrim').val(arrayInfo[0].elemPrim)
        $('#tipoTerm').val(arrayInfo[0].tipoTerm)
        $('#tipoTerm2').val(arrayInfo[0].tipoTerm2)
        $('#otratipoterm').val(arrayInfo[0].otratipoterm)
        $('#rtd').val(arrayInfo[0].rtd)
        $('#hilos').val(arrayInfo[0].hilos)
        $('#rtdotro').val(arrayInfo[0].rtdotro)


    }


    if (arrayDatos.termocupla != "") {
        arrayItems = JSON.parse(arrayDatos.termocupla)
        for (var i = 0; i <= 8; i++) {
            b = i + 1;
            $('#einicial' + b).val(arrayItems[i].einicial)
            $('#efinal' + b).val(arrayItems[i].efinal)
            $('#obs' + b).val(arrayItems[i].obs)
        }
    }

    $('#tagtermo').val(arrayDatos.tagtermo)
    $('#ratingterm').val(arrayDatos.ratingterm)
    $('#longinm').val(arrayDatos.longinm)


    if(arrayDatos.termopozo != ""){
        arrayItems = JSON.parse(arrayDatos.termopozo)
        for(var i=0; i<= 3; i++){
            b=i+1;
             $('#einicialt'+b).val(arrayItems[i].einicialt)
             $('#efinalt'+b).val(arrayItems[i].efinalt)
             $('#obst'+b).val(arrayItems[i].obst)
        }
    }


    if (arrayDatos.verificado != "") {
        var arrayFirmasItems = JSON.parse(arrayDatos.verificado)

    

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


    }


    if (arrayDatos.prueba != "") {
        var arrayFirmasItems = JSON.parse(arrayDatos.prueba)

    

        //ut

        $('#pitem1').val(arrayFirmasItems[0].pitem1)
        $('#pitem2').val(arrayFirmasItems[0].pitem2)
        $('#pitem3').val(arrayFirmasItems[0].pitem3)

        $('#fecha3').val(arrayFirmasItems[0].fecha)
        $('#presion3').val(arrayFirmasItems[0].presion)
        $('#horainifin3').val(arrayFirmasItems[0].horainifin)
        $('#nombre3').val(arrayFirmasItems[0].nombre)

        $('#registro3').val(arrayFirmasItems[0].registro)
     
        

        if (arrayFirmasItems[0].fecha != "") {
            document.querySelector("#firma3").src = arrayFirmasItems[0].firma;
            $('#firma3').removeClass('oculto')
            $('#btnFirmar3').hide()
        }
    }

      if(arrayDatos.estadoinicial != ""){
        var arrayFirmasItems = JSON.parse(arrayDatos.estadoinicial)

        //ecp

        $('#fecha5').val(arrayFirmasItems[0].fechaec)
        $('#hora5').val(arrayFirmasItems[0].horaec)
        $('#nombre5').val(arrayFirmasItems[0].nombreec)

        if(arrayFirmasItems[0].fechaec != ""){
            document.querySelector("#firma5").src = arrayFirmasItems[0].firmaec;
            $('#firma5').removeClass('oculto')
            $('#btnFirmar5').hide()
        }

        $('#registro5').val(arrayFirmasItems[0].registroec)

        //ut

        $('#fecha4').val(arrayFirmasItems[0].fechaut)
        $('#hora4').val(arrayFirmasItems[0].horaut)
        $('#nombre4').val(arrayFirmasItems[0].nombreut)

        if(arrayFirmasItems[0].fechaut != ""){
            document.querySelector("#firma4").src = arrayFirmasItems[0].firmaut;
            $('#firma4').removeClass('oculto')
            $('#btnFirmar4').hide()
        }

        $('#registro4').val(arrayFirmasItems[0].registrout)


    }

    if(arrayDatos.estadofinal != ""){
        var arrayFirmasItems = JSON.parse(arrayDatos.estadofinal)

        //ecp

        $('#fecha7').val(arrayFirmasItems[0].fechaec)
        $('#hora7').val(arrayFirmasItems[0].horaec)
        $('#nombre7').val(arrayFirmasItems[0].nombreec)

        if(arrayFirmasItems[0].fechaec != ""){
            document.querySelector("#firma7").src = arrayFirmasItems[0].firmaec;
            $('#firma7').removeClass('oculto')
            $('#btnFirmar7').hide()
        }

        $('#registro7').val(arrayFirmasItems[0].registroec)

        //ut

        $('#fecha6').val(arrayFirmasItems[0].fechaut)
        $('#hora6').val(arrayFirmasItems[0].horaut)
        $('#nombre6').val(arrayFirmasItems[0].nombreut)

        if(arrayFirmasItems[0].fechaut != ""){
            document.querySelector("#firma6").src = arrayFirmasItems[0].firmaut;
            $('#firma6').removeClass('oculto')
            $('#btnFirmar6').hide()
        }

        $('#registro6').val(arrayFirmasItems[0].registrout)


    }


    if(arrayDatos.infocal != ""){
        arrayInfo = JSON.parse(arrayDatos.infocal)

         
        $('#fechacal').val(arrayInfo[0].fecha)
        $('#unding').val(arrayInfo[0].unding)
        $('#tiposensor').val(arrayInfo[0].tiposensor)
        $('#rangocal').val(arrayInfo[0].rangocal)
        $('#longitud').val(arrayInfo[0].longitud)
        $('#serviciocal').val(arrayInfo[0].servicio)
        

   }

   if(arrayDatos.firmadatoscal != ""){
        var arrayFirmasItems = JSON.parse(arrayDatos.firmadatoscal)

        //ecp

        $('#fecha8').val(arrayFirmasItems[0].fechaut1)
        $('#hora8').val(arrayFirmasItems[0].horaut1)
        $('#nombre8').val(arrayFirmasItems[0].nombreut1)

        if(arrayFirmasItems[0].fechaut1 != ""){
            document.querySelector("#firma8").src = arrayFirmasItems[0].firmaut2;
            $('#firma8').removeClass('oculto')
            $('#btnFirmar8').hide()
        }

        $('#registro8').val(arrayFirmasItems[0].registrout1)

        //ut

        $('#fecha9').val(arrayFirmasItems[0].fechaut2)
        $('#hora9').val(arrayFirmasItems[0].horaut2)
        $('#nombre9').val(arrayFirmasItems[0].nombreut2)

        if(arrayFirmasItems[0].fechaut2 != ""){
            document.querySelector("#firma9").src = arrayFirmasItems[0].firmaut2;
            $('#firma9').removeClass('oculto')
            $('#btnFirmar9').hide()
        }

        $('#registro9').val(arrayFirmasItems[0].registrout2)


    }

    if(arrayDatos.itemscal != ""){
        arrayItems = JSON.parse(arrayDatos.itemscal)
        for(var i=0; i<= 9; i++){
            b=i+1;
             $('#señal'+b).val(arrayItems[i].señal)
             $('#salida'+b).val(arrayItems[i].salida)
             $('#error'+b).val(arrayItems[i].error)
        }
    }

    if(arrayDatos.datospruebalazo != ""){
        var arrayFirmasItems = JSON.parse(arrayDatos.datospruebalazo)
        console.log(arrayFirmasItems)

        //ecp

        $('#fecha11').val(arrayFirmasItems[0].fechaec)
        $('#hora11').val(arrayFirmasItems[0].horaec)
        $('#nombre11').val(arrayFirmasItems[0].nombreec)

        if(arrayFirmasItems[0].fechaec != ""){
            document.querySelector("#firma11").src = arrayFirmasItems[0].firmaec;
            $('#firma11').removeClass('oculto')
            $('#btnFirmar11').hide()
        }

        $('#registro11').val(arrayFirmasItems[0].registroec)

        //ut

        $('#fecha10').val(arrayFirmasItems[0].fechaut)
        $('#hora10').val(arrayFirmasItems[0].horaut)
        $('#nombre10').val(arrayFirmasItems[0].nombreut)

        if(arrayFirmasItems[0].fechaut != ""){
            document.querySelector("#firma10").src = arrayFirmasItems[0].firmaut;
            $('#firma10').removeClass('oculto')
            $('#btnFirmar10').hide()
        }

        $('#registro10').val(arrayFirmasItems[0].registrout)


    }

    if(arrayDatos.itemspruebalazo != ""){
        arrayItems = JSON.parse(arrayDatos.itemspruebalazo)
        for(var i=0; i<= 4; i++){
            b=i+1;
             $('#señalP'+b).val(arrayItems[i].señalP)
             $('#indicacionP'+b).val(arrayItems[i].indicacionP)
             $('#errorP'+b).val(arrayItems[i].errorP)
        }
    }

    if(arrayDatos.equiposprueba != ""){
        arrayItems = JSON.parse(arrayDatos.equiposprueba)
        for(var i=0; i<= 2; i++){
            b=i+1;
             $('#marcaEU'+b).val(arrayItems[i].marcaEU)
             $('#modeloEU'+b).val(arrayItems[i].modeloEU)
             $('#serieEU'+b).val(arrayItems[i].serieEU)
             $('#fechacalibracionEU'+b).val(arrayItems[i].fechacalibracionEU)
        }
    }





   //CARGUE DE OBSERVACIONES

   if (arrayDatos.observaciones != "") {
        var arrayObs = JSON.parse(arrayDatos.observaciones)
        var html = ''
        for (var i = 0; i < arrayObs.length; i++) {
            html = `<b>Nota ${i+1}: </b>
            ${arrayObs[i].obs} | ${arrayObs[i].nombre} | Registro: ${arrayObs[i].registro} | Fecha: ${arrayObs[i].fecha} | Firma: <span id="firm${i}" style="width: 60px;"></span> <br>--------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>
            `
            $('#observaciones').append(html)
            const imagef = document.createElement('img')
            imagef.src = arrayObs[i].firma
            imagef.height = "60"
            document.querySelector('#firm' + i).appendChild(imagef)

        }
    }
    if(arrayDatos.doc!= ""){
        listaArchivos = JSON.parse(arrayDatos.doc)

    }

    if (arrayDatos.obsprueba != "") {
        var arrayObs = JSON.parse(arrayDatos.obsprueba)
        var html = ''
        for (var i = 0; i < arrayObs.length; i++) {
            html = `<b>Nota ${i+1}: </b>
            ${arrayObs[i].obs} | ${arrayObs[i].nombre} | Registro: ${arrayObs[i].registro} | Fecha: ${arrayObs[i].fecha} | Firma: <span id="firm${i}" style="width: 60px;"></span> <br>--------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>
            `
            $('#observaciones2').append(html)
            const imagef = document.createElement('img')
            imagef.src = arrayObs[i].firma
            imagef.height = "60"
            document.querySelector('#firm' + i).appendChild(imagef)

        }
    }
    if(arrayDatos.docprueba!= ""){
        listaArchivosV = JSON.parse(arrayDatos.docprueba)

    }


        Swal.close()


    }


//actualiza informacion

function actInfoDatos() {
    var serie = $('#serie').val()
    var fecha = $('#fecha').val()
    var unding = $('#unding').val()
    var marca = $('#marca').val()
    var modelo = $('#modelo').val()
    var rangocal = $('#rangocal').val()
    var servicio = $('#servicio').val()

    var transTemp = $('#transTemp').val()
    var tipoTrans = $('#tipoTrans').val()
    var elemPrim = $('#elemPrim').val()
    var tipoTerm = $('#tipoTerm').val()
    var tipoTerm2 = $('#tipoTerm2').val()
    var otratipoterm = $('#otratipoterm').val()
    var rtd = $('#rtd').val()
    var hilos = $('#hilos').val()
    var rtdotro = $('#rtdotro').val()
     


    var arrayInfo = []

    arrayInfo.push({
        "serie": serie,
        "fecha": fecha,
        "unding": unding,
        "marca": marca,
        "modelo": modelo,
        "servicio": servicio,
        "transTemp": transTemp,
        "tipoTrans": tipoTrans,
        "elemPrim": elemPrim,
        "tipoTerm": tipoTerm,
        "tipoTerm2": tipoTerm2,
        "otratipoterm": otratipoterm,
        "rtd": rtd,
        "hilos": hilos,
        "rtdotro": rtdotro,
    })

    $.post(server + 'act90info.php', {
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

    $.post(server + 'act90Items.php', {
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

function actItemTermo(){

    var arrayItems = []

        for(var i=1; i<=4; i++){
            var einicialt = $('#einicialt'+i).val()
            var efinalt = $('#efinalt'+i).val()
            var obst = $('#obst'+i).val()

            arrayItems.push({
                'einicialt':einicialt,
                'efinalt':efinalt,
                'obst':obst
            })

        }

        $.post(server + 'act90DatosTermo.php', {
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


function actDatosTerm(){
    var tagtermo = $('#tagtermo').val()
    var ratingterm = $('#ratingterm').val()
    var longinm = $('#longinm').val()

    $.post(server + 'act90Tag.php', {
            ods: odsq,
            tag: tag,
            tagtermo: tagtermo,
            ratingterm : ratingterm,
            longinm: longinm
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

function actVerificado(){

    var fechaut = $('#fecha1').val()
    var horaut = $('#hora1').val()
    var nombreut = $('#nombre1').val()

    var img = document.getElementById("firma1");
    var firmaut = img.src

    if (fechaut == '') {
        firmaut = ''
    }

    var registrout = $('#registro1').val()


    var fechaec = $('#fecha2').val()
    var horaec = $('#hora2').val()
    var nombreec = $('#nombre2').val()

    var img = document.getElementById("firma2");
    var firmaec = img.src

    if (fechaec == '') {
        firmaec = ''
    }

    var registroec = $('#registro2').val()

    var arrayFirmasItems = []

    arrayFirmasItems.push({
        'fechaut':fechaut,
        'horaut':horaut,
        'nombreut':nombreut,
        'firmaut':firmaut,
        'registrout':registrout,
        'fechaec':fechaec,
        'horaec':horaec,
        'nombreec':nombreec,
        'firmaec':firmaec,
        'registroec':registroec
    })

    $.post(server + 'act90Verificado.php', {
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

function actPruebaHidro(){

    var pitem1 = $('#pitem1').val()
    var pitem2 = $('#pitem2').val()
    var pitem3 = $('#pitem3').val()

    var fecha = $('#fecha3').val()
    var presion = $('#presion3').val()
    var tiempo = $('#tiempo3').val()
    var horainifin = $('#horainifin3').val()
    var nombre = $('#nombre3').val()
    var registro = $('#registro3').val()
    

    var img = document.getElementById("firma3");
    var firma = img.src

    if (fecha == '') {
        firma = ''
    }

 

    var arrayFirmasItems = []

    arrayFirmasItems.push({
        'pitem1':pitem1,
        'pitem2':pitem2,
        'pitem3':pitem3,
        'fecha':fecha,
        'presion':presion,
        'tiempo':tiempo,
        'horainifin':horainifin,
        'nombre':nombre,
        'registro':registro,
        'firma':firma,
    })

    $.post(server + 'act90Prueba.php', {
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


  function actEstadoFinal(){

    var fechaec = $('#fecha7').val()
    var horaec = $('#hora7').val()
    var nombreec = $('#nombre7').val()

    var img = document.getElementById("firma7");
    var firmaec = img.src

    if (fechaec == '') {
        firmaec = ''
    }

    var registroec = $('#registro7').val()

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
        'fechaec':fechaec,
        'horaec':horaec,
        'nombreec':nombreec,
        'firmaec':firmaec,
        'registroec':registroec,
        'fechaut':fechaut,
        'horaut':horaut,
        'nombreut':nombreut,
        'firmaut':firmaut,
        'registrout':registrout,
    })

    $.post(server + 'act90FirmaEstFinal.php', {
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

  function actEstadoInicial(){

    var fechaec = $('#fecha5').val()
    var horaec = $('#hora5').val()
    var nombreec = $('#nombre5').val()

    var img = document.getElementById("firma5");
    var firmaec = img.src

    if (fechaec == '') {
        firmaec = ''
    }

    var registroec = $('#registro5').val()

    var fechaut = $('#fecha4').val()
    var horaut = $('#hora4').val()
    var nombreut = $('#nombre4').val()

    var img = document.getElementById("firma4");
    var firmaut = img.src

    if (fechaut == '') {
        firmaut = ''
    }

    var registrout = $('#registro4').val()

    var arrayFirmasItems = []

    arrayFirmasItems.push({
        'fechaec':fechaec,
        'horaec':horaec,
        'nombreec':nombreec,
        'firmaec':firmaec,
        'registroec':registroec,
        'fechaut':fechaut,
        'horaut':horaut,
        'nombreut':nombreut,
        'firmaut':firmaut,
        'registrout':registrout,
    })

    $.post(server + 'act90FirmaEstInicial.php', {
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


//CALIBRACIÓN


function actInfoCal(){
     
    var fecha = $('#fechacal').val()
    var unding = $('#unding').val()
    var tiposensor = $('#tiposensor').val()
    var rangocal = $('#rangocal').val()
    var longitud = $('#longitud').val()
    var servicio = $('#serviciocal').val()
    

    var arrayInfo = []

    arrayInfo.push({
        "fecha":fecha,
        "unding":unding,
        "tiposensor":tiposensor,
        "rangocal":rangocal,
        "longitud":longitud,
        "servicio":servicio                
    })

    $.post(server + 'act90infocal.php', {
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

function actDatos(){

    var fechaut1 = $('#fecha8').val()
    var horaut1 = $('#hora8').val()
    var nombreut1 = $('#nombre8').val()
    var registrout1 = $('#registro8').val()

    var img = document.getElementById("firma8");
    var firmaut1 = img.src

    if (fechaut1 == '') {
        firmaut1 = ''
    }

    var fechaut2 = $('#fecha9').val()
    var horaut2 = $('#hora9').val()
    var nombreut2 = $('#nombre9').val()

    var img = document.getElementById("firma9");
    var firmaut2 = img.src

    if (fechaut2 == '') {
        firmaut2 = ''
    }

    var registrout2 = $('#registro9').val()

    var arrayFirmasItems = []

    arrayFirmasItems.push({
        'fechaut1':fechaut1,
        'horaut1':horaut1,
        'nombreut1':nombreut1,
        'registrout1':registrout1,
        'fechaut2':fechaut2,
        'horaut2':horaut2,
        'nombreut2':nombreut2,
        'firmaut2':firmaut2,
        'registrout2':registrout2
    })

    $.post(server + 'act90DatosCal.php', {
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


function actItems(){

    var arrayItems = []

        for(var i=1; i<=10; i++){
            var señal = $('#señal'+i).val()
            var salida = $('#salida'+i).val()
            var error = $('#error'+i).val()

            arrayItems.push({
                'señal':señal,
                'salida':salida,
                'error':error
            })

        }

        $.post(server + 'act90ItemsCal.php', {
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

function actDatosPrueba(){

    var fechaut = $('#fecha10').val()
    var horaut = $('#hora10').val()
    var nombreut = $('#nombre10').val()

    var img = document.getElementById("firma10");
    var firmaut = img.src

    if (fechaut == '') {
        firmaut = ''
    }

    var registrout = $('#registro10').val()


    var fechaec = $('#fecha11').val()
    var horaec = $('#hora11').val()
    var nombreec = $('#nombre11').val()

    var img = document.getElementById("firma11");
    var firmaec = img.src

    if (fechaec == '') {
        firmaec = ''
    }

    var registroec = $('#registro11').val()

    var arrayFirmasItems = []

    arrayFirmasItems.push({
        'fechaut':fechaut,
        'horaut':horaut,
        'nombreut':nombreut,
        'firmaut':firmaut,
        'registrout':registrout,
        'fechaec':fechaec,
        'horaec':horaec,
        'nombreec':nombreec,
        'firmaec':firmaec,
        'registroec':registroec
    })

    $.post(server + 'act90DatosPrueba.php', {
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

function actItems2(){

    var arrayItems = []

        for(var i=1; i<=5; i++){
            var señalP = $('#señalP'+i).val()
            var indicacionP = $('#indicacionP'+i).val()
            var errorP = $('#errorP'+i).val()

            arrayItems.push({
                'señalP':señalP,
                'indicacionP':indicacionP,
                'errorP':errorP
            })

        }

        $.post(server + 'act90Items2.php', {
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

function actEquipos(){

    var arrayItems = []

        for(var i=1; i<=3; i++){
            var marcaEU = $('#marcaEU'+i).val()
            var modeloEU = $('#modeloEU'+i).val()
            var serieEU = $('#serieEU'+i).val()
            var fechacalibracionEU = $('#fechacalibracionEU'+i).val()

            arrayItems.push({
                'marcaEU':marcaEU,
                'modeloEU':modeloEU,
                'serieEU':serieEU,
                'fechacalibracionEU':fechacalibracionEU
            })

        }

        $.post(server + 'act90Equipos.php', {
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




//FIN CALIBRACIÓN





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


function verArchivos2() {
    var htmltexto = ''
    for (var i = 0; i < listaArchivosV.length; i++) {
        htmltexto += `
                    <a href='https://utitalco.com/calidad/034/server/archivos/${listaArchivosV[i].archivo}' target='_blank'>${listaArchivosV[i].archivo}</a> <br>
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
                url: server + 'guardarArchivo90.php',
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

function adjuntar2() {
    Swal.fire({
        title: 'Adjuntar archivo',
        html: `
                <input type="file" id="archivo2" class="form-control" placeholder="Buscar..."> <br>
				Según el tamaño del archivo puede tardar un tiempo... espere el aviso de archivo cagado. 
                `,
        showCancelButton: true,
        confirmButtonText: 'Adjuntar'
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {

            var formData = new FormData();
            var files = $('#archivo2')[0].files[0];
            formData.append('archivo', files);
            formData.append('ods', odsq);
            formData.append('tag', tag);
            $.ajax({
                url: server + 'guardarArchivo90Cal.php',
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


    $.post(server + 'actOs90Obs.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayLmp)
    },
        function (res) {
            console.log(res)
            location.reload()
        })

}

function guardarObs2() {
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

    if (arrayDatos.obsprueba != "") {

        var arrayLmp = JSON.parse(arrayDatos.obsprueba)
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


    $.post(server + 'actOs90Obsprueba.php', {
        ods: odsq,
        tag: tag,
        datos: JSON.stringify(arrayLmp)
    },
        function (res) {
            console.log(res)
            location.reload()
        })

}