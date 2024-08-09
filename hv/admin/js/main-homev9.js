const API = "https://utitalco.com/hv/server/";

var arrayDatos = []
var arrayPerfil = []
var arrayDatosPersonales = []

cargando()
cargarDatos()

function cargarDatos() {

        $.post(API+"cargarDatosPersonal.php",{},
        function(resp){

            console.log(resp)

            arrayDatos = resp
            

            var html = ''

            for(var i=0; i<arrayDatos.length; i++){
                html += `
                <tr>

                                    
                                    <td>${arrayDatos[i].nombres}</td>
                                    <td>${arrayDatos[i].doc}</td>
                                    <td>${arrayDatos[i].nacimiento}</td>
                                    <td>${arrayDatos[i].tel}</td>
                                    <td>`
                                         
                                        if(arrayDatos[i].datospersonales != null){
                                            html += `${arrayDatos[i].datospersonales.sexo}`
                                        }
                                        
                                    html += `
                                    </td>
                                    <td>`

                                    if(arrayDatos[i].perfil != null){
                                        html += `${arrayDatos[i].perfil.perfil.replace(/[æ]/gm, '\n')}`
                                    }

                                    html += `   
                                    </td>

                                    <td>`

                                    if(arrayDatos[i].datospersonales != null){
                                        html += `${arrayDatos[i].datospersonales.cargoasp}`
                                    }

                                    html += `  
                                    </td>

                                    <td>`

                                    if(arrayDatos[i].datospersonales != null){
                                        html += `${arrayDatos[i].datospersonales.postulado}`
                                    }

                                    html += `  
                                    </td>

                                    <td>`

                                    if(arrayDatos[i].datospersonales != null){
                                        html += `${arrayDatos[i].datospersonales.emergencia}`
                                    }

                                    html += `  
                                    </td>

                                    <td>`

                                    if(arrayDatos[i].datospersonales != null){
                                        html += `${arrayDatos[i].datospersonales.numemergencia}`
                                    }

                                    html += `  
                                    </td>

                                    

                                    <td>

                                        <button type="button" class="btn btn-info" onclick="abrirArchivo(${arrayDatos[i].doc})">
                                            <span class="material-symbols-outlined">
                                                file_open
                                            </span>
                                        </button>

                                    </td>
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
    
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    showConfirmButton: false,
                    width: 300,
                    timer: 500,
                })

            //this.cargarInfo(resp)
                 

        })
 
}

function abrirArchivo(e){
    console.log('open')
    console.log(e)
    sessionStorage.setItem('docuser', e)
    location = 'hojadevida.html';
}

function cerrar(){
    sessionStorage.clear()
    location = '../index.html'
}

function cargando() {
    let timerInterval
    Swal.fire({
        title: 'Procesando datos...!',
        timer: 20000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
                // b.textContent = Swal.getTimerLeft()
            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
        }
    })
}



