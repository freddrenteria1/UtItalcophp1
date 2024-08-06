
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

cargarInfo()

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


