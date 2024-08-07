
var server = 'https://utitalco.com/cgm/server/'
var arrayDatos = []
var arrayItems = []


var user = sessionStorage.getItem('usermat');

if(user == null){
    location = 'login.html';
}else{
    var ods = sessionStorage.getItem('ods');
    $('#ods').html(ods)
    $('#ods2').html(ods)
    buscarCons()
}


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

function buscarCons(){
 
    $.post(server + 'bConsDev.php', 
    function(resp) {

        $('#nument').html('000'+resp.num)

    })
}

function buscar(){

    codigo = $('#codigob').val()
    numsol = $('#numsolb').val()
    posb = $('#posb').val()

    $.post(server + 'bCodigo.php', {codigo:codigo, numsol:numsol, posb:posb},
    function(resp) {

        if(resp != null){

            arrayDatos = resp
            console.log(resp)
    
            var html = `
                <tr>
                    <td>${arrayDatos.descripcion}</td>
                    <td>${arrayDatos.cm}</td>
                    <td>${arrayDatos.reserva}</td>
                    <td>${arrayDatos.posres}</td>
                    <td>${arrayDatos.numdoc}</td>
                    <td>${arrayDatos.ubicatec}</td>
                    <td>${arrayDatos.unidad}</td>
                    <td>${arrayDatos.cantsol}</td>
                    <td>${arrayDatos.cantrec}</td>
                    <td>
                        <input type="number" class="form-control" id="cantdev" value="0" style="width: 60px">
                        
                    </td>
                    <td>
                    <button class="btn btn-sm btn-success" onclick="agregarItem()">+</button>
                    </td>
                     
                </tr>
                `
    
            $('#tabMat').removeClass('oculto')
            $('#tabMat').addClass('visible')
            $('#mostrarMaterial').html(html)
        }else{
            mensaje('Información','Búsqueda sin resultados...')
        }

    })
}

function agregarItem(){

    var item = arrayItems.length + 1;
    cantdev =  $('#cantdev').val()

    cantrec = arrayDatos.cantrec

    if(cantdev <= cantrec && cantdev > 0){
        
        arrayItems.push({
            'item':item,
            'descripcion': arrayDatos.descripcion,
            'cm': arrayDatos.cm,
            'reserva': arrayDatos.reserva,
            'posres': arrayDatos.posres,
            'numdoc': arrayDatos.numdoc,
            'ubicatec': arrayDatos.ubicatec,
            'unidad': arrayDatos.unidad,
            'cantdev': cantdev
        })
    
        cargarItems()

    }else{
        mensaje('Error','Cantidad devuelta no puede ser mayor a la recibida ni puede ser 0...')
    }

}

function cargarItems(){
    var html = ''
    for(var i=0; i<arrayItems.length; i++){
        html += `
        <tr>
            <td>${arrayItems[i].item}</td>
            <td>${arrayItems[i].descripcion}</td>
            <td>${arrayItems[i].cm}</td>
            <td>${arrayItems[i].reserva}</td>
            <td>${arrayItems[i].posres}</td>
            <td>${arrayItems[i].numdoc}</td>
            <td>${arrayItems[i].ubicatec}</td>
            <td>${arrayItems[i].unidad}</td>         
            <td>${arrayItems[i].cantdev}</td> 
            <td>
            <button class="btn btn-sm btn-info" onclick="borrarItem(${i})">X</button>
            </td> 

    </tr>
        `
    }
    $('#tablaItems').html(html)

    $('#tabMat').removeClass('visible')
    $('#tabMat').addClass('oculto')

}

function borrarItem(index){
     
        arrayItems.splice(index, 1);
        cargarItems()
    
}

function guardar(){

    almacen = $('#almacen').val()
    obs = $('#obs').val()
    recibido = $('#recibido').val()
    registro = $('#registro').val()
    cargo = $('#cargo').val()

    console.log('Guardar')

    $.post(server + 'guardarDev.php', {ods:ods, user:user, almacen:almacen, obs:obs, recibido:recibido, registro:registro, cargo:cargo},
    function(resp){
        console.log(resp)

        if(resp.msn=='Ok'){
            guardarDetalles(resp.num)
        }else{
            mensaje('Error','Error en conexión no se ha almacenado la devolución...')
        }
    })


}

function guardarDetalles(num){

    items = JSON.stringify(arrayItems);
    
    $.post(server + 'guardarDevDet.php', {num:num, items:items},
    function(resp){
        console.log(resp)

        if(resp.msn=='Ok'){
             
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                html: 'Devolución almancenada correctamente...',
                showConfirmButton: false,
                timer: 1500
              }).then(()=>{
                location.reload()
              })

        }else{
            mensaje('Error','Error en conexión no se ha almacenado la devolución...')
        }
    })
}