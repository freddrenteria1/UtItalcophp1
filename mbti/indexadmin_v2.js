server = 'https://utitalco.com/mbti/server/'

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

datos = []
perfiles = []


buscarDatos()

function buscarDatos(){
     
    $.post(server+'buscarDatosTodos.php',{},
    function(resp){
        console.log(resp)

        datos = resp.pruebas
        perfiles = resp.perfiles

        var html = ''

        for(var i=0; i<datos.length; i++){
            html += `
            <tr>
                <td>${datos[i].fecha_e}</td>
                <td>${datos[i].nombre}</td>
                <td>${datos[i].doc}</td>
                <td>${datos[i].fecha_n}</td>
                <td>${datos[i].edad}</td>
                <td>${datos[i].cargo}</td>
                <td>${datos[i].link}</td>
                <td><button class="btn btn-info" onclick="ver(${i})">Ver</button></td>
            </tr>
            `
        }

        $('#datosTabla').html(html)

        $('#tblData').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });

        
    })
}

function  ver(e){

    var datosuser = []

    localStorage.setItem('arrayRespP1',datos[e].parte1)
    localStorage.setItem('arrayRespP2',datos[e].parte2)
    localStorage.setItem('arrayRespP3',datos[e].parte3)
    localStorage.setItem('arrayRespP4',datos[e].parte4)

    datosuser.push({
        'fecha':datos[e].fecha_e,
        'nombre':datos[e].nombre,
        'doc':datos[e].doc,
        'fecha_n':datos[e].fecha_n,
        'edad':datos[e].edad,
        'cargo':datos[e].cargo,
        'foto':datos[e].foto
    });

    localStorage.setItem('datosuser',JSON.stringify(datosuser))
    localStorage.setItem('perfiles',JSON.stringify(perfiles))

    
     
    location = 'final.html'
}

var datosListado = []

function subir(){

    var file = $('#archivo')[0].files[0];

    var formData = new FormData();

    formData.append('adjunto', file);

    $.ajax({
        url: server + 'guardarFile.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response.msn)
            if(response.msn == 'Ok'){

                datosListado = response.listado;

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Personal cargado correctamente, se van a enviar los correos masivos, un momento por favor...',
                    showConfirmButton: true
                }).then(() => {
                    enviarMasivos()
                })
            }
        }
    })

}

function enviarMasivos(){
    var url = "https://jcsistemas.online/server/"
    console.log(datosListado)
    $.post(url+'enviarEmail.php',{lista:datosListado},
        function(resp){
            console.log('resp'+resp)
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Correos enviados...',
                showConfirmButton: true
            }).then(() => {
                console.log('Respuesta jc')
                console.log(resp)
                //location.reload()
            })
        }
    )
}