var server = 'https://utitalco.com/hse/hvarnes/server/';

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

var datos = JSON.parse(localStorage.getItem('datos'))

if (datos == null) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Sin autorización!'
    }).then(() => {
        location = 'index.html'
    })
}

$('#nombres').val(datos[0].nombres)
$('#doc').val(datos[0].doc)

var ods = datos[0].ods;
var doc = datos[0].doc;

var editor1 = CKEDITOR.replace('editor1');

document.addEventListener("DOMContentLoaded", function (event) {
    //FUNCION
    console.log('Contenido cargado')
    //cargarDatos()
});

function cargando() {
    let timerInterval
    Swal.fire({
        title: 'Guardando datos!',
        html: 'Un momento por favor...',
        timer: 40000,
        timerProgressBar: true,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
            timerInterval = setInterval(() => {

            }, 1000)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {

        }
    })

}

function cargando2() {
    let timerInterval
    Swal.fire({
        title: 'Subiendo fotografía!',
        html: 'Un momento por favor...',
        timer: 60000,
        timerProgressBar: true,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
            timerInterval = setInterval(() => {
                const content = Swal.getContent()
                if (content) {
                    const b = content.querySelector('b')
                }
            }, 1000)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {

        }
    })

}



function guardar() {

    cargando()

    var nombres = $('#nombres').val()
    var doc = $('#doc').val()
    var especialidad = $('#especialidad').val()
    var marca_a = $('#marca_a').val()
    var referencia_a = $('#referencia_a').val()
    var serie_a = $('#serie_a').val()
    var fecha_a = $('#fecha_a').val()
    var lote_a = $('#lote_a').val()
    var estado_a = $('#estado_a').val()

    var marca_e = $('#marca_e').val()
    var referencia_e = $('#referencia_e').val()
    var serie_e = $('#serie_e').val()
    var fecha_e = $('#fecha_e').val()
    var lote_e = $('#lote_e').val()
    var estado_e = $('#estado_e').val()

    var notas = editor1.getData();
    
    var formData = new FormData();

    // var files = $('#foto')[0].files[0];
    // formData.append('foto', files);

    formData.append('ods', ods);

    formData.append('nombres', nombres);
    formData.append('doc', doc);
    formData.append('ods', ods);
    formData.append('especialidad', especialidad);
    formData.append('marca_a', marca_a);
    formData.append('referencia_a', referencia_a);
    formData.append('serie_a', serie_a);
    formData.append('fecha_a', fecha_a);
    formData.append('lote_a', lote_a);
    formData.append('estado_a', estado_a);
    formData.append('marca_e', marca_e);
    formData.append('referencia_e', referencia_e);
    formData.append('serie_e', serie_e);
    formData.append('fecha_e', fecha_e);
    formData.append('lote_e', lote_e);
    formData.append('estado_e', estado_e);
    formData.append('notas', notas);
    
    $.ajax({
        url: server + 'guardarHv.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response)

            if (response.msn == "Realizado...") {
                Swal.fire({
                    icon: 'info',
                    text: 'Datos cargados...!',
                }).then(()=>{
                    location.reload()

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

function ver() {
    location = 'oficina.html?ods=' + ods
}


 