var server = 'https://utitalco.com/alimentacion/server/';

function cargando() {
    let timerInterval
    Swal.fire({
        title: 'Subiendo archivo...!',
        timer: 30000,
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

informe()

function informe(){
    
    Swal.fire({
        title: "Informe",
        html: `
        Fecha inicial
        <input type="date" class="form-control" id="finicio">
        Fecha final
        <input type="date" class="form-control" id="ffinal">
        ODS
        <select class="form-control" id="ods" >
        <option value="Todo">Todo</option>
            <option value="031">031</option>
            <option value="032">032</option>
            <option value="033">033</option>
            <option value="034">034</option>
            <option value="035">035</option>
            <option value="036">036</option>
        </select>
        `,
        showCancelButton: true,
        confirmButtonText: "Aceptar",
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {

            var finicio = $('#finicio').val()
            var ffinal = $('#ffinal').val()
            var ods = $('#ods').val()

            $.post(server+'informe.php',{ods:ods,finicio:finicio,ffinal:ffinal},
                function(resp){
                    var html = ''

                    for(var i=0; i<resp.length; i++){
                        html += `
                        <tr>
                            <td>${resp[i].fecha}</td>
                            <td>${resp[i].servicio}</td>
                            <td>${resp[i].casino}</td>
                            <td>${resp[i].ods}</td>
                            <td>${resp[i].solicitado}</td>
                            <td>${resp[i].sistema}</td>
                            <td>${resp[i].manual}</td>
                            <td>${resp[i].adicionales}</td>
                            <td>${resp[i].sobrantes}</td>
                            <td>${resp[i].total}</td>
                        </tr>
                        `
                    }

                    $('#tablaDatos').html(html)
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
            )
            
        }
      });
}

function buscarDatos(){

    var finicio = sessionStorage.getItem("finicio")
    var ffinal = sessionStorage.getItem("ffinal")
    var ods = sessionStorage.getItem("ods")

    $.post(server+'informe.php',{ods:ods,finicio:finicio,ffinal:ffinal},
        function(resp){
            console.log(resp)
        }
    )
}