var url = "https://utitalco.com/mct/server/";

var userfase = sessionStorage.getItem("userfase");
var nombres = sessionStorage.getItem("nombres");

var numpag = 1;
var arrayDatos = [];
var arrayResp = [];
var arr = []; // Arreglo para llenar
var cont = 0;
var respsel = null
var puntaje = 0;

var contpreg = 0;

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
         
        location = 'home.html'
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

function numaleatoriosmct() {

    var lista = [0,1,2,3,4];
    arr = lista.sort(function() {return Math.random() - 0.5});
    console.log(arr);  
}

function numaleatoriosar() {

    var lista = [5,6,7,8,9];
    arr = lista.sort(function() {return Math.random() - 0.5});
    console.log(arr);  
}

function cargarPreguntas() {
    $.post(url + "preguntas.php", {}, function (resp) {
        arrayDatos = resp;
        numaleatoriosmct()
        cargarPregunta()

        //console.log(arr[2])


        // for (var i = 0; i < arrayDatos.length; i++) {
        //     arrayResp = JSON.parse(arrayDatos[i].respuestas);
        //     console.log(arrayResp);
        // }
    });
}

function cargarPregunta() {
    if(contpreg == 5){
 
        $('#titulo').html('ANÁLISIS DE RIESGOS')

        numaleatoriosar()
        cont=0;

        console.log(cont)
        contpreg++;
        console.log(contpreg)

        nump = arr[cont]
        console.log('Numero pregunta index ' + nump)

        preg = arrayDatos[nump].pregunta
        $('#pregunta').html(preg)

        arrayResp = JSON.parse(arrayDatos[nump].respuestas);
        var html = ''
        for (var i = 0; i < arrayResp.length; i++) {
            html += `
            <div class="resp">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="resp" id="resp${i}" onchange="selresp('${arrayResp[i].p}')">
                <label class="form-check-label" for="flexRadioDefault1">
                    ${arrayResp[i].p}
                </label>
            </div>
            </div>
            `
        }
        $('#respuestas').html(html)
         
    } else {
        
        contpreg++;

        nump = arr[cont]

        console.log('Numero pregunta index ' + nump)

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
        

}

function selresp(a) {
    respsel = a;
    if (respsel == arrayDatos[nump].correcta) {
        puntaje += 10;
    }
    console.log('Puntaje: ' + puntaje)

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
    if (contpreg < 10) {
        cargarPregunta()
        $('#pag').html('Pregunta: ' + contpreg + '/10')

    } else {
        if (puntaje == 100) {
            localStorage.setItem('preguntas', JSON.stringify(listaPreg))
            localStorage.setItem('puntaje', puntaje)

            $.post(url + 'guardarCertificado.php', {doc:userfase,nombres:nombres,resp:JSON.stringify(listaPreg),puntaje:puntaje},
            function(resp){
                localStorage.setItem('datosuser',JSON.stringify(resp))
                if(puntaje==100){
                    sessionStorage.setItem('estado','SI')
                }else{
                    sessionStorage.setItem('estado','NO')
                }

                Swal.fire({
                    position: "top-end",
                    icon: "info",
                    text: "Evaluación aprobada...!",
                    showConfirmButton: false,
                    timer: 3500,
                }).then(() => {
    
                    location = 'home.html';
                })

                
            })

        } else {
            Swal.fire({
                position: "top-end",
                icon: "info",
                text: "Para superar la evaluación debe responder correctamente las 10 preguntas.  Tiene 2 intentos al día para presentar la evaluación...!",
                showConfirmButton: false,
                timer: 3500,
            }).then(() => {

                if (localStorage.getItem('intentos')) {
                    var totint = parseInt(localStorage.getItem('intentos')) + 1
                } else {
                    var totint = 1
                }


                localStorage.setItem('intentos', totint);
                location = 'home.html'
            })
        }
    }
    if (cont > 8) {
        $('#btnsig').html('Finalizar')
    }
}