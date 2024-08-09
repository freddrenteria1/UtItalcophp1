
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


function cargarDatos(){
    mensaje('Cargando...', 'Sincronizando información...')

    $.post(server + 'cargarBDCod.php',
    function(resp) {
        arrayDatos = resp
        console.log(resp)

        new DataTable('#datable_1', {
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
              },
             
            data: arrayDatos,
            columns: [
                { data: 'cm' },
                { data: 'descripcion' },
                { data: 'unidad' },
                { data: 'localizacion' },
                { data: 'clase' },
                { data: 'tipo' },
                { data: 'precio' }


            ],
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ],
        });

 

        

    })
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
                url: server + 'subirdbm.php',
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