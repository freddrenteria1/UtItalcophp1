var url = "https://utitalco.com/hse/andamios/server/";

var arrayDatos = []

cargarDatos()

function cargarDatos() {

    $.post(
        url + "listaArchivos.php", {

        },
        function (resp) {
            arrayDatos = resp
            var html = ''

            for (var i = 0; i < arrayDatos.length; i++) {
                html += `
                    <a href="https://utitalco.com/hse/andamios/server/archivos/${arrayDatos[i].archivo}" target="_black">
                        <img src="img/icono.webp" class="midoc">
                    </a>
                `
            }
            $('#lista').html(html)
        }
    );


}

function subir() {

    cargando()

    var file = document.getElementById('listado').files[0]

    let formData = new FormData();
    formData.append('excel', file);

    $.ajax({
        url: url + 'guardarExcelAndamios.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Archivo cargado...',
                showConfirmButton: false,
                timer: 1500
              }).then(()=>{
                location.reload()
              })

        }
    })


}

function cargando() {
    let timerInterval
    Swal.fire({
        title: 'Cargando archivo...!',
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