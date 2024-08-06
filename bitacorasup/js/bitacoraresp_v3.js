var server = 'https://utitalco.com/bitacorasup/server/';
var url = 'https://utitalco.com/server/';
var serverP = "https://utitalco.com/031/server/";



function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

var datos = JSON.parse(localStorage.getItem('datosbitacora'))


var frente = datos[0].frente
var numsem = datos[0].numsem

var numom = null
var numop = null
var alcance  = null
var actividades = null

var galeria = []
var respuestas = []

var arrayOp = null

$('#frente').val(frente)
$('#nombres').val(datos[0].supervisor)
$('#doc').val(datos[0].doc)
$('#fecha').val(datos[0].fecha)

$('#numom').val(datos[0].om)



var arrayDatosOP = JSON.parse(datos[0].op)

var tablaOP = `
<table class="table table-striped">
    <thead>
        <th>OM</th>
        <th>OP</th>
        <th>Unidad</th>
        <th>Actividad</th>
        <th>Estado</th>
        <th># Pers.</th>
    </thead>
<tbody>
`

for(var a=0; a<arrayDatosOP.length; a++){
    tablaOP += `
    <tr>
        <td>${arrayDatosOP[a].NUMOM}</td>
        <td>${arrayDatosOP[a].OP}</td>
        <td>${arrayDatosOP[a].UNIDAD}</td>
        <td>${arrayDatosOP[a].ACTIVIDADES}</td>
        <td>${arrayDatosOP[a].ESTADO}</td>
        <td>${arrayDatosOP[a].NUMP}</td>
            
    </tr>
    `
}

tablaOP += `
</tbody>
</table>
`

$('#datosOP').html(tablaOP)



$('#alcance').val(datos[0].alcance)
$('#actividades').val(datos[0].actividades)
$('#estado').val(datos[0].estado)

$('#turno').val(datos[0].turno)

var respuestas = JSON.parse(datos[0].preguntas);

$('#permiso').html(respuestas[0].permiso)
$('#analisisr').html(respuestas[1].analisisriesgo)
$('#procesp').html(respuestas[2].procesp)
$('#procresc').html(respuestas[3].procresc)
$('#certapoy').html(respuestas[4].certapoyo)
$('#preope').html(respuestas[5].preop)

$('#pg2').html(respuestas[6].pg2)

$('#docnocumple').html(respuestas[7].docnocumple)

$('#aspectoshse').html(respuestas[8].aspectohse)

if(respuestas[8].aspectohse == "Sí, aspectos positivos"){
    $('#eventopos').removeClass('oculto')
    $('#asphsepositivo').html(respuestas[9].asphsepositivo)
}

if(respuestas[8].aspectohse == "Sí, eventos NO deseados"){
    $('#notaeventonod').removeClass('oculto')
    $('#evento').html(respuestas[10].evento)
    $('#eventohsedetalle').html(respuestas[11].eventohsedetalle)
}

$('#interrupcion').html(respuestas[12].interrupcion)

if(respuestas[12].interrupcion == "SI"){
    $('#causaint').removeClass('oculto')
    $('#interrupcioncausa').html(respuestas[13].interrupcioncausa)
    $('#tiempoint').html(respuestas[14].tiempoint)
    $('#causasint').html(respuestas[15].causasint)
}

$('#reproceso').html(respuestas[16].reproceso)

if(respuestas[16].reproceso == 'SI'){
    $('#causades').removeClass('oculto')
    $('#reprocesoclase').html(respuestas[17].reprocesoclase)
    $('#detareproceso').html(respuestas[18].detareproceso)
}


galeria = JSON.parse(datos[0].galeria)

console.log(galeria)

if(galeria.length != 0){


    var html = ''

    for (var i = 0; i < galeria.length; i++) {
        html += `
        <div class="fotos">
            <img src="${server + galeria[i].foto}" width="100%" >
            <div class="piefoto">
                ${galeria[i].det}
             </div>
              
            
            
        </div>
    `
    }

    $('#galeria').html(html)
}



