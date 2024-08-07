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

if (totint >= 5) {
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



