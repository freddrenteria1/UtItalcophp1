
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

function firmar(){
    limpiarCanvas()
    var myModal = new bootstrap.Modal(document.getElementById('modalFirma'))
    myModal.show()
}

function pasarFirma() {
     
    imagencargada = canvas.toDataURL("image/png");
    //document.querySelector("#firma").src = window.opener.obtenerImagen();
    document.querySelector("#firma").src = canvas.toDataURL("image/png");

    $('#firma').removeClass('oculto')
    $('#btnFirmar').hide()

}

function agregarPD(){
    var myModal = new bootstrap.Modal(document.getElementById('modalFoto1'))
    myModal.show()

}

function readURLpDelantera(input) {
     
    if (input.files && input.files[0]) { //Revisamos que el input tenga contenido

      var reader = new FileReader(); //Leemos el contenido
      reader.onload = function(e) { //Al cargar el contenido lo pasamos como atributo de la imagen de arriba
        $('#parteDelantera').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
}

$("#fotoPD").change(function() { 
    
    $('#modalFoto1').modal({
        show: 'false'
    }); 
    readURLpDelantera(this);

});


function agregarPP(){
    var myModal = new bootstrap.Modal(document.getElementById('modalFoto2'))
    myModal.show()

}

function readURLpPosterior(input) {
     
    if (input.files && input.files[0]) { //Revisamos que el input tenga contenido

      var reader = new FileReader(); //Leemos el contenido
      reader.onload = function(e) { //Al cargar el contenido lo pasamos como atributo de la imagen de arriba
        $('#partePosterior').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
}

$("#fotoPP").change(function() { 
    
    $('#modalFoto2').modal({
        show: 'false'
    }); 
    readURLpPosterior(this);
    
});


function agregarLD(){
    var myModal = new bootstrap.Modal(document.getElementById('modalFoto3'))
    myModal.show()

}

function readURLLD(input) {
     
    if (input.files && input.files[0]) { //Revisamos que el input tenga contenido

      var reader = new FileReader(); //Leemos el contenido
      reader.onload = function(e) { //Al cargar el contenido lo pasamos como atributo de la imagen de arriba
        $('#ladoDerecho').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
}

$("#fotoLD").change(function() { 
    
    $('#modalFoto3').modal({
        show: 'false'
    }); 
    readURLLD(this);
    
});

function agregarLI(){
    var myModal = new bootstrap.Modal(document.getElementById('modalFoto4'))
    myModal.show()

}

function readURLLI(input) {
     
    if (input.files && input.files[0]) { //Revisamos que el input tenga contenido

      var reader = new FileReader(); //Leemos el contenido
      reader.onload = function(e) { //Al cargar el contenido lo pasamos como atributo de la imagen de arriba
        $('#ladoIzquierdo').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
}

$("#fotoLI").change(function() { 
    
    $('#modalFoto4').modal({
        show: 'false'
    }); 
    readURLLI(this);
    
});

server = 'https://utitalco.com/conductores/server/';
arrayDatos = null

function buscarPlaca(){
    placab = $('#placab').val()
    $.post(server+'buscarPlaca.php', {placa:placab},
    function(resp){
        console.log(resp)
        if(resp.id != null){
            arrayDatos = resp
            cargarInfo()
        }else{
            Swal.fire({
                title: "Información!",
                text: "Placa no está registrada.",
                icon: "info"
              });
        }
    })
}

function cargarInfo(){
    $('#placa').html(arrayDatos.placa)
    $('#tipo').html(arrayDatos.tipo)
    $('#modelo').html(arrayDatos.modelo)
    $('#marca').html(arrayDatos.marca)
    $('#capacidad').html(arrayDatos.capacidad)
    $('#ultmant').html(arrayDatos.ultmant)
    $('#kmmant').html(arrayDatos.kiloultmant)
    $('#proxmant').html(arrayDatos.proxmant)
    $('#soatexp').html(arrayDatos.soatexp)
    $('#soatvence').html(arrayDatos.soatvence)
    $('#tecnoexp').html(arrayDatos.tecnoexp)
    $('#tecnovence').html(arrayDatos.tecnovence)
    
}

arrayItems = []

function guardarTodo(){

    placa = arrayDatos.placa
    fecha = $('#fecha').val()
    documento = $('#documento').val()
    conductor = $('#conductor').val()
    ods = $('#ods').val()
    planta = $('#planta').val()

    for(var i=1; i<=49; i++){

        item = $('#item'+i).val()

        arrayItems.push({
            item: item
        })
    }

    firma = canvas.toDataURL("image/png");

    
    fotoPD = $('#fotoPD')[0].files[0];
    fotoPP = $('#fotoPP')[0].files[0];
    fotoLD = $('#fotoLD')[0].files[0];
    fotoLI = $('#fotoLI')[0].files[0];

    observaciones = $('#observaciones').val()

    var formData = new FormData();

    formData.append('placa', placa);
    formData.append('fecha', fecha);
    formData.append('documento', documento);
    formData.append('conductor', conductor);
    formData.append('ods', ods);
    formData.append('planta', planta);

    formData.append('items', JSON.stringify(arrayItems));

    formData.append('firma', firma);

    formData.append('fotoPD', fotoPD);
    formData.append('fotoPP', fotoPP);
    formData.append('fotoLD', fotoLD);
    formData.append('fotoLI', fotoLI);

    formData.append('observaciones', observaciones);

    $.ajax({
        url: server + 'guardarInsp.php',
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
                    title: 'Inspección almacenada correctamente...',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {

                    location.reload();
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error en el registro...!',
                })
            }
        }
    });




    

}