//cargarListaOM()

function cargarListaOM(){
    $.post(serverP+'listasOMFrente.php', {semana:numsem, frente:frente},
        function(resp){
            console.log('resp bd: ')
            console.log(resp)
            arrayDatosFrentes = resp

            var html = '<option value="">Seleccione OM</option>'

            for(var i=0; i<arrayDatosFrentes.length; i++){
                html += `<option value="${arrayDatosFrentes[i].numom}">${arrayDatosFrentes[i].numom}</option>`
            }

            $('#numom').html(html)

        })
}

function cargarOP(){

    numom = $('#numom').val()
    $('#alcance').val('')
    $('#actividades').val('')

    $.post(serverP+'verFilesOM.php',{semana:numsem, frente:frente, om:numom},
        function(resp){
            console.log('resp bd: ')
            console.log(resp)
            
            arrayOp = resp.op

            var html = '<option value="">Seleccione OP</option>'

            for(var i=0; i<arrayOp.length; i++){
                html += `<option value="${arrayOp[i].op}">${arrayOp[i].op}</option>`
            }

            $('#numop').html(html)

        })
}

function cargarAlcance(){

    numop = $('#numop').val()

    for(var i=0; i<arrayOp.length; i++){
        if(arrayOp[i].op == numop){
            alcance = arrayOp[i].alcance
            actividades = arrayOp[i].actividades
        }
    }

    $('#alcance').val(alcance)
    $('#actividades').val(actividades)



}

// var editor1 = CKEDITOR.replace('editor1');
// var editor2 = CKEDITOR.replace('editor2');

// document.addEventListener("DOMContentLoaded", function (event) {
//     //FUNCION
//     console.log('Contenido cargado')
//     cargarDatos()
//     cargarDatosBitacora()
// });

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



