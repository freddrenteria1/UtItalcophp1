        var server = 'https://utitalco.com/bitacorasup/server/';
        var serverP = "https://utitalco.com/031/server/";



        //CALUCLO DE SEMANA

        var numsem = null

        var semana = null
        var frente = null
        var arrayDatos = null

        

        const formateador = new Intl.DateTimeFormat('es-MX', {
            dateStyle: 'long',
        });
        const numeroDeSemana = fecha => {
            // https://parzibyte.me/blog
            const DIA_EN_MILISEGUNDOS = 1000 * 60 * 60 * 24,
                DIAS_QUE_TIENE_UNA_SEMANA = 7,
                JUEVES = 4;
            console.log(fecha)
            fecha = new Date(Date.UTC(fecha.getFullYear(), fecha.getMonth(), fecha.getDate()));
            let diaDeLaSemana = fecha.getUTCDay(); // Domingo es 0, sábado es 6
            if (diaDeLaSemana === 0) {
                diaDeLaSemana = 7;
            }
            fecha.setUTCDate(fecha.getUTCDate() - diaDeLaSemana + JUEVES);
            const inicioDelAño = new Date(Date.UTC(fecha.getUTCFullYear(), 0, 1));
            const diferenciaDeFechasEnMilisegundos = fecha - inicioDelAño;
            return Math.ceil(((diferenciaDeFechasEnMilisegundos / DIA_EN_MILISEGUNDOS) + 1) / DIAS_QUE_TIENE_UNA_SEMANA);
        };

        // const inicio = new Date('2023-10-01');
        // const fin = new Date('2023-10-05');

        // console.log(inicio.getDate())

        function calSem(e) {

            fecha = e.value;
            console.log(fecha)
            fecha = new Date(fecha);
            fecha.setDate(fecha.getDate() + 1)
            //console.log(fecha)
            const numero = numeroDeSemana(fecha);
            numsem = numero
            console.log(`Para ${fecha} el número de semana es ${numero} `);
            $('#sem').html(numero)
            $('#dias').html(numero)



        }

        function calSemDia(e) {

            fecha = e.value;
            console.log(fecha)
            fecha = new Date(fecha);
            fecha.setDate(fecha.getDate() + 1)
            //console.log(fecha)
            const numero = numeroDeSemana(fecha);
            numsem = numero
            console.log(`Para ${fecha} el número de semana es ${numero} `);

            
            
            sessionStorage.setItem('semana', numero)

            buscarFrentes()

           

        }

        function calSemMes(e) {

            fecha = e.value;
            console.log(fecha)
            fecha = new Date(fecha);
            fecha.setDate(fecha.getDate() + 1)
            //console.log(fecha)
            const numero = numeroDeSemana(fecha);
            numsem = numero
            console.log(`Para ${fecha} el número de semana es ${numero} `);

            
            
            //$('#semmes').html(numero)
        }

        function buscarFrentes(){

            console.log(numsem)
             
            $.post(serverP+'listasOM.php', {semana:numsem},
                function(resp){
                    console.log(resp)
                    arrayDatos = resp.om

                    var html = ''

                    for(var i=0; i<arrayDatos.length; i++){
                        html += `
                        <option value="${arrayDatos[i].frente}">${arrayDatos[i].frente}</option>
                        `
                    }
                   

                    $('#frente').html(html)

                    
                })

        }


        //FIN CALCULO DE SEMANA



        function getParameterByName(name) {
            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(location.search);
            return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
        }

        var arrayFrentes = []
        var datosUser = []



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

        // function buscarFrentes() {
        //     ods = $('#ods').val()

        //     $.post(server + 'buscarFrentes.php', {
        //             ods: ods
        //         },
        //         function (resp) {
        //             console.log(resp)
        //             var html = ''

        //             if (resp != null) {

        //                 arrayFrentes = resp


        //                 for (var i = 0; i < arrayFrentes.length; i++) {
        //                     html += `
        //                 <option value="${arrayFrentes[i].frente}">${arrayFrentes[i].frente}</option>
        //                 `
        //                 }

        //             }
        //             $('#frente').html(html)
        //         })
        // }


        function enviar() {


            var doc = $('#doc').val()
            var ods = '031'
            var fecha = $('#fecha').val()
            var frente = $('#frente').val()


            if (doc != '' && fecha != '' && ods != '') {
                cargando()

                var formData = new FormData();

                formData.append('doc', doc);
                formData.append('ods', ods);

                $.ajax({
                    url: server + 'verificaruser.php',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response)
                        if (response.msn == 'Ok') {

                            datosUser.push({
                                'doc': doc,
                                'fecha': fecha,
                                'ods': ods,
                                'frente': frente,
                                'numsem': numsem,
                                'nombres': response.nombres
                            })


                            localStorage.setItem('datos', JSON.stringify(datosUser))
                            localStorage.setItem('fechabit', fecha)
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