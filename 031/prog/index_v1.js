
        var odsq = null
        var server = "https://utitalco.com/031/server/";
        var filesdiarios = []
        var filessem = []
        var filesmes = []

        var userprog = sessionStorage.getItem('userprog');

        //CALUCLO DE SEMANA

        var numsem = null

        $( function() {

            $.datepicker.regional['es'] = {
                closeText: 'Cerrar',
                prevText: '< Ant',
                nextText: 'Sig >',
                currentText: 'Hoy',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                weekHeader: 'Sm',
                dateFormat: 'yy-mm-dd',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };

            $.datepicker.setDefaults($.datepicker.regional['es']);


            $( "#fechadiario" ).datepicker({
                showWeek: true,
                firstDay: 1
            });

            
            $( "#fechaseg" ).datepicker({
                showWeek: true,
                firstDay: 1
            });

            
            $( "#fechasem" ).datepicker({
                showWeek: true,
                firstDay: 1
            });

            
            $( "#fechames" ).datepicker({
                showWeek: true,
                firstDay: 1
            });


        } );

        const formateador = new Intl.DateTimeFormat('es-MX', { dateStyle: 'long', });
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

        function calSem(e){

            fecha = e.value;
            console.log(fecha)
            fecha = new Date(fecha);
            fecha.setDate(fecha.getDate() + 1)
            //console.log(fecha)
            const numero = numeroDeSemana(fecha);
            numsem = numero
            console.log(`Para ${fecha} el número de semana es ${numero} `);
            $('#sem').html(numero)
        }

        function calSemDia(e){

            fecha = e.value;
            console.log(fecha)
            fecha = new Date(fecha);
            fecha.setDate(fecha.getDate() + 1)
            //console.log(fecha)
            const numero = numeroDeSemana(fecha);
            numsem = numero
            console.log(`Para ${fecha} el número de semana es ${numero} `);
            $('#semdia').html(numero)
        }

        function calSemMes(e){

            fecha = e.value;
            console.log(fecha)
            fecha = new Date(fecha);
            fecha.setDate(fecha.getDate() + 1)
            //console.log(fecha)
            const numero = numeroDeSemana(fecha);
            numsem = numero
            console.log(`Para ${fecha} el número de semana es ${numero} `);
            $('#semmes').html(numero)
        }

        function calSemSeg(e){

            fecha = e.value;
            console.log(fecha)
            fecha = new Date(fecha);
            fecha.setDate(fecha.getDate() + 1)
            //console.log(fecha)
            const numero = numeroDeSemana(fecha);
            numsem = numero
            console.log(`Para ${fecha} el número de semana es ${numero} `);
            $('#semseg').html(numero)
        }


        //FIN CALCULO DE SEMANA





        if (userprog == null) {
            veriAdmin()
        }else{
            cargarFilesDiarios()
            cargarInfo()
        }

        function veriAdmin() {
            Swal.fire({
                title: 'Verificar Permisos',
                html: `
                <input type="text" id="useradmin" class="form-control" placeholder="Usuario con acceso">
                <input type="password" id="claveadmin" class="form-control" placeholder="Contraseña">
                `,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                var claveadmin = $('#claveadmin').val()
                var useradmin = $('#useradmin').val()

                if (useradmin == 'programador031@utitalco.com' && claveadmin == 'italco2024*') {
                    sessionStorage.setItem('userprog', claveadmin)
                    cargarFilesDiarios()
                    cargarInfo()
                    
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Acceso denegado...!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location = '../index.html'
                    })
                }

            })
        }


        function inicio() {
            location = '../index.html'
        }

        function subirDia() {
             
            cargando()

            var formData = new FormData();
            var files = $('#filed')[0].files[0];
            var  fechad = $('#fechadiario').val();
            var semdia = $('#semdia').html()

            formData.append('archivo', files);
            formData.append('fecha', fechad);
            formData.append('semana', semdia);

            $.ajax({
                url: server + 'guardarFileDiario.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response)

                    if (response.msn == "Ok") {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Archivo cargado correctamente...',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {

                            location.reload();
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Formato de archivo incorrecto...!',
                        })
                    }
                }
            });

        }

        function subirSem() {
             
            cargando()

            var formData = new FormData();
            var files = $('#files')[0].files[0];
            var  fechad = $('#fechasem').val();
            var sem = $('#sem').html()

            formData.append('archivo', files);
            formData.append('fecha', fechad);
            formData.append('semana', sem);

            $.ajax({
                url: server + 'guardarFileSem.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response)

                    if (response.msn == "Ok") {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Archivo cargado correctamente...',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {

                            location.reload();
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Formato de archivo incorrecto...!',
                        })
                    }
                }
            });

        }
        
        function subirMes() {
             
            cargando()

            var formData = new FormData();
            var files = $('#filem')[0].files[0];
            var  mes = $('#mes').val();
             

            formData.append('archivo', files);
            formData.append('mes', mes);
             

            $.ajax({
                url: server + 'guardarFileMes.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response)

                    if (response.msn == "Ok") {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Archivo cargado correctamente...',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {

                            location.reload();
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Formato de archivo incorrecto...!',
                        })
                    }
                }
            });

        }

        
        function subirSeg() {
             
            cargando()

            var formData = new FormData();
            var files = $('#fileseg')[0].files[0];
            var  fechad = $('#fechaseg').val();
            var semdia = $('#semseg').html()
            
            

            formData.append('archivo', files);
            formData.append('fecha', fechad);
            formData.append('semana', semdia);
            

            $.ajax({
                url: server + 'guardarFileSeg.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response)

                    if (response.msn == "Ok") {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Archivo cargado correctamente...',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {

                            location.reload();
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Formato de archivo incorrecto...!'+response.msn,
                        })
                    }
                }
            });

        }

        

        function cargarFilesDiarios(){
            $.post(server+'verFilesDiarios.php',{},
            function(resp){
                filesdiarios = resp.filesdiarios
                filessem = resp.filessemana
                filesmes = resp.filesmes

                var html = ''

                if(resp.filesdiarios != null){
                    for(var i=0; i<filesdiarios.length; i++){
                        html += `
                            <div class="doc">
                                <a href="https://utitalco.com/031/server/archivos/${filesdiarios[i].archivo}" target="_blank">
                                <img src="../img/doc.jpg" width="70px" alt="">
                                    </a>
                                 <br>
                                <div class="nomb">
                                    ${filesdiarios[i].archivo}
                                </div>
                                <div class="borrar" onclick="borrarFilesDiarios('${filesdiarios[i].id}')">
                                    X
                                </div>
                            </div>
                        `
                    }
                    $('#archivosdiarios').html(html)
                }

                var html = ''

                if(filessem != null){
                    for(var i=0; i<filessem.length; i++){
                        html += `
                            <div class="doc">
                                <a href="https://utitalco.com/031/server/archivos/${filessem[i].archivo}" target="_blank">
                                <img src="../img/doc.jpg" width="70px" alt="">
                                </a>
                                <br>
                               <div class="nomb">
                                 
                                    ${filessem[i].archivo}    
                                 
                                </div>
                                <div class="borrar" onclick="borrarFileSem('${filessem[i].id}')">
                                    X
                                </div>
                            </div>
                        `
                    }
                    $('#archivossem').html(html)
                }

                var html = ''

                if(filesmes != null){
                    for(var i=0; i<filesmes.length; i++){
                        html += `
                            <div class="doc">
                                <a href="https://utitalco.com/031/server/archivos/${filesmes[i].archivo}" target="_blank">
                                <img src="../img/doc.jpg" width="70px" alt="">
                                </a>
                                <br>
                               <div class="nomb">
                                 
                                    ${filesmes[i].archivo}    
                                 
                                </div>
                                <div class="borrar" onclick="borrarFileMes('${filesmes[i].id}')">
                                    X
                                </div>
                            </div>
                        `
                    }
                    $('#archivosmes').html(html)
                }


            })
        }

        function borrarFilesDiarios(id){
            $.post(server+'borrarFileDiario.php', {id:id},
            function(resp){
                location.reload();
            })
        }

        function borrarFileSem(id){
            $.post(server+'borrarFileSem.php', {id:id},
            function(resp){
                location.reload();
            })
        }
        
        function borrarFileMes(id){
            $.post(server+'borrarFileMes.php', {id:id},
            function(resp){
                location.reload();
            })
        }

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


        function actdias(){
            var diastot = $('#totdias').val()
            var finicio = $('#finicio').val()
            $.post(server+'actdias.php', {dias:diastot, finicio:finicio},
            function(resp){
                location.reload()
            })
        }
        
        function actavance(){
            var avanceprog = $('#avanceprog').val()
            var avanceeje = $('#avanceeje').val()
            var avancedesv = $('#avancedesv').val()

            $.post(server+'actavance.php', {avanceprog:avanceprog, avanceeje:avanceeje, avancedesv:avancedesv},
            function(resp){
                console.log('Resp ', resp)
                location.reload()
            })
        }

        function actruta(){
            var rutaprog = $('#rutaprog').val()
            var rutaeje = $('#rutaeje').val()
            var rutadesv = $('#rutadesv').val()

            $.post(server+'actruta.php', {rutaprog:rutaprog, rutaeje:rutaeje, rutadesv:rutadesv},
            function(resp){
                console.log('Resp ', resp)
                location.reload()
            })
        }

        function cargarInfo(){
            $.post(server+'verInfo.php',{},
            function(resp){
                console.log(resp)
                $('#totdias').val(resp.dias)
                $('#finicio').val(resp.finicio)
                $('#avanceprog').val(resp.avanceprog)
                $('#avanceeje').val(resp.avanceeje)
                $('#avancedesv').val(resp.avancedesv)
                $('#rutaprog').val(resp.rutaprog)
                $('#rutaeje').val(resp.rutaeje)
                $('#rutadesv').val(resp.rutadesv)

            })
        }

