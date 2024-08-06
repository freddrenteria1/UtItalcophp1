

        var server = 'https://utitalco.com/bitacorasup/server/';

        var arrayDatos = []
        var arrayKpi = []

       var fecha = null
       var fechainf = null

        //CALUCLO DE SEMANA

        var numsem = null

        var semana = null
        var frente = null
        var arrayDatos = null
        var datosBitacora = []
        var arrayDatosOP = null

        

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

            fecha = e;
            console.log(fecha)
            fecha = new Date(fecha);
            fecha.setDate(fecha.getDate() + 1)
            //console.log(fecha)
            const numero = numeroDeSemana(fecha);
            numsem = numero
            console.log(`Para ${fecha} el número de semana es ${numero} `);

            
            
            sessionStorage.setItem('semana', numero)
            $('#semana').html(numero)

            cargarDatos() 

           

           

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

            
            
            
        }


        var ods = '031'

        fechainf = sessionStorage.getItem('fechainf')

        if(fechainf != "" && fechainf != null){
            $('#fechainf').html(fechainf)
            calSemDia(fechainf)
        }else{

            Swal.fire({
                icon: 'info',
                title: 'Fecha',
                html: `
                    <div class="row" style="width: 100%">
                         
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="fecha" >
                        </div>
                    </div>
                    
                `,
                allowOutsideClick: false
            }).then(() => {
                fechainf = $('#fecha').val()
                $('#fechainf').html(fechainf)
    
                sessionStorage.setItem('fechainf',fechainf)
    
                calSemDia(fechainf)
    
            })
        }

        function cambiarFecha(){
            Swal.fire({
                icon: 'info',
                title: 'Fecha',
                html: `
                    <div class="row" style="width: 100%">
                         
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="fecha" >
                        </div>
                    </div>
                    
                `,
                allowOutsideClick: false
            }).then(() => {
                fechainf = $('#fecha').val()
                $('#fechainf').html(fechainf)
    
                sessionStorage.setItem('fechainf',fechainf)
    
                calSemDia(fechainf)
    
            })
        }

         
        



        function cargarDatos() {

            var html = ''

            $.post(server + 'cargarBitacora.php', {
                    fecha: fechainf,
                    sem: numsem
                },
                function(resp) {
                    arrayDatos = resp
                    
                    if(arrayDatos != null){

                        for (var i = 0; i < arrayDatos.length; i++) {


                            arrayDatosOP = JSON.parse(arrayDatos[i].op)

                            var tablaOP = `
                            <table>
                                <thead>
                                    <th>OM</th>
                                    <th>OP</th>
                                    <th>Unidad</th>
                                    <th>Actividad</th>
                                    <th>Estado</th>
                                    <th># Pers.</th>
                                </thead>
                            <tbody>
                            `

                            for(var a=0; a<arrayDatosOP.length; a++){
                                tablaOP += `
                                <tr>
                                    <td>${arrayDatosOP[a].NUMOM}</td>
                                    <td>${arrayDatosOP[a].OP}</td>
                                    <td>${arrayDatosOP[a].UNIDAD}</td>
                                    <td>${arrayDatosOP[a].ACTIVIDADES}</td>
                                    <td>${arrayDatosOP[a].ESTADO}</td>
                                    <td>${arrayDatosOP[a].NUMP}</td>
                                     
                                </tr>
                                `
                            }

                            tablaOP += `
                            </tbody>
                            </table>
                            `

                            
    
                            html += `
                        <tr>
                            <td>
                                ${arrayDatos[i].fecha}
                            </td>
                            <td>
                                ${arrayDatos[i].supervisor}
                            </td>
                            <td>
                                ${arrayDatos[i].frente}
                            </td>
                            <td>
                                ${arrayDatos[i].turno}
                            </td>
                            
                            
                            <td>
                                 ${tablaOP}
                            </td>
                            
                             
                            <td>
                               <button class="btn btn-info" onclick="ver(${i})">Ver</button>
                            </td>
                             
                            
                          
    
                        </tr>
                    `
                        }

                        $('#datosTabla').html(html)
                        



                    }else{
                        $('#datosTabla').html(html)
                    }



                    

                    //cargarGrafica()
                })


        }

        function buscar() {
            Swal.fire({
                title: 'Búscar por fecha',
                html: `
                    <div class="row" style="width: 100%">
                        <div class="col-sm-6">
                            <label>Fecha inicial</label>
                            <input type="date" class="form-control" id="finicio">
                        </div>
                        <div class="col-sm-6">
                            <label>Fecha final</label>
                            <input type="date" class="form-control" id="ffin">
                        </div>

                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Buscar'

            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var finicio = $('#finicio').val()
                    var ffin = $('#ffin').val()
                    $.post(server + 'buscarListadoPcr.php', {
                            finicio: finicio,
                            ffin: ffin
                        },
                        function(resp) {
                            arrayDatos = resp
                            var html = ''
                            for (var i = 0; i < arrayDatos.length; i++) {
                                if (arrayDatos[i].resultado == 'undefined') {
                                    var result = 'N/A'
                                } else {
                                    var result = arrayDatos[i].resultado
                                }
                                html += `
                                <tr>
                                    <td>
                                        ${arrayDatos[i].ods}
                                    </td>
                                    <td>
                                        ${arrayDatos[i].nombres}
                                    </td>
                                    <td>
                                        ${arrayDatos[i].doc}
                                    </td>
                                    <td>
                                        ${arrayDatos[i].fechapcr}
                                    </td>
                                    
                                    <td>
                                        ${result}
                                    </td>
                                    <td>
                                        ${arrayDatos[i].asistencia}
                                    </td>
                                    <td>
                                        ${arrayDatos[i].motivo}
                                    </td>
                                    <td>`
                                if (arrayDatos[i].soporte != '') {
                                    html += `
                                            <a href="http://italco.tk/pruebapcr/server/pruebapcr/${arrayDatos[i].soporte}" target="_blank">
                                                <img src='img/buscar.png' height="50">
                                            </a>
                                            `
                                } else {
                                    html += `
                                            
                                                <img src='img/error.jpg' height="50">
                                            
                                            `
                                }
                                html += `
                                    </td>
                                

                                </tr>
                            `
                            }
                            $('#datosTabla').html(html)

                        })
                }
            })
        }

        function ver(i){
            datosBitacora.push({
                'fecha':arrayDatos[i].fecha,
                'numsem':numsem,
                'supervisor':arrayDatos[i].supervisor,
                'doc':arrayDatos[i].doc,
                'turno':arrayDatos[i].turno,
                'frente':arrayDatos[i].frente,
                'numtrab':arrayDatos[i].numtrab,
                'alcance':arrayDatos[i].alcance,
                'actividades':arrayDatos[i].actividades,
                'om':arrayDatos[i].om,
                'op':arrayDatos[i].op,
                'estado':arrayDatos[i].estado,
                'galeria':arrayDatos[i].galeria,
                'preguntas':arrayDatos[i].preguntas

            });

            localStorage.setItem('datosbitacora', JSON.stringify(datosBitacora))
            location = 'bitacoraresp.html'
        }
