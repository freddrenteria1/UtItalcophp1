
var server = 'https://utitalco.com/cgm/server/'
var arrayDatos = []
var arrayItems = []
var numdoc = null


var user = sessionStorage.getItem('usermat');

if(user == null){
    location = 'login.html';
}else{
    var ods = sessionStorage.getItem('ods');
    $('#ods').html(ods)
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
 
    $.post(server + 'bConsEnt.php', 
    function(resp) {

        $('#nument').html('000'+resp.num)

    })
}

function buscar(){

    codigo = $('#codigob').val()
    numsol = $('#numsolb').val()
    posb = $('#posb').val()
    numdoc = $('#ndoc').val()

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
                    <td>${arrayDatos.ordenmtto}</td>
                    <td>${numdoc}</td>
                    <td>${arrayDatos.equipo}</td>
                    <td>${arrayDatos.cantreq}</td>
                    <td>${arrayDatos.unidad}</td>
                    <td> <input type="text" class="form-control" id="obsitem" style="width: 200px;"></td>
                    <td> <input type="date" class="form-control" id="fechareserva" style="width: 130px;" ></td>
                    <td>
                        <input type="number" class="form-control" id="cantrec" value="0" style="width: 60px">
                        
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
    cantrec =  $('#cantrec').val()
    cantreq = arrayDatos.cantreq
    var obsitem = $('#obsitem').val();
    var fechareserva = $('#fechareserva').val();

    
    if(cantrec <= cantreq && cantrec > 0 ){

        saldo = cantreq - cantrec
    
        arrayItems.push({
            'item':item,
            'descripcion': arrayDatos.descripcion,
            'cm': arrayDatos.cm,
            'reserva': arrayDatos.reserva,
            'posres': arrayDatos.posres,
            'ordenmtto': arrayDatos.ordenmtto,
            'numdoc':numdoc,
            'equipo': arrayDatos.equipo,
            'cantreq': arrayDatos.cantreq,
            'cantrec': cantrec,
            'saldo': saldo,
            'unidad': arrayDatos.unidad,
            'obsadicional': obsitem,
            'fechareserva':fechareserva
        })
    
        cargarItems()

    }else{
        mensaje('Error','Cantidad recibida no puede ser mayor a la requerida ni puede ser 0...')
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
            <td>${arrayItems[i].ordenmtto}</td>
            <td>${arrayItems[i].numdoc}</td>
            <td>${arrayItems[i].equipo}</td>
            <td>${arrayItems[i].cantreq}</td>
            <td>${arrayItems[i].cantrec}</td>
            <td>${arrayItems[i].saldo}</td>
            <td>${arrayItems[i].unidad}</td>         
            <td>${arrayItems[i].obsadicional} </td> 
            <td>${arrayItems[i].fechareserva} </td> 
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
    documento = $('#doc').val()
    inspeccion = $('#insp').val()
    
    if($('#estadoconf').is(":checked")){
        estado = 'Conforme'
    }else{
        estado = 'No conforme'
    }

    acciones = $('#acciones').val()
    almac = $('#almac').val()
    obsgen = $('#obsgen').val()
    aprob = $('#aprobado').val()
    registro = $('#registro').val()
    cargo = $('#cargo').val()

    fecha = $('#fecha').val()

    console.log('Guardar')

    $.post(server + 'guardarEntrada.php', {ods:ods, fecha:fecha, user:user, documento:documento, inspeccion:inspeccion, estado:estado, acciones:acciones, almac:almac, obsgen:obsgen, aprob:aprob, registro:registro, cargo:cargo},
    function(resp){
        console.log(resp)

        if(resp.msn=='Ok'){
            guardarDetalles(resp.num)
        }else{
            mensaje('Error','Error en conexión no se ha almacenado la entrada...')
        }
    })


}

function guardarDetalles(num){

    items = JSON.stringify(arrayItems);
    fecha = $('#fecha').val()
    
    $.post(server + 'guardarEntradaDet.php', {num:num, fecha:fecha, items:items},
    function(resp){
        console.log(resp)

        if(resp.msn=='Ok'){
             
            

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                html: 'Entrada almancenada correctamente...',
                showConfirmButton: false,
                timer: 1500
              }).then(()=>{
                location.reload()
              })

        }else{
            mensaje('Error','Error en conexión no se ha almacenado la entrada...')
        }
    })
}