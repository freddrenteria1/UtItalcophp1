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

function subir(){

    cargando()

            var formData = new FormData();
            var files = $('#info')[0].files[0];
            var  fechad = $('#fecha').val();
            

            formData.append('archivo', files);
            formData.append('fecha', fechad);
           

            $.ajax({
                url: server + 'guardarFile.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response)

                    
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Archivo cargado correctamente...',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {

                            location.reload();
                        })
                    
                }
            });
}

function informe(){
    
    location = "informe.html"
    
}