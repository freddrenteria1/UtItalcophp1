
var server = 'https://utitalco.com/cgm/server/'
var arrayDatos = []

var user = sessionStorage.getItem('usermat');

if(user == null){
    location = 'login.html';
}else{
    var ods = sessionStorage.getItem('ods');
    $('#ods').html(ods)
}


cargarDatos()

function mensaje(title, msn){
    $.toast({
        heading: title,
        text: msn,
        position: 'top-right',
        loaderBg:'#e69a2a',
        icon: 'info',
        hideAfter: 8500, 
        stack: 6
    });
}

function cargando() {
    let timerInterval
    Swal.fire({
        title: 'Cargando...!',
        html: 'Un momento por favor...',
        timer: 50000,
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


function cargarDatos(){
    mensaje('Cargando...', 'Sincronizando información...')

    $.post(server + 'cargarBDgen.php',
    function(resp) {
        arrayDatos = resp
        console.log(resp)

        new DataTable('#datable_1', {
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
              },
             
            data: arrayDatos,
            columns: [
                { data: 'item' },
                { data: 'reserva' },
                { data: 'posres' },
                { data: 'cm' },
                { data: 'descripcion' },
                { data: 'unidad' },
                { data: 'cantreq' },
                { data: 'impacto' },
                { data: 'ods' },
                { data: 'ordenmtto' },
                { data: 'equipo' },
                { data: 'sistema' },
                { data: 'isometrico' },
                { data: 'ingenieria' },
                { data: 'obsadicional' },
                { data: 'alcance' },
                { data: 'ubicatec' },
                { data: 'planeado' },
                { data: 'etapa' },
                { data: 'especialidad' },
                { data: 'sk' },
                { data: 'numcolada' },
                { data: 'certificado' }


            ],
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ],
        });

 

        

    })
}


function impDatos() {
    Swal.fire({
        title: 'Importar Base de Datos',
        html: `<hr>
        <div class="row" style="width: 100%;">
       
            <div class="col-sm-12">
                
                <div class="form-group">
                    <label for="">Archivo</label>
                    <input type="file" class="form-control" id="excelMarcaciones"  ref="excelMarcaciones" placeholder="Importar">
                </div>
            </div>
        </div><hr>
        `,

        showCancelButton: true,
        confirmButtonText: 'Importar',
        cancelButtonText: 'Cancelar',
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            var file = document.getElementById('excelMarcaciones').files[0]
            cargando()

            let formData = new FormData();
            formData.append('excel', file);


            $.ajax({
                url: server + 'subirdbg.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {

                    mensaje('¡Importado!','Base de datos cargada correctamente')

                    console.log(response)
                    // const Toast = Swal.mixin({
                    //     toast: true,
                    //     position: 'top-end',
                    //     showConfirmButton: false,
                    //     timer: 3000
                    // });
                    // Toast.fire({
                    //     icon: 'success',
                    //     title: '¡Importado!',
                    //     text: 'Base de datos cargada correctamente...'
                    // })

                     

                }
            })

        }
    })
}
