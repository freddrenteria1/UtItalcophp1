
var odsq = null
var server = "https://utitalco.com/031/server/";

// crea un nuevo objeto `Date`
var today = new Date();

// `getDate()` devuelve el día del mes (del 1 al 31)
var day = today.getDate();

// `getMonth()` devuelve el mes (de 0 a 11)
var month = today.getMonth() + 1;

// `getFullYear()` devuelve el año completo
var year = today.getFullYear();

// muestra la fecha de hoy en formato `MM/DD/YYYY`
var fechaact = `${month}/${day}/${year}`

var arrayPersonal = []
var arrayPermisos = []


        //CALUCLO DE SEMANA

        var numsem = null

        var semana = null
        var frente = null

        

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
            $('#dias').html(numero)

           

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
            $('#infno').html(numero)
            $('#dias').html(numero)

            sessionStorage.setItem('semana',numero)

            var mes = fecha.getMonth()+1;
            console.log('Mes '+mes)

            if(mes==1){
                mes = 'Enero'
            }

            if(mes==2){
                mes = 'Febrero'
            }

            if(mes==3){
                mes = 'Marzo'
            }

            if(mes==4){
                mes = 'Abril'
            }

            if(mes==5){
                mes = 'Mayo'
            }

            if(mes==6){
                mes = 'Junio'
            }

            if(mes==7){
                mes = 'Julio'
            }

            if(mes==8){
                mes = 'Agosto'
            }

            if(mes==9){
                mes = 'Septiembre'
            }

            if(mes==10){
                mes = 'Octubre'
            }

            if(mes==11){
                mes = 'Noviembre'
            }

            if(mes==12){
                mes = 'Diciembre'
            }

            $('#mes').html(mes)

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


//cargarInfo()

function cargarInfo(){
    $.post(server+'verInfo.php',{},
    function(resp){
        console.log(resp)
        
        // $('#diasprog').html(resp.dias)
        // $('#dias').html(resp.diastrans)
        // $('#diastrans').html(resp.porcdias + '%')
        // $('#diasfaltantes').html(resp.diasfaltantes)
        // $('#avanceprog').html(resp.avanceprog)
        // $('#avance').html(resp.avanceeje)
        // $('#desv').html(resp.avancedesv)
        // $('#progruta').html(resp.rutaprog)
        // $('#avanceruta').html(resp.rutaeje)
        // $('#desvruta').html(resp.rutadesv)

        // $('#infno').html(resp.dias)
        $('#fechainfo').html(fechaact)
        $('#fechacorte').html(fechaact)


    })
}

solFecha()

        function solFecha(){
            Swal.fire({
                title: "Fecha a Consultar",
                html: `
                <p>Fecha: <input type="date" id="fechadiario" onchange="calSemDia(this)"> | Semana # <span id="semdia"></span> </p>
                `,
                showCancelButton: true,
                confirmButtonText: "Cosultar",
                cancelButtonText: `Cancelar`,
                allowOutsideClick: false,
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {

                    var fecha = $('#fechadiario').val()

                    $('#fechainfo').html(fecha)
                    $('#fechacorte').html(fecha)

                    sessionStorage.setItem('fecha',fecha)

                    

                     

                    if(fecha != ""){
                         
                        $.post(server+'cargarPersonal.php', {fecha:fecha},
                        function(resp){
                            console.log(resp)

                            arrayPersonal = resp.personal
                            arrayPermisos = resp.permisos

                            $('#totp').html(arrayPersonal.totp)
                            $('#pdir').html(arrayPersonal.pdir)
                            $('#pindir').html(arrayPersonal.pindir)

                            $('#totpemisos').html(arrayPermisos.totp)
                            $('#pabiertos').html(arrayPermisos.pabiertos)
                            $('#pcerrados').html(arrayPermisos.pcerrados)
                            
                            
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


