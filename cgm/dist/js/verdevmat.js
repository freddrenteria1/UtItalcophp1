
var server = 'https://utitalco.com/cgm/server/'
var arrayDatos = []
var arrayItems = []


var user = sessionStorage.getItem('usermat');

if(user == null){
    location = 'login.html';
}else{
    var ods = sessionStorage.getItem('ods');
    $('#ods').html(ods)
    
}


function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

var idEnt = getParameterByName('id');

cargarDatos()


function mensaje(title, msn){
    $.toast({
        heading: title,
        text: msn,
        position: 'top-right',
        loaderBg:'#e69a2a',
        icon: 'info',
        hideAfter: 2500, 
        stack: 6
    });
}

function cargando() {
    let timerInterval
    Swal.fire({
        title: 'Cargando...!',
        html: 'Un momento por favor...',
        timer: 50000,
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

 

function cargarDatos(){
    mensaje('Cargando...', 'Sincronizando información...')

    $.post(server + 'cargarDevolucion.php', {id:idEnt},
    function(resp) {
        arrayDatos = resp
        console.log(resp)

        if(arrayDatos.id < 10){
            $('#nument').html('000'+arrayDatos.id)
        }

        if(arrayDatos.id < 100 && arrayDatos.id > 9){
            $('#nument').html('00'+arrayDatos.id)
        }


        $('#fecha').html(arrayDatos.fecha)
        $('#almacen').html(arrayDatos.almacen)

        $('#obs').html(arrayDatos.observaciones)
       
        $('#realizado').val(arrayDatos.realizado)
        $('#cc').val(arrayDatos.ccr)
        $('#cargor').val(arrayDatos.cargor)
        var firmar =`<img src="`+arrayDatos.firmarr+`" height="40px">`
        $('#firmarr').html(firmar)

        $('#recibido').val(arrayDatos.recibido)
        $('#registro').val(arrayDatos.rega)
        $('#cargoa').val(arrayDatos.cargoa)
        $('#firmaa').val(arrayDatos.firmaa)      

        arrayItems =  arrayDatos.items

        var html = ''

        for(var i=0; i<arrayItems.length; i++){
            html += `
            <tr>
                <td>${arrayItems[i].item}</td>
                <td>${arrayItems[i].descripcion}</td>
                <td>${arrayItems[i].codigo}</td>
                <td>${arrayItems[i].solicitud}</td>
                <td>${arrayItems[i].pos}</td>
                <td>${arrayItems[i].numdoc}</td>
                <td>${arrayItems[i].loca}</td>
                <td>${arrayItems[i].unidad}</td>
                <td>${arrayItems[i].cant}</td>
            </tr>
            `
        }

        $('#tablaItems').html(html)
         

        

                

    })
}


 