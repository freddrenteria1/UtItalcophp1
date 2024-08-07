const API = "https://utitalco.com/hv/server/";

var arrayDatos = []
var arrayPerfil = []
var arrayDatosPersonales = []

cargando()
cargarDatos()

function cargarDatos() {

        $.post(API+"cargarDatosPersonalLista_.php",{},
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

                                    <td>${arrayDatos[i].sexo}</td>
                                    <td>${arrayDatos[i].perfil}</td>
                                    <td>`
                                    var textoedu = ''
                                    if(arrayDatos[i].niveledu != null){
                                        var nivele = arrayDatos[i].niveledu;
                                        
                                        for(var a=0; a<nivele.length; a++){
                                            textoedu += `
                                            Formación: ${nivele[a].niveleduc} - Tílulo: ${nivele[a].titulo} - Institución: ${nivele[a].institucion}  <br>
                                            `
                                        }
                                    }
                                    
                                    html += ` ${textoedu} </td>
                                    <td>${arrayDatos[i].cargoasp}</td>
                                    <td>${arrayDatos[i].postulado}</td>
                                    <td>${arrayDatos[i].emergencia}</td>
                                    <td>${arrayDatos[i].numemergencia}</td>`
                                    

 
                                     

                                    html += `  
                                    

                                    

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



