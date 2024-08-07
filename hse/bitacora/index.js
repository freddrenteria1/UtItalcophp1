
        var server = 'https://utitalco.com/hse/bitacora/server/';

        function getParameterByName(name) {
            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(location.search);
            return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
        }



        function cargando() {
            let timerInterval
            Swal.fire({
                title: 'Verificando!',
                html: 'Un momento por favor...',
                timer: 40000,
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


        function enviar() {


            var doc = $('#doc').val()
            var ods = $('#ods').val()
            var frente = $('#frente').val()
            var fecha = $('#fecha').val()
            var ods = $('#ods').val()


            if (doc != '' && fecha != '' && ods != '') {
                cargando()

                var formData = new FormData();

                ods = ods + ' ' + frente;

                formData.append('doc', doc);
                formData.append('ods', ods);

                $.ajax({
                    url: server + 'verificaruser.php',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response)
                        if (response != null) {
                            localStorage.setItem('datos', JSON.stringify(response))
                            localStorage.setItem('fechabit',fecha)
                            Swal.fire({
                                position: 'top-end',
                                icon: 'info',
                                title: 'Correcto...',
                                showConfirmButton: false,
                                timer: 500
                            })
                            location = 'bitacora.html'
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'warning',
                                title: 'Sin acceso...',
                                showConfirmButton: false,
                                timer: 500
                            })
                        }
                    }
                })

            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Por favor registre su documento y fecha de reporte',
                    showConfirmButton: false,
                    timer: 1500
                })
            }

        }
    