var server = 'https://utitalco.com/hse/bitacora/server/';
var url = 'https://utitalco.com/server/';



function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

var datos = JSON.parse(localStorage.getItem('datos'))
var fecharep = localStorage.getItem('fechabit')

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
$('#ods').val(datos[0].ods)
$('#fecha').val(fecharep)

var ods = datos[0].ods;
var doc = datos[0].doc;

var editor1 = CKEDITOR.replace('editor1');
var editor2 = CKEDITOR.replace('editor2');

document.addEventListener("DOMContentLoaded", function (event) {
    //FUNCION
    console.log('Contenido cargado')
    cargarDatos()
    cargarDatosBitacora()
});

function cargando() {
    let timerInterval
    Swal.fire({
        title: 'Guardando test!',
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

function cargarBita(){

    var arrayInfo = JSON.parse(sessionStorage.getItem('arryInfo'))
    console.log('Array info')
    console.log(arrayInfo)
    if(arrayInfo != null){
        $('#nombres').val(arrayInfo[0].nombres)
        $('#doc').val(arrayInfo[0].doc)
        $('#fecha').val(arrayInfo[0].fecha)
        $('#turno').val(arrayInfo[0].turno)
        $('#pdir').val(arrayInfo[0].pdir)
        $('#pindir').val(arrayInfo[0].pindir)
        $('#permiso').val(arrayInfo[0].permiso)
        $('#aspectos').text(arrayInfo[0].aspectos)
        $('#novedades').text(arrayInfo[0].novedades)
        
        var arrayEquipos = arrayInfo[0].equipos

        console.log('equipos ', arrayEquipos)


        for (var i=0; i<arrayEquipos.length; i++){
            if(arrayEquipos[i].equipo=='Avantel'){
                alert(arrayEquipos[i].equipo)
                $('#avantel').checked = true
            }
            if(arrayEquipos[i].equipo=='Cámara'){
                $('#camara').checked = true
            }
            if(arrayEquipos[i].equipo=='PC'){
                $('#pc').checked = true
            }
            if(arrayEquipos[i].equipo=='Monitor Gas'){
                $('#monitorgas').checked = true
            }

            if(arrayEquipos[i].equipo=='Equipo de rescate'){
                $('#equiporesc').checked = true
            }

            if(arrayEquipos[i].equipo=='Equipo Autocontenido'){
                $('#equipoauto').checked = true
            }

            if(arrayEquipos[i].equipo=='Extintor'){
                $('#extintor').checked = true
            }

            if(arrayEquipos[i].equipo=='Línea de vida retractil'){
                $('#lineavida').checked = true
            }

            if(arrayEquipos[i].equipo=='Línea de vida fija'){
                $('#lineavidafija').checked = true
            }

            if(arrayEquipos[i].equipo=='Camilla Fel'){
                $('#camillafel').checked = true
            }

            if(arrayEquipos[i].equipo=='Camilla Sked'){
                $('#camillasked').checked = true
            }

            if(arrayEquipos[i].equipo=='Botiquín'){
                $('#botiquin').checked = true
            }

             


        }


    }
}


function cargarDatos() {
    //se guarda la información a la base de datos
    //para luego ser procesada en el informe



    $.post(url + 'buscarFotosRepGen.php', {
            fecha: fecharep,
            ods: ods
        },
        function (resp) {

            arrayDatos = resp

            var html = '';

            if (arrayDatos != null) {

                for (var i = 0; i < arrayDatos.length; i++) {
                    html += `
                    <div class="fotos">
                        <img src="${url + arrayDatos[i].foto}" width="100%" >
                        <div class="piefoto">
                            ${arrayDatos[i].detalles}
                         </div>
                         <div class="piefotoods">
                            ${arrayDatos[i].ods}
                         </div>
                        
                        <div class="btnedit" onclick="edit(${i})">E
                        </div>
                    </div>
                `
                }

            }

            $('#galeria').html(html)

            //cargarDatosBitacora()


        })

}

function cargarDatosBitacora() {
    //se guarda la información a la base de datos
    //para luego ser procesada en el informe



    $.post(server + 'cargarBitacoraInd.php', {
            fecha: fecharep,
            ods: ods,
            doc: doc
        },
        function (resp) {

            var arrayDatos = resp

            

            if (arrayDatos != null) {
                $('#turno').val(arrayDatos.turno)
                $('#pdir').val(arrayDatos.pdir)
                $('#pindir').val(arrayDatos.pindir)
                $('#permiso').val(arrayDatos.permiso)
                editor1.setData(arrayDatos.aspectos)
                editor2.setData(arrayDatos.novedades)

            }else{
                //cargarBita()
            }

        })

}


function guardar() {


    cargando2()

    var nombres = $('#nombres').val()
    var doc = $('#doc').val()
    var fecha = $('#fecha').val()
    var turno = $('#turno').val()
    var pdir = $('#pdir').val()
    var pindir = $('#pindir').val()
    var permiso = $('#permiso').val()
   var aspectos = editor1.getData();
    var novedades = editor2.getData();
    var equipos =  [];

    if ($('#avantel').prop('checked')) {
        equipos.push({
            'equipo':'Avantel'
        })
    }
    if ($('#camara').prop('checked')) {
        equipos.push({
            'equipo':'Cámara'
        })
    }

    if ($('#pc').prop('checked')) {
        equipos.push({
            'equipo':'PC'
        })
    }
    if ($('#monitorgas').prop('checked')) {
        equipos.push({
            'equipo':'Monitor Gas'
        })
    }

    if ($('#equiporesc').prop('checked')) {
        equipos.push({
            'equipo':'Equipo de rescate'
        })
    }

    if ($('#equipoauto').prop('checked')) {
        equipos.push({
            'equipo':'Equipo Autocontenido'
        })
    }

    if ($('#extintor').prop('checked')) {
        equipos.push({
            'equipo':'Extintor'
        })
    }

    if ($('#lineavida').prop('checked')) {
        equipos.push({
            'equipo':'Línea de vida retractil'
        })
    }

    if ($('#lineavidafija').prop('checked')) {
        equipos.push({
            'equipo':'Línea de vida fija'
        })
    }

    if ($('#camillafel').prop('checked')) {
        equipos.push({
            'equipo':'Camilla Fel'
        })
    }

    if ($('#camillasked').prop('checked')) {
        equipos.push({
            'equipo':'Camilla Sked'
        })
    }

    if ($('#botiquin').prop('checked')) {
        equipos.push({
            'equipo':'Botiquín'
        })
    }

    var arrayInfo = []

    arrayInfo.push({
        'nombres':nombres,
        'doc':doc,
        'fecha':fecha,
        'turno':turno,
        'pdir':pdir,
        'pindir':pindir,
        'permiso':permiso,
        'aspectos':aspectos,
        'novedades':novedades,
        'equipos':equipos,
    })

    sessionStorage.setItem('arryInfo', JSON.stringify(arrayInfo))
 

    var detalles = $('#detalles').val()
    var seccion = $('#seccion').val()

    var fecha = $('#fecha').val()

    var formData = new FormData();

    var files = $('#foto')[0].files[0];
    formData.append('foto', files);
    formData.append('ods', ods);
    formData.append('fecha', fecha);
    formData.append('detalles', detalles);
    formData.append('seccion', seccion);
    $.ajax({
        url: url + 'guardarFotoRep.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response)

            if (response.msn == "Realizado...") {
                Swal.fire({
                    icon: 'info',
                    text: 'Foto cargada...!',
                })

                cargarDatos()
                //cargarBita()

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

function registros() {
    location = 'oficina.html?ods=' + ods
}


function enviar() {

    var nombres = $('#nombres').val()
    var doc = $('#doc').val()
    var equipos = ''

    var fecha = $('#fecha').val()


    if ($('#avantel').prop('checked')) {
        equipos += ' Avantel '

    }
    if ($('#camara').prop('checked')) {
        equipos += ' Cámara '
    }

    if ($('#pc').prop('checked')) {
        equipos += ' PC '
    }
    if ($('#monitorgas').prop('checked')) {
        equipos += ' Monitor Gas '
    }

    if ($('#equiporesc').prop('checked')) {
        equipos += ' Equipo de rescate'
         
    }

    if ($('#equipoauto').prop('checked')) {
        equipos += ' Equipo Autocontenido'
         
    }

    if ($('#extintor').prop('checked')) {
        equipos += ' Extintor'
        
    }

    if ($('#lineavida').prop('checked')) {
        equipos += ' Línea de vida retractil'
         
    }

    if ($('#lineavidafija').prop('checked')) {
        equipos += ' Línea de vida fija'
         
    }

    if ($('#camillafel').prop('checked')) {
        equipos += ' Camilla Fel'
        
    }

    if ($('#camillasked').prop('checked')) {
        equipos += ' Camilla Sked'
         
    }

    if ($('#botiquin').prop('checked')) {
        equipos += ' Botiquín'
         
    }


    var turno = $('#turno').val()

    if ($('#pdir').val() != '') {
        var pdir = $('#pdir').val()
    } else {
        var pdir = 0;
    }

    if (pindir = $('#pindir').val() != '') {
        var pindir = $('#pindir').val()
    } else {
        var pindir = 0;
    }


    var aspectos = editor1.getData();
    var novedades = editor2.getData();

    var permiso = $('#permiso').val()


    if (nombres != '' && fecha != '' && turno != '') {
        cargando()

        var formData = new FormData();

        formData.append('nombres', nombres);
        formData.append('doc', doc);
        formData.append('ods', ods);
        formData.append('turno', turno);
        formData.append('fecha', fecha);
        formData.append('pdir', pdir);
        formData.append('pindir', pindir);
        formData.append('permiso', permiso);
        formData.append('equipos', equipos);
        formData.append('aspectos', aspectos);
        formData.append('novedades', novedades);



        $.ajax({
            url: server + 'guardarBitacora.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log('Respuesta de guardar bitacora')
                console.log(response)
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Correcto...',
                    showConfirmButton: false,
                    timer: 500
                })
                $('#bv').html('')
                $('#cuerpo').html(
                    '<center>Gracias por diligenciar el registro de la Bitacora, ya quedó guardado.</center>'
                )
                //location = 'oficina.html'
            }
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

function borrar(idfoto) {
    console.log('Id foto ' + idfoto)
    //borrar foto
    $.post(url + 'borrarfotorep.php', {
            id: idfoto
        },
        function (resp) {
            console.log(resp)
            cargarDatos()
        })
}

function edit(id) {
    var idfoto = arrayDatos[id].id;
    Swal.fire({
        title: 'Editar',
        html: `
                <input type="text" id="textofoto" class="form-control" value="${arrayDatos[id].detalles}">
            `,
        showCancelButton: true,
        confirmButtonText: 'Actualizar',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        var det = $('#textofoto').val()
        if (result.isConfirmed) {
            $.post(url + 'actFotoGal.php', {
                    id: idfoto,
                    det: det
                },
                function (resp) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Actualizado...',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        cargarDatos()
                    })
                })
        }
    })
}