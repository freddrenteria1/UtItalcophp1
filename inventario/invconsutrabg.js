        var odsalm = sessionStorage.getItem('odsalm')
        var almacen = sessionStorage.getItem('almacen')
        var useralm = sessionStorage.getItem('useralm')

        var ubicacion = sessionStorage.getItem('ubicacion')

        function getParameterByName(name) {
            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(location.search);
            return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
        }

        var ods = getParameterByName('ods');
        var inicio = getParameterByName('inicio');
        var fin = getParameterByName('fin');

         

        var arrayDatos = []
        var arrayDet = []

        document.body.style.zoom = "75%";

        var url = 'https://utitalco.com/inventario/server/'

        buscar()

        function buscar() {

             

            cargando()
                    $.post(url + 'cargarConsumiblesTrabajadorTotalGen.php', {ods:ods, inicio:inicio, fin:fin},
                    function(resp) {

                        console.log(resp)
                        arrayDatos = resp.datos

                        arrayDet = resp.det

                    if (arrayDatos != null) {

                        var html = ''
                        for (var i = 0; i < arrayDatos.length; i++) {
                            html += `
                            <tr>
                                    <td>${i+1}</td>
                                    <td>${arrayDatos[i].ced}</td>
                                    <td>${arrayDatos[i].nombres}</td>
                                    <td>${arrayDatos[i].cargo}</td>
                                    <td>${arrayDatos[i].cant}</td>
                                    <td>${arrayDatos[i].ods}</td>
                                    <td><button class="btn btn-info" onclick="verDet(${arrayDatos[i].ced})" > Detalles </button> </td>
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

                    } else {
                        $('#datosTabla').html('')
                    }
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Informe cargado...',
                        showConfirmButton: false,
                        timer: 1500
                    })
                })
        


           
        
        }

        function verDet(cedu){
            console.log(cedu)
            var html = ''

            for (var i = 0, len = arrayDet.length; i < len; i++) {
                if (arrayDet[i].ced == cedu) {
                    html += `
                        <tr>
                                <td>${i+1}</td>
                                <td>${arrayDet[i].fecha}</td>
                                <td>${arrayDet[i].ced}</td>
                                <td>${arrayDet[i].nombres}</td>
                                <td>${arrayDet[i].cargo}</td>
                                <td>${arrayDet[i].supervisor}</td>
                                <td>${arrayDet[i].frente}</td>
                                <td>${arrayDet[i].cod}</td>
                                <td>${arrayDet[i].item}</td>
                                <td>${arrayDet[i].cant}</td>
                                <td>${arrayDet[i].ods}</td>
                                <td>${arrayDet[i].ubicacion}</td>
                                <td>${arrayDet[i].entregado}</td>
                            </tr>
                        `
                }
            }

            
            
            $('#datosTabla2').html(html)
            $('#tblData2').DataTable({
                retrieve: true,
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

            $('#tabla2').removeClass('oculto')


             
            
        }

         





        function cargando() {
            let timerInterval
            Swal.fire({
                title: 'Cargando datos!',
                html: 'Un momento por favor...',
                timer: 45000,
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
