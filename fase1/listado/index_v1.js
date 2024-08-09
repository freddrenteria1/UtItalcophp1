var url = "https://utitalco.com/fase1/server/";

var arrayDatos = []

cargarDatos()

function cargarDatos() {

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
                        <td>${arrayDatos[i].fecha}</td>
                        <td>${arrayDatos[i].puntaje}</td>
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
        }
    );


}

function subir() {

    var file = document.getElementById('listado').files[0]

    let formData = new FormData();
    formData.append('listado', file);

    $.ajax({
        url: url + 'guardarExcelPersonal.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'success',
                title: '¡Importado!',
                text: 'Personal importado...'
            })

            location.reload()

        }
    })


}