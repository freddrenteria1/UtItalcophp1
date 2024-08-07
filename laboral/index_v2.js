var url = "https://utitalco.com/laboral/server/";

var arrayDatos = []

cargarDatos()

function cargarDatos() {

    cargandoP()

    

    $.post(
        url + "personal.php", {

        },
        function (resp) {
            arrayDatos = resp

         

            var html = ''

            for (var i = 0; i < arrayDatos.length; i++) {
                html += `
                    <tr>
                        <td>${arrayDatos[i].cedula}</td>
                        <td>${arrayDatos[i].nombres}</td>
                        <td>${arrayDatos[i].ods}</td>
                        <td>${arrayDatos[i].cargo}</td>
                        <td>${arrayDatos[i].finicio}</td>
                        <td>${arrayDatos[i].ffinal}</td>
                        <td>
                            <button class="btn btn-success" onclick="certificado(${arrayDatos[i].cedula})">C</button>
                            <button class="btn btn-danger" onclick="final(${arrayDatos[i].id})">F</button>
                        </td>
                    </tr>
                `
            }
            $('#tabla').html(html)

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
              Swal.close()

              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
            });
            Toast.fire({
                icon: 'success',
                title: '¡Importado!',
                text: 'Personal importado...'
            })

        }
    );


}

function certificado(ced){
    window.open('lib/certificados/certificadolab.html?doc='+ced, '_blank'); 
}

function subir() {

    cargando()

    var file = document.getElementById('listado').files[0]

    let formData = new FormData();
    formData.append('listado', file);

    console.log('Archivo: '+file)

    $.ajax({
        url: url + 'guardarExcelPersonal.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {

            if(response.msn == 'Ok'){
                
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000
                });
                Toast.fire({
                    icon: 'success',
                    title: '¡Importado!',
                    text: 'Personal importado...'
                })
    
                location.reload()

            }else{
                console.log(response.msn)
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000
                });
                Toast.fire({
                    icon: 'info',
                    title: '¡No Importado!',
                    text: 'Error en archivo...'
                })
            }


        }
    })


}

function cargando(){
    let timerInterval;
    Swal.fire({
    title: "Subiendo archivo plano!",
    timer: 300000,
    timerProgressBar: true,
    didOpen: () => {
        Swal.showLoading();
        
    },
    willClose: () => {
        clearInterval(timerInterval);
    }
    }).then((result) => {
    /* Read more about handling dismissals below */
    if (result.dismiss === Swal.DismissReason.timer) {
        console.log("I was closed by the timer");
    }
});
}

function cargandoP(){
    let timerInterval;
    Swal.fire({
    title: "Cargando Personal!",
    timer: 120000,
    timerProgressBar: true,
    didOpen: () => {
        Swal.showLoading();
        
    },
    willClose: () => {
        clearInterval(timerInterval);
    }
    }).then((result) => {
    /* Read more about handling dismissals below */
    if (result.dismiss === Swal.DismissReason.timer) {
        console.log("I was closed by the timer");
    }
});
}