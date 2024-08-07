


var server = 'https://utitalco.com/evaluaciones/evalper/'

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

window.onload = function () {
    var fecha = new Date(); //Fecha actual
    var mes = fecha.getMonth() + 1; //obteniendo mes
    var dia = fecha.getDate(); //obteniendo dia
    var ano = fecha.getFullYear(); //obteniendo año
    if (dia < 10)
        dia = '0' + dia; //agrega cero si el menor de 10
    if (mes < 10)
        mes = '0' + mes //agrega cero si el menor de 10
    document.getElementById('desde').value = ano + "-" + mes + "-" + dia;
    document.getElementById('hasta').value = ano + "-" + mes + "-" + dia;
}

//se verifica el usuario
var nombres = ''
var cargo = ''

var evaluador = ''
var cargoeval = ''

var myArr = []
var valor = 0;

var p1 = 0;
var p2 = 0
var p3 = 0
var p4 = 0
var p5 = 0
var p6 = 0
var p7 = 0
var p8 = 0
var p9 = 0
var p10 = 0
var p11 = 0
var p12a = 0
var p12b = 0
var p13 = 0
var p14 = 0


var arrayPrg = []
var sum = 0
var prom = 0


var user = sessionStorage.getItem('user');

if (user == null) {
    location = 'login.html';
} else {
    evaluador = sessionStorage.getItem('nombres')
    cargoeval = sessionStorage.getItem('cargo')

    $('#nombreeval').val(evaluador)
    $('#cargoeval').val(cargoeval)
}

function removeItemFromArr(arr, item) {
    var i = arr.indexOf(item);

    if (i !== -1) {
        arr.splice(i, 1);
    }
}

function buscarCed(e){
    var cedb = e.value;

    $.post(server+'buscarced.php', {ced:cedb},
    function(resp){
        if(resp.msn != 'Ok'){
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Cédula no está registrada en la base de datos, por favor verificar...',
                showConfirmButton: false,
                timer: 1500
            }).then(()=>{
                $('#doc').val('')
                $('#doc').focus()
                $('#nombres').val('')
                $('#cargo').val('')
                $('#ods').val('')
            })
        }else{
            $('#nombres').val(resp.nombres)
            $('#cargo').val(resp.cargo)
            $('#ods').val(resp.ods)
             
        }
    })
}



$("input[type='radio']").change(function () {

    valor = $(this).val()

    removeItemFromArr(arrayPrg, valor);

    myArr = valor.split("-");
    sum += parseInt(myArr[3])
    arrayPrg.push(valor)

    var numpg = myArr[1];

    if (numpg == "1") {
        p1 = parseInt(myArr[3])
    }
    if (numpg == "2") {
        p2 = parseInt(myArr[3])
    }
    if (numpg == "3") {
        p3 = parseInt(myArr[3])
    }
    if (numpg == "4") {
        p4 = parseInt(myArr[3])
    }
    if (numpg == "5") {
        p5 = parseInt(myArr[3])
    }
    if (numpg == "6") {
        p6 = parseInt(myArr[3])
    }
    if (numpg == "7") {
        p7 = parseInt(myArr[3])
    }
    if (numpg == "8") {
        p8 = parseInt(myArr[3])
    }
    if (numpg == "9") {
        p9 = parseInt(myArr[3])
    }
    if (numpg == "10") {
        p10 = parseInt(myArr[3])
    }
    if (numpg == "11") {
        p11 = parseInt(myArr[3])
    }
    if (numpg == "12a") {
        p12a = parseInt(myArr[3])
    }
    if (numpg == "12b") {
        p12b = parseInt(myArr[3])
    }
    if (numpg == "13") {
        p13 = parseInt(myArr[3])
    }
    if (numpg == "14") {
        p14 = parseInt(myArr[3])
    }

    promedio()

});

function promedio() {

    prom = (p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9 + p10 + p11 + p12a + p12b + p13 + p14) / 15;
    prom = Number(prom.toFixed(2));

}



function enviar() {

    var nombres = $('#nombres').val()
    var doc = $('#doc').val()
    var cargo = $('#cargo').val()
    var ods = $('#ods').val()
    var pinicial = $('#desde').val()
    var pfinal = $('#hasta').val()
    var observaciones = $('#observaciones').val()
    var planes = $('#planes').val()
    var compromisos = $('#compromisos').val()

    if (ods == '') {
        Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'Por favor seleccione una ODS',
            showConfirmButton: false,
            timer: 1500
        })
    } else {
        if (pinicial == pfinal) {
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Por favor registre correctamente el período a evaluar',
                showConfirmButton: false,
                timer: 1500
            })
        } else {



            if (nombres != '' && doc != '' && cargo != '' && p1 != 0 && p2 != 0 && p3 != 0 && p4 != 0 && p5 != 0 && p6 != 0 && p7 != 0 && p8 != 0 && p9 != 0 && p10 != 0 && p11 != 0 && p12a != 0 && p12b != 0 && p13 != 0 && p14 != 0) {




                $.post(server + 'guardarEval.php', {
                    evaluador: evaluador,
                    cargoeval: cargoeval,
                    pinicial: pinicial,
                    pfinal: pfinal,
                    observaciones: observaciones,
                    planes: planes,
                    compromisos: compromisos,
                    nombres: nombres,
                    doc: doc,
                    cargo: cargo,
                    ods: ods,
                    p1: p1,
                    p2: p2,
                    p3: p3,
                    p4: p4,
                    p5: p5,
                    p6: p6,
                    p7: p7,
                    p8: p8,
                    p9: p9,
                    p10: p10,
                    p11: p11,
                    p12a: p12a,
                    p12b: p12b,
                    p13: p13,
                    p14: p14,
                    prom: prom
                },
                    function (resp) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'info',
                            title: 'Correcto...',
                            showConfirmButton: false,
                            timer: 500
                        })
                        $('#bv').html('')
                        $('#cuerpo').html('<center>Evaluación registrada de forma correcta. <button typye="button" class="btn btn-success" onclick="reiniciar()">Realizar otra evaluación</button> </center>')
                    })

            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Por favor registre todos los datos',
                    showConfirmButton: false,
                    timer: 1500
                })
            }

        }
    }


}

function reiniciar() {
    location.reload()
}