function guardar() {


    cargando()


    var nombres = $('#nombres').val()
    var doc = $('#doc').val()
    var fecha = $('#fecha').val()
    var turno = $('#turno').val()

    var frente = $('#frente').val()
    var numom = $('#numom').val()
    var numop = $('#numop').val()
    var alcance = $('#alcance').val()
    var actividades = $('#actividades').val()
    var estado = $('#estado').val()

    var personas = $('#pdir').val()

   
    

    if ($('#permisot1').prop('checked')) {
        var permiso = 'SI'
    }

    if ($('#permisot2').prop('checked')) {
        var permiso = 'NO'
    }

    if ($('#permisot3').prop('checked')) {
        var permiso = 'NA'
    }

    respuestas.push({
        'permiso':permiso
    })


    if ($('#ariesgos1').prop('checked')) {
        var analisisriesgo = 'SI'
    }

    if ($('#ariesgos2').prop('checked')) {
        var analisisriesgo = 'NO'
    }

    if ($('#ariesgos3').prop('checked')) {
        var analisisriesgo = 'NA'
    }

    respuestas.push({
        'analisisriesgo':analisisriesgo
    })

    if ($('#procesp1').prop('checked')) {
        var procesp = 'SI'
    }

    if ($('#procesp2').prop('checked')) {
        var procesp = 'NO'
    }

    if ($('#procesp3').prop('checked')) {
        var procesp = 'NA'
    }

    respuestas.push({
        'procesp':procesp
    })


    if ($('#procresc1').prop('checked')) {
        var procresc = 'SI'
    }

    if ($('#procresc2').prop('checked')) {
        var procresc = 'NO'
    }

    if ($('#procresc3').prop('checked')) {
        var procresc = 'NA'
    }

    respuestas.push({
        'procresc':procresc
    })



    if ($('#certapoyo1').prop('checked')) {
        var certapoyo = 'SI'
    }

    if ($('#certapoyo2').prop('checked')) {
        var certapoyo = 'NO'
    }

    if ($('#certapoyo3').prop('checked')) {
        var certapoyo = 'NA'
    }

    respuestas.push({
        'certapoyo':certapoyo
    })



    if ($('#preop1').prop('checked')) {
        var preop = 'SI'
    }

    if ($('#preop2').prop('checked')) {
        var preop = 'NO'
    }

    if ($('#preop3').prop('checked')) {
        var preop = 'NA'
    }

    respuestas.push({
        'preop':preop
    })


    if ($('#pg2-1').prop('checked')) {
        respuestas.push({
            'pg2':'SI'
        })
    }

    if ($('#pg2-2').prop('checked')) {
        respuestas.push({
            'pg2':'NO'
        })
    }

         
    respuestas.push({
        'docnocumple':$('#docnocumple').val()
    })

    if ($('#pg3-1').prop('checked')) {
        respuestas.push({
            'aspectohse':'Sí, aspectos positivos'
        })
    }

    if ($('#pg3-2').prop('checked')) {
        respuestas.push({
            'aspectohse':'Sí, eventos NO deseados'
        })
    }

    if ($('#pg3-3').prop('checked')) {
        respuestas.push({
            'aspectohse':'No'
        })
    }

    respuestas.push({
        'asphsepositivo':$('#asphsepositivo').val()
    })

    
    if ($('#pg4-1').prop('checked')) {
        respuestas.push({
            'evento':'Casi Accidente'
        })
    }

    if ($('#pg4-2').prop('checked')) {
        respuestas.push({
            'evento':'Condición insegura'
        })
    }

    if ($('#pg4-3').prop('checked')) {
        respuestas.push({
            'evento':'Acto inseguro'
        })
    }

    if ($('#pg4-4').prop('checked')) {
        respuestas.push({
            'evento':'Incidente'
        })
    }

    if ($('#pg4-5').prop('checked')) {
        respuestas.push({
            'evento':'Accidente'
        })
    }

    if ($('#pg4-6').prop('checked')) {
        respuestas.push({
            'evento':'Otras'
        })
    }

    respuestas.push({
        'eventohsedetalle':$('#eventohsedetalle').val()
    })


    if ($('#pg5-1').prop('checked')) {
        respuestas.push({
            'interrupcion':'SI'
        })
    }

    if ($('#pg5-2').prop('checked')) {
        respuestas.push({
            'interrupcion':'NO'
        })
    }

    if ($('#pg6-1').prop('checked')) {
        respuestas.push({
            'interrupcioncausa':'Mitín/Sindicatos'
        })
    }
    
    if ($('#pg6-2').prop('checked')) {
        respuestas.push({
            'interrupcioncausa':'Lluvia'
        })
    }

    if ($('#pg6-3').prop('checked')) {
        respuestas.push({
            'interrupcioncausa':'Falta de herramientas'
        })
    }

    if ($('#pg6-4').prop('checked')) {
        respuestas.push({
            'interrupcioncausa':'Falta de materiales'
        })
    }

    if ($('#pg6-5').prop('checked')) {
        respuestas.push({
            'interrupcioncausa':'Falta de personal'
        })
    }

    if ($('#pg6-6').prop('checked')) {
        respuestas.push({
            'interrupcioncausa':'Interferencia con otros frentes/contratistas'
        })
    }

    if ($('#pg6-7').prop('checked')) {
        respuestas.push({
            'interrupcioncausa':'Acto/condición insegura/Aspecto HSE'
        })
    }

    if ($('#pg6-8').prop('checked')) {
        respuestas.push({
            'interrupcioncausa':'Demoras en entrega y recibo equipos (por firma permisos de trabajo, inspección CIE, recibo de equipos por operaciones/procesos/confiabilidad)'
        })
    }

    if ($('#pg6-9').prop('checked')) {
        respuestas.push({
            'interrupcioncausa':'Documentación incompleta o inexistente'
        })
    }

    if ($('#pg6-10').prop('checked')) {
        respuestas.push({
            'interrupcioncausa':'Otras'
        })
    }

    respuestas.push({
        'tiempoint':$('#tiempoint').val()
    })

    respuestas.push({
        'causasint':$('#causasint').val()
    })

    if ($('#pgdp-1').prop('checked')) {
        respuestas.push({
            'reproceso':'SI'
        })
    }

    if ($('#pgdp-2').prop('checked')) {
        respuestas.push({
            'reproceso':'NO'
        })
    }

    if ($('#pgd-1').prop('checked')) {
        respuestas.push({
            'reprocesoclase':'Repeteción del trabajo'
        })
    }

    if ($('#pgd-2').prop('checked')) {
        respuestas.push({
            'reprocesoclase':'Ejecución de actividades NO programadas en el turno o NO incluidasen en el alcalce'
        })
    }

    if ($('#pgd-3').prop('checked')) {
        respuestas.push({
            'reprocesoclase':'Desviación en la calidad'
        })
    }

    respuestas.push({
        'detareproceso':$('#detareproceso').val()
    })


    respuestas.push({
        'acteje':$('#acteje').val()
    })

    respuestas.push({
        'avanceeje':$('#avanceeje').val()
    })

    respuestas.push({
        'pendiente':$('#pendiente').val()
    })


    console.log('guardado...')

    $.post(server+'guardarReg.php', {
        nombres:nombres,
        doc:doc,
        fecha:fecha,
        turno:turno,
        frente:frente,
        numom:numom,
        numop:numop,
        alcance:alcance,
        actividades:actividades,
        estado:estado,
        personas:personas,
        respuestas: JSON.stringify(respuestas),
        galeria: JSON.stringify(galeria)
    },
    function(resp){
        console.log(resp)
        Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'Correcto...',
            showConfirmButton: false,
            timer: 500
        }).then(()=>{
            location = 'index.html'
        })
    })


    
}

