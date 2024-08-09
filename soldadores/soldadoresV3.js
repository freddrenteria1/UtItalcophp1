var server = 'https://utitalco.com/soldadores/server/';
var url = 'https://utitalco.com/soldadores/server/';



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

$('#nombres').val(datos.nombres)
$('#doc').val(datos.doc)

var doc = datos[0].doc;


 ;

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

 
function llenarmetal(){
    var tipo1 = $('#tipo1').val()

    var html = '<option value="">Seleccione...</option>';

    if(tipo1=='GTAW'){
        html += '<option value="CS">CS</option>';
        html += '<option value="CR5%">CR5%</option>';
        html += '<option value="SS316">SS316</option>';
    }

    if(tipo1=='GMAW'){
        html += '<option value="CS">CS</option>';
    }
    if(tipo1=='SMAW'){
        html += '<option value="CS">CS</option>';
    }
    if(tipo1=='MIXTO'){
        html += '<option value="CS">CS</option>';
        html += '<option value="CR5%">CR5%</option>';
        html += '<option value="SS316">SS316</option>';
    }
    $('#metal').html(html)
}

function buscarHoras() {
    //se guarda la información a la base de datos
    //para luego ser procesada en el informe

    
    var fecha = $('#fecha').val()

    $.post(url + 'buscarHoras.php', {
            fecha: fecha
        },
        function (resp) {

            arrayDatos = resp

            var html = '<option value="">Seleccione una hora</option>';

            if (arrayDatos != null) {

                for (var i = 0; i < arrayDatos.length; i++) {
                    html += `
                    <option value="${arrayDatos[i].hora}">${arrayDatos[i].hora}</option>
                `
                }

            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No hay cupos para esta fecha...!',
                })
            }

            $('#hora').html(html)

            


        })

}

 

function guardar() {


    var nombres = $('#nombres').val()
    var doc = $('#doc').val()
    var fecha = $('#fecha').val()
    var hora = $('#hora').val()
    var tipo1 = $('#tipo1').val()
    var tipo2 = $('#tipo2').val()
    var metal = $('#metal').val()

    if(nombres != "" && doc != "" && fecha != "" && hora != "" && tipo1 != "" && metal != ""){

        cargando()

        var formData = new FormData();
    
        formData.append('nombres', nombres);
        formData.append('doc', doc);
        formData.append('fecha', fecha);
        formData.append('hora', hora);
        formData.append('tipo1', tipo1);
        formData.append('tipo2', tipo2);
        formData.append('metal', metal);

        localStorage.setItem('fecha', fecha)
        localStorage.setItem('hora',hora)

        $.ajax({
            url: url + 'guardarSoldador.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response)

                if (response.msn == "Ok") {
                    Swal.fire({
                        icon: 'info',
                        text: 'Cita creada por favor presentarse ...!',
                    })

                    salir()
                    //cargarBita()

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error en el registro...!',
                    })
                }
            }
        });

    }else{
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Debe registrar los campos...!',
        })
    }
     

    
}

function salir() {
    location = 'salir.html'
} 