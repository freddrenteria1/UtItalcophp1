        var odsalm = sessionStorage.getItem('odsalm')
        var almacen = sessionStorage.getItem('almacen')
        var useralm = sessionStorage.getItem('useralm')

        var contTabla2 = false

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
                    $.post(url + 'cargarConsumiblesTrabajadorTotalCon.php', {ods:ods, inicio:inicio, fin:fin},
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
                                    <td>${arrayDatos[i].cod}</td>
                                    <td>${arrayDatos[i].unidad}</td>
                                    <td>${arrayDatos[i].item}</td>
                                    <td>${arrayDatos[i].cant}</td>
                                    <td>${arrayDatos[i].ods}</td>
                                    <td><button class="btn btn-info" onclick="verDet(${i})" > Detalles </button> </td>
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

        function verDet(e){
            console.log(e)
            codi = arrayDatos[e].cod
            console.log(codi)
            var html = ''

            for (var a = 0, len = arrayDet.length; a < len; a++) {
                if (arrayDet[a].cod === codi) {
                    html += `
                        <tr>
                                <td>${a+1}</td>
                                <td>${arrayDet[a].ced}</td>
                                <td>${arrayDet[a].nombres}</td>
                                <td>${arrayDet[a].cargo}</td>
                                <td>${arrayDet[a].supervisor}</td>
                                <td>${arrayDet[a].frente}</td>
                                <td>${arrayDet[a].cod}</td>
                                <td>${arrayDet[a].item}</td>
                                <td>${arrayDet[a].cant}</td>
                                <td>${arrayDet[a].fecha}</td>
                                <td>${arrayDet[a].ods}</td>
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
                    paging: false,
                    searching: true,
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
                timer: 65000,
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