function registros() {
    location = 'oficina.html?ods=' + ods
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


function mostrar(e){
    $('#eventopos').addClass("oculto");
    $('#notaeventonod').addClass("oculto");

    $('#'+e).removeClass("oculto")
    
}


function mostrarInt(e){
    $('#causaint').addClass("oculto");
    $('#'+e).removeClass("oculto")
}


function mostrarDes(e){
    $('#causades').addClass("oculto");
    $('#'+e).removeClass("oculto")
}


function subirFoto(){
    var formData = new FormData();

    var files = $('#foto')[0].files[0];
    formData.append('foto', files);

    var detfoto = $('#detfoto').val()
   
    $.ajax({
        url: server + 'guardarFotoRep.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {

            console.log(response)

            if (response.msn == "Ok") {

                Swal.fire({
                    icon: 'info',
                    text: 'Foto cargada...!',
                })

                galeria.push({
                    'foto':response.foto,
                    'det':detfoto
                })

                $('#detfoto').val('')
                $('#foto').val('')

                cargarGaleria()
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

function cargarGaleria(){

    var html = ''


    if (galeria != null) {

        for (var i = 0; i < galeria.length; i++) {
            html += `
            <div class="fotos">
                <img src="${server + galeria[i].foto}" width="100%" >
                <div class="piefoto">
                    ${galeria[i].det}
                 </div>
                  
                
                <div class="btnborrar" onclick="borrar(${i})">X
                </div>
            </div>
        `
        }

    }

    $('#galeria').html(html)

}

function borrar(idfoto) {

    // for (var i = 0, len = galeria.length; i < len; i++) {
    //     if (galeria[i].cod === coditem) {
    //         index = i;
    //         break;
    //     }
    // }

    // if (index !== -1) {
    //     galeria.splice(idfoto, 1);
    // }

    galeria.splice(idfoto, 1);

    cargarGaleria()

}