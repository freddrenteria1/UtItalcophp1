var url = "https://utitalco.com/fase1/2024/server/";

var userfase = sessionStorage.getItem("userfase");
var nombres = sessionStorage.getItem("nombres");

var numpag = 1;
var arrayDatos = [];
var arrayResp = [];
var arr = []; // Arreglo para llenar
var cont = 0;
var respsel = null
var puntaje = 0;

var nump = null
var preg = null

var listaPreg = []



if (localStorage.getItem('intentos')) {
    var totint = parseInt(localStorage.getItem('intentos'))
} else {
    var totint = 1
}

if (totint >= 2) {
    Swal.fire({
        position: "top-end",
        icon: "info",
        text: "Ya realizó los 2 intentos diarios para superar la evaluación. Intente nuevamente en 24 horas...!",
        showConfirmButton: false,
        timer: 3500,
    }).then(() => {
         
        location = 'fase1.html'
    })
}





cargarPreguntas();

function login() {
    var doc = $("#doc").val();
    var clave = $("#clave").val();

    if (doc && clave != "") {
        $.post(
            url + "ingreso.php", {
                doc: doc,
                clave: clave,
            },
            function (resp) {
                if (resp.msn == "Ok") {
                    sessionStorage.setItem("userfase", doc);
                    sessionStorage.setItem(
                        "nombres",
                        resp.nombres + " " + resp.apellidos
                    );

                    location = "home.html";
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Oops...",
                        text: "Acceso denegado...!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            }
        );
    } else {
        Swal.fire({
            position: "top-end",
            icon: "info",
            title: "Oops...",
            text: "Ingrese su usuario y contraseña...!",
            showConfirmButton: false,
            timer: 1500,
        });
    }
}

function salir() {
    location = "home.html";
}

function sumpag() {
    numpag++;
    if (numpag > 60) {
        numpag = 60;
    }
    $("#pag").html("Página: " + numpag + "/60");
}

function restpag() {
    numpag--;
    if (numpag < 1) {
        numpag = 1;
    }
    $("#pag").html("Página: " + numpag + "/60");
}

function evaluacion() {
    location = "evaluacion.html";
}

function numaleatorios() {

    var cantidadNumeros = 10; // Cantidad de números en el arreglo
    var hasta = 36; // Máximo valor de los números en el arreglo

    function llenarAleatorios(a) {
        var v = Math.floor(Math.random() * hasta);
        if (
            !a.some(function (e) {
                return e == v;
            })
        ) {
            /**
             * Si no se encuentra el valor aleatorio en el arreglo
             * se pushea el valor.
             */
            a.push(v);
        }
    }
    /**
     * Bucle para llenar el arreglo con la cantidad que necesites
     */
    while (arr.length < cantidadNumeros && cantidadNumeros < hasta) {
        llenarAleatorios(arr);
    }
}

function cargarPreguntas() {
    $.post(url + "preguntas.php", {}, function (resp) {
        arrayDatos = resp;
        numaleatorios()
        cargarPregunta()

        //console.log(arr[2])


        // for (var i = 0; i < arrayDatos.length; i++) {
        //     arrayResp = JSON.parse(arrayDatos[i].respuestas);
        //     console.log(arrayResp);
        // }
    });
}

function cargarPregunta() {
    nump = arr[cont]
    preg = arrayDatos[nump].pregunta
    $('#pregunta').html(preg)

    arrayResp = JSON.parse(arrayDatos[nump].respuestas);
    var html = ''
    for (var i = 0; i < arrayResp.length; i++) {
        html += `
        <div class="resp">
            <div class="form-check" onclick="selresp('${arrayResp[i].p}')">
                    ${arrayResp[i].p}
            </div>
            </div>
        `
    }
    $('#respuestas').html(html)

}

function selresp(a) {
    respsel = a;
    if (respsel == arrayDatos[nump].correcta) {
        puntaje += 10;
    }

    html = `<div class="progress-bar progress-bar-striped" role="progressbar" style="width: ${puntaje}%;" aria-valuenow="${puntaje}" aria-valuemin="0" aria-valuemax="100">PUNTAJE ${puntaje}</div>`
    $('#prog').html(html)

    setTimeout(function(){
        sig()
    }, 500);
}

function sig() {

    listaPreg.push({
        'pregunta': preg,
        'respuesta': respsel
    })


    cont++;
    var pag = cont + 1;
    if (cont < 10) {
        cargarPregunta()
        $('#pag').html('Pregunta: ' + pag + '/10')

    } else {
        if (puntaje >= 80) {
            localStorage.setItem('preguntas', JSON.stringify(listaPreg))
            localStorage.setItem('puntaje', puntaje)

            //detenerGrabacion()

            $.post(url + 'guardarCertificado.php', {doc:userfase,nombres:nombres,resp:JSON.stringify(listaPreg),puntaje:puntaje},
            function(resp){
                localStorage.setItem('datosuser',JSON.stringify(resp))
                if(puntaje>=80){
                    sessionStorage.setItem('estado','SI')
                }else{
                    sessionStorage.setItem('estado','NO')
                }
                location = 'home.html';
            })

        } else {
            Swal.fire({
                position: "top-end",
                icon: "info",
                text: "Para superar la evaluación debe responder correctamente 8 preguntas.  Tiene 2 intentos al día para presentar la evaluación...!",
                showConfirmButton: false,
                timer: 3500,
            }).then(() => {

                if (localStorage.getItem('intentos')) {
                    var totint = parseInt(localStorage.getItem('intentos')) + 1
                } else {
                    var totint = 1
                }


                localStorage.setItem('intentos', totint);
                location = 'fase1.html'
            })
        }
    }
    if (cont > 8) {
        $('#btnsig').html('Finalizar')
    }
}

$( document ).ready( function() {
    
    const tieneSoporteUserMedia = () =>
        !!(navigator.mediaDevices.getUserMedia)

    // Si no soporta...
    // Amable aviso para que el mundo comience a usar navegadores decentes ;)
    if (typeof MediaRecorder === "undefined" || !tieneSoporteUserMedia())
        return alert("Tu navegador web no cumple los requisitos; por favor, actualiza a un navegador decente como Firefox o Google Chrome");


    // Declaración de elementos del DOM
    const $dispositivosDeAudio = document.querySelector("#dispositivosDeAudio"),
        $dispositivosDeVideo = document.querySelector("#dispositivosDeVideo"),
        $duracion = document.querySelector("#duracion"),
        $video = document.querySelector("#video"),
        $btnComenzarGrabacion = document.querySelector("#btnComenzarGrabacion"),
        $btnDetenerGrabacion = document.querySelector("#btnDetenerGrabacion");

    // Algunas funciones útiles
    const limpiarSelect = elemento => {
        for (let x = elemento.options.length - 1; x >= 0; x--) {
            elemento.options.remove(x);
        }
    }

    const segundosATiempo = numeroDeSegundos => {
        let horas = Math.floor(numeroDeSegundos / 60 / 60);
        numeroDeSegundos -= horas * 60 * 60;
        let minutos = Math.floor(numeroDeSegundos / 60);
        numeroDeSegundos -= minutos * 60;
        numeroDeSegundos = parseInt(numeroDeSegundos);
        if (horas < 10) horas = "0" + horas;
        if (minutos < 10) minutos = "0" + minutos;
        if (numeroDeSegundos < 10) numeroDeSegundos = "0" + numeroDeSegundos;

        return `${horas}:${minutos}:${numeroDeSegundos}`;
    };
    // Variables "globales"
    let tiempoInicio, mediaRecorder, idIntervalo;
    const refrescar = () => {
        $duracion.textContent = segundosATiempo((Date.now() - tiempoInicio) / 1000);
    }

    // Consulta la lista de dispositivos de entrada de audio y llena el select
    const llenarLista = () => {
        navigator
            .mediaDevices
            .enumerateDevices()
            .then(dispositivos => {
                limpiarSelect($dispositivosDeAudio);
                limpiarSelect($dispositivosDeVideo);
                dispositivos.forEach((dispositivo, indice) => {
                    if (dispositivo.kind === "audioinput") {
                        const $opcion = document.createElement("option");
                        // Firefox no trae nada con label, que viva la privacidad
                        // y que muera la compatibilidad
                        $opcion.text = dispositivo.label || `Micrófono ${indice + 1}`;
                        $opcion.value = dispositivo.deviceId;
                        $dispositivosDeAudio.appendChild($opcion);
                    } else if (dispositivo.kind === "videoinput") {
                        const $opcion = document.createElement("option");
                        // Firefox no trae nada con label, que viva la privacidad
                        // y que muera la compatibilidad
                        $opcion.text = dispositivo.label || `Cámara ${indice + 1}`;
                        $opcion.value = dispositivo.deviceId;
                        $dispositivosDeVideo.appendChild($opcion);
                    }
                })
                comenzarAGrabar()
            })
    };
    // Ayudante para la duración; no ayuda en nada pero muestra algo informativo
    const comenzarAContar = () => {
        tiempoInicio = Date.now();
        idIntervalo = setInterval(refrescar, 500);
    };

    // Comienza a grabar el audio con el dispositivo seleccionado
    const comenzarAGrabar = () => {
        if (!$dispositivosDeAudio.options.length) return alert("No hay micrófono");
        if (!$dispositivosDeVideo.options.length) return alert("No hay cámara");
        // No permitir que se grabe doblemente
        if (mediaRecorder) return alert("Ya se está grabando");

        navigator.mediaDevices.getUserMedia({
                audio: {
                    deviceId: $dispositivosDeAudio.value, // Indicar dispositivo de audio
                },
                video: {
                    deviceId: $dispositivosDeAudio.value, // Indicar dispositivo de vídeo
                }
            })
            .then(stream => {
                // Poner stream en vídeo
                $video.srcObject = stream;
                $video.play();
                // Comenzar a grabar con el stream
                mediaRecorder = new MediaRecorder(stream);
                mediaRecorder.start();
                comenzarAContar();
                // En el arreglo pondremos los datos que traiga el evento dataavailable
                const fragmentosDeAudio = [];
                // Escuchar cuando haya datos disponibles
                mediaRecorder.addEventListener("dataavailable", evento => {
                    // Y agregarlos a los fragmentos
                    fragmentosDeAudio.push(evento.data);
                });
                // Cuando se detenga (haciendo click en el botón) se ejecuta esto
                mediaRecorder.addEventListener("stop", () => {
                    // Pausar vídeo
                    $video.pause();
                    // Detener el stream
                    stream.getTracks().forEach(track => track.stop());
                    // Detener la cuenta regresiva
                    detenerConteo();
                    // Convertir los fragmentos a un objeto binario
                    const blobVideo = new Blob(fragmentosDeAudio);

                    const formData = new FormData();

                    // Enviar el BinaryLargeObject con FormData
                    formData.append("video", blobVideo);
                    const RUTA_SERVIDOR = "https://utitalco.com/cam/guardar.php";
                    $duracion.textContent = "Enviando vídeo...";
                    fetch(RUTA_SERVIDOR, {
                            method: "POST",
                            body: formData,
                        })
                        .then(respuestaRaw => respuestaRaw.text()) // Decodificar como texto
                        .then(respuestaComoTexto => {
                            // Aquí haz algo con la respuesta ;)
                            console.log("La respuesta: ", respuestaComoTexto);
                            // Abrir el archivo, es opcional y solo lo pongo como demostración
                            $duracion.innerHTML = `<strong>Vídeo subido correctamente.</strong>&nbsp; <a target="_blank" href="${respuestaComoTexto}">Abrir</a>`
                        })
                });
            })
            .catch(error => {
                // Aquí maneja el error, tal vez no dieron permiso
                console.log(error)
            });
    };


    const detenerConteo = () => {
        clearInterval(idIntervalo);
        tiempoInicio = null;
        $duracion.textContent = "";
    }

    const detenerGrabacion = () => {
        if (!mediaRecorder) return alert("No se está grabando");
        mediaRecorder.stop();
        mediaRecorder = null;
    };


    //$btnComenzarGrabacion.addEventListener("click", comenzarAGrabar);
    //$btnDetenerGrabacion.addEventListener("click", detenerGrabacion);

   

    // Cuando ya hemos configurado lo necesario allá arriba llenamos la lista

    llenarLista();
    
})

