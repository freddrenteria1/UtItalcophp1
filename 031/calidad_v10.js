
        var odsq = null
        var server = "https://utitalco.com/031/server/";

        var arrayFiles = []

        var arrayDatos = []
        var arrayDatosFrentes = []
        
        var arrayOm =  []

        var numeroom= null

        var listaFrentes = []
        var listaprog = []
        var listaeje = []

        var listaFrentesT = []
        var listaprogT = []
        var listaejeT = []
        var listaprogTP = []
        var listaejeTP = []

        var frenteb = null
        var arrayOp = []

        var userprog = sessionStorage.getItem('userprog');

        //CALUCLO DE SEMANA

        var numsem = null

        var semana = null
        var frente = null

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
            $('#selsem').html(' | SEMANA # ' + numero)
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


        //FIN CALCULO DE SEMANA


       


        function inicio() {
            location = 'index.html'
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
            $.post(server+'borrarFileOM.php', {id:id},
            function(resp){
                mostrarArchivos(numeroom)
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


        function cargarOM(){
            semana = $('#semdia').html()
            frente = $('#frentes').val()

            if(semana == '' || frente == ''){
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Información...',
                    text: 'Debe seleccionar un frente y semana',
                    showConfirmButton: false,
                    timer: 2500
                })
            }else{
                cargarListaOM()
            }

        }

            

        function agregarOM(){
            Swal.fire({
                title: "Agregar Orden de Mantenimiento",
                html: `
                <input type="text" class="form-control" id="nom" placeholder="OM">
                `,
                showCancelButton: true,
                confirmButtonText: "Guardar",
                cancelButtonText: `Cancelar`
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var nom = $('#nom').val()
                   
                    $.post(server + 'guardarOM.php', {om:nom, frente:frente, semana:semana},
                    function(resp){
                        
                        if(resp.msn == 'Ok'){
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Info...',
                                text: 'Agregada OM',
                                showConfirmButton: false,
                                timer: 2500
                            }).then(()=>{
                                cargarListaOM()
                            })
                        }else{
                            Swal.fire({
                                position: 'top-end',
                                icon: 'info',
                                title: 'Error...',
                                text: resp.msn,
                                showConfirmButton: false,
                                timer: 2500
                            })
                        }
                        
                    })


                } 
              });
        }

        function borrarOM(){
            Swal.fire({
                title: "Borrar Orden de Mantenimiento",
                html: `
                <input type="text" class="form-control" id="nom" placeholder="OM">
                `,
                showCancelButton: true,
                confirmButtonText: "Borrar",
                cancelButtonText: `Cancelar`
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var nom = $('#nom').val()
                   
                    $.post(server + 'borrarOM.php', {om:nom, frente:frente, semana:semana},
                    function(resp){
                        
                        if(resp.msn == 'Ok'){
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Info...',
                                text: 'Borrada OM',
                                showConfirmButton: false,
                                timer: 2500
                            }).then(()=>{
                                cargarListaOM()
                            })
                        }else{
                            Swal.fire({
                                position: 'top-end',
                                icon: 'info',
                                title: 'Error...',
                                text: resp.msn,
                                showConfirmButton: false,
                                timer: 2500
                            })
                        }
                        
                    })


                } 
              });
        }

        function mostrarArchivos(numom){

            numeroom = numom

            $('#numom').html(numeroom)


            $.post(server+'verFilesOM.php',{semana:numsem, frente:frenteb, om:numom},
            function(resp){
                arrayOp = resp.op
                arrayFiles = resp.files

                console.log(arrayFiles)
                

                var html = `
                <div class="card-title">
                            ARCHIVOS 
                                
                            </div>
                `

                if(resp.op != null){

                    if(arrayFiles != null){

                        for(var i=0; i<arrayFiles.length; i++){
                            html += `
                            
                                <div class="doc">
                                    <a href="https://utitalco.com/031/server/archivos/${arrayFiles[i].archivo}" target="_blank">
                                    <img src="img/doc.jpg" width="70px" alt="">
                                        </a>
                                     <br>
                                    <div class="nomb">
                                        ${arrayFiles[i].archivo}
                                    </div>
                                    
                                </div>
                            `
                        }

                    }

                    html += `<div class="table-responsive mt-3">
                    <table class="table table-striped">
                        <thead>
                            <th># OP</th>
                            <th>Dpto</th>
                            <th>Unidad</th>
                            <th>Alcance</th>
                            <th>Actividades</th>
                            <th>Fecha Prog</th>
                            <th>Fecha Rep</th>
                            <th>Estado</th>
                        </thead>
                        <tbody>`

                    for(var i=0; i< arrayOp.length; i++){

                        html += `
                        <tr>
                            <td>${arrayOp[i].op}</td>
                            <td>${arrayOp[i].dpto}</td>
                            <td>${arrayOp[i].unidad}</td>
                            <td>${arrayOp[i].alcance}</td>
                            <td>${arrayOp[i].actividades}</td>
                            <td>${arrayOp[i].fechaprog}</td>
                            <td>${arrayOp[i].fecharep}</td>
                            <td>${arrayOp[i].estado}</td>
                        </tr>
                        `

                    }



                    html += `
                        
                        </tbody>
                    
                    </table></div>
                    `


                    $('#archivossem').html(html)
                }else{
                        
                }

                 


            })

        }


        function subirArchivo() {
             

            if(numeroom != null){

                cargando()
    
                var formData = new FormData();
                var files = $('#files')[0].files[0];
                 
    
                formData.append('archivo', files);
                formData.append('om', numeroom);
                formData.append('frente', frente);
                formData.append('semana', semana);
    
                $.ajax({
                    url: server + 'guardarFileOM.php',
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
    
                                mostrarArchivos(numeroom)
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

            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Cargue primero una orden de mantenimiento...!',
                })
            }
             

        }

        numsem = sessionStorage.getItem('semana')
    fecha = sessionStorage.getItem('fecha')

    

    if(numsem == null){

        solFecha()
    }else{
        $('#semdia').html(numsem)
        $('#selsem').html(' | SEMANA # ' + numsem)
        cargarDatos(numsem)
    }

    function cargarDatos(semb){
        $.post(server+'listasOM.php', {semana:numsem},
            function(resp){
                console.log(resp)
                arrayDatos = resp

                var html = ''

                for(var i=0; i<arrayDatos.length; i++){
                    html += `
                    <button class="btn btn-dark" onclick="cargarLOM('${arrayDatos[i].frente}')">${arrayDatos[i].frente}</button>
                    `
                }

                html += `
                <button class="btn btn-warning" onclick="cambiarFecha()">CARGAR SEMANA</button>
                `

                $('#botonesf').html(html)

                cargarGrafica()
            })
    }


        function solFecha(){
            Swal.fire({
                title: "Fecha a Consultar",
                html: `
                <p>Fecha: <input type="text" id="fechadiario" onchange="calSemDia(this)"> | Semana # <span id="semdia"></span> </p>
                `,
                showCancelButton: true,
                confirmButtonText: "Cosultar",
                cancelButtonText: `Cancelar`,
                allowOutsideClick: false,
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var fecha = $('#fechadiario').val()
                    var semb = numsem

                    if(fecha != ""){
                         
                        $.post(server+'listasOM.php', {semana:semb},
                        function(resp){
                            console.log(resp)
                            arrayDatos = resp

                            var html = ''

                            for(var i=0; i<arrayDatos.length; i++){
                                html += `
                                <button class="btn btn-dark" onclick="cargarLOM('${arrayDatos[i].frente}')">${arrayDatos[i].frente}</button>
                                `
                            }

                            html += `
                            <button class="btn btn-warning" onclick="cambiarFecha()">CARGAR SEMANA</button>
                            `

                            $('#botonesf').html(html)

                            cargarGrafica()
                        })
                    }else{
                        Swal.fire({
                            position: 'top-end',
                            icon: 'info',
                            title: 'Error...',
                            text: 'Por favor seleccione una fecha',
                            showConfirmButton: false,
                            timer: 2500
                        }).then(()=>{
                            location.reload()
                        })
                    }
                   
                    


                } 
              });
        }

        function cambiarFecha(){
            location.reload()
        }

        function cargarLOM(frente){
            frenteb = frente

            $('#nomfrente').html(frente)
            $('#archivossem').html('')

            $.post(server+'listasOMFrente.php', {semana:numsem, frente:frenteb},
            function(resp){
                console.log('resp bd: ')
                console.log(resp)
                arrayDatosFrentes = resp
                cargarGraficaFrente()
                cargarListaOM()
            })

        }

        function cargarGrafica(){

            var cantprog = 0;
            var canteje = 0;
            
            for(var i=0; i<arrayDatos.length; i++){
                listaFrentes.push(arrayDatos[i].frente)
                listaprog.push(arrayDatos[i].cantom)
                cantprog += arrayDatos[i].cantom;
                listaeje.push(arrayDatos[i].cantomeje)
                canteje += arrayDatos[i].cantomeje
            }

            var promeje = ((canteje * 100)/cantprog);
            promeje = parseFloat(promeje.toFixed(2))
            console.log('promeje ', promeje)
            var prompdte = (100 - promeje)

            listaFrentesT.push("TOTAL")
            listaprogT.push(cantprog)
            listaejeT.push(canteje)

            

            var chart11 = Highcharts.chart("fig1", {
                colors: [
                    "#01005e",
                    "#00c901",
                    "#efd520",
                    "#bfbfbf",
                    "#537b35",
                    "#a4c639",
                    "#537b35",
                    "#a4c639",
                    "#537b35",
                ],
                credits: {
                    enabled: false,
                },
                chart: {
                    type: "column",

                },
                title: {
                    text: null,
                },

                xAxis: {
                    categories: listaFrentes,
                    crosshair: true,
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: "Cant ",
                    },
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:f}</b></td></tr>',
                    footerFormat: "</table>",
                    shared: true,
                    useHTML: true,
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                        },
                    },
                },

                series: [{
                        name: "OM PLAN",
                        data: listaprog,
                    },
                    {
                        name: "OM EJE",
                        data: listaeje,
                    },
                ],
            });

            var chart12 = Highcharts.chart("fig2", {
                colors: [
                    "#01005e",
                    "#00c901",
                    "#efd520",
                    "#bfbfbf",
                    "#537b35",
                    "#a4c639",
                    "#537b35",
                    "#a4c639",
                    "#537b35",
                ],
                credits: {
                    enabled: false,
                },
                chart: {
                    type: "column",

                },
                title: {
                    text: null,
                },

                xAxis: {
                    categories: listaFrentesT,
                    crosshair: true,
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: "Cant ",
                    },
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:f}</b></td></tr>',
                    footerFormat: "</table>",
                    shared: true,
                    useHTML: true,
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                        },
                    },
                },

                series: [{
                        name: "OM PLAN",
                        data: listaprogT,
                    },
                    {
                        name: "OM EJE",
                        data: listaejeT,
                    },
                ],
            });

            Highcharts.chart('fig3', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: ''
                },
                tooltip: {
                    valueSuffix: '%'
                },
                credits: {
                    enabled: false,
                },
               
                plotOptions: {
                    series: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: [{
                            enabled: true,
                            distance: 20
                        }, {
                            enabled: true,
                            distance: -40,
                            format: '{point.percentage:.1f}%',
                            style: {
                                fontSize: '1.2em',
                                textOutline: 'none',
                                opacity: 0.7
                            },
                            filter: {
                                operator: '>',
                                property: 'percentage',
                                value: 10
                            }
                        }]
                    }
                },
                series: [
                    {
                        name: 'Percentage',
                        colorByPoint: true,
                        data: [
                            
                            {
                                name: 'Ejecutadas',
                                y: promeje
                            },
                            {
                                name: 'Pendientes',
                               
                                y: prompdte
                            }
                        ]
                    }
                ]
            });
            
            
           
        }

        function cargarGraficaFrente(){

            listaFrentes = []
            listaprog = []
            listaeje = []

            listaFrentesT = []
            listaprogT = []
            listaejeT = []

            var totprog = 0;
            var toteje = 0;
            
            for(var i=0; i<arrayDatosFrentes.length; i++){
                listaFrentes.push(arrayDatosFrentes[i].numom)
                listaprog.push(arrayDatosFrentes[i].plan)
                totprog += arrayDatosFrentes[i].plan
                listaeje.push(arrayDatosFrentes[i].eje)
                toteje += arrayDatosFrentes[i].eje
            }

            var promeje = ((toteje * 100)/totprog);
            promeje = parseFloat(promeje.toFixed(2))
            console.log('promeje ', promeje)
            var prompdte = (100 - promeje)

            listaFrentesT.push("TOTAL")
            listaprogT.push(totprog)
            listaejeT.push(toteje)

            var chart11 = Highcharts.chart("fig1", {
                colors: [
                    "#01005e",
                    "#00c901",
                    "#efd520",
                    "#bfbfbf",
                    "#537b35",
                    "#a4c639",
                    "#537b35",
                    "#a4c639",
                    "#537b35",
                ],
                credits: {
                    enabled: false,
                },
                chart: {
                    type: "column",

                },
                title: {
                    text: null,
                },

                xAxis: {
                    categories: listaFrentes,
                    crosshair: true,
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: "Cant ",
                    },
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:f}</b></td></tr>',
                    footerFormat: "</table>",
                    shared: true,
                    useHTML: true,
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                        },
                    },
                },

                series: [{
                        name: "OP PLAN",
                        data: listaprog,
                    },
                    {
                        name: "OP EJE",
                        data: listaeje,
                    },
                ],
            });

            var chart12 = Highcharts.chart("fig2", {
                colors: [
                    "#01005e",
                    "#00c901",
                    "#efd520",
                    "#bfbfbf",
                    "#537b35",
                    "#a4c639",
                    "#537b35",
                    "#a4c639",
                    "#537b35",
                ],
                credits: {
                    enabled: false,
                },
                chart: {
                    type: "column",

                },
                title: {
                    text: null,
                },

                xAxis: {
                    categories: listaFrentesT,
                    crosshair: true,
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: "Cant ",
                    },
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:f}</b></td></tr>',
                    footerFormat: "</table>",
                    shared: true,
                    useHTML: true,
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                        },
                    },
                },

                series: [{
                        name: "OM PLAN",
                        data: listaprogT,
                    },
                    {
                        name: "OM EJE",
                        data: listaejeT,
                    },
                ],
            });
           

            Highcharts.chart('fig3', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: ''
                },
                tooltip: {
                    valueSuffix: '%'
                },
                credits: {
                    enabled: false,
                },
               
                plotOptions: {
                    series: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: [{
                            enabled: true,
                            distance: 20
                        }, {
                            enabled: true,
                            distance: -40,
                            format: '{point.percentage:.1f}%',
                            style: {
                                fontSize: '1.2em',
                                textOutline: 'none',
                                opacity: 0.7
                            },
                            filter: {
                                operator: '>',
                                property: 'percentage',
                                value: 10
                            }
                        }]
                    }
                },
                series: [
                    {
                        name: 'Percentage',
                        colorByPoint: true,
                        data: [
                            
                            {
                                name: 'Ejecutadas',
                                y: promeje
                            },
                            {
                                name: 'Pendientes',
                               
                                y: prompdte
                            }
                        ]
                    }
                ]
            });

             

           
        
           
        }

        function cargarListaOM(){
            console.log(frente)
            console.log(semana)
            $.post(server+'verOMFrente.php',{frente:frenteb, semana:numsem},
            function(resp){
                arrayOm = resp

                console.log(resp)
                 

                var html = `
                <div class="card-title">
                        ORDENES DE MANTENIMIENTO 
                            
                        </div>
                `


                if(resp != null){
                    for(var i=0; i<arrayOm.length; i++){
                        html += `
                        
                            <div class="btnom">
                                <button class="btn btn-info btn-lg btn-block" onclick="mostrarArchivos('${arrayOm[i].om}')">${arrayOm[i].om}</button>
                                
                            </div>
                        `
                    }
                    
                    $('#omSemana').html(html)
                }
            })
        }

